<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Lazy]
#[Layout('layouts.guest')]
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
        $query = Product::with(['category', 'promotions' => function($q) {
            $q->where('status', true);
        }]);

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
        sleep(2);
        return view('livewire.home-page');
    }

    public function placeholder()
    {
        return view('skeletons.product-grid');
    }
}
