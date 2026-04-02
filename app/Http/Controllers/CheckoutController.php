<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Http;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach($cart as $id => $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }

        $discount = 0;
        $coupon_code = $request->coupon_code;
        $coupon_data = null; 

        if ($coupon_code) {
             // Logic repeated from CartController. Ideally move to Service/Helper.
             // For now, simple fetch.
             if (class_exists(\Addons\Coupon\Models\Coupon::class)) {
                  $coupon = \Addons\Coupon\Models\Coupon::where('code', $coupon_code)
                    ->where('status', true)
                    ->whereDate('expiry_date', '>=', now())
                    ->first();
                  
                  if ($coupon) {
                       // Min spend check
                       if (!$coupon->min_spend || $subtotal >= $coupon->min_spend) {
                            if ($coupon->type == 'fixed') {
                                $discount = $coupon->value;
                            } else {
                                $discount = ($subtotal * $coupon->value) / 100;
                            }
                            // Cap discount
                            if($discount > $subtotal) $discount = $subtotal;
                            
                            $coupon_data = $coupon;
                       }
                  }
             }
        }
        
        $total = $subtotal - $discount;

        $gateways = PaymentGateway::where('status', true)->get();

        return view('checkout', compact('cart', 'subtotal', 'discount', 'total', 'gateways', 'coupon_data'));
    }

    // Razorpay functionality moved to Addons\Razorpay\Controllers\RazorpayController
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'post_code' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'razorpay_payment_id' => 'nullable|string',
            'header_razorpay_order_id' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $orderData = $validated;
        $orderData['total_amount'] = $total;
        $orderData['status'] = 'pending';
        $orderData['status'] = 'pending';
        $orderData['user_id'] = Auth::id() ?? null;
        
        if ($request->payment_method === 'Razorpay') {
             if (empty($request->razorpay_payment_id)) {
                 return redirect()->back()->with('error', 'Payment failed or cancelled. Please try again.');
             }
             $orderData['payment_id'] = $request->razorpay_payment_id;
             $orderData['payment_method'] = 'Razorpay';
             if ($request->razorpay_payment_id) {
                 $orderData['status'] = 'processing';
             }
        } else {
             $orderData['payment_method'] = $request->payment_method;
        }

        $order = Order::create($orderData);

        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully! Order ID: #' . $order->id);
    }
}
