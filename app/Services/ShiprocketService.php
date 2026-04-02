<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use App\Models\SiteSetting;

class ShiprocketService
{
    private $baseUrl = 'https://apiv2.shiprocket.in/v1/external';
    private $email;
    private $password;

    public function __construct()
    {
        $setting = SiteSetting::first();
        $this->email = $setting->shiprocket_email ?? env('SHIPROCKET_EMAIL');
        $this->password = $setting->shiprocket_password ?? env('SHIPROCKET_PASSWORD');
    }

    public function login()
    {
        if (Cache::has('shiprocket_token')) {
            return Cache::get('shiprocket_token');
        }

        $response = Http::post("{$this->baseUrl}/auth/login", [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            $token = $response->json()['token'];
            // Cache token for 24 hours (or less as per expiry)
            Cache::put('shiprocket_token', $token, 60 * 60 * 24); 
            return $token;
        }

        return null;
    }

    public function createOrder($order)
    {
        $token = $this->login();

        if (!$token) {
            return ['error' => 'Authentication failed. Please check credentials.'];
        }

        // Map Order Items
        $orderItems = [];
        foreach ($order->items as $item) {
            $orderItems[] = [
                'name' => $item->product ? $item->product->name : 'Product',
                'sku' => $item->product_id, // Assuming ID as SKU for now
                'units' => $item->quantity,
                'selling_price' => $item->price,
                'discount' => 0,
                'tax' => 0,
                'hsn' => 0,
            ];
        }

        // Prepare Payload
        $payload = [
            'order_id' => $order->id,
            'order_date' => $order->created_at->format('Y-m-d H:i'),
            'pickup_location' => 'Primary', // Must be configured in Shiprocket Panel
            'billing_customer_name' => $order->first_name,
            'billing_last_name' => $order->last_name,
            'billing_address' => $order->address,
            'billing_city' => $order->city,
            'billing_pincode' => $order->post_code,
            'billing_state' => 'State', // You might need to add State to checkout!
            'billing_country' => $order->country,
            'billing_email' => $order->email,
            'billing_phone' => $order->phone,
            'shipping_is_billing' => true,
            'order_items' => $orderItems,
            'payment_method' => $order->payment_method == 'COD' ? 'COD' : 'Prepaid',
            'shipping_charges' => 0,
            'giftwrap_charges' => 0,
            'transaction_charges' => 0,
            'total_discount' => 0,
            'sub_total' => $order->total_amount,
            'length' => 10,
            'breadth' => 10,
            'height' => 10,
            'weight' => 0.5, // Default weight
        ];

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/orders/create/adhoc", $payload);

        return $response->json();
    }
    public function cancelOrder($shiprocketOrderId)
    {
        $token = $this->login();
        if (!$token) return ['error' => 'Auth failed'];

        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/orders/cancel", [
                'ids' => [$shiprocketOrderId]
            ]);

        return $response->json();
    }

    public function createReturnOrder($order)
    {
        $token = $this->login();
        if (!$token) return ['error' => 'Auth failed'];

        $orderItems = [];
        foreach ($order->items as $item) {
            $orderItems[] = [
                'name' => $item->product ? $item->product->name : 'Product',
                'sku' => $item->product_id,
                'units' => $item->quantity,
                'selling_price' => $item->price,
                'discount' => 0,
                'tax' => 0,
                'hsn' => 0,
            ];
        }

        $payload = [
            'order_id' => $order->id . '_RET', // Append _RET to avoid duplicate ID
            'order_date' => now()->format('Y-m-d H:i'),
            'channel_id' => '', // Optional, or existing channel ID
            'pickup_customer_name' => $order->first_name,
            'pickup_last_name' => $order->last_name,
            'pickup_address' => $order->address,
            'pickup_city' => $order->city,
            'pickup_state' => 'State', 
            'pickup_country' => $order->country,
            'pickup_email' => $order->email,
            'pickup_phone' => $order->phone,
            'pickup_pincode' => $order->post_code,
            'shipping_customer_name' => 'Your Store Name', // Return to you
            'shipping_last_name' => '',
            'shipping_address' => 'Your Warehouse Address',
            'shipping_address_2' => '',
            'shipping_city' => 'City',
            'shipping_pincode' => '110001', // Your Pin
            'shipping_country' => 'India',
            'shipping_state' => 'Delhi',
            'shipping_email' => $this->email,
            'shipping_phone' => '9999999999',
            'order_items' => $orderItems,
            'payment_method' => 'Prepaid',
            'sub_total' => $order->total_amount,
            'length' => 10,
            'breadth' => 10,
            'height' => 10,
            'weight' => 0.5
        ];
        
        // Use the return creation endpoint
        $response = Http::withToken($token)
            ->post("{$this->baseUrl}/orders/create/return", $payload);
            
        return $response->json();
    }
}
