@extends('layouts.app-default')

@section('content')
<div class="container">
    <div class="row">
        <div class="float-end">
        </div>
        <div class="col-5">
            <h1>{{ $product->product_title }}</h1>
            <form method="POST" action="{{ route('add-cart') }}" enctype="multipart/form-data">
                @csrf
                <input name="product_id" type="hidden" value="{{ $product->id }}" class="form-control" />
                <div class="mb-3 m">
                    <label for="quantity">Quantidade</label>
                    <input id="quantity" name="quantity" type="number" min="1" max="{{ $product->productStock->stock_quantity }}" class="form-control" />
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Adiciona ao Carrinho</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
