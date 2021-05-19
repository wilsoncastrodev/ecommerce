<div class="card card-resume">
    <div class="card-header pb-0">
        <h3>Resumo da Compra</h3>
    </div>
    <div class="card-body">
        @include('web.partials.forms.shipping-cart-form')
        <div class="d-flex justify-content-between mb-2">
            @empty($cart->shipping_price)
                <span>{{ formatLeadingZero($cart->products->count()) }} produtos</span>
            @else  
                <span>Subtotal</span>
            @endempty
            <strong id="subtotal">R$ {{ formatCurrency($cart->order_subtotal) }}</strong>
        </div>
        <div class="{{!$cart->shipping_price ? "d-none" : "d-flex" }} justify-content-between mb-2" id="shipping">
            <span>Frete</span>
            <strong id="sedex-shipping">
                @empty(!$cart->shipping_price)
                    R$ {{ formatCurrency($cart->shipping_price) }}
                @endempty
            </strong>
        </div>
        <hr>
        <div class="card-total d-flex justify-content-between mb-2">
            <span>Total</span>
            <span id="total">
                @empty(!$cart->shipping_price)
                    R$ {{ formatCurrency($cart->order_total) }}
                @else  
                    R$ {{ formatCurrency($cart->order_subtotal) }}
                @endempty
            </span>
        </div>
        @empty($cart->shipping_price)
        <div class="px-4 mt-4">
            <a href="{{ route('checkout') }}" class="btn btn-lg btn-success w-100">Finalizar Compra</a>
        </div>
        @endempty
    </div>
</div>

@empty($cart->shipping_price)
<div class="px-3">
    <div class="mt-4 text-center">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary"><i class="fa fa-reply me-3"></i>Comprar Mais Produtos</a>
    </div>
</div>
@endif