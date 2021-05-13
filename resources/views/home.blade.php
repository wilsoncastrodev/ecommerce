@extends('web.layout.app')

@section('content')
<section class="news">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja as Últimas Novidades</h2>
        <div class="scrolling-wrapper">
            @foreach($products as $product)
                @include('web.partials.cards.card')
            @endforeach
        </div>
    </div>
</section>

<section class="features mt-5">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja as Melhores Ofertas do Dia</h2>
        <div class="scrolling-wrapper">
            @foreach($products_featured as $product)
                @include('web.partials.cards.card')
            @endforeach
        </div>
    </div>
</section>

<section class="features mt-5">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja os Produtos Mais Vendidos</h2>
        <div class="scrolling-wrapper">
            @foreach($products_top as $product)
                @include('web.partials.cards.card')
            @endforeach
        </div>
    </div>
</section>
@endsection
