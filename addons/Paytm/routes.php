<?php

use Illuminate\Support\Facades\Route;
use Addons\Paytm\Controllers\PaytmController;

Route::middleware(['web'])->group(function () {
    Route::post('/checkout/paytm/pay', [PaytmController::class, 'createPayment'])->name('checkout.paytm.pay');
    Route::post('/checkout/paytm/callback', [PaytmController::class, 'callback'])->name('checkout.paytm.callback');
});
