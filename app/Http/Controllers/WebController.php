<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $products = Product::all();
        $products_featured = Product::productsFeatured($products);
        $products_top = Product::productsTop($products);

        return view('home', compact('products', 'products_featured', 'products_top'));
    }

    public function productDetails($slug)
    {
        $customer_ip = getRealCustomerIp();

        $cart = Cart::where('customer_ip', $customer_ip)->first();

        $product = Product::with('productStock')->where('product_url', $slug)->first();

        foreach ($cart->products as $cart_product) {
            if ($cart_product->product_url == $slug) {
                $product->quantity = $cart_product->pivot->quantity;
            }
        }

        return view('web.product-details', compact('product', 'cart'));
    }

    public function addCart(Request $request)
    {
        $customer_ip = getRealCustomerIp();

        $cart = Cart::where('customer_ip', $customer_ip)->first();

        if (isset($cart)) {
            $cart_item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id)
                ->update(['quantity' => $request->quantity]);

            if (empty($cart_item)) {
                $cart_item =  new CartItem;
                $cart_item->product_id = $request->product_id;
                $cart_item->cart_id = $cart->id;
                $cart_item->quantity = $request->quantity;
                $cart_item->save();
            }

            return redirect()->route('cart');
        }

        $cart = new Cart;
        $cart->customer_ip = $customer_ip;
        $cart_id = $cart->save();

        $cart_item =  new CartItem;
        $cart_item->product_id = $request->product_id;
        $cart_item->cart_id = $cart_id;
        $cart_item->quantity = $request->quantity;
        $cart_item->save();

        return redirect()->route('cart');
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
        $shippingRequest = collect();

        $cart = Cart::where('customer_ip', $customer_ip)->first();

        $products = $cart->products;
        $customer = $cart->customer;
        $customer_address = $cart->customer->customerAddress;

        $shippingRequest->cart_id = $cart->id;
        $shippingRequest->zipcode = $customer_address->zipcode;

        $cart->shipping_price = Shipping::calculateShipping($shippingRequest)[0]['price'];

        $cart->products = Cart::subtotalCart($products);
        $cart->order_subtotal = Order::subtotalOrder($products);

        $cart->order_total = Order::totalOrder($cart->order_subtotal, $cart->shipping_price);

        return view('web.checkout', compact('cart', 'customer', 'customer_address'));
    }

    public function checkShipping(Request $request)
    {
        if (!empty($request->cart_page)) {
            $cart = Cart::find($request->cart_id);

            $products = $cart->products;

            $cart->products = Cart::subtotalCart($products);
            $cart->order_subtotal = Order::subtotalOrder($products);
            $cart->order_total = $cart->order_subtotal;

            if ($request->zipcode) {
                $cart->shipping = Shipping::calculateShipping($request);
                $cart->order_total = Order::totalOrder($cart->order_subtotal, $cart->shipping[0]['price']);
            }

            return $cart;
        }

        return Shipping::calculateShipping($request);
    }

    public function updateQuantity(Request $request)
    {
        CartItem::where('cart_id', $request->cart_id)
                ->where('product_id', $request->product_id)
                ->update(['quantity' => $request->quantity]);

        return $this->checkShipping($request);
    }

    public function deleteProduct(Request $request)
    {
        CartItem::where('cart_id', $request->cart_id)
                ->where('product_id', $request->product_id)
                ->delete();

        return $this->checkShipping($request);
    }
}
