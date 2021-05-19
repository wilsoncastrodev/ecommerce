@extends('web.layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-11">
                    @include('web.partials.panels.panel-product-image')
                </div>
                <div class="col-1">
                    @include('web.partials.panels.panel-share')
                </div>
            </div>
        </div>
        <div class="col-6 ps-4">
            <span class="badge bg-orange px-4 mb-2">Tablet</span>
            <h1 class="h1" id="product-title">{{ $product->product_title }}</h1>
            <div class="stars">
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <span>(20)</span>
                <span class="text-base text-decoration-underline">Ver Avaliações</span>
            </div>
            <div class="product-price mt-4 mb-3">
                <div class="price">
                    <small><s>De R$ {{ formatCurrency($product->product_price) }}</s></small>
                </div>
                <div class="sale-price">
                    <span>Por R$ {{ formatCurrency($product->product_sale_price) }}</span>
                </div>
            </div>
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
            @include('web.partials.forms.shipping-product-form')
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-7 pe-5">
            <div class="panel panel-border-top px-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
            </div>
        </div>
        <div class="col-5">
            <div class="panel panel-border-top px-3">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, aliquid aut, doloremque non perferendis quisquam ipsam quo sit voluptate magnam inventore reprehenderit, architecto quibusdam accusamus! Maiores autem nostrum quidem nihil.
            </div>
        </div>
    </div>
</div>
@endsection
