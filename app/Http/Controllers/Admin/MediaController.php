<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function index()
    {
        $images = $this->getAllImages();
        return view('admin.media.index', compact('images'));
    }

    public function getImagesJson()
    {
        $images = $this->getAllImages();
        return response()->json($images);
    }

    private function getAllImages()
    {
        $images = [];
        
        // 1. Scan public/uploads directory
        $publicUploadsDir = public_path('uploads');
        if (File::exists($publicUploadsDir)) {
            $files = File::allFiles($publicUploadsDir);
            foreach ($files as $file) {
                 $extension = strtolower($file->getExtension());
                 if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) {
                     $relativePath = str_replace(public_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                     $relativePath = str_replace('\\', '/', $relativePath);
                     $images[] = [
                        'url' => asset($relativePath),
                        'name' => $file->getFilename(),
                        'size' => $file->getSize(),
                        'relative_path' => $relativePath
                     ];
                 }
            }
        }

        // 2. Scan public/storage directory
        if (Storage::disk('public')->exists('')) {
            $storageFiles = Storage::disk('public')->allFiles();
            foreach($storageFiles as $file) {
                try {
                    $mime = Storage::disk('public')->mimeType($file);
                    if(str_starts_with($mime, 'image/')) {
                        $images[] = [
                            'url' => Storage::url($file),
                            'name' => basename($file),
                            'size' => Storage::disk('public')->size($file),
                            'relative_path' => 'storage/' . $file
                        ];
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
        
        // Sort by newest first (using file mtime)
        usort($images, function($a, $b) {
            $fileA = public_path($a['relative_path']);
            $fileB = public_path($b['relative_path']);
            return (file_exists($fileB) ? filemtime($fileB) : 0) <=> (file_exists($fileA) ? filemtime($fileA) : 0);
        });
        
        return $images;
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/media'), $filename);
                $path = 'uploads/media/' . $filename;
                
                $uploadedImages[] = [
                    'url' => asset($path),
                    'relative_path' => $path
                ];
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true, 
                    'message' => count($uploadedImages) . ' images uploaded successfully!',
                    'images' => $uploadedImages
                ]);
            }
            
            return back()->with('success', count($uploadedImages) . ' images uploaded successfully!');
        }

        if ($request->ajax()) {
             return response()->json(['success' => false, 'message' => 'Upload failed'], 400);
        }

        return back()->with('error', 'Please select images to upload.');
    }

    public function destroy($relativePath)
    {
        if (str_contains($relativePath, '..')) {
             return back()->with('error', 'Invalid path.');
        }

        $fullPath = public_path($relativePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
            return back()->with('success', 'Image deleted successfully.');
        }

        return back()->with('error', 'Image not found.');
    }
}
