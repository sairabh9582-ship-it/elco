<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentGateway;

class RazorpaySeeder extends Seeder
{
    public function run()
    {
        PaymentGateway::updateOrCreate(
            ['code' => 'razorpay'],
            [
                'name' => 'Razorpay',
                'settings' => [
                    'key_id' => '',
                    'key_secret' => ''
                ],
                'status' => false,
            ]
        );
    }
}
