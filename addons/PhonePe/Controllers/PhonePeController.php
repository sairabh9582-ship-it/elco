<?php

namespace Addons\PhonePe\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Http;

class PhonePeController extends Controller
{
    public function createPayment(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $gateway = PaymentGateway::where('code', 'phonepe')->first();
        if(!$gateway || !$gateway->status) {
            return response()->json(['error' => 'PhonePe not configured'], 400);
        }

        $merchantId = $gateway->settings['merchant_id'] ?? '';
        $saltKey = $gateway->settings['salt_key'] ?? '';
        $saltIndex = $gateway->settings['salt_index'] ?? '1';
        $env = $gateway->settings['env'] ?? 'sandbox';

        $baseUrl = ($env === 'production') ? 'https://api.phonepe.com/apis/hermes' : 'https://api-preprod.phonepe.com/apis/pg-sandbox';
        
        $orderId = 'ORD' . time();
        $payload = [
            'merchantId' => $merchantId,
            'merchantTransactionId' => $orderId,
            'merchantUserId' => 'U' . (auth()->id() ?? 'GUEST'),
            'amount' => $total * 100, // in paise
            'redirectUrl' => route('checkout.phonepe.callback'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('checkout.phonepe.callback'),
            'paymentInstrument' => ['type' => 'PAY_PAGE'],
        ];

        $encodedPayload = base64_encode(json_encode($payload));
        $stringToHash = $encodedPayload . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $stringToHash);
        $checksum = $sha256 . '###' . $saltIndex;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $checksum,
            'accept' => 'application/json',
        ])->post($baseUrl . '/pg/v1/pay', [
            'request' => $encodedPayload,
        ]);

        if ($response->successful()) {
            return response()->json([
                'url' => $response->json()['data']['instrumentResponse']['redirectInfo']['url']
            ]);
        }

        return response()->json(['error' => 'PhonePe Initiative Failed'], 500);
    }

    public function callback(Request $request)
    {
        // Handle PhonePe callback logic here
        return redirect()->route('home')->with('success', 'PhonePe payment processed.');
    }
}
