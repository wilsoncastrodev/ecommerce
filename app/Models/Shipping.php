<?php

namespace App\Models;

use App\Models\Product;
use App\Models\CartItem;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipping extends Model
{
    use HasFactory;

    public static function calculateShipping($cart_id, $cep)
    {
        $items = CartItem::where('cart_id', $cart_id)->get();

        $correios = new Client;

        $correios = $correios->freight()
            ->origin('01001-000')
            ->destination($cep)
            ->services(Service::SEDEX, Service::PAC);

        foreach ($items as $item) {
            $product = Product::find($item->product_id);
            $correios->item($product->product_width, $product->product_height, $product->product_lenght, $product->product_weight, $item->quantity);
        }

        return $correios->calculate();
    }
}
