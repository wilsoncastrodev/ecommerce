@extends('layouts.app-admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            @if(Auth::user()->is_admin == 1)
                @include('partials.contents.page-title.title-button', ['title' => 'Usuário', 'route' => 'admin.usuarios.create'])
            @else
                @include('partials.contents.page-title.title', ['title' => 'Usuário'])
            @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @if(Auth::user()->is_admin == 1)
                        @include('partials.tables.head',
                        ['heads' => ['#', 'Nome', 'Função', 'E-mail', 'Data de Criação', 'Ações']]
                        )
                    @else
                        @include('partials.tables.head',
                        ['heads' => ['#', 'Nome', 'Função', 'E-mail', 'Data de Criação']]
                        )
                    @endif
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="td-id" scope="row">{{ $user->id }}</td>
                        <td scope="row">{{ $user->name }}</td>
                        <td scope="row">{{ $user->is_admin == 1 ? "Administrador" : "Usuário" }}</td>
                        <td scope="row">{{ $user->email }}</td>
                        <td scope="row">{{ formatDateDefault($user->created_at) }}</td>
                        @if(Auth::user()->is_admin == 1)
                            <td class="td-actions">
                                <a href="" class="me-1"><i class="fas fa-edit"></i></a>
                                <a href=""><i class="fas fa-trash"></i></a>
                            </td>
                        @endif
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
