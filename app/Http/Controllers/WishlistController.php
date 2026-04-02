<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist', compact('wishlistItems'));
    }

    public function add($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to wishlist.');
        }

        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->exists();

        if ($exists) {
            return back()->with('error', 'Item is already in your wishlist!');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);

        return back()->with('success', 'Item added to wishlist successfully!');
    }

    public function remove($productId)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        return back()->with('success', 'Item removed from wishlist!');
    }
}
