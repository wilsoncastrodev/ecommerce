<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
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
        $categories = Category::orderBy('category_title')->get();
        $categories_top = Category::where('category_top', 'yes')->orderBy('category_title')->get();

        return view('home', compact('products', 'products_featured', 'products_top', 'categories', 'categories_top'));
    }

    public function showCategory($slug)
    {
        $products_view = 4;

        $category = Category::with([
            'products' => function ($query) use ($products_view) {
                 $query->limit($products_view);
            }
        ])->where('category_slug', $slug)->first();

        $category_products = Category::where('category_slug', $slug)->first();
        $category->total_products = $category_products->products->count();
        $category->products_view = $products_view;
        
        $categories = Category::orderBy('category_title')->get();
        $categories_top = Category::where('category_top', 'yes')->orderBy('category_title')->get();

        return view('web.category', compact('category', 'categories', 'categories_top'));
    }
    
    public function loadMoreCategory(Request $request)
    {
        $category = Category::with([
            'products' => function ($query) use ($request) {
                 $query->offset($request->number_products)->take($request->products_view);
            }
        ])->where('category_slug', $request->category_slug)->first();

        $products = $category->products;
        
        return view('web.partials.cards.card-alt', compact('products'));
    }

    public function search(Request $request)
    {
        $products_view = 4;

        $keywords = explode(' ', $request->s);
        $categories = Category::orderBy('category_title')->get();
        $categories_top = Category::where('category_top', 'yes')->orderBy('category_title')->get();

        $search = Product::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where('product_title', 'like', "%{$keyword}%");
            }
        })->limit(4)->get();

        $search_products = Product::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where('product_title', 'like', "%{$keyword}%");
            }
        })->get();

        $search->total_products = $search_products->count();
        $search->products_view = $products_view;
        $search->keywords = $request->s;

        return view('web.search', compact('search', 'categories', 'categories_top'));
    }
    
    public function loadMoreSearch(Request $request)
    {
        $keywords = explode(' ', $request->s);

        $categories = Category::orderBy('category_title')->get();
        $categories_top = Category::where('category_top', 'yes')->orderBy('category_title')->get();

        $search = Product::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where('product_title', 'like', "%{$keyword}%");
            }
        })->offset($request->number_products)->take($request->products_view)->get();

        $products = $search;
        
        return view('web.partials.cards.card-alt', compact('products'));
    }

    public function quickSearchProducts($keywords)
    {
        $keywords = explode(' ', $keywords);

        $products = Product::select('product_title')->where(function ($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhere('product_title', 'like', "%{$keyword}%");
            }
        })->get();
        
        if (!empty($products->first())) {
            foreach ($products as $key => $product) {
                $search_keywords[$key]['words'] = 0;
                $products_array[] = explode(' ', removeSpecialChars(ucwords($product->product_title)));
                
                foreach ($products_array[$key] as $product_array) {
                    foreach ($keywords as $keyword) {
                        if (strpos(strtolower($product_array), strtolower($keyword)) !== false) {
                            $keywords_array[$key][] = ucfirst($product_array);
                            $search_keywords[$key]['words']  = $search_keywords[$key]['words'] + 1;
                        }
                    }
                }
                
                $search_keywords[$key]['product_title'][] = implode(' ', array_slice(array_unique(array_merge($keywords_array[$key], $products_array[$key])), 0, $search_keywords[$key]['words']));
                $search_keywords[$key]['product_title'][] = implode(' ', array_slice(array_unique(array_merge($keywords_array[$key], $products_array[$key])), 0, $search_keywords[$key]['words'] + 1));
                $search_keywords[$key]['product_title'][] = implode(' ', array_slice(array_unique(array_merge($keywords_array[$key], $products_array[$key])), 0, $search_keywords[$key]['words'] + 2));
            }

            $search_keywords = uniqueArrayMulti(sortArrayMulti($search_keywords, 'words', 'reverse'), 'product_title');

            foreach ($search_keywords as $keywords) {
                foreach ($keywords['product_title'] as $keyword) {
                    $main_keywords[] = $keyword;
                }
            }

            return array_slice(array_values(array_unique($main_keywords, SORT_STRING)), 0, 8);
        }

        return false;
    }

    public function productDetails($slug)
    {
        $customer_ip = getRealCustomerIp();

        $cart = Cart::where('customer_ip', $customer_ip)->first();

        $product = Product::with('productStock')->where('product_url', $slug)->first();
        
        $categories = Category::orderBy('category_title')->get();
        $categories_top = Category::where('category_top', 'yes')->orderBy('category_title')->get();
        $product->quantity = 0;

        $reviews = Review::has('customer')->where('product_id', $product->id)->get();

        if (isset($cart)) {
            foreach ($cart->products as $cart_product) {
                if ($cart_product->product_url == $slug) {
                    $product->quantity = $cart_product->pivot->quantity;
                }
            }
        }

        return view('web.product-details', compact('product', 'cart', 'categories', 'categories_top', 'reviews'));
    }

    public function addCart(Request $request)
    {
        $customer_ip = getRealCustomerIp();
        $customer_id = Auth::id() ? Auth::id() : null;

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
        $cart->customer_id = $customer_id;
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

        $categories = Category::orderBy('category_title')->get();
        $categories_top = Category::where('category_top', 'yes')->orderBy('category_title')->get();

        $products = $cart->products;

        $cart->products = Cart::subtotalCart($products);
        $cart->order_subtotal = Order::subtotalOrder($products);

        return view('web.cart', compact('cart', 'categories', 'categories_top'));
    }

    public function showCheckout()
    {
        $customer_ip = getRealCustomerIp();
        $customer_id = Auth::id();
        $shipping_request = collect();
        $credit_card = collect();

        $categories = Category::orderBy('category_title')->get();
        $categories_top = Category::where('category_top', 'yes')->orderBy('category_title')->get();

        $cart = Cart::where('customer_ip', $customer_ip)->first();
        $cart->update(['customer_id' => $customer_id]);

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

        return view('web.checkout', compact('cart', 'customer', 'customer_address', 'credit_card', 'categories', 'categories_top'));
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

    public function storeReviewProduct(Request $request)
    {
        $review = new Review();
        $review->product_id = $request->product_id;
        $review->customer_id = $request->customer_id;
        $review->review_rating = $request->review_rating;
        $review->review_title = $request->review_title;
        $review->review_content = $request->review_content;
        $review->review_status = 'active';
        $review->save();

        return redirect()->back();
    }
}
