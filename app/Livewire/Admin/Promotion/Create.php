<?php

namespace App\Livewire\Admin\Promotion;

use Livewire\Component;
use App\Models\Product;
use App\Models\Promotion;

class Create extends Component
{
    public $title;
    public $percentage;
    public $status = true;
    public $selectedProducts = [];

    protected $rules = [
        'title' => 'required|string',
        'percentage' => 'required|numeric|min:0|max:100',
        'status' => 'boolean',
        'selectedProducts' => 'array',
        'selectedProducts.*' => 'exists:products,id',
    ];

    public function save()
    {
        $this->validate();

        $promotion = Promotion::create([
            'title' => $this->title,
            'percentage' => $this->percentage,
            'status' => $this->status,
        ]);

        $promotion->products()->sync($this->selectedProducts);

        return redirect()->route('admin.promotions.index');
    }

    public function render()
    {
        return view('livewire.admin.promotion.create', [
            'products' => Product::all()
        ])->layout('layouts.admin');
    }
}
