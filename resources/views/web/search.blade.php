@extends('web.layout.app')

@section('content')
<section class="category">
    <div class="container">
        <h2 class="ms-2 pb-2 mt-3">Você pesquisou por: {{ $search->keywords }}</h2>
        <div class="row mt-4" id="content-load-more">
           @include('web.partials.cards.card-alt', ['products' => $search])
        </div>

        @if($search->total_products > $search->products_view)
            <div class="text-center">
                <div class="btn btn-base btn-lg" id="btn-load-more" 
                    data-products-view="{{ $search->products_view }}" 
                    data-route="{{ route('load-more-search') }}" 
                    data-total-products="{{ $search->total_products }}"
                    data-s="{{ $search->keywords }}"
                >
                    Ver Mais Produtos
                </div>
            </div>
        @endif
    </div>
</section>
@endsection