<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Shipping;
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
        $customer_ip = getRealCustomerIp();

        $cart = Cart::where('customer_ip', $customer_ip)->first();

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
        $cart->customer_ip = $customer_ip;
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
        $customer_ip = getRealCustomerIp();
        
        $cart = Cart::where('customer_ip', $customer_ip)->first();

        $products = $cart->products;

        $cart->products = Cart::subtotalCart($products);
        $cart->order_subtotal = Order::subtotalOrder($products);

        return view('web.cart', compact('cart'));
    }
    
    public function checkout()
    {
        $customer_ip = getRealCustomerIp();
        
        $cart = Cart::where('customer_ip', $customer_ip)->first();

        $products = $cart->products;
        $customer = $cart->customer;
        $customer_address = $cart->customer->customerAddress;
        
        $shipping = Shipping::calculateShipping($cart->id, $customer_address->zipcode);

        $cart->products = Cart::subtotalCart($products);
        $cart->order_subtotal = Order::subtotalOrder($products);
        $cart->order_total = Order::totalOrder($cart->order_subtotal, $shipping[0]['price']);

        return view('web.checkout', compact('cart', 'customer', 'customer_address', 'shipping'));
    }

    public function checkShipping(Request $request)
    {
        return Shipping::calculateShipping($request->cart_id, $request->zipcode);
    }
}
