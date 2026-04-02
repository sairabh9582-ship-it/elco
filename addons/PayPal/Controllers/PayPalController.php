<?php

namespace Addons\PayPal\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Http;

class PayPalController extends Controller
{
    private function getAccessToken($clientId, $clientSecret)
    {
        $response = Http::withBasicAuth($clientId, $clientSecret)
            ->asForm()
            ->post('https://api-m.sandbox.paypal.com/v1/oauth2/token', [
                'grant_type' => 'client_credentials'
            ]);

        return $response->json()['access_token'] ?? null;
    }

    public function createOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $gateway = PaymentGateway::where('code', 'paypal')->first();
        if(!$gateway || !$gateway->status) {
            return response()->json(['error' => 'PayPal not configured'], 400);
        }

        $clientId = $gateway->settings['client_id'] ?? null;
        $clientSecret = $gateway->settings['client_secret'] ?? null;

        $token = $this->getAccessToken($clientId, $clientSecret);
        if(!$token) return response()->json(['error' => 'PayPal Auth Failed'], 500);

        $response = Http::withToken($token)
            ->post('https://api-m.sandbox.paypal.com/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD', // Need to handle currency dynamic later
                        'value' => number_format($total, 2, '.', '')
                    ]
                ]],
                'application_context' => [
                    'return_url' => route('checkout.index'),
                    'cancel_url' => route('checkout.index')
                ]
            ]);

        return response()->json($response->json());
    }

    public function captureOrder(Request $request)
    {
        $orderId = $request->get('orderID');
        
        $gateway = PaymentGateway::where('code', 'paypal')->first();
        $clientId = $gateway->settings['client_id'] ?? null;
        $clientSecret = $gateway->settings['client_secret'] ?? null;

        $token = $this->getAccessToken($clientId, $clientSecret);
        
        $response = Http::withToken($token)
            ->post("https://api-m.sandbox.paypal.com/v2/checkout/orders/{$orderId}/capture");

        if ($response->successful() && $response->json()['status'] === 'COMPLETED') {
            return response()->json(['status' => 'success', 'data' => $response->json()]);
        }

        return response()->json(['status' => 'error'], 500);
    }
}
