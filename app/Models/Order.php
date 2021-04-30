<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static function subtotalOrder($products)
    {
        return $products->sum('subtotal');
    }

    public static function totalOrder($subtotal, $shipping_price)
    {
        return $subtotal + $shipping_price;
    }
}
