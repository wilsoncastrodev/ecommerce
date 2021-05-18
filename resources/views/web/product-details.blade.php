@extends('web.layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-11">
                    <div class="panel pt-1">
                        <div class="panel-image-feature">
                            <img src="{{ asset($product->product_image1) }}">
                        </div>
                        <div class="panel-image-thumbnails">
                            @empty(!$product->product_image1)
                            <img src="{{ asset($product->product_image1) }}">
                            @endempty
                            @empty(!$product->product_image2)
                            <img src="{{ asset($product->product_image2) }}">
                            @endempty
                            @empty(!$product->product_image3)
                            <img src="{{ asset($product->product_image3) }}">
                            @endempty
                        </div>
                    </div>
                </div>
                <div class="col-1">

                </div>
            </div>
        </div>
        <div class="col-6">
            <span class="badge bg-orange px-4 mb-2">Tablet</span>
            <h1 class="h1">{{ $product->product_title }}</h1>
            <div class="stars">
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <i class="fa fa-star text-yellow"></i>
                <span>(20)</span>
                <span class="text-blue">Ver Avaliações</span>
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
                <button type="submit" class="btn btn-success btn-md">Comprar</button>
                <div class="quantity-form d-inline-block">
                    <input type="button" value="-" id="btn-minus" class="box-minus" />
                    <input id="quantity" class="quantity" name="quantity" type="text" onfocus="this.blur()" readonly="readonly" data-max="{{ $product->productStock->stock_quantity }}" value="{{ $product->quantity ? $product->quantity : 1 }}" />
                    <input type="button" value="+" id="btn-plus" class="box-plus" />
                </div>
                <a class="btn btn-purple btn-sm">
                    <i class="fa fa-heart"></i>
                    <span aria-label="Adicionar aos Favoritos">Favoritos</span>
                </a>
            </form>
            <form id="shippingForm" class="shipping-form">
                <div class="mt-4">
                    <div class="position-relative">
                        <i class="fa fa-truck"></i><input type="text" id="zipcode" class="form-control" placeholder="Digite aqui o seu CEP" name="zipcode" value="{{ old('zipcode') }}">
                        <input type="hidden" id="product_id" class="form-control" value="{{ $product->id }}" />
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
                    <div class="shipping-table-item shipping-pac">
                        <div class="shipping-transport">
                            <span>Correios</span>
                        </div>
                        <div class="shipping-service">
                            <span>PAC</span>
                        </div>
                        <div class="shipping-price">
                            <strong id="pac-price"></strong>
                        </div>
                        <div class="shipping-deadline">
                            Entrega em <span id="pac-deadline"></span> dias úteis
                        </div>
                    </div>
                </div>
            </form>
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
