<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            // Formal Wears
            [
                'name' => 'Classic Navy Suit',
                'description' => 'A timelessly tailored navy blue two-piece suit. Perfect for boardrooms and formal events. Premium wool blend for all-day comfort.',
                'price' => 299.00,
                'stock' => 15,
                'category' => 'Formal Wears',
                'image' => 'photo-1594938298603-c8148c4dae35.jpg'
            ],
            [
                'name' => 'Elegant Evening Gown',
                'description' => 'Floor-length evening gown with intricate beadwork and a flattering silhouette. Step into elegance with this stunning formal attire.',
                'price' => 350.00,
                'stock' => 10,
                'category' => 'Formal Wears',
                'image' => 'photo-1566160980486-4ce57a41ea42.jpg'
            ],
            [
                'name' => 'Premium Leather Oxfords',
                'description' => 'Genuine leather Oxford shoes featuring classic brogue detailing and a durable leather sole for formal mastery.',
                'price' => 140.00,
                'stock' => 25,
                'category' => 'Formal Wears',
                'image' => 'photo-1614252627993-9c59500c0f65.jpg'
            ],
            [
                'name' => 'Silk Tie & Cufflinks Set',
                'description' => 'Add the final touch of luxury with this 100% natural silk tie and matching silver-plated cufflinks set.',
                'price' => 55.00,
                'stock' => 45,
                'category' => 'Formal Wears',
                'image' => 'photo-1589756823695-278bc923f962.jpg'
            ],

            // Casual Wears
            [
                'name' => 'Essential White Tee',
                'description' => 'The perfect everyday t-shirt. Made from 100% organic heavy-weight cotton for a relaxed, breathable fit.',
                'price' => 35.00,
                'stock' => 100,
                'category' => 'Casual Wears',
                'image' => 'photo-1521572163474-6864f9cf17ab.jpg'
            ],
            [
                'name' => 'Vintage Denim Jacket',
                'description' => 'A classic vintage-wash denim jacket with copper hardware. Easily layers over any casual outfit.',
                'price' => 85.00,
                'stock' => 40,
                'category' => 'Casual Wears',
                'image' => 'photo-1576995853123-5a10305d93c0.jpg'
            ],
            [
                'name' => 'Comfortable Urban Joggers',
                'description' => 'Premium fleece joggers designed for maximum comfort and a modern, tapered street-style look.',
                'price' => 50.00,
                'stock' => 60,
                'category' => 'Casual Wears',
                'image' => 'photo-1584865288642-42078afe6942.jpg'
            ],
            [
                'name' => 'Breathable Cotton Hoodie',
                'description' => 'Your new favorite hoodie. Soft brushed interior lining with a spacious front pocket and adjustable drawstring.',
                'price' => 65.00,
                'stock' => 75,
                'category' => 'Casual Wears',
                'image' => 'photo-1556821840-3a63f95609a7.jpg'
            ],

            // Men's Collection
            [
                'name' => 'Rugged Leather Jacket',
                'description' => 'A classic masculine staple. Made with authentic distressing, quilted shoulders, and durable zipped pockets.',
                'price' => 245.00,
                'stock' => 20,
                'category' => "Men's Collection",
                'image' => 'photo-1520975954732-57dd22299614.jpg'
            ],
            [
                'name' => 'Chronograph Field Watch',
                'description' => 'A military-inspired chronograph watch featuring a matte black dial, luminous hands, and a sturdy NATO strap.',
                'price' => 180.00,
                'stock' => 30,
                'category' => "Men's Collection",
                'image' => 'photo-1524805444758-089113d48a6d.jpg'
            ],
            [
                'name' => 'Classic Chelsea Boots',
                'description' => 'Premium suede Chelsea boots. Slip-on design with elastic side panels for a secure fit and elegant profile.',
                'price' => 135.00,
                'stock' => 40,
                'category' => "Men's Collection",
                'image' => 'photo-1638247025967-b4e38f787b76.jpg'
            ],
            [
                'name' => 'Minimalist Cardholder',
                'description' => 'Slim, genuine leather wallet cardholder designed to reduce pocket bulk while securing up to 6 essential cards.',
                'price' => 45.00,
                'stock' => 85,
                'category' => "Men's Collection",
                'image' => 'photo-1627063467664-5e1a3bc7155d.jpg'
            ],

            // Women's Collection
            [
                'name' => 'Designer Crossbody Bag',
                'description' => 'A chic everyday bag crafted from textured saffiano leather, featuring gold-tone hardware and adjustable strap.',
                'price' => 210.00,
                'stock' => 25,
                'category' => "Women's Collection",
                'image' => 'photo-1548036328-c928907dcca7.jpg'
            ],
            [
                'name' => 'Stiletto Heel Pumps',
                'description' => 'Essential classic stilettos. A versatile pump featuring patent leather, an elegant pointed toe, and a 4-inch heel.',
                'price' => 125.00,
                'stock' => 30,
                'category' => "Women's Collection",
                'image' => 'photo-1543163521-1bf539c55dd2.jpg'
            ],
            [
                'name' => 'Silk Floral Blouse',
                'description' => 'A lightweight, flowing silk blouse adorned with a delicate watercolor floral print. Elegant and comfortable.',
                'price' => 85.00,
                'stock' => 50,
                'category' => "Women's Collection",
                'image' => 'photo-1580911394025-a7bdfd92d427.jpg'
            ],
            [
                'name' => 'Rose Gold Plated Necklace',
                'description' => 'A minimalist and elegant chain necklace plated in 18k rose gold, featuring a dazzling cubic zirconia pendant.',
                'price' => 95.00,
                'stock' => 45,
                'category' => "Women's Collection",
                'image' => 'photo-1599643477877-3e117838d728.jpg'
            ],

            // Kid's Collection
            [
                'name' => 'Playful Graphic Tee',
                'description' => 'A fun, bright t-shirt made with ultra-soft cotton to keep active kids comfortable all day long.',
                'price' => 20.00,
                'stock' => 120,
                'category' => "Kid's Collection",
                'image' => 'photo-1519689680058-324335c77eba.jpg'
            ],
            [
                'name' => 'Kids Denim Overalls',
                'description' => 'Durable and cute. These classic denim overalls feature multiple pockets and adjustable shoulder straps.',
                'price' => 45.00,
                'stock' => 60,
                'category' => "Kid's Collection",
                'image' => 'photo-1519241047957-be31d7379a5d.jpg'
            ],
            [
                'name' => 'Light Up Sneakers',
                'description' => 'Watch them run and glow! These lightweight athletic sneakers feature built-in LED lights in the soles.',
                'price' => 55.00,
                'stock' => 75,
                'category' => "Kid's Collection",
                'image' => 'photo-1514989940723-e8e51635b782.jpg'
            ],
            [
                'name' => 'Cozy Bear Winter Coat',
                'description' => 'Keep your little one warm and adorable with this fleece-lined winter coat, featuring bear ears on the hood.',
                'price' => 75.00,
                'stock' => 35,
                'category' => "Kid's Collection",
                'image' => 'photo-1503919005314-30d9ec8ce7ba.jpg'
            ],

            // Accessories
            [
                'name' => 'Obsidian Smart Watch',
                'description' => 'A premium smart watch featuring a sleek black finish, heart monitor, and a sapphire crystal display.',
                'price' => 299.99,
                'stock' => 30,
                'category' => 'Accessories',
                'image' => 'photo-1523275335684-37898b6baf30.jpg'
            ],
            [
                'name' => 'Golden Hour Aviators',
                'description' => 'Classic aviator sunglasses featuring 18k gold-plated frames and polarized lenses for maximum UV protection.',
                'price' => 145.00,
                'stock' => 60,
                'category' => 'Accessories',
                'image' => 'photo-1511499767150-a48a237f0083.jpg'
            ],
            [
                'name' => 'Sapphire Statement Ring',
                'description' => 'A dazzling 2-carat lab-grown sapphire set in an intricate sterling silver band. Pure luxury.',
                'price' => 599.00,
                'stock' => 8,
                'category' => 'Accessories',
                'image' => 'photo-1605100804763-247f66122e28.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
