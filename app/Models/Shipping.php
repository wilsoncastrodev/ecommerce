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

    public static function calculateShipping($cep, $cart_id = null, $product = null)
    {
        $cart_items = CartItem::where('cart_id', $cart_id)->get();

        $correios = new Client;

        $correios = $correios->freight()
            ->origin('01001-000')
            ->destination($cep)
            ->services(Service::SEDEX, Service::PAC);

        if (!empty($cart_items)) {
            foreach ($cart_items as $cart_item) {
                $item = Product::find($cart_item->product_id);
                $correios->item($item->product_width, $item->product_height, $item->product_lenght, $item->product_weight, $item->quantity);
            }
        }

        if (!empty($product)) {
            $item = Product::find($product['product_id']);
            $correios->item($item->product_width, $item->product_height, $item->product_lenght, $item->product_weight, $product['product_quantity']);
        }

        return $correios->calculate();
    }
}
