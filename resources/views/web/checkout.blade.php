@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h5>Endereço de Entrega</h5>
            <ul class="list-unstyled">
                <li>
                    {{ $customer->name }}
                </li>
                <li>
                    {{ $customer_address->address }} {{ $customer_address->number }} {{ $customer_address->complement }}
                </li>
                <li>
                    {{ $customer_address->neighbourhood }}
                </li>
                <li>
                    {{ $customer_address->state }} - {{ $customer_address->city }}
                </li>
                <li>
                    {{ $customer_address->zipcode }}
                </li>
            </ul>
        </div>
        <div class="col-6">
            <div class="card bg-light">
                <div class="card-header">
                    <h5>Resumo do Pedido</h5>
                </div>
                <div class="card-body">
                    <div>
                        Subtotal: R$ {{ formatCurrency($cart->order_subtotal) }}
                    </div>
                   <div>
                        Frete: R$ {{ formatCurrency($shipping[0]['price']) }}
                   </div>
                   <div>
                        Total: R$ {{ formatCurrency($cart->order_total) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

