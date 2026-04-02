<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\ProductImage;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AdminService
{
    /**
     * Get all data required for the admin dashboard.
     */
    public function getDashboardData(): array
    {
        $dates = $this->getLastSevenDays();

        return [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
            'totalRevenue' => Order::sum('total_price'),
            'monthlyEarnings' => Order::whereMonth('created_at', now()->month)
                                      ->whereYear('created_at', now()->year)
                                      ->sum('total_price'),
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
            'recentUsers' => User::latest()->take(5)->get(),
            'lowStockProducts' => Product::where('stock', '<', 5)->get(),
            'salesData' => $dates->merge(
                Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->pluck('total', 'date')
            ),
            'orderStatusData' => $this->getOrderStatusStats(),
            'userGrowthData' => $dates->merge(
                User::selectRaw('DATE(created_at) as date, count(*) as total')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->pluck('total', 'date')
            ),
            'topProducts' => OrderItem::selectRaw('product_name, SUM(quantity) as total_qty')
                                     ->groupBy('product_name')
                                     ->orderByDesc('total_qty')
                                     ->take(5)
                                     ->get(),
            'productsByCategory' => Product::all()->groupBy('category'),
            'trendingSearches' => SearchHistory::select('query', DB::raw('SUM(hit_count) as total_hits'))
                                             ->groupBy('query')
                                             ->orderByDesc('total_hits')
                                             ->take(10)
                                             ->get()
        ];
    }

    /**
     * Get all orders for admin.
     */
    public function getAllOrders(int $perPage = 10)
    {
        return Order::with('user')->latest()->paginate($perPage);
    }

    /**
     * Get a specific order with details.
     */
    public function getOrder(int $id): Order
    {
        return Order::with(['items', 'user'])->findOrFail($id);
    }

    /**
     * Update the status of an order.
     */
    public function updateOrderStatus(int $id, string $status): void
    {
        Order::findOrFail($id)->update(['status' => $status]);
    }

    /**
     * Create a new product with images.
     */
    public function storeProduct(array $data, $imageFile, $galleryImages = []): Product
    {
        if ($imageFile) {
            $data['image'] = $this->uploadImage($imageFile);
        }

        $data['is_flash_deal'] = isset($data['is_flash_deal']) && $data['is_flash_deal'] == 'on';
        
        $product = Product::create($data);

        if (!empty($galleryImages)) {
            $this->uploadGallery($product->id, $galleryImages);
        }

        return $product;
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(Product $product, array $data, $imageFile = null, $galleryImages = []): Product
    {
        if ($imageFile) {
            $data['image'] = $this->uploadImage($imageFile);
        }

        $data['is_flash_deal'] = isset($data['is_flash_deal']) && $data['is_flash_deal'] == 'on';

        $product->update($data);

        if (!empty($galleryImages)) {
            $this->uploadGallery($product->id, $galleryImages);
        }

        return $product;
    }

    /**
     * Upload a single image.
     */
    private function uploadImage($file): string
    {
        $fileName = date('YmdHis') . "_" . uniqid() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $fileName);
        return $fileName;
    }

    /**
     * Upload gallery images for a product.
     */
    private function uploadGallery(int $productId, array $files): void
    {
        foreach ($files as $file) {
            $fileName = $this->uploadImage($file);
            ProductImage::create([
                'product_id' => $productId,
                'image_path' => $fileName
            ]);
        }
    }

    /**
     * Get last 7 days as keys for collection.
     */
    private function getLastSevenDays(): Collection
    {
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->put(now()->subDays($i)->format('Y-m-d'), 0);
        }
        return $dates;
    }

    /**
     * Get order count statistics by status.
     */
    private function getOrderStatusStats(): Collection
    {
        $counts = Order::selectRaw('status, count(*) as total')
                       ->groupBy('status')
                       ->pluck('total', 'status');

        $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        return collect($statuses)->mapWithKeys(fn($status) => [$status => $counts->get($status, 0)]);
    }
}
