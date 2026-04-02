<?php

namespace Addons\Currency\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'exchange_rate',
        'is_default',
        'status'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'status' => 'boolean',
        'exchange_rate' => 'decimal:4',
    ];
}
