@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Clientes'])
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    @include('partials.tables.head', 
                        ['heads' => ['#', 'Nome', 'Email', 'Telefone', 'Função', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        @php(extract($customer))
                        <tr>
                            <th scope="row">{{ $id }}</th>
                            <th scope="row">{{ $customer_name }}</th>
                            <th scope="row">{{ $customer_email }}</th>
                            <th scope="row">{{ $customer_contact }}</th>
                            <th scope="row">{{ $customer_role }}</th>
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
