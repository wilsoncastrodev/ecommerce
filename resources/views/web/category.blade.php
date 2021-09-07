@extends('web.layout.app')

@section('content')
<section class="category">
    <div class="container">
        <h2 class="ms-2 pb-2 mt-3">{{ $category->category_title }}</h2>
        <div class="row mt-4" id="content-load-more">
           @include('web.partials.cards.card-alt', ['products' => $category->products])
        </div>
        <div class="text-center">
            <div class="btn btn-base btn-lg" id="btn-load-more" 
                data-products-view="{{ $category->products_view }}" 
                data-route="{{ route('load-more-category') }}" 
                data-total-products="{{ $category->total_products }}"
                data-category-slug="{{ $category->category_slug }}"
            >
                Ver Mais Produtos
            </div>
        </div>
    </div>
</section>
@endsection