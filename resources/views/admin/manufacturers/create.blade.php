@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Fabricante'])
        </div>
    </div>
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row pt-3 pb-5">
        <div class="col">
            <form method="POST" class="form-admin" action="{{ route('admin.fabricantes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h5 class="mt-2 mb-4 text-blue-100">Informações do Fabricante</h5>
                    <div class="row px-3 mb-3">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="manufacturer-title" class="mb-2">Nome do Fabricante</label>
                                <input type="text" class="form-control" name="manufacturer_title" id="manufacturer-title" placeholder="Entre com o Nome do Fabricante" value="{{ old('manufacturer_title') }}">
                                <div class="mt-1">
                                    @error('manufacturer_title')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="manufacturer-image" class="form-label">Selecione a Imagem do Fabricante</label>
                                    <input class="form-control form-control-lg" type="file" name="manufacturer_image" id="manufacturer-image">
                                </div>
                                <div class="mt-1">
                                    @error('manufacturer_image')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-admin btn-admin-primary">Cadastrar Fabricante</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
