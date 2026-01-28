<?php

namespace App\Livewire\Auth;

use App\Models\Province;
use App\Models\City;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $mobile = '';
    public $province_id = '';
    public $city_id = '';
    public $address_line = '';
    public $password = '';
    public $password_confirmation = '';
    public $terms = false;

    public $provinces = [];
    public $cities = [];

    public function mount()
    {
        $this->provinces = Province::all();
        $this->cities = [];
    }

    public function updatedProvinceId($value)
    {
        if ($value) {
            $this->cities = City::where('province_id', $value)->get();
            $this->city_id = ''; // Reset city selection when province changes
        } else {
            $this->cities = [];
            $this->city_id = '';
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
