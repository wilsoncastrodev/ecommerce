@extends('layouts.app-admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Avaliações'])
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @include('partials.tables.head',
                    ['heads' => ['#', 'Avaliação do Produto', 'Conteúdo da Avaliação', 'Avaliação', 'Status', 'Data', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td class="td-id" scope="row">{{ $review->id }}</td>
                        <td scope="row">
                            <a href="{{ url('/produto/' . $review->product->product_url) }}">
                                {{ $review->product->product_title }}
                            </a>
                        </td>
                        <td scope="row">
                            <div class="fw-bold">{{ $review->review_title }}</div>
                            <div>{{ $review->review_content }}</div>
                            <div class="mt-2 fw-bold">Avaliado Por: {{ $review->customer->name }}</div>
                        </td>
                        <td>
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $review->review_rating)
                                    <i class="fa fa-star text-yellow"></i>
                                @else 
                                    <i class="fa fa-star text-gray"></i>
                                @endif
                            @endfor
                        </td>
                        <td>{{ $review->review_status == "active" ? "Aprovado" : "Desaprovado" }}</td>
                        <td>{{ formatDateDefault($review->created_at) }}</td>
                        <td class="td-actions">
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {!! $reviews->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
