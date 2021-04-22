@extends('layouts.app-default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <table class="table">
                <thead>
                    @include('partials.tables.head', 
                        ['heads' => ['Produto', 'Quantidade', 'Preço Unitário', 'Subtotal']]
                    )
                </thead>
                <tbody>
                    @foreach($cart->products as $product)
                        <tr>
                            <th scope="row">{{ $product->product_title }}</th>
                            <th scope="row">{{ $product->pivot->quantity }}</th>
                            <th scope="row">{{ $product->product_sale_price }}</th>
                            <th scope="row">{{ $product->subtotal_format }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <div class="card bg-light">
                <div class="card-header">
                    <h3>Resumo do Pedido</h3>
                </div>
                <div class="card-body">
                    Subtotal: {{ $cart->order_subtotal }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
