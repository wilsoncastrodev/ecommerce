@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Categorias dos Produtos', 'route' => 'admin.categorias-produtos.create'])
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
                    @foreach($product_categories as $product_category)
                        @php(extract($product_category))
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
