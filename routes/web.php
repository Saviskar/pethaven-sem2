<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\ProductDetail;
use App\Livewire\CartPage;
use App\Livewire\ShopPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\OrderDetailPage;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\Product\Create as ProductCreate;
use App\Livewire\Admin\Product\Edit as ProductEdit;
use App\Livewire\Admin\Promotion\Index as PromotionIndex;
use App\Livewire\Admin\Promotion\Create as PromotionCreate;
use App\Livewire\Admin\Promotion\Edit as PromotionEdit;
use App\Livewire\Admin\Order\Index as OrderIndex;
use App\Livewire\Admin\Order\Show as OrderShow;
use App\Livewire\Admin\Customer\Index as CustomerIndex;
use App\Livewire\Admin\Customer\Show as CustomerShow;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', HomePage::class)->name('home');
    Route::get('/shop/{type?}', ShopPage::class)->name('shop');
    Route::get('/product/{product}', ProductDetail::class)->name('product.detail');
    Route::get('/cart', CartPage::class)->name('cart');
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/checkout/success', CheckoutPage::class)->name('checkout.success');
    Route::get('/checkout/cancel', CheckoutPage::class)->name('checkout.cancel');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order}', OrderDetailPage::class)->name('my-orders.show');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    EnsureUserIsAdmin::class,
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    
    // Products
    Route::get('/products', ProductIndex::class)->name('products.index');
    Route::get('/products/create', ProductCreate::class)->name('products.create');
    Route::get('/products/{product}/edit', ProductEdit::class)->name('products.edit');

    // Promotions
    Route::get('/promotions', PromotionIndex::class)->name('promotions.index');
    Route::get('/promotions/create', PromotionCreate::class)->name('promotions.create');
    Route::get('/promotions/{promotion}/edit', PromotionEdit::class)->name('promotions.edit');

    // Orders
    Route::get('/orders', OrderIndex::class)->name('orders.index');
    Route::get('/orders/{order}', OrderShow::class)->name('orders.show');

    // Customers
    Route::get('/customers', CustomerIndex::class)->name('customers.index');
    Route::get('/customers/{user}', CustomerShow::class)->name('customers.show');
});
