<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_items')->using(CartItem::class)->withPivot('quantity');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function subtotalCart($products)
    {
        return $products->map(function ($item) {
            $item->subtotal = $item->product_sale_price * $item->pivot->quantity;
            return $item;
        });
    }
}
