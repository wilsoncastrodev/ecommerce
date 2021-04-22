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
}
