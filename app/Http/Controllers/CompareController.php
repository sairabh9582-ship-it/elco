<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompareController extends Controller
{
    public function index()
    {
        $compareIds = Session::get('compare_products', []);
        $products = Product::whereIn('id', $compareIds)->get();
        return view('compare', compact('products'));
    }

    public function add($productId)
    {
        $compare = Session::get('compare_products', []);

        if (in_array($productId, $compare)) {
            return back()->with('error', 'Item already added to compare list!');
        }

        if (count($compare) >= 3) {
            return back()->with('error', 'You can compare only up to 3 products at a time!');
        }

        array_push($compare, $productId);
        Session::put('compare_products', $compare);

        return back()->with('success', 'Item added to compare list!');
    }

    public function remove($productId)
    {
        $compare = Session::get('compare_products', []);
        
        if (($key = array_search($productId, $compare)) !== false) {
            unset($compare[$key]);
            Session::put('compare_products', array_values($compare));
        }

        return back()->with('success', 'Item removed from compare list!');
    }
}
