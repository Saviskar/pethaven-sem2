<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCard extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function navigateToProduct()
    {
        return $this->redirect(route('product.detail', ['product' => $this->product->id]), navigate: true);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
