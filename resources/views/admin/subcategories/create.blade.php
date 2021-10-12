@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Subcategoria'])
        </div>
    </div>
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row pt-3 pb-5">
        <div class="col">
            <form method="POST" class="form-admin" action="{{ route('admin.subcategory.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h5 class="mt-2 mb-4 text-blue-100">Informações da Subcategoria</h5>
                    <div class="row px-3 mb-3">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="product-category-title" class="mb-2">Título da Subcategoria</label>
                                <input type="text" class="form-control" name="product_category_title" id="product-category-title" placeholder="Entre com o Título da Subcategoria">
                                <div class="mt-1">
                                    @error('product_category_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="mb-1">
                                    <label class="form-check-label">Exibir Subcategoria no Topo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="product_category_top" id="product-category-top1" value="yes">
                                    <label class="form-check-label" for="product-category-top1">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="product_category_top" id="product-category-top2" value="no">
                                    <label class="form-check-label" for="product-category-top2">Não</label>
                                </div>
                                <div class="mt-1">
                                    @error('product_category_top')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="product-category-image" class="form-label">Selecione a Imagem da Subcategoria</label>
                                    <input class="form-control form-control-lg" type="file" name="product_category_image" id="product-category-image">
                                </div>
                                <div class="mt-1">
                                    @error('product_category_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-admin btn-admin-primary">Cadastrar Subcategoria</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
