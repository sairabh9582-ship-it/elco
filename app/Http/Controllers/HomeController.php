<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Category;
use App\Models\Product;

use Addons\Coupon\Models\Coupon;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->get();
        $services = Service::where('status', true)->get();
        $categories = Category::all();
        $products = Product::all();
        $newArrivals = Product::where('is_new_arrival', true)->latest()->take(8)->get();
        $featuredProducts = Product::where('is_featured', true)->latest()->take(8)->get();
        $topSellingProducts = Product::where('is_best_selling', true)->latest()->take(8)->get();
        $offerBanners = Banner::where('position', 'like', 'product-offer%')->get();
        $bottomBanners = Banner::where('position', 'like', 'bottom%')->get();

        return view('home', compact('sliders', 'services', 'categories', 'products', 'newArrivals', 'featuredProducts', 'topSellingProducts', 'offerBanners', 'bottomBanners'));
    }

    public function product_detail(Product $product)
    {
        $meta_title = $product->meta_title ?? $product->name;
        $meta_description = $product->meta_description ?? \Illuminate\Support\Str::limit($product->description, 160);
        $meta_keywords = $product->meta_keywords;
        
        $coupons = collect();
        if (class_exists(Coupon::class)) {
            $coupons = Coupon::where('status', true)
                ->whereDate('expiry_date', '>=', now())
                ->where(function ($query) {
                        $query->whereDate('start_date', '<=', now())
                              ->orWhereNull('start_date');
                    })
                ->get()
                ->filter(function ($coupon) use ($product) {
                    if ($coupon->target_type == 'product') {
                        return in_array($product->id, $coupon->target_ids ?? []);
                    }
                    if ($coupon->target_type == 'category') {
                        return in_array($product->category_id, $coupon->target_ids ?? []);
                    }
                    return false;
                });
        }

        return view('product_detail', compact('product', 'meta_title', 'meta_description', 'meta_keywords', 'coupons'));
    }

    public function category_detail(Category $category)
    {
        $products = $category->products;
        $meta_title = $category->meta_title ?? $category->name;
        $meta_description = $category->meta_description ?? 'Shop ' . $category->name . ' at Electro';
        $meta_keywords = $category->meta_keywords;

        return view('category_detail', compact('category', 'products', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function shop()
    {
        $products = Product::latest()->paginate(9);
        return view('shop', compact('products'));
    }
}
