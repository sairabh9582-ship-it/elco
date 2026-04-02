<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'price',
        'old_price',
        'description',
        'image',
        'label',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'is_new_arrival',
        'is_best_selling',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = \Illuminate\Support\Str::slug($product->name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function wholesalePrices()
    {
        if (class_exists(\Addons\Wholesale\Models\WholesaleProduct::class)) {
            return $this->hasMany(\Addons\Wholesale\Models\WholesaleProduct::class);
        }
        return $this->hasMany(\App\Models\Product::class, 'id', 'id')->whereRaw('1 = 0'); // Empty relation
    }

    public function getWholesalePrice($quantity)
    {
        if (class_exists(\Addons\Wholesale\Models\WholesaleProduct::class)) {
            $rule = \Addons\Wholesale\Models\WholesaleProduct::where('product_id', $this->id)
                ->where('min_quantity', '<=', $quantity)
                ->where(function ($query) use ($quantity) {
                    $query->where('max_quantity', '>=', $quantity)
                          ->orWhereNull('max_quantity');
                })
                ->orderBy('min_quantity', 'desc')
                ->first();

            if ($rule) {
                return $rule->price;
            }
        }
        return $this->price;
    }

    public function isWholesaleProduct()
    {
        if (class_exists(\Addons\Wholesale\Models\WholesaleProduct::class)) {
            return \Addons\Wholesale\Models\WholesaleProduct::where('product_id', $this->id)->exists();
        }
        return false;
    }

    public function getWholesaleDisplayPrice()
    {
        if (class_exists(\Addons\Wholesale\Models\WholesaleProduct::class)) {
            $tiers = \Addons\Wholesale\Models\WholesaleProduct::where('product_id', $this->id)
                ->orderBy('price', 'asc')
                ->get();
            
            if ($tiers->count() > 0) {
                $minPrice = $tiers->first()->price;
                $maxPrice = $tiers->last()->price;
                
                if ($minPrice == $maxPrice) {
                    return $minPrice;
                }
                // Return the lowest price as "From $X"
                return $minPrice;
            }
        }
        return $this->price;
    }
}
