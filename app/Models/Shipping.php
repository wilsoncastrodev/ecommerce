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

    public static function calculateShipping($shipping)
    {
        $cart_items = CartItem::where('cart_id', $shipping->cart_id)->get();

        $correios = new Client;

        $correios = $correios->freight()
            ->origin('01001-000')
            ->destination($shipping->zipcode)
            ->services(Service::SEDEX);

        if (!empty($cart_items)) {
            foreach ($cart_items as $cart_item) {
                $item = Product::find($cart_item->product_id);
                $correios->item($item->product_width, $item->product_height, $item->product_lenght, $item->product_weight, $cart_item->quantity);
            }
        }

        if (!empty($shipping->product)) {
            $item = Product::find($shipping->product['product_id']);
            $correios->item($item->product_width, $item->product_height, $item->product_lenght, $item->product_weight, $shipping->product['product_quantity']);
        }

        return $correios->calculate();
    }
}
