<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function productDetails($slug)
    {
        $product = Product::with('productStock')->where('product_url', $slug)->first();

        return view('web.product-details', compact('product'));
    }

    public function addCart(Request $request)
    {
        $cart_customer_ip = getRealCustomerIp();

        $cart = Cart::where('cart_customer_ip', $cart_customer_ip)->first();

        if (isset($cart)) {
            $cart_item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id)
                ->increment('quantity', $request->quantity);

            if (empty($cart_item)) {
                $cart_item =  new CartItem;
                $cart_item->product_id = $request->product_id;
                $cart_item->cart_id = $cart->id;
                $cart_item->quantity = $request->quantity;
                $cart_item->save();
            }

            return redirect()->back();
        }

        $cart = new Cart;
        $cart->cart_customer_ip = $cart_customer_ip;
        $cart_id = $cart->save();

        $cart_item =  new CartItem;
        $cart_item->product_id = $request->product_id;
        $cart_item->cart_id = $cart_id;
        $cart_item->quantity = $request->quantity;
        $cart_item->save();

        return redirect()->back();
    }
}
