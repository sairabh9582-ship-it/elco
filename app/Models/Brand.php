<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'meta_title', 'meta_description', 'meta_keywords'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = \Illuminate\Support\Str::slug($brand->name);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
