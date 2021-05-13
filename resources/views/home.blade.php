@extends('web.layout.app')

@section('content')
<section class="news">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja as Últimas Novidades</h2>
        <div class="scrolling-wrapper">
            @foreach($products as $product)
            <a href="/ecommerce/public/produto/{{ $product->product_url }}" class="card card-simple">
                <img class="card-img-top" src="{{ asset($product->product_image1) }}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text mb-2">{{ $product->product_title }}</p>
                    <div class="card-stars">
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <span>(20)</span>
                    </div>
                    <div class="card-content-price">
                        <div class="card-price">
                            <small><s>De R$ {{ formatCurrency($product->product_price) }}</s></small>
                        </div>
                        <div class="card-sale-price">
                            <span>Por R$ {{ formatCurrency($product->product_sale_price) }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="features mt-5">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja as Melhores Ofertas do Dia</h2>
        <div class="scrolling-wrapper">
            @foreach($products_featured as $product)
            <a href="/ecommerce/public/produto/{{ $product->product_url }}" class="card card-simple">
                <img class="card-img-top" src="{{ asset($product->product_image1) }}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text mb-2">{{ $product->product_title }}</p>
                    <div class="card-stars">
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <span>(20)</span>
                    </div>
                    <div class="card-content-price">
                        <div class="card-price">
                            <small><s>De R$ {{ formatCurrency($product->product_price) }}</s></small>
                        </div>
                        <div class="card-sale-price">
                            <span>Por R$ {{ formatCurrency($product->product_sale_price) }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
