<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Mystic Aura Perfume',
                'description' => 'A captivating blend of midnight jasmine, dark vanilla, and sandalwood. Experience the extraordinary scent of elegance.',
                'price' => 120.00,
                'stock' => 50,
                'category' => 'Beauty & Fragrance',
                'image' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Obsidian Smart Watch',
                'description' => 'A premium smart watch featuring a sleek black finish, heart monitor, and a sapphire crystal display. Stay connected in style.',
                'price' => 299.99,
                'stock' => 30,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Midnight Leather Tote',
                'description' => 'Crafted from full-grain Italian leather, this spacious tote bag is perfect for your everyday premium lifestyle.',
                'price' => 185.00,
                'stock' => 25,
                'category' => 'Fashion & Accessories',
                'image' => 'https://images.unsplash.com/photo-1584916201218-f4242ceb4809?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Stellar Noise-Cancelling Headphones',
                'description' => 'Immerse yourself in crystal clear sound. These over-ear headphones offer industry-leading active noise cancellation.',
                'price' => 349.50,
                'stock' => 40,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Golden Hour Aviators',
                'description' => 'Classic aviator sunglasses featuring 18k gold-plated frames and polarized lenses for maximum UV protection.',
                'price' => 145.00,
                'stock' => 60,
                'category' => 'Fashion & Accessories',
                'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'ProVision 4K Camera',
                'description' => 'Capture memories in stunning 4K resolution. This mirrorless camera comes with a versatile 24-70mm lens.',
                'price' => 1299.00,
                'stock' => 15,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Crimson High-Top Sneakers',
                'description' => 'Step out in bold luxury. These limited edition sneakers feature premium suede and a comfortable ergonomic sole.',
                'price' => 220.00,
                'stock' => 50,
                'category' => 'Footwear',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Zenith Mechanical Keyboard',
                'description' => 'Enhance your workspace with this premium mechanical keyboard featuring custom tactile switches and RGB backlighting.',
                'price' => 160.00,
                'stock' => 35,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Lumina Desk Lamp',
                'description' => 'A minimalist LED desk lamp with adjustable brightness and color temperature, perfect for late-night tasks.',
                'price' => 85.00,
                'stock' => 100,
                'category' => 'Home & Living',
                'image' => 'https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Velvet Lounge Chair',
                'description' => 'Add a touch of elegance to your living room with this plush velvet accent chair featuring golden metallic legs.',
                'price' => 450.00,
                'stock' => 10,
                'category' => 'Home & Living',
                'image' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Botanica Face Serum',
                'description' => 'Rejuvenate your skin with our organic botanical serum, infused with vitamin C and hyaluronic acid.',
                'price' => 65.00,
                'stock' => 80,
                'category' => 'Beauty & Fragrance',
                'image' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Monstera Deliciosa Plant',
                'description' => 'Bring nature indoors. This beautiful live Monstera plant comes in a premium ceramic pot.',
                'price' => 45.00,
                'stock' => 40,
                'category' => 'Home & Living',
                'image' => 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Aero Drone 360',
                'description' => 'Explore the skies with this high-performance drone featuring a 4K gimbal camera and 30-minute flight time.',
                'price' => 799.00,
                'stock' => 20,
                'category' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1507582020474-9a35b7d315c9?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Titanium Coffee Maker',
                'description' => 'Brew barista-quality coffee at home with this sleek, programmable espresso and drip coffee machine.',
                'price' => 249.99,
                'stock' => 25,
                'category' => 'Home Appliances',
                'image' => 'https://images.unsplash.com/photo-1517686469429-8bdb88b9f907?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'name' => 'Sapphire Statement Ring',
                'description' => 'A dazzling 2-carat lab-grown sapphire set in an intricate sterling silver band. Pure mystical elegance.',
                'price' => 599.00,
                'stock' => 8,
                'category' => 'Jewelry',
                'image' => 'https://images.unsplash.com/photo-1605100804763-247f66122e28?auto=format&fit=crop&q=80&w=800'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
