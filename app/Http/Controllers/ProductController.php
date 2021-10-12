<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Manufacturer;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_title')->get()->toArray();
        $products_categories = ProductCategory::orderBy('product_category_title')->get()->toArray();
        $manufacturers = Manufacturer::orderBy('manufacturer_title')->get()->toArray();
        return view('admin.products.create', compact('categories', 'products_categories', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock_enabled = $request->stock_enabled == 'yes' ? 'required' : '';

        $request->validate([
            'product_title' => 'required',
            'product_url' => 'required',
            'product_description' => 'required',
            'product_features' => 'required',
            'product_featured' => 'required',
            'product_status' => 'required',
            'product_weight' => 'required',
            'product_height' => 'required',
            'product_width' => 'required',
            'product_lenght' => 'required',
            'product_price' => 'required|regex:#^[0-9,]+$#',
            'product_sale_price' => 'required|regex:#^[0-9,]+$#',
            'product_image.0' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'product_image.1' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'product_image.2' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            /* 'product_category_id' => 'required', */
            'manufacturer_id' => 'required',
            'category_id' => 'required',
            'product_seo_description' => 'required',
            'product_keywords' => 'required',
            'stock_enabled' => 'required',
            'stock_quantity' => $stock_enabled,
        ], [
            'product_title.required' => 'O campo "Título do Produto" é obrigatório',
            'product_url.required' => 'O campo "Slug do Produto" é obrigatório',
            'product_description.required' => 'O campo "Descrição do Produto" é obrigatório',
            'product_features.required' => 'O campo "Características do Produto" é obrigatório',
            'product_featured.required' => 'O campo "Produto em Destaque" é obrigatório',
            'product_status.required' => 'O campo "Status do Produto" é obrigatório',
            'product_weight.required' => 'O campo "Peso do Produto" é obrigatório',
            'product_height.required' => 'O campo "Altura do Produto" é obrigatório',
            'product_width.required' => 'O campo "Largura do Produto" é obrigatório',
            'product_lenght.required' => 'O campo "Comprimento do Produto" é obrigatório',
            'product_price.required' => 'O campo "Preço do Produto" é obrigatório',
            'product_sale_price.required' => 'O campo "Preço de Venda do Produto" é obrigatório',
            'product_price.regex' => 'O campo "Preço do Produto" está com o formato inválido.',
            'product_sale_price.regex' => 'O campo "Preço de Venda do Produto" está com o formato inválido.',
            'product_image.required' => 'O campo "Imagem do Produto" é obrigatório',
            /* 'product_category_id.required' => 'O campo "Subcategoria" é obrigatório', */
            'manufacturer_id.required' => 'O campo "Fabricante" é obrigatório',
            'category_id.required' => 'O campo "Categoria" é obrigatório',
            'product_seo_description.required' => 'O campo "Descrição para o SEO do Produto" é obrigatório',
            'product_keywords.required' => 'O campo "Palavras-Chave o SEO do Produto" é obrigatório',
            'stock_enabled.required' => 'O campo "Habilitar Gerencimento de Estoque" é obrigatório',
            'stock_quantity.required' => 'O campo "Quantidade em estoque" é obrigatório',
            'allow_backorders.required' => 'O campo "Preço do Produto" é obrigatório',
            'product_image.0.required' => 'O campo "Imagem do Produto 1" é obrigatório',
            'product_image.1.required' => 'O campo "Imagem do Produto 2" é obrigatório',
            'product_image.2.required' => 'O campo "Imagem do Produto 3" é obrigatório'
        ]);

        if ($request->hasFile('product_image')) {
            $product_images_path = storeImages($request->file('product_image'), 'produtos', $request->product_title);
        }

        $product = new Product;
        $product->product_category_id = $request->product_category_id;
        $product->category_id = $request->category_id;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->product_title = $request->product_title;
        $product->product_seo_description = $request->product_seo_description;
        $product->product_url = Str::slug($request->product_url);
        $product->product_image1 = $product_images_path[0];
        $product->product_image2 = $product_images_path[1];
        $product->product_image3 = $product_images_path[2];
        $product->product_price = $request->product_price;
        $product->product_sale_price = $request->product_sale_price;
        $product->product_description = $request->product_description;
        $product->product_features = $request->product_features;
        $product->product_featured = $request->product_featured;
        $product->product_keywords = $request->product_keywords;
        $product->product_weight = $request->product_weight;
        $product->product_height = $request->product_height;
        $product->product_width = $request->product_width;
        $product->product_lenght = $request->product_lenght;
        $product->product_status = $request->product_status;
        $product->save();

        $productStock = new ProductStock;
        $productStock->product_id = $product->id;

        if ($request->stock_enabled == 'yes') {
            if ($request->stock_quantity > 0) {
                $stock_status = 'in_stock';
            }

            if ($request->stock_quantity < 1) {
                if ($request->allow_backorders == 'no') {
                    $stock_status = 'out_stock';
                }

                if (($request->allow_backorders == 'yes' || $request->allow_backorders == 'notify')) {
                    $stock_status = 'on_backorder';
                }
            }

            $productStock->stock_status = $stock_status;
            $productStock->stock_enabled = $request->stock_enabled;
            $productStock->stock_quantity = $request->stock_quantity;
            $productStock->allow_backorders = $request->allow_backorders;
            $productStock->save();
        }

        if ($request->stock_enabled == 'no') {
            $productStock->stock_status = $request->stock_status;
            $productStock->stock_enabled = $request->stock_enabled;
            $productStock->stock_quantity = 0;
            $productStock->allow_backorders = 'no';
            $productStock->save();
        }
        
        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
