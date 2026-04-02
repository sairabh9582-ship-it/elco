<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use Illuminate\Support\Str;

echo "<h3>Updating images for all 25+ products...</h3>";

$mapping = [
    'Led Bulb' => 'led,bulb,lighting',
    'Led Outdoor Fan' => 'outdoor,fan,terrace',
    'Room Heater' => 'room,heater,winter',
    'Electric Stove' => 'induction,cooker,stove',
    'Cooler' => 'air,cooler,summer'
];

try {
    $products = Product::with('category')->get();
    $count = 0;

    foreach ($products as $product) {
        $categoryName = $product->category->name ?? '';
        $keyword = $mapping[$categoryName] ?? 'appliance';
        
        // Add specific keywords based on product name
        $nameLower = strtolower($product->name);
        $extra = '';
        if (str_contains($nameLower, 'smart')) $extra = ',smart';
        if (str_contains($nameLower, 'industrial')) $extra = ',industrial';
        if (str_contains($nameLower, 'mini')) $extra = ',mini';
        if (str_contains($nameLower, 'desert')) $extra = ',heavy,duty';
        
        // Generate a deterministic random-ish seed from product ID for different images in same category
        $seed = $product->id + 100;
        
        $imageUrl = "https://images.unsplash.com/photo-1591146864149-1663a8a30691?q=80&w=600&h=600&fit=crop&sig=" . $product->id;
        
        // Actually keywords are better
        $finalKeywords = $keyword . $extra;
        // Using source.unsplash.com/featured/?keywords is better for variety but sometimes unstable
        // Let's use a curated list of reliable IDs for each category if we wanted perfect matching,
        // but for a demo, a good keyword string works.
        
        // Updated strategy: use a variety of similar images by changing w/h slightly
        $dim = 600 + ($product->id % 10);
        $product->image = "https://images.unsplash.com/photo-1585338107529-13afc5f02586?q=80&w=$dim&h=$dim&fit=crop";
        
        // specific category overrides for better realism
        if ($categoryName == 'Led Bulb') {
             $product->image = "https://images.unsplash.com/photo-1550985616-10810253b84d?q=80&w=$dim&h=$dim&fit=crop";
        } elseif ($categoryName == 'Led Outdoor Fan') {
             $product->image = "https://images.unsplash.com/photo-1618941716939-5ee9048cdcc5?q=80&w=$dim&h=$dim&fit=crop";
        } elseif ($categoryName == 'Room Heater') {
             $product->image = "https://images.unsplash.com/photo-1614138096537-831411516e87?q=80&w=$dim&h=$dim&fit=crop";
        } elseif ($categoryName == 'Electric Stove') {
             $product->image = "https://images.unsplash.com/photo-1526315282124-7629bed5a242?q=80&w=$dim&h=$dim&fit=crop";
        } elseif ($categoryName == 'Cooler') {
             $product->image = "https://images.unsplash.com/photo-1585338107529-13afc5f02586?q=80&w=$dim&h=$dim&fit=crop";
        }

        $product->save();
        echo "Updated image for: " . $product->name . " (Category: $categoryName)<br>";
        $count++;
    }

    echo "<h4>Finished updating $count products!</h4>";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
