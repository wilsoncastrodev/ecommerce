@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Produto'])
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    @include('partials.tables.head', 
                        ['heads' => ['#', 'Título', 'Preço', 'Preço de Venda', 'Descrição', 'Status', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($products as $product)
                        @php(extract($product))
                        <tr>
                            <th scope="row">{{ $id }}</th>
                            <th scope="row">{{ $product_title }}</th>
                            <th scope="row">{{ $product_price }}</th>
                            <th scope="row">{{ $product_sale_price }}</th>
                            <th scope="row">{{ $product_description }}</th>
                            <th scope="row">{{ $product_status }}</th>
                            <td>
                                <a href="">Editar</a><br>
                                <a href="">Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
