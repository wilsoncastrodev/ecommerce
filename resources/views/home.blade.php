@extends('web.layout.app')

@section('content')
<section class="news">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja as Últimas Novidades</h2>
        <div class="scrollbox">
            <div class="scrolling-wrapper" id="content">
                @if($products->count() > 4) 
                    <div class="btn-group-scrolling">
                        <button class="btn btn-base btn-left-arrow">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-base btn-right-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                @endif
                @php $i = 1; @endphp
                @foreach($products as $product)
                    @include('web.partials.cards.card')
                    @php $i++; @endphp
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="features mt-5">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja as Melhores Ofertas do Dia</h2>
        <div class="scrollbox">
            <div class="scrolling-wrapper" id="content">
                @if($products_featured->count() > 4) 
                    <div class="btn-group-scrolling">
                        <button class="btn btn-base btn-left-arrow">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-base btn-right-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                @endif
                @php $i = 1; @endphp
                @foreach($products_featured as $product)
                    @include('web.partials.cards.card')
                    @php $i++; @endphp
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="features mt-5">
    <div class="container">
        <h2 class="ms-2 pb-2">Veja os Produtos Mais Vendidos</h2>
        <div class="scrollbox">
            <div class="scrolling-wrapper" id="content">
                @empty($products_top)
                    @if($products_top->count() > 4) 
                        <div class="btn-group-scrolling">
                            <button class="btn btn-base btn-left-arrow">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-base btn-right-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    @endif
                    @php $i = 1; @endphp
                    @foreach($products_top as $product)
                        @include('web.partials.cards.card')
                        @php $i++; @endphp
                    @endforeach
                @endempty
            </div>
        </div>
    </div>
</section>
@endsection
