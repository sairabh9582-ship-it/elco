<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Sliders
        Slider::create([
            'title_small' => 'Save Up To A $400',
            'title_big' => 'On Selected Laptops & Desktop Or Smartphone',
            'description' => 'Terms and Condition Apply',
            'image' => 'assets/img/carousel-1.png',
            'link' => '#',
        ]);
        Slider::create([
            'title_small' => 'Save Up To A $200',
            'title_big' => 'On Selected Laptops & Desktop Or Smartphone',
            'description' => 'Terms and Condition Apply',
            'image' => 'assets/img/carousel-2.png',
            'link' => '#',
        ]);

        // Services
        Service::create(['title' => 'Free Return', 'description' => '30 days money back guarantee!', 'icon' => 'fa fa-sync-alt']);
        Service::create(['title' => 'Free Shipping', 'description' => 'Free shipping on all order', 'icon' => 'fab fa-telegram-plane']);
        Service::create(['title' => 'Support 24/7', 'description' => 'We support online 24 hrs a day', 'icon' => 'fas fa-life-ring']);
        Service::create(['title' => 'Receive Gift Card', 'description' => 'Recieve gift all over oder $50', 'icon' => 'fas fa-credit-card']);
        Service::create(['title' => 'Secure Payment', 'description' => 'We Value Your Security', 'icon' => 'fas fa-lock']);
        Service::create(['title' => 'Online Service', 'description' => 'Free return products in 30 days', 'icon' => 'fas fa-blog']);

        // Categories (Mock)
        Category::create(['name' => 'Accessories', 'slug' => 'accessories', 'product_count_mock' => 3]);
        Category::create(['name' => 'Electronics & Computer', 'slug' => 'electronics-computer', 'product_count_mock' => 5]);
        Category::create(['name' => 'Laptops & Desktops', 'slug' => 'laptops-desktops', 'product_count_mock' => 2]);
        Category::create(['name' => 'Mobiles & Tablets', 'slug' => 'mobiles-tablets', 'product_count_mock' => 8]);
        Category::create(['name' => 'SmartPhone & Smart TV', 'slug' => 'smartphone-tv', 'product_count_mock' => 5]);

        // Products
        $cat1 = Category::first(); 
        
        for ($i = 1; $i <= 8; $i++) {
             Product::create([
                'name' => 'Apple iPad Mini G2356 ' . $i,
                'slug' => 'apple-ipad-mini-g2356-' . $i,
                'category_id' => $cat1->id ?? 1,
                'price' => 1050.00,
                'old_price' => 1250.00,
                'image' => 'assets/img/product-'.($i%10 + 3).'.png', // Using existing images 3-10
                'label' => $i % 2 == 0 ? 'New' : 'Sale',
                'description' => 'Great product description here.',
                'rating' => 5,
            ]);
        }

        // Banners
        Banner::create([
             'title' => 'Smart Camera',
             'offer_text' => '40% Off',
             'image' => 'assets/img/product-1.png',
             'position' => 'product-offer-left'
        ]);
         Banner::create([
             'title' => 'Smart Watch',
             'offer_text' => '20% Off',
             'image' => 'assets/img/product-2.png',
             'position' => 'product-offer-right'
        ]);

        // Product Banners (Bottom)
        Banner::create([
             'title' => 'EOS Rebel T7i Kit',
             'offer_text' => '$899.99',
             'image' => 'assets/img/product-banner.jpg',
             'position' => 'bottom-left'
        ]);
        Banner::create([
             'title' => 'SALE',
             'offer_text' => 'Get UP To 50% Off',
             'image' => 'assets/img/product-banner-2.jpg',
             'position' => 'bottom-right'
        ]);
        // Admin User
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'is_admin' => true,
            'password' => bcrypt('admin'),
        ]);
        // Site Settings
        \App\Models\SiteSetting::create([
            'phone' => '(+012) 3456 7890',
            'email' => 'info@example.com',
            'address' => '123 Street New York.USA',
            'footer_description' => 'Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit.',
            'copyright_text' => 'Your Site Name, All right reserved.',
            'facebook_link' => '#',
            'twitter_link' => '#',
            'instagram_link' => '#',
            'linkedin_link' => '#',
        ]);
        // Menus
        \App\Models\Menu::create(['title' => 'Home', 'url' => route('home'), 'order' => 1]);
        \App\Models\Menu::create(['title' => 'Shop', 'url' => '#', 'order' => 2]);
        \App\Models\Menu::create(['title' => 'Shop Cart', 'url' => '#', 'order' => 3]);
        \App\Models\Menu::create(['title' => 'Checkout', 'url' => '#', 'order' => 4]);
        \App\Models\Menu::create(['title' => 'Contact', 'url' => '#', 'order' => 4]);

        // Payment Gateways
        \App\Models\PaymentGateway::create(['name' => 'Cash On Delivery', 'code' => 'cod', 'status' => true]);
        \App\Models\PaymentGateway::create(['name' => 'Stripe', 'code' => 'stripe', 'status' => false]);
        \App\Models\PaymentGateway::create(['name' => 'PayPal', 'code' => 'paypal', 'status' => false]);
    }
}
