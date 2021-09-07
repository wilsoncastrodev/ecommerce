@empty($cart->shipping_price)
    <form id="shippingCartForm" class="shipping-cart">
        <div class="position-relative mt-2 mb-3">
            Calcular o valor e o prazo do frete:
            <i class="fa fa-truck"></i>
            <input type="text" id="zipcode" class="form-control zipcode" onkeydown="return (event.keyCode!=13);"
                            placeholder="Digite aqui o seu CEP" name="zipcode" value="">
            <input type="hidden" id="cart" class="form-control" value="1">
            <input type="hidden" id="route" class="form-control" value="{{ route('check-shipping') }}" />
        </div>
        <div id="shipping-message" class="d-none">
            <div class="d-flex justify-content-between mb-2">
                <span>Serviço</span>
                <span>Sedex</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Valor do Frete</span>
                <span id="sedex-price"></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span>Prazo</span>
                <span>Entrega em <span id="sedex-deadline""></span> dias úteis</span>
            </div>
        </div>
    </form>
    <hr>
@endempty