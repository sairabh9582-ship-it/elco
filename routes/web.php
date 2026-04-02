<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AddonController;
use App\Http\Controllers\Admin\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'shop'])->name('products.index');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/category/{category:slug}', [HomeController::class, 'category_detail'])->name('category.show');
Route::get('/category-detail/{category:slug}', [HomeController::class, 'category_detail'])->name('category.detail');
Route::get('/product/{product:slug}', [HomeController::class, 'product_detail'])->name('product.detail');

// Cart
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

// Compare
Route::get('compare', [CompareController::class, 'index'])->name('compare.index');
Route::get('compare-add/{id}', [CompareController::class, 'add'])->name('compare.add');
Route::delete('compare-remove/{id}', [CompareController::class, 'remove'])->name('compare.remove');

// Wishlist
Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('wishlist-add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('wishlist-remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// Checkout & Orders (User)
Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('order-success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::get('profile-show', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('my-orders-user', [OrderController::class, 'index'])->name('user.orders');
    Route::get('my-orders/{order}', [OrderController::class, 'show'])->name('user.orders.show');
});

// Admin Routes
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products with POST fallback for update
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('products/{product}/update-post', [ProductController::class, 'updatePost'])->name('products.update.post');
    Route::resource('products', ProductController::class);
    
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('addons', AddonController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('menus', MenuController::class);
    
    // Addon Routes (Placeholders if needed)
    Route::get('wholesale', [ProductController::class, 'index'])->name('wholesale.index');
    Route::get('currency', [SiteSettingController::class, 'index'])->name('currency.index');
    
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    
    Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::get('settings/header', [SiteSettingController::class, 'editHeader'])->name('settings.header');
    Route::put('settings/header', [SiteSettingController::class, 'updateHeader'])->name('settings.header.update');
    
    Route::get('settings/footer', [SiteSettingController::class, 'editFooter'])->name('settings.footer');
    Route::put('settings/footer', [SiteSettingController::class, 'updateFooter'])->name('settings.footer.update');
    
    Route::get('settings/shipping', [SiteSettingController::class, 'editShipping'])->name('settings.shipping');
    Route::put('settings/shipping', [SiteSettingController::class, 'updateShipping'])->name('settings.shipping.update');
    
    Route::get('settings/appearance', [SiteSettingController::class, 'editAppearance'])->name('settings.appearance');
    Route::put('settings/appearance', [SiteSettingController::class, 'updateAppearance'])->name('settings.appearance.update');
    
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::get('media/json', [MediaController::class, 'getImagesJson'])->name('media.json');
    Route::post('media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('media/{relativePath}', [MediaController::class, 'destroy'])->name('media.destroy')->where('relativePath', '.*');
});

// Misc
Route::post('contact-us', [ContactController::class, 'store'])->name('contact.store');

// Auth Routes
require __DIR__.'/auth.php';
