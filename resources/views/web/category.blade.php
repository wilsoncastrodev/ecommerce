@extends('web.layout.app')

@section('content')
<section class="category">
    <div class="container">
        <h2 class="ms-2 pb-2">{{ $category->category_title }}</h2>
        <div class="scrolling-wrapper">
            @empty(!$category->products)
                @foreach($category->products as $product)
                    @include('web.partials.cards.card')
                @endforeach
            @endempty
        </div>
    </div>
</section>
@endsection