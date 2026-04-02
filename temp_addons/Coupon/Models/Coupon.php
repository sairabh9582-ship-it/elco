<?php

namespace Addons\Coupon\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_spend',
        'usage_limit',
        'used_count',
        'expiry_date',
        'status'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'status' => 'boolean',
    ];
}
