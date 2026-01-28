<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\ProductDetail;
use App\Livewire\CartPage;

Route::get('/', HomePage::class)->name('home');
Route::get('/product/{product}', ProductDetail::class)->name('product.detail');
Route::get('/cart', CartPage::class)->name('cart');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
