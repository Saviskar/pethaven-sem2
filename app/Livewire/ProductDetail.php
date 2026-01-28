<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        // Load the product with its category relationship
        $this->product = $product->load('category');
    }

    public function addToCart()
    {
        // Placeholder for future cart functionality
        session()->flash('message', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.product-detail')->layout('layouts.guest');
    }
}
