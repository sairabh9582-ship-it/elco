<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentGateway;

class PaymentGatewaySeeder extends Seeder
{
    public function run()
    {
        PaymentGateway::firstOrCreate(['code' => 'cod'], ['name' => 'Cash On Delivery', 'status' => true]);
        PaymentGateway::firstOrCreate(['code' => 'stripe'], ['name' => 'Stripe', 'status' => false]);
        PaymentGateway::firstOrCreate(['code' => 'paypal'], ['name' => 'PayPal', 'status' => false]);
        PaymentGateway::firstOrCreate(['code' => 'razorpay'], ['name' => 'Razorpay', 'status' => false]);
    }
}
