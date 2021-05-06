<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_items')->using(OrderItem::class)->withPivot('price', 'quantity');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public static function subtotalOrder($products)
    {
        return $products->sum('subtotal');
    }

    public static function totalOrder($subtotal, $shipping_price)
    {
        return $subtotal + $shipping_price;
    }
}
