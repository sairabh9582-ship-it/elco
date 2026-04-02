<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'is_admin'])->prefix('admin/currency')->name('admin.currency.')->group(function () {
    Route::get('/', [\Addons\Currency\Controllers\CurrencyController::class, 'index'])->name('index');
    Route::get('/create', [\Addons\Currency\Controllers\CurrencyController::class, 'create'])->name('create');
    Route::post('/', [\Addons\Currency\Controllers\CurrencyController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [\Addons\Currency\Controllers\CurrencyController::class, 'edit'])->name('edit');
    Route::put('/{id}', [\Addons\Currency\Controllers\CurrencyController::class, 'update'])->name('update');
    Route::delete('/{id}', [\Addons\Currency\Controllers\CurrencyController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/default', [\Addons\Currency\Controllers\CurrencyController::class, 'setDefault'])->name('default');
});
