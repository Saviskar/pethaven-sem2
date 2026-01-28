<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomePage extends Component
{
    public $search = '';
    public $featuredProducts = [];

    public function mount()
    {
        // Load featured products on component initialization
        $this->loadProducts();
    }

    public function updatedSearch()
    {
        // Reload products when search changes
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $query = Product::with('category');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhereHas('category', function($categoryQuery) {
                      $categoryQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        $this->featuredProducts = $query->take(6)->get();
    }

    public function render()
    {
        return view('livewire.home-page')->layout('layouts.guest');
    }
}
