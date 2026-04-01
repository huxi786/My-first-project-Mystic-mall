<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Dashboard view with analytics.
     */
    public function dashboard()
    {
        $data = $this->adminService->getDashboardData();
        return view('admin.dashboard', $data);
    }

    /**
     * List all products.
     */
    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * List all users.
     */
    public function users()
    {
        $users = User::with(['loginActivities' => function($query) {
            $query->latest('login_at');
        }])->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Create product view.
     */
    public function createProduct()
    {
        return view('admin.products.create');
    }

    /**
     * Store a new product.
     */
    public function storeProduct(StoreProductRequest $request)
    {
        $this->adminService->storeProduct(
            $request->validated(),
            $request->file('image'),
            $request->file('gallery_images')
        );

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    /**
     * Edit product view.
     */
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->adminService->updateProduct(
            $product,
            $request->validated(),
            $request->file('image'),
            $request->file('gallery_images')
        );

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    /**
     * Delete a product.
     */
    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }
}
