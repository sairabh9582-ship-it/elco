<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use Addons\Coupon\Models\Coupon;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        
        // Recalculate prices based on wholesale rules
        foreach($cart as $id => &$details) {
            $product = Product::find($id);
            if ($product) {
                $details['price'] = $product->getWholesalePrice($details['quantity']);
            }
            $subtotal += $details['price'] * $details['quantity'];
        }
        session()->put('cart', $cart);

        $formatted_subtotal = $subtotal; // For view
        $discount = 0;
        $coupon_code = null;
        
        if (session()->has('coupon')) {
            $coupon = session()->get('coupon');
            $coupon_code = $coupon['code'];
            
            // Validate functionality again just in case (e.g. min spend)
            if (isset($coupon['min_spend']) && $subtotal < $coupon['min_spend']) {
                session()->forget('coupon');
                $discount = 0;
            } else {
                if ($coupon['type'] == 'fixed') {
                    $discount = $coupon['value'];
                } else {
                    $discount = ($subtotal * $coupon['value']) / 100;
                }
            }
        }
        
        // Ensure discount doesn't exceed total
        if($discount > $subtotal) $discount = $subtotal;
        
        $total = $subtotal - $discount;

        $coupons = collect();
        if (class_exists(Coupon::class)) {
            $coupons = Coupon::where('status', true)
                ->whereDate('expiry_date', '>=', now())
                ->where(function ($query) {
                        $query->whereDate('start_date', '<=', now())
                              ->orWhereNull('start_date');
                    })
                ->whereIn('target_type', ['total_order', 'welcome'])
                ->get();
        }

        // Pass variables to view. Note: 'total' is now final total, 'subtotal' is original.
        // We will send 'total' as the final pay amount.
        return view('cart', compact('cart', 'subtotal', 'discount', 'total', 'coupons', 'coupon_code'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if(isset($cart[$id])) {
            if ($request->has('quantity')) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id]['quantity']++;
            }
            $cart[$id]['price'] = $product->getWholesalePrice($cart[$id]['quantity']);
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->getWholesalePrice($quantity),
                "image" => $product->image,
                "slug" => $product->slug
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $product = Product::find($request->id);
            
            $cart[$request->id]["quantity"] = $request->quantity;
            
            if ($product) {
                $cart[$request->id]["price"] = $product->getWholesalePrice($request->quantity);
            }

            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
            session()->reflash(); // Keep coupon active during update reload
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
            return response()->json(['success' => true]);
        }
    }
    
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        if (!class_exists(Coupon::class)) {
            return redirect()->back()->with('error', 'Coupon system not active.');
        }

        $coupon = Coupon::where('code', $request->coupon_code)
                    ->where('status', true)
                    ->whereDate('expiry_date', '>=', now())
                    ->where(function ($query) {
                        $query->whereDate('start_date', '<=', now())
                              ->orWhereNull('start_date');
                    })
                    ->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid or expired coupon code.');
        }

        // Calculate current cart total
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        if ($coupon->min_spend && $total < $coupon->min_spend) {
             return redirect()->back()->with('error', 'Minimum spend of ' . $coupon->min_spend . ' required.');
        }

        // Store coupon in session
        session()->flash('coupon', [ // Use flash to remove on refresh/navigation
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'min_spend' => $coupon->min_spend,
            'target_type' => $coupon->target_type,
            'target_ids' => $coupon->target_ids
        ]);

        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }
}
