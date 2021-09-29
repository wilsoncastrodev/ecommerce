@extends('layouts.app-admin')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Clientes'])
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @include('partials.tables.head',
                    ['heads' => ['#', 'Nome', 'CPF', 'Email', 'Telefone', 'Data de Cadastro', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    @php(extract($customer))
                    <tr>
                        <td scope="row">{{ $id }}</td>
                        <td scope="row">{{ $name }}</td>
                        <td scope="row">{{ $cpf }}</td>
                        <td scope="row">{{ $email }}</td>
                        <td scope="row">{{ $phone }}</td>
                        <td scope="row">{{ formatDateDefault($created_at) }}</td>
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
