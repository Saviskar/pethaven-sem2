<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Order;

class Show extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order->load(['items.product', 'user.addresses.city']);
    }

    public function render()
    {
        return view('livewire.admin.order.show')->layout('layouts.admin');
    }
}
