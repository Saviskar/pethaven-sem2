<?php

namespace App\Livewire\Admin\Customer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;

#[Lazy]
#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $customers = User::whereHas('role', function ($query) {
            $query->where('name', 'customer');
        })->latest()->paginate(10);

        return view('livewire.admin.customer.index', [
            'customers' => $customers
        ]);
    }

    public function placeholder()
    {
        return view('skeletons.table');
    }
}
