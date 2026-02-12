<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        $users = User::all();

        if($products->count() == 0 || $users->count() == 0) {
            return;
        }

        foreach($products as $product) {
            // Add 1-3 reviews per product
            $numReviews = rand(1, 3);
            for($i = 0; $i < $numReviews; $i++) {
                DB::table('reviews')->insert([
                    'user_id' => $users->random()->id,
                    'product_id' => $product->id,
                    'rating' => rand(3, 5),
                    'comment' => $this->getRandomComment(),
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function getRandomComment()
    {
        $comments = [
            'Great product! Really loved the quality.',
            'Fast delivery and good packaging.',
            'Value for money. Highly recommended.',
            'Average quality but good for the price.',
            'Absolutely stunning! Will buy again.',
            'The material is very soft and comfortable.',
            'Color is slightly different from image but still nice.',
            'Best purchase I made this month!',
        ];
        return $comments[array_rand($comments)];
    }
}
