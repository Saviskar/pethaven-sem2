<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Product;

class Edit extends Component
{
    use WithFileUploads;

    public Product $product;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category_id;
    public $image;
    public $newImage;

    protected $rules = [
        'name' => 'required|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'newImage' => 'nullable|image|max:1024',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->image = $product->image_url;
    }

    public function update()
    {
        $this->validate();

        $imageUrl = $this->image;
        if ($this->newImage) {
            $path = $this->newImage->store('products', 'public');
            $imageUrl = '/storage/' . $path;
        }

        $this->product->update([
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
        return view('livewire.admin.product.edit', [
            'categories' => Category::all()
        ])->layout('layouts.admin');
    }
}
