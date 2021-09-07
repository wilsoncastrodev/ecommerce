<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'vendor_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productStock()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')->using(CartItem::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_items')->using(OrderItem::class);
    }

    public static function productsFeatured($products)
    {
        return $products->filter(function ($item) {
            return $item->product_featured === "yes";
        });
    }

    public static function productsTop($products)
    {
        $collection = $products->sortBy([
            fn ($b, $a) => $a['product_top'] <=> $b['product_top'],
        ]);

        $collection->splice(3);

        return $collection->all();
    }
}
