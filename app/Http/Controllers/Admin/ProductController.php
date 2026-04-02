<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable', 
            'media_image' => 'nullable|string',
            'label' => 'nullable|string|max:50',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = 'storage/' . $path;
        } elseif ($request->filled('media_image')) {
            $validated['image'] = $request->media_image;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable', 
            'media_image' => 'nullable|string',
            'label' => 'nullable|string|max:50',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Fix: If no new image is provided, don't wipe existing image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = 'storage/' . $path;
        } elseif ($request->filled('media_image')) {
            $validated['image'] = $request->media_image;
        } else {
            // Keep the original image from the database if no new choice is made
            $validated['image'] = $product->image;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * This is a POST fallback for environments that block PUT
     */
    public function updatePost(Request $request, Product $product)
    {
        return $this->update($request, $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Request $request, Product $product)
    {
        $field = $request->input('field');
        if (in_array($field, ['is_featured', 'is_new_arrival', 'is_best_selling'])) {
            $product->$field = $product->$field ? 0 : 1;
            $product->save();
            return response()->json(['success' => true, 'new_status' => $product->$field]);
        }
        return response()->json(['success' => false, 'message' => 'Invalid field'], 400);
    }
}
