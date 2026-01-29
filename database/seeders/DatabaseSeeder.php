<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Roles
        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);
        $vendorRole = Role::create(['name' => 'vendor']);

        // 2. Seed Provinces (Sri Lankan provinces)
        $provinces = [
            'Western', 'Central', 'Southern', 'Northern', 'Eastern',
            'North Western', 'North Central', 'Uva', 'Sabaragamuwa'
        ];
        
        $provinceModels = [];
        foreach ($provinces as $provinceName) {
            $provinceModels[$provinceName] = Province::create(['name' => $provinceName]);
        }

        // 3. Seed Cities
        $cities = [
            'Western' => ['Colombo', 'Dehiwala', 'Moratuwa', 'Negombo', 'Gampaha'],
            'Central' => ['Kandy', 'Matale', 'Nuwara Eliya'],
            'Southern' => ['Galle', 'Matara', 'Hambantota'],
            'Northern' => ['Jaffna', 'Kilinochchi', 'Mannar'],
            'Eastern' => ['Batticaloa', 'Trincomalee', 'Ampara'],
            'North Western' => ['Kurunegala', 'Puttalam', 'Chilaw'],
            'North Central' => ['Anuradhapura', 'Polonnaruwa'],
            'Uva' => ['Badulla', 'Monaragala'],
            'Sabaragamuwa' => ['Ratnapura', 'Kegalle']
        ];

        $cityModels = [];
        foreach ($cities as $provinceName => $cityNames) {
            foreach ($cityNames as $cityName) {
                $cityModels[] = City::create([
                    'name' => $cityName,
                    'province_id' => $provinceModels[$provinceName]->id
                ]);
            }
        }

        // 4. Seed Categories
        $categories = [
            'Dog Food', 'Cat Food', 'Dog Toys', 'Cat Toys',
            'Pet Accessories', 'Pet Grooming', 'Pet Health', 'Pet Beds & Furniture'
        ];

        $categoryModels = [];
        foreach ($categories as $categoryName) {
            $categoryModels[] = Category::create(['name' => $categoryName]);
        }

        // 5. Seed Products
        $products = [
            ['name' => 'Premium Dog Food - Chicken & Rice', 'category' => 'Dog Food', 'price' => 45.99, 'stock' => 150],
            ['name' => 'Organic Cat Food - Salmon', 'category' => 'Cat Food', 'price' => 39.99, 'stock' => 200],
            ['name' => 'Interactive Dog Toy Ball', 'category' => 'Dog Toys', 'price' => 12.99, 'stock' => 300],
            ['name' => 'Catnip Mouse Toy', 'category' => 'Cat Toys', 'price' => 5.99, 'stock' => 400],
            ['name' => 'Adjustable Dog Collar', 'category' => 'Pet Accessories', 'price' => 15.99, 'stock' => 250],
            ['name' => 'Automatic Pet Feeder', 'category' => 'Pet Accessories', 'price' => 89.99, 'stock' => 50],
            ['name' => 'Pet Grooming Brush', 'category' => 'Pet Grooming', 'price' => 18.99, 'stock' => 180],
            ['name' => 'Orthopedic Pet Bed', 'category' => 'Pet Beds & Furniture', 'price' => 79.99, 'stock' => 75],
            ['name' => 'Dog Leash - Heavy Duty', 'category' => 'Pet Accessories', 'price' => 22.99, 'stock' => 200],
            ['name' => 'Cat Scratching Post', 'category' => 'Cat Toys', 'price' => 35.99, 'stock' => 100],
            ['name' => 'Pet Shampoo - Hypoallergenic', 'category' => 'Pet Grooming', 'price' => 14.99, 'stock' => 220],
            ['name' => 'Dog Treats - Dental Care', 'category' => 'Dog Food', 'price' => 9.99, 'stock' => 350],
            ['name' => 'Cat Litter - Clumping', 'category' => 'Pet Accessories', 'price' => 24.99, 'stock' => 180],
            ['name' => 'Pet Carrier - Travel Size', 'category' => 'Pet Accessories', 'price' => 49.99, 'stock' => 90],
            ['name' => 'Dog Chew Toys Set', 'category' => 'Dog Toys', 'price' => 16.99, 'stock' => 270],
            ['name' => 'Cat Water Fountain', 'category' => 'Pet Accessories', 'price' => 42.99, 'stock' => 110],
            ['name' => 'Pet Nail Clipper', 'category' => 'Pet Grooming', 'price' => 11.99, 'stock' => 200],
            ['name' => 'Dog Training Pads', 'category' => 'Pet Accessories', 'price' => 19.99, 'stock' => 160],
            ['name' => 'Cat Food Bowl Set', 'category' => 'Pet Accessories', 'price' => 13.99, 'stock' => 240],
            ['name' => 'Pet Hair Remover', 'category' => 'Pet Grooming', 'price' => 8.99, 'stock' => 300],
            ['name' => 'Puppy Training Treats', 'category' => 'Dog Food', 'price' => 12.99, 'stock' => 280],
            ['name' => 'Cat Tunnel Toy', 'category' => 'Cat Toys', 'price' => 21.99, 'stock' => 150],
            ['name' => 'Dog Dental Chews', 'category' => 'Dog Food', 'price' => 17.99, 'stock' => 200],
            ['name' => 'Pet First Aid Kit', 'category' => 'Pet Health', 'price' => 34.99, 'stock' => 80],
            ['name' => 'Flea & Tick Collar', 'category' => 'Pet Health', 'price' => 26.99, 'stock' => 140],
            ['name' => 'Dog Raincoat', 'category' => 'Pet Accessories', 'price' => 28.99, 'stock' => 100],
            ['name' => 'Cat Litter Box', 'category' => 'Pet Accessories', 'price' => 32.99, 'stock' => 120],
            ['name' => 'Pet Vitamins', 'category' => 'Pet Health', 'price' => 29.99, 'stock' => 150],
            ['name' => 'Dog Waste Bags', 'category' => 'Pet Accessories', 'price' => 7.99, 'stock' => 400],
            ['name' => 'Cat Grooming Gloves', 'category' => 'Pet Grooming', 'price' => 10.99, 'stock' => 180],
        ];

        $productModels = [];
        foreach ($products as $productData) {
            $category = collect($categoryModels)->firstWhere('name', $productData['category']);
            $productModels[] = Product::create([
                'category_id' => $category->id,
                'name' => $productData['name'],
                'description' => fake()->paragraph(3),
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'image_url' => fake()->imageUrl(640, 480, 'animals', true),
            ]);
        }

        // 6. Seed Promotions
        $promotions = [5.00, 10.00, 15.00, 20.00, 25.00];
        $promotionModels = [];
        foreach ($promotions as $percentage) {
            $promotionModels[] = Promotion::create([
                'title' => 'Discount ' . $percentage . '%',
                'percentage' => $percentage,
                'status' => true,
            ]);
        }

        // Attach random promotions to some products
        foreach ($productModels as $product) {
            if (fake()->boolean(30)) { // 30% chance of having a promotion
                $product->promotions()->attach(
                    fake()->randomElement($promotionModels)->id
                );
            }
        }

        // 7. Seed Users
        // Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@pethaven.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'mobile' => '0771234567',
            'role_id' => $adminRole->id,
        ]);

        // Customer users
        $customers = [];
        for ($i = 0; $i < 15; $i++) {
            $customers[] = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'mobile' => fake()->numerify('07########'),
                'role_id' => $customerRole->id,
            ]);
        }

        // Vendor users
        $vendors = [];
        for ($i = 0; $i < 4; $i++) {
            $vendors[] = User::create([
                'name' => fake()->company(),
                'email' => fake()->unique()->companyEmail(),
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'mobile' => fake()->numerify('07########'),
                'role_id' => $vendorRole->id,
            ]);
        }

        // 8. Seed User Addresses
        foreach ($customers as $customer) {
            // Each customer gets 1-3 addresses
            $addressCount = fake()->numberBetween(1, 3);
            for ($i = 0; $i < $addressCount; $i++) {
                UserAddress::create([
                    'user_id' => $customer->id,
                    'address_line' => fake()->streetAddress(),
                    'city_id' => fake()->randomElement($cityModels)->id,
                ]);
            }
        }

        // 9. Seed Carts and Cart Items
        // Create carts for 10 random customers
        $customersWithCarts = fake()->randomElements($customers, 10);
        foreach ($customersWithCarts as $customer) {
            $cart = Cart::create([
                'user_id' => $customer->id,
            ]);

            // Add 1-5 items to each cart
            $itemCount = fake()->numberBetween(1, 5);
            $cartProducts = fake()->randomElements($productModels, $itemCount);
            
            foreach ($cartProducts as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => fake()->numberBetween(1, 5),
                ]);
            }
        }

        // 10. Seed Orders and Order Items
        foreach ($customers as $customer) {
            // Each customer gets 0-3 orders
            $orderCount = fake()->numberBetween(0, 3);
            
            for ($i = 0; $i < $orderCount; $i++) {
                $order = Order::create([
                    'user_id' => $customer->id,
                    'placed_at' => fake()->dateTimeBetween('-3 months', 'now'),
                    'status' => fake()->randomElement(['processing', 'shipped', 'delivered', 'cancelled']),
                ]);

                // Add 1-5 items to each order
                $itemCount = fake()->numberBetween(1, 5);
                $orderProducts = fake()->randomElements($productModels, $itemCount);
                
                foreach ($orderProducts as $product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => fake()->numberBetween(1, 5),
                        'unit_price_at_order' => $product->price, // Use current price as snapshot
                    ]);
                }
            }
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin credentials: admin@pethaven.com / password');
        $this->command->info('Customer credentials: any customer email / password');
    }
}
