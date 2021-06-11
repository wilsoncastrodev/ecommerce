@extends('web.layout.app')

@section('content')
<section class="category">
    <div class="container">
        <h2 class="ms-2 pb-2">Pesquisa</h2>
        <div class="scrolling-wrapper">
            @empty(!$search)
                @foreach($search as $product)
                    @include('web.partials.cards.card')
                @endforeach
            @endempty
        </div>
    </div>
</section>
@endsection