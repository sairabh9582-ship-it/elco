<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

echo "<h3>Initializing Cooler products...</h3>";

try {
    // Check Category
    $category = Category::where('name', 'Cooler')->first();
    if (!$category) {
        $category = Category::create([
            'name' => 'Cooler',
            'slug' => 'cooler',
            'icon' => 'fa fa-snowflake'
        ]);
        echo "Created Category: Cooler<br>";
    } else {
        echo "Found Category ID: " . $category->id . "<br>";
    }

    $products = [
        [
            'name' => 'Tower Air Cooler - 35L Tank',
            'price' => 6500,
            'old_price' => 7500,
            'description' => 'Sleek tower air cooler with 35L tank capacity and powerful air throw.',
            'image' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?q=80&w=600&h=600&fit=crop',
        ],
        [
            'name' => 'Desert Air Cooler - 75L Honeycomb',
            'price' => 9800,
            'old_price' => 11000,
            'description' => 'Heavy duty desert cooler with 75L tank and high-efficiency honeycomb pads.',
            'image' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?q=80&w=601&h=601&fit=crop',
        ],
        [
            'name' => 'Personal Mini Air Cooler - USB Powered',
            'price' => 950,
            'old_price' => 1250,
            'description' => 'Portable mini air cooler, perfect for office desks or bedside tables.',
            'image' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?q=80&w=602&h=602&fit=crop',
        ],
        [
            'name' => 'Window Air Cooler - High Flow',
            'price' => 7200,
            'old_price' => 8500,
            'description' => 'High air flow window cooler designed for effective cooling in medium rooms.',
            'image' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?q=80&w=603&h=603&fit=crop',
        ],
        [
            'name' => 'Smart Bluetooth Air Cooler',
            'price' => 11500,
            'old_price' => 13000,
            'description' => 'Next-gen smart cooler with Bluetooth connectivity and mobile app control.',
            'image' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?q=80&w=604&h=604&fit=crop',
        ],
    ];

    foreach ($products as $p) {
        $product = Product::updateOrCreate(
            ['name' => $p['name']],
            array_merge($p, [
                'category_id' => $category->id,
                'slug' => Str::slug($p['name']),
                'brand_id' => null,
                'label' => 'COOL',
                'meta_title' => $p['name'],
                'meta_description' => $p['description']
            ])
        );
        echo "Created/Updated: " . $product->name . "<br>";
    }

    echo "<h4>All 5 Cooler products created successfully!</h4>";
} catch (\Exception $e) {
    echo "Fatal Error: " . $e->getMessage() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
