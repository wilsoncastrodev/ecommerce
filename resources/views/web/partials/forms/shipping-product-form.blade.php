
<form id="shippingProductForm" class="shipping-form">
    <div class="mt-4">
        <div class="position-relative">
            <i class="fa fa-truck"></i><input type="text" id="zipcode" class="form-control" placeholder="Digite aqui o seu CEP" name="zipcode" value="{{ old('zipcode') }}">
            <input type="hidden" id="product_id" class="form-control" value="{{ $product->id }}" />
            <input type="hidden" id="cart" class="form-control" value="{{ $cart->id }}" />
            <input type="hidden" id="route" class="form-control" value="{{ route('check-shipping') }}" />
            <label class="btn" id="check-shipping" disabled>Calcular Prazo e Valor do Frete</label>
        </div>
    </div>
    <div class="shipping-table mt-3 d-none" id="shipping-message">
        <div class="shipping-table-header">
            <span>Transportadora</span>
            <span>Serviço</span>
            <span>Preço</span>
            <span>Prazo</span>
        </div>
        <div class="shipping-table-item shipping-sedex">
            <div class="shipping-transport">
                <span>Correios</span>
            </div>
            <div class="shipping-service">
                <span>Sedex</span>
            </div>
            <div class="shipping-price">
                <strong id="sedex-price"></strong>
            </div>
            <div class="shipping-deadline">
                Entrega em <span id="sedex-deadline"></span> dias úteis
            </div>
        </div>
    </div>
</form>
