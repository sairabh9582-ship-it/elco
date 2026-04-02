<?php

use Illuminate\Support\Facades\Route;
use Addons\PayPal\Controllers\PayPalController;

Route::middleware(['web'])->group(function () {
    Route::post('/checkout/paypal/create-order', [PayPalController::class, 'createOrder'])->name('checkout.paypal.create_order');
    Route::post('/checkout/paypal/capture-order', [PayPalController::class, 'captureOrder'])->name('checkout.paypal.capture_order');
});
