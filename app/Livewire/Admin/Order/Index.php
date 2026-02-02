<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Lazy]
#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public function updateStatus($orderId, $status)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => $status]);
        }
    }

    public function render()
    {
        return view('livewire.admin.order.index', [
            'orders' => Order::with('user')->latest()->paginate(10)
        ]);
    }

    public function placeholder()
    {
        return view('skeletons.table');
    }
}
