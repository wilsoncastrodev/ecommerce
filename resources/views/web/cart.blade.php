@extends('layouts.app')

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
                    Subtotal: {{ formatCurrency($cart->order_subtotal) }}
                    <div>
                        <a href="{{ route('checkout') }}" class="btn btn-lg btn-primary">Fechar Pedido</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <form id="shippingForm">
                    <div>
                        <label for="zipcode">CEP</label>
                        <input type="text" id="zipcode" class="form-control" name="zipcode" value="{{ old('zipcode') }}">
                        <input type="hidden" id="cart" class="form-control" value="{{ json_encode($cart->id) }}" />
                        <input type="hidden" id="route" class="form-control" value="{{ route('check-shipping') }}" />
                    </div>
                    <div>
                        <span class="d-none" id="message-sedex"></span>
                    </div>
                </form>
            </div>
            <button class="btn btn-primary" id="check-shipping">Verificar</button>
        </div>
    </div>
</div>
@endsection
