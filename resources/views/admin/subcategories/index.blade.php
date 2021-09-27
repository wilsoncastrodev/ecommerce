@extends('layouts.app-admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Subcategoria', 'route' => 'admin.subcategory.create'])
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @include('partials.tables.head',
                    ['heads' => ['#', 'Título', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($product_categories as $product_category)
                    @php(extract($product_category))
                    <tr>
                        <td class="td-id" scope="row">{{ $id }}</td>
                        <td scope="row">{{ $product_category_title }}</td>
                        <td class="td-actions">
                            <a href="" class="me-1"><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
