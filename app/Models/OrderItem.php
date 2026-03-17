<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'user_name',
        'payment_id',
        'product_name',
        'quantity',
        'product_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    */

    // Optional: Link to Product if needed for images/details
    // Note: The migration stores product_name and price, essentially snapshotting the product.
    // If we want to link back to the live product, we'd need product_id in the table.
    // For now, let's assume we rely on the snapshotted data or name matching.
}
