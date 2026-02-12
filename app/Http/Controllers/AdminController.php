<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Basic Counts
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
        $totalUsers = \App\Models\User::count();

        // Financial Stats
        $totalRevenue = \App\Models\Order::sum('total_price');
        $monthlyEarnings = \App\Models\Order::whereMonth('created_at', date('m'))
                                            ->whereYear('created_at', date('Y'))
                                            ->sum('total_price');

        // Recent Activity
        $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
        $recentUsers = \App\Models\User::latest()->take(5)->get();

        // Low Stock Alert
        $lowStockProducts = \App\Models\Product::where('stock', '<', 5)->get();

        // Chart Data (Last 7 Days Sales)
        // Chart Data (Last 7 Days Sales - Zero Filled)
        $dates = collect();
        for ($i = 6; $i >= 0; $i--) {
            $dates->put(now()->subDays($i)->format('Y-m-d'), 0);
        }

        $sales = \App\Models\Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->pluck('total', 'date');

        $salesData = $dates->merge($sales);
            
        // Fetch all products grouped by category (Existing)
        $productsByCategory = \App\Models\Product::all()->groupBy('category');
        
        return view('admin.dashboard', compact(
            'totalProducts', 'totalOrders', 'totalUsers',
            'totalRevenue', 'monthlyEarnings',
            'recentOrders', 'recentUsers',
            'lowStockProducts', 'salesData',
            'productsByCategory'
        ));
    }

    public function products()
    {
        $products = \App\Models\Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function users()
    {
        $users = \App\Models\User::with(['loginActivities' => function($query) {
            $query->latest('login_at');
        }])->get();
        return view('admin.users.index', compact('users'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $profileImage);
            $input['image'] = $profileImage;
        }

        \App\Models\Product::create($input);
    
        return redirect()->route('admin.products')->with('success','Product created successfully.');
    }

    public function editProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $product = \App\Models\Product::findOrFail($id);
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $profileImage);
            $input['image'] = $profileImage;
        } else {
            unset($input['image']);
        }

        $product->update($input);
    
        return redirect()->route('admin.products')->with('success','Product updated successfully');
    }

    public function deleteProduct($id)
    {
        \App\Models\Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success','Product deleted successfully');
    }

}
