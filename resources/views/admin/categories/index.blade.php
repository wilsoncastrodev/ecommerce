@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Categoria', 'route' => 'admin.categorias.create'])
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
                    @foreach($categories as $category)
                        @php(extract($category))
                        <tr>
                            <th scope="row">{{ $id }}</th>
                            <th scope="row">{{ $category_title }}</th>
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
