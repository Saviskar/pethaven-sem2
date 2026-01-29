<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\ProductDetail;
use App\Livewire\CartPage;
use App\Livewire\ShopPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\OrderDetailPage;

Route::get('/', HomePage::class)->name('home');
Route::get('/shop/{type?}', ShopPage::class)->name('shop');
Route::get('/product/{product}', ProductDetail::class)->name('product.detail');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/checkout', CheckoutPage::class)->name('checkout');
Route::get('/checkout/success', CheckoutPage::class)->name('checkout.success');
Route::get('/checkout/cancel', CheckoutPage::class)->name('checkout.cancel');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order}', OrderDetailPage::class)->name('my-orders.show');
});
