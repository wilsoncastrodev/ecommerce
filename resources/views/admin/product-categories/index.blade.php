@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Categorias dos Produtos'])
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    @include('partials.tables.head', 
                        ['heads' => ['#', 'Título', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($productCategories as $productCategory)
                        @php(extract($productCategory))
                        <tr>
                            <th scope="row">{{ $id }}</th>
                            <th scope="row">{{ $product_category_title }}</th>
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
