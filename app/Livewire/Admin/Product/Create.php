<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Product;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $price;
    public $stock;
    public $category_id;
    public $image;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:1024',
    ];

    public function save()
    {
        $this->validate();

        $imageUrl = null;
        if ($this->image) {
            $path = $this->image->store('products', 'public');
            $imageUrl = '/storage/' . $path;
        }

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.product.create', [
            'categories' => Category::all()
        ])->layout('layouts.admin');
    }
}
