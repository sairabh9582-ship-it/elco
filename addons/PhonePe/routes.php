<?php

use Illuminate\Support\Facades\Route;
use Addons\PhonePe\Controllers\PhonePeController;

Route::middleware(['web'])->group(function () {
    Route::post('/checkout/phonepe/pay', [PhonePeController::class, 'createPayment'])->name('checkout.phonepe.pay');
    Route::post('/checkout/phonepe/callback', [PhonePeController::class, 'callback'])->name('checkout.phonepe.callback');
});
