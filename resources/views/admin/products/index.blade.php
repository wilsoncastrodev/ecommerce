@extends('layouts.app-admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Produto', 'route' => 'admin.produtos.create'])
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @include('partials.tables.head',
                    ['heads' => ['#', 'Título', 'Preço', 'Preço de Venda', 'Descrição', 'Status', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="td-id" scope="row">{{ $product->id }}</td>
                        <td scope="row">
                            <a href="{{ url('/produto/' . $product->product_url) }}">
                                {{ limitText($product->product_title) }}
                            </a>
                        </td>
                        <td scope="row">R$ {{ formatCurrency($product->product_price) }}</td>
                        <td scope="row">R$ {{ formatCurrency($product->product_sale_price) }}</td>
                        <td scope="row">{{ limitText($product->product_description) }}</td>
                        <td scope="row">{{ $product->product_status == "active" ? "Ativado" : "Desativado" }}</td>
                        <td class="td-actions">
                            <a href="" class="me-1"><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
