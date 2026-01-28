<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public int $quantity = 1;

    public function mount(Product $product)
    {
        // Load the product with its category relationship
        $this->product = $product->load('category');
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        // Get existing cart from session or create new array
        $cart = session()->get('cart', []);
        
        $productId = $this->product->id;
        
        // If product already exists in cart, update quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $this->quantity;
        } else {
            // Add new product to cart
            $cart[$productId] = [
                'name' => $this->product->name,
                'price' => $this->product->price,
                'quantity' => $this->quantity,
                'image_url' => $this->product->image_url,
            ];
        }
        
        // Save cart to session
        session()->put('cart', $cart);
        
        // Dispatch event to update cart count in navigation
        $this->dispatch('cartUpdated');
        
        // Show success message
        session()->flash('message', 'Product added to cart!');
        
        // Reset quantity to 1
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.product-detail')->layout('layouts.guest');
    }
}
