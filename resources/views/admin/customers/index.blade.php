@extends('layouts.app-admin')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Clientes'])
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
                        <td scope="row">{{ $id }}</td>
                        <td scope="row">{{ $customer_name }}</td>
                        <td scope="row">{{ $customer_email }}</td>
                        <td scope="row">{{ $customer_contact }}</td>
                        <td scope="row">{{ $customer_role }}</td>
                        <td>
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
