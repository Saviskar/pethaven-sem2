<?php

namespace App\Livewire;

use Livewire\Component;

class CartPage extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function removeItem($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        
        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Item removed from cart');
    }

    public function clearCart()
    {
        session()->forget('cart');
        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Cart cleared successfully');
    }

    public function updateQuantity($productId, $action)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            if ($action === 'increment') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrement' && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            }
            
            session()->put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cartUpdated');
        }
    }

    public function render()
    {
        return view('livewire.cart-page')->layout('layouts.guest');
    }
}
