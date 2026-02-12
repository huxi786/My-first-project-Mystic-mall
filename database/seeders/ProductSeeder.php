<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Classic Blue Suit',
                'description' => 'A timeless two-piece formal suit for men.',
                'price' => 15000.00,
                'stock' => 20,
                'category' => 'Formal Wears',
                'image' => 'formal_suit.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elegant Evening Gown',
                'description' => 'A stunning red gown for formal occasions.',
                'price' => 18000.00,
                'stock' => 13,
                'category' => 'Formal Wears',
                'image' => 'formal_gown.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Men\'s Casual Tee',
                'description' => 'Comfortable cotton t-shirt for daily wear.',
                'price' => 2500.00,
                'stock' => 49,
                'category' => 'Casual Wears',
                'image' => 'casual_tee.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Women\'s Denim Jeans',
                'description' => 'Stylish and comfortable blue denim jeans.',
                'price' => 4500.00,
                'stock' => 39,
                'category' => 'Casual Wears',
                'image' => 'casual_jeans.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Men\'s Leather Jacket',
                'description' => 'A stylish black leather jacket.',
                'price' => 9500.00,
                'stock' => 25,
                'category' => 'Mens Collection',
                'image' => 'mens_jacket.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Women\'s Floral Dress',
                'description' => 'A beautiful floral print summer dress.',
                'price' => 6000.00,
                'stock' => 30,
                'category' => 'Womens Collection',
                'image' => 'womens_dress.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kid\'s Graphic Hoodie',
                'description' => 'A fun and colorful hoodie for kids.',
                'price' => 3500.00,
                'stock' => 60,
                'category' => 'Kids Collection',
                'image' => 'kids_hoodie.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Leather Belt',
                'description' => 'A classic brown leather belt.',
                'price' => 1500.00,
                'stock' => 100,
                'category' => 'Accessories',
                'image' => 'accessory_belt.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Silk Scarf',
                'description' => 'A luxurious printed silk scarf.',
                'price' => 2200.00,
                'stock' => 80,
                'category' => 'Accessories',
                'image' => 'accessory_scarf.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New Arrival Blazer',
                'description' => 'Modern single-breasted blazer for men.',
                'price' => 12000.00,
                'stock' => 18,
                'category' => 'New Arrivals',
                'image' => 'new_blazer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
