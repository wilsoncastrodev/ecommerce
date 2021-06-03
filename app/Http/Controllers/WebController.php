<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function showCart()
    {
        $customer_ip = getRealCustomerIp();

        $cart = Cart::where('customer_ip', $customer_ip)->first();

        $products = $cart->products;

        $cart->products = Cart::subtotalCart($products);
        $cart->order_subtotal = Order::subtotalOrder($products);

        return view('web.cart', compact('cart'));
    }

    public function showCheckout()
    {
        $customer_ip = getRealCustomerIp();
        $shipping_request = collect();
        $credit_card = collect();

        $cart = Cart::where('customer_ip', $customer_ip)->first();

        $products = $cart->products;
        $customer = $cart->customer;
        $customer_address = $cart->customer->customerAddress;

        $shipping_request->cart_id = $cart->id;
        $shipping_request->zipcode = $customer_address->zipcode;

        $cart->shipping_price = Shipping::calculateShipping($shipping_request)[0]['price'];

        $cart->products = Cart::subtotalCart($products);
        $cart->order_subtotal = Order::subtotalOrder($products);

        $cart->order_total = Order::totalOrder($cart->order_subtotal, $cart->shipping_price);

        $credit_card->years = creditCardYears();
        $credit_card->months = creditCardMonths();

        return view('web.checkout', compact('cart', 'customer', 'customer_address', 'credit_card'));
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

    public function createOrder(Request $request)
    {
        $customer_id = Auth::id();
        $shipping = collect();

        $cart = Cart::where('customer_id', $customer_id)->first();

        $products = $cart->products;
        $customer_address = $cart->customer->customerAddress;

        $shipping->cart_id = $cart->id;
        $shipping->zipcode = $customer_address->zipcode;

        $shipping = Shipping::calculateShipping($shipping);

        $cart->products = Cart::subtotalCart($products);
        $cart->order_subtotal = Order::subtotalOrder($products);
        $cart->order_total = Order::totalOrder($cart->order_subtotal, $shipping[0]['price']);

        $order = new Order();
        $order->customer_id = $customer_id;
        $order->status = "open";
        $order->shipping_type = $shipping[0]['name'];
        $order->shipping_cost = $shipping[0]['price'];
        $order->subtotal = $cart->order_subtotal;
        $order->total = $cart->order_total;
        $order->save();

        foreach ($cart->products as $product) {
            $order_item = new OrderItem;
            $order_item->order_id = $order->id;
            $order_item->product_id = $product->id;
            $order_item->price = $product->product_sale_price;
            $order_item->quantity = $product->pivot->quantity;
            $order_item->save();
        }

        if ($request->payment_method == "CREDIT_CARD") {
            $data = Payment::createDataCC($request, $order);
            $payment_response = Payment::paymentCreditCard($data);
        } else {
            $payment_response = Payment::paymentBankSlip($request);
        }

        $payment = new Payment();
        $payment->order_id = $payment_response['reference_id'];
        $payment->code = $payment_response['id'];
        $payment->status = $payment_response['status'];
        $payment->method = $payment_response['payment_method']['type'];
        $payment->paid_at = !empty($payment_response['paid_at']) ? $payment_response['paid_at'] : null;
        $payment->save();

        return redirect()->back();
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
