@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Usuário'])
        </div>
    </div>
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row pt-3">
        <div class="col">
            <form method="POST" class="form-admin" action="{{ route('admin.usuarios.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h5 class="mt-2 mb-4 text-blue-100">Informações do Usuário</h5>
                    <div class="row px-3 mb-3">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="name" class="mb-2">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Entre com o Nome">
                                <div class="mt-1">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="mb-2">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Entre com o E-mail">
                                <div class="mt-1">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="mb-1">
                                    <label class="form-check-label">É Administrador?</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_admin" id="yes-admin" value="1">
                                    <label class="form-check-label" for="yes">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_admin" id="no-admin" value="0">
                                    <label class="form-check-label" for="no">Não</label>
                                </div>
                                <div class="mt-1">
                                    @error('is_admin')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="mb-2">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Entre com a Senha">
                                <div class="mt-1">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-admin btn-admin-primary">Cadastrar Usuário</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
