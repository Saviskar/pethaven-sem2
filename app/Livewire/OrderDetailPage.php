<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderDetailPage extends Component
{
    use AuthorizesRequests;

    public $orderId;

    public function mount($order)
    {
        $this->orderId = $order;
    }

    public function render()
    {
        $order = Order::with('items.product')->findOrFail($this->orderId);

        // Ensure user owns the order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('livewire.order-detail-page', [
            'order' => $order,
        ])->layout('layouts.guest');
    }
}
