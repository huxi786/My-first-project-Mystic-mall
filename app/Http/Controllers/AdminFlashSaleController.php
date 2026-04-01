<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminFlashSaleController extends Controller
{
    /**
     * Display a listing of items on flash sale.
     */
    public function index()
    {
        $flashDeals = Product::where('is_flash_deal', true)
            ->orderBy('flash_deal_end', 'asc')
            ->paginate(10);

        return view('admin.flash-sales.index', compact('flashDeals'));
    }

    /**
     * Remove the flash sale status from a product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'is_flash_deal' => false,
            'discount_price' => null,
            'flash_deal_end' => null
        ]);

        return redirect()->route('admin.flash-sales.index')->with('success', 'Product removed from Flash Sale!');
    }
}
