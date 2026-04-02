<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'offer_text',
        'image',
        'link',
        'position',
        'status',
    ];
}
