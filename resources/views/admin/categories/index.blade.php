@extends('layouts.app-admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Categoria', 'route' => 'admin.categorias.create'])
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @include('partials.tables.head',
                    ['heads' => ['#', 'Nome da Categoria', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="td-id" scope="row">{{ $category->id }}</td>
                        <td scope="row">{{ $category->category_title }}</td>
                        <td class="td-actions">
                            <a href="" class="me-1"><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
