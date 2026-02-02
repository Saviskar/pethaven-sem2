<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Lazy]
#[Layout('layouts.guest')]
class ShopPage extends Component
{
    use WithPagination;

    public $selectedCategory = null;
    public $petType = 'all'; // Default to dog, can be changed based on route parameter
    public $search = '';

    protected $queryString = [
        'selectedCategory', 
        'petType',
        'search' => ['except' => '']
    ];

    public function mount($type = 'all')
    {
        $this->petType = strtolower($type);
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage(); // Reset to page 1 when category changes
    }
    
    // Reset page when search changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Get all categories for the filter buttons
        $categories = Category::all();

        // Build the query
        $query = Product::with(['category', 'promotions']);

        // Filter by category if selected
        $currentTitle = $this->petType;
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
            $category = Category::find($this->selectedCategory);
            if ($category) {
                $currentTitle = $category->name;
            }
        }

        // Filter by search term
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Get paginated products (12 per page)
        $cacheKey = 'shop_' . $this->petType . '_' . ($this->selectedCategory ?? 'all') . '_search_' . md5($this->search) . '_page_' . $this->getPage();
        
        $products = \Illuminate\Support\Facades\Cache::flexible($cacheKey, [5, 10], function () use ($query) {
            return $query->paginate(12);
        });

        return view('livewire.shop-page', [
            'products' => $products,
            'categories' => $categories,
            'currentTitle' => $currentTitle,
        ]);
    }

    public function placeholder()
    {
        return view('skeletons.product-grid');
    }
}
