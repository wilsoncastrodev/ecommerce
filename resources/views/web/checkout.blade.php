@extends('web.layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 mt-2 me-3">
            <h5 class="text-green-600">Alterar o Carrinho de Compra</h5>
            <div class="btn-back-cart">
                <i class="fa fa-shopping-cart"></i>
                <a href="{{ route('cart') }}">Voltar ao Carrinho</a>
            </div>
        </div>
        <div class="col-3 ps-5 mt-2">
            <h5 class="text-green-600">Endereço de Entrega</h5>
            <ul class="list-unstyled">
                <li class="mb-1">
                    {{ $customer->name }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->address }}, {{ $customer_address->number }} 
                </li>
                <li class="mb-1">
                    {{ $customer_address->complement }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->neighbourhood }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->state }} - {{ $customer_address->city }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->zipcode }}
                </li>
            </ul>
        </div>
        <div class="col-5">
            @include('web.partials.cards.card-resume')
        </div>
    </div>
</div>
@endsection

