@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Categoria'])
        </div>
    </div>
    <div class="row pt-5">
        <div class="col">
            <form method="POST" action="{{ route('categorias.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="category-title" class="mb-2">Título da Categoria</label>
                    <input type="text" class="form-control" name="category_title" id="category-title" placeholder="Entre com o Título da Categoria">
                    <div class="mt-1">
                        @error('category_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="mb-1">
                        <label class="form-check-label">Exibir a Categoria no Topo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="category_top" id="category-top1" value="yes">
                        <label class="form-check-label" for="category-top1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="category_top" id="category-top2" value="no">
                        <label class="form-check-label" for="category-top2">Não</label>
                    </div>
                    <div class="mt-1">
                        @error('category_top')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="category-image" class="form-label">Selecione a Imagem da Categoria</label>
                        <input class="form-control" type="file" name="category_image" id="category-image">
                    </div>
                    <div class="mt-1">
                        @error('category_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar Categoria</button>
            </form>
        </div>
    </div>
</div>
@endsection
