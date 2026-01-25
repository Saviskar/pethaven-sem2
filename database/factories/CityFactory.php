<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Colombo', 'Dehiwala', 'Moratuwa', 'Negombo', 'Gampaha',
                'Kandy', 'Matale', 'Nuwara Eliya',
                'Galle', 'Matara', 'Hambantota',
                'Jaffna', 'Kilinochchi', 'Mannar',
                'Batticaloa', 'Trincomalee', 'Ampara',
                'Kurunegala', 'Puttalam', 'Chilaw',
                'Anuradhapura', 'Polonnaruwa',
                'Badulla', 'Monaragala',
                'Ratnapura', 'Kegalle'
            ]),
            'province_id' => \App\Models\Province::factory(),
        ];
    }
}
