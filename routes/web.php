<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;

Route::get('/', HomePage::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
