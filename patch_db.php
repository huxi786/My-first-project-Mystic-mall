<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;

// Patch Products
$products = Product::where('image', 'LIKE', 'http%')->get();
$pCount = 0;
foreach($products as $p) {
    if (preg_match('/unsplash\.com\/([^?\"\'<]+)/', $p->image, $matches)) {
        $filename = str_replace('/', '_', $matches[1]) . '.jpg';
        $p->update(['image' => $filename]);
        $pCount++;
    }
}
echo "Updated $pCount products.\n";

// Patch Categories
$categories = Category::where('image', 'LIKE', 'http%')->get();
$cCount = 0;
foreach($categories as $c) {
    if (preg_match('/unsplash\.com\/([^?\"\'<]+)/', $c->image, $matches)) {
        $filename = str_replace('/', '_', $matches[1]) . '.jpg';
        $c->update(['image' => $filename]);
        $cCount++;
    }
}
echo "Updated $cCount categories.\n";
