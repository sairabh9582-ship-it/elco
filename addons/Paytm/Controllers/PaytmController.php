<?php

namespace Addons\Paytm\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;

class PaytmController extends Controller
{
    public function createPayment(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $gateway = PaymentGateway::where('code', 'paytm')->first();
        if(!$gateway || !$gateway->status) {
            return response()->json(['error' => 'Paytm not configured'], 400);
        }

        // Paytm integration typically requires vendor SDK for checksum
        // Here we provide the registration logic
        return response()->json(['message' => 'Paytm integration initiated. Please include Paytm SDK.']);
    }

    public function callback(Request $request)
    {
        return redirect()->route('home')->with('success', 'Paytm payment processed.');
    }
}
