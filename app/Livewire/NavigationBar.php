<?php

namespace App\Livewire;

use Livewire\Component;

class NavigationBar extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $cart = session()->get('cart', []);
        // Count the number of unique items (products) in cart, not total quantity
        $this->cartCount = count($cart);
    }

    public function render()
    {
        return view('livewire.navigation-bar');
    }
}
