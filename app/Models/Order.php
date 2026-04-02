<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'status', 'total_amount', 'payment_method', 'payment_id',
        'first_name', 'last_name', 'email', 'phone', 
        'address', 'city', 'country', 'post_code',
        'shiprocket_order_id', 'shiprocket_shipment_id',
        'return_status', 'return_reason', 'refund_status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
