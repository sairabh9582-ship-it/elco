<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'is_admin'])->prefix('admin/coupons')->name('admin.coupons.')->group(function () {
    Route::get('/', [\Addons\Coupon\Controllers\CouponController::class, 'index'])->name('index');
    Route::get('/create', [\Addons\Coupon\Controllers\CouponController::class, 'create'])->name('create');
    Route::post('/', [\Addons\Coupon\Controllers\CouponController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [\Addons\Coupon\Controllers\CouponController::class, 'edit'])->name('edit');
    Route::put('/{id}', [\Addons\Coupon\Controllers\CouponController::class, 'update'])->name('update');
    Route::delete('/{id}', [\Addons\Coupon\Controllers\CouponController::class, 'destroy'])->name('destroy');
});
