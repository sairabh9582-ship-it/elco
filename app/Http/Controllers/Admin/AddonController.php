<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    public function index()
    {
        $addons = \App\Models\Addon::all();
        return view('admin.addons.index', compact('addons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'addon_file' => 'required|file|mimes:zip|max:10240', // 10MB limit
            'purchase_code' => 'required|string|min:10',
        ]);

        // Purchase Code Verification Logic (Hash-based)
        $purchaseCode = $request->purchase_code;
        $hashedCode = '744bd79e71cad349a845d3bfdded020890a5234854979ecc409478fa9f68576d'; // SHA-256 Hash of the code

        if (hash('sha256', $purchaseCode) !== $hashedCode) {
            return back()->with('error', 'Invalid Purchase Code. Please provide a valid license to install this addon.');
        }

        if ($request->hasFile('addon_file')) {
            $zipFile = $request->file('addon_file');
            $originalName = pathinfo($zipFile->getClientOriginalName(), PATHINFO_FILENAME);
            
            $zip = new \ZipArchive;
            $res = $zip->open($zipFile->getPathname());
            
            if ($res === TRUE) {
                // Extract to a temporary location first
                $tempId = uniqid();
                $tempPath = storage_path('app/temp/addons/' . $tempId);
                
                if (!file_exists($tempPath)) {
                    mkdir($tempPath, 0777, true);
                }

                $zip->extractTo($tempPath);
                $zip->close();
                
                // Check if the extracted content is a single folder or loose files
                $files = scandir($tempPath);
                $files = array_values(array_diff($files, ['.', '..', '__MACOSX'])); // Exclude common junk
                
                $sourcePath = $tempPath;
                $targetFolderName = ucfirst($originalName);
                
                // If only one item and it's a directory, allow it to define the addon name/structure
                if (count($files) === 1 && is_dir($tempPath . '/' . $files[0])) {
                     $sourcePath = $tempPath . '/' . $files[0];
                     // Use the folder name from inside zip if it matches expectations, 
                     // or purely rely on zip name? 
                     // Let's prefer the inner folder name if it's meant to be the ID.
                     $targetFolderName = $files[0];
                }
                
                // Define final destination
                $finalPath = base_path('addons/' . $targetFolderName);
                
                // Cleanup existing if necessary
                if (file_exists($finalPath)) {
                    \Illuminate\Support\Facades\File::deleteDirectory($finalPath);
                }
                
                // Move to addons/Folder
                \Illuminate\Support\Facades\File::moveDirectory($sourcePath, $finalPath, true);
                
                // Cleanup partial temp
                if (file_exists($tempPath)) {
                    \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/temp/addons'));
                }

                // Register Logic
                // If the folder is "Wholesale" (case-insensitive check or normalized)
                if (strtolower($targetFolderName) === 'wholesale' && file_exists(base_path('addons/' . $targetFolderName))) {
                     \App\Models\Addon::updateOrCreate(
                        ['unique_identifier' => 'wholesale'],
                        [
                            'name' => 'Wholesale Products', 
                            'version' => '1.0', 
                            'status' => true,
                            'description' => 'Wholesale product management.'
                        ]
                    );

                    return back()->with('success', 'Addon installed successfully!');
                }

                if (strtolower($targetFolderName) === 'coupon' && file_exists(base_path('addons/' . $targetFolderName))) {
                     \App\Models\Addon::updateOrCreate(
                        ['unique_identifier' => 'coupon'],
                        [
                            'name' => 'Coupon System', 
                            'version' => '1.0', 
                            'status' => true,
                            'description' => 'Manage discount coupons and promotions.'
                        ]
                    );

                    return back()->with('success', 'Coupon Addon installed successfully!');
                }

                if (strtolower($targetFolderName) === 'currency' && file_exists(base_path('addons/' . $targetFolderName))) {
                     \App\Models\Addon::updateOrCreate(
                        ['unique_identifier' => 'currency'],
                        [
                            'name' => 'Currency Manager', 
                            'version' => '1.0', 
                            'status' => true,
                            'description' => 'Manage multiple currencies and set defaults.'
                        ]
                    );

                    return back()->with('success', 'Currency Addon installed successfully!');
                }

                // Payment Gateways Registration
                $paymentGateways = [
                    'razorpay' => 'Razorpay Payment Gateway',
                    'stripe'   => 'Stripe Payment Gateway',
                    'paypal'   => 'PayPal Payment Gateway',
                    'phonepe'  => 'PhonePe Payment Gateway',
                    'paytm'    => 'Paytm Payment Gateway',
                ];

                $lowerFolderName = strtolower($targetFolderName);
                if (array_key_exists($lowerFolderName, $paymentGateways) && file_exists(base_path('addons/' . $targetFolderName))) {
                    \App\Models\Addon::updateOrCreate(
                        ['unique_identifier' => $lowerFolderName],
                        [
                            'name' => $paymentGateways[$lowerFolderName],
                            'version' => '1.0',
                            'status' => true,
                            'description' => 'Enable ' . $paymentGateways[$lowerFolderName] . ' for your checkout.'
                        ]
                    );

                    return back()->with('success', $paymentGateways[$lowerFolderName] . ' installed and registered successfully!');
                }
                
                // Fallback for other addons (generic registration)
                if (file_exists(base_path('addons/' . $targetFolderName))) {
                     \App\Models\Addon::updateOrCreate(
                        ['unique_identifier' => $lowerFolderName],
                        [
                            'name' => ucfirst($targetFolderName), 
                            'version' => '1.0', 
                            'status' => true,
                            'description' => 'Custom addon installed via zip.'
                        ]
                    );
                    return back()->with('success', 'Addon ' . $targetFolderName . ' installed and registered successfully!');
                }
                
                return back()->with('warning', 'Addon extracted but installation verification failed.');
            } else {
                return back()->with('error', 'Failed to open zip file.');
            }
        }

        return back()->with('error', 'Please upload a valid zip file.');
    }

    public function destroy($id)
    {
        $addon = \App\Models\Addon::findOrFail($id);
        
        // Delete folder
        $path = base_path('addons/' . ucfirst($addon->unique_identifier)); // e.g. addons/Wholesale
        if (file_exists($path)) {
            \Illuminate\Support\Facades\File::deleteDirectory($path);
        }
        
        $addon->delete();
        
        return back()->with('success', 'Addon removed successfully.');
    }
}
