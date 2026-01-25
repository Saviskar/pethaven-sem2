<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productNames = [
            'Premium Dog Food - Chicken & Rice',
            'Organic Cat Food - Salmon',
            'Interactive Dog Toy Ball',
            'Catnip Mouse Toy',
            'Adjustable Dog Collar',
            'Automatic Pet Feeder',
            'Pet Grooming Brush',
            'Orthopedic Pet Bed',
            'Dog Leash - Heavy Duty',
            'Cat Scratching Post',
            'Pet Shampoo - Hypoallergenic',
            'Dog Treats - Dental Care',
            'Cat Litter - Clumping',
            'Pet Carrier - Travel Size',
            'Dog Chew Toys Set',
            'Cat Water Fountain',
            'Pet Nail Clipper',
            'Dog Training Pads',
            'Cat Food Bowl Set',
            'Pet Hair Remover',
        ];

        $name = fake()->randomElement($productNames);
        
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $name,
            'description' => fake()->paragraph(3),
            'price' => fake()->randomFloat(2, 5.99, 299.99),
            'stock' => fake()->numberBetween(0, 500),
            'image_url' => fake()->imageUrl(640, 480, 'animals', true),
        ];
    }
}
