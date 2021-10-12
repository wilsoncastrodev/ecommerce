@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Categoria'])
        </div>
    </div>
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row pt-3 pb-5">
        <div class="col">
            <form method="POST" class="form-admin" action="{{ route('admin.categorias.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h5 class="mt-2 mb-4 text-blue-100">Informações da Categoria</h5>
                    <div class="row px-3 mb-3">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="category-title" class="mb-2">Título da Categoria</label>
                                <input type="text" class="form-control" name="category_title" id="category-title" placeholder="Entre com o Título da Categoria" value="{{ old('category_title') }}">
                                <div class="mt-1">
                                    @error('category_title')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="mb-1">
                                    <label class="form-check-label">Exibir a Categoria no Topo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="category_top" id="category-top1" value="yes" {{ old('category_top') === "yes" ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category-top1">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="category_top" id="category-top2" value="no" {{ old('category_top') === "no" ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category-top2">Não</label>
                                </div>
                                <div class="mt-1">
                                    @error('category_top')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="category-image" class="form-label">Selecione a Imagem da Categoria</label>
                                    <input class="form-control form-control-lg" type="file" name="category_image" id="category-image">
                                </div>
                                <div class="mt-1">
                                    @error('category_image')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-admin btn-admin-primary">Cadastrar Categoria</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
