<?php

namespace App\Livewire\Admin\Promotion;

use Livewire\Component;
use App\Models\Product;
use App\Models\Promotion;

class Edit extends Component
{
    public Promotion $promotion;
    public $title;
    public $percentage;
    public $status;
    public $selectedProducts = [];

    protected $rules = [
        'title' => 'required|string',
        'percentage' => 'required|numeric|min:0|max:100',
        'status' => 'boolean',
        'selectedProducts' => 'array',
        'selectedProducts.*' => 'exists:products,id',
    ];

    public function mount(Promotion $promotion)
    {
        $this->promotion = $promotion;
        $this->title = $promotion->title;
        $this->percentage = $promotion->percentage;
        $this->status = (bool) $promotion->status;
        $this->selectedProducts = $promotion->products()->pluck('products.id')->toArray();
    }

    public function update()
    {
        $this->validate();

        $this->promotion->update([
            'title' => $this->title,
            'percentage' => $this->percentage,
            'status' => $this->status,
        ]);

        $this->promotion->products()->sync($this->selectedProducts);

        return redirect()->route('admin.promotions.index');
    }

    public function render()
    {
        return view('livewire.admin.promotion.edit', [
            'products' => Product::all()
        ])->layout('layouts.admin');
    }
}
