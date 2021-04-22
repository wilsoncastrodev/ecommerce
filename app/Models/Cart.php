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
}
