<?php

namespace App\Livewire\Admin\Promotion;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Promotion;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $promotion = Promotion::find($id);
        if ($promotion) {
            $promotion->products()->detach(); // Detach relations first
            $promotion->delete();
            session()->flash('message', 'Promotion deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.promotion.index', [
            'promotions' => Promotion::latest()->paginate(10)
        ])->layout('layouts.admin');
    }
}
