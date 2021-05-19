@extends('web.layout.app')

@section('content')
<section class="cart">
    <div class="container">
        <h2 class="h2">Meu Carrinho</h2>
        <div class="row">
            <div class="col-8 pe-5">
                <table class="cart-table">
                    <thead>
                        @include('partials.tables.head',
                        ['heads' => ['', '', 'Quantidade', 'Preço']]
                        )
                    </thead>
                    <tbody>
                        @php($i = 1)
                         @foreach($cart->products as $product)
                        <tr id="product-{{ $product->id }}">
                            <td class="td-product-image"><img src="{{ asset($product->product_image1) }}" /></td>
                            <td class="td-product-title px-2">{{ $product->product_title }}</td>
                            <td class="td-product-quantity">
                                <div class="quantity-form d-inline-block position-static" id="quantity-cart-form">
                                    <input type="button" value="-" id="btn-minus-{{ $i }}" class="box-minus" />
                                    <input id="quantity-{{ $i }}" class="quantity" name="quantity" type="text" onfocus="this.blur()" 
                                    data-max="{{ $product->productStock->stock_quantity }}" 
                                    data-product="{{ $product->id }}" 
                                    data-cart="{{ $cart->id }}"
                                    data-route="{{ route('update-quantity') }}"
                                    value="{{ $product->pivot->quantity }}" readonly="readonly"  />
                                    <input type="button" value="+" id="btn-plus-{{ $i }}" class="box-plus" />
                                </div>
                                <div class="mt-2">
                                    <a href="#" id="delete-product" class="delete-product text-base" 
                                        data-route="{{ route('delete-product') }}"
                                        data-product="{{ $product->id }}"
                                        data-cart="{{ $cart->id }}">
                                        Remover
                                    </a>
                                </div>
                            </td>
                            <td class="td-product-price">R$ {{ formatCurrency($product->product_sale_price) }}</td>
                        </tr>
                        @php($i++)
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                @include('web.partials.cards.card-resume')
            </div>
        </div>
    </div>
</section>
@endsection
