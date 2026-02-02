<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Lazy]
#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        sleep(2);
        $totalOrders = Order::count();
        $totalRevenue = OrderItem::sum(DB::raw('quantity * unit_price_at_order'));
        $activeProducts = Product::count(); // Assuming all products are active if they exist
        $activePromotions = Promotion::where('status', true)->count();

        return view('livewire.admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'activeProducts' => $activeProducts,
            'activePromotions' => $activePromotions,
        ]);
    }

    public function placeholder()
    {
        return view('skeletons.stats-grid');
    }
}
