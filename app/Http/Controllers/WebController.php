<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        return view('home');
    }

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

    public function cart()
    {
        $cart_customer_ip = getRealCustomerIp();
        
        $cart = Cart::where('cart_customer_ip', $cart_customer_ip)->first();

        $cart->products = $cart->products->map(function ($item) {
            $item->subtotal = $item->product_sale_price * $item->pivot->quantity;
            $item->subtotal_format = number_format($item->subtotal, 2, ',', '');
            $item->product_sale_price = number_format($item->product_sale_price, 2, ',', '');
            return $item;
        });

        $cart->order_subtotal = number_format($cart->products->sum('subtotal'), 2, ',', '');

        return view('web.cart', compact('cart'));
    }
}
