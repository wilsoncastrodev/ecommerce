@extends('layouts.app-admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Usuários'])
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @include('partials.tables.head',
                    ['heads' => ['#', 'Nome', 'E-mail', 'Data de Criação', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="td-id" scope="row">{{ $user->id }}</td>
                        <td scope="row">{{ $user->name }}</td>
                        <td scope="row">{{ $user->email }}</td>
                        <td scope="row">{{ formatDateDefault($user->created_at) }}</td>
                        <td class="td-actions">
                            <a href="" class="me-1"><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
