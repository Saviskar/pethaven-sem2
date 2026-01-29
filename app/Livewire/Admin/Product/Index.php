<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            session()->flash('message', 'Product deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.product.index', [
            'products' => Product::latest()->paginate(10)
        ])->layout('layouts.admin');
    }
}
