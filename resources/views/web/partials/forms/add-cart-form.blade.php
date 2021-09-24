<form method="POST" action="{{ route('add-cart') }}" enctype="multipart/form-data">
    @csrf
    <input name="product_id" type="hidden" value="{{ $product->id }}" class="form-control" />
    <button type="submit" class="btn btn-base btn-md">Comprar</button>
    <div class="quantity-form d-inline-block" id="quantity-product-form">
        <input type="button" value="-" id="btn-minus" class="box-minus" />
        <input id="quantity" class="quantity" name="quantity" type="text" onfocus="this.blur()" readonly="readonly" data-max="{{ $product->productStock->stock_quantity }}" value="{{ $product->quantity ? $product->quantity : 1 }}" />
        <input type="button" value="+" id="btn-plus" class="box-plus" />
    </div>
    <a class="btn btn-danger btn-sm">
        <i class="fa fa-heart"></i>
        <span aria-label="Adicionar aos Favoritos">Favoritos</span>
    </a>
</form>