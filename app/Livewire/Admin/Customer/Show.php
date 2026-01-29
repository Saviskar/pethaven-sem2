<?php

namespace App\Livewire\Admin\Customer;

use Livewire\Component;
use App\Models\User;

class Show extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user->load(['addresses.city', 'orders']);
    }

    public function render()
    {
        return view('livewire.admin.customer.show')->layout('layouts.admin');
    }
}
