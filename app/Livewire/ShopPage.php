<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    public $selectedCategory = null;
    public $petType = 'dog'; // Default to dog, can be changed based on route parameter

    protected $queryString = ['selectedCategory', 'petType'];

    public function mount($type = 'dog')
    {
        $this->petType = strtolower($type);
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage(); // Reset to page 1 when category changes
    }

    public function render()
    {
        // Get all categories for the filter buttons
        $categories = Category::all();

        // Build the query
        $query = Product::with('category');

        // Filter by category if selected
        $currentTitle = $this->petType;
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
            $category = Category::find($this->selectedCategory);
            if ($category) {
                $currentTitle = $category->name;
            }
        }

        // Get paginated products (12 per page)
        $products = $query->paginate(12);

        return view('livewire.shop-page', [
            'products' => $products,
            'categories' => $categories,
            'currentTitle' => $currentTitle,
        ])->layout('layouts.guest');
    }
}
