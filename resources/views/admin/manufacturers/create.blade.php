@extends('layouts.app-admin')

@section('content')
<div class="container">
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Fabricante'])
        </div>
    </div>
    <div class="row pt-5">
        <div class="col">
            <form method="POST" action="{{ route('admin.fabricantes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="manufacturer-title" class="mb-2">Nome do Fabricante</label>
                    <input type="text" class="form-control" name="manufacturer_title" id="manufacturer-title" placeholder="Entre com o Nome do Fabricante">
                    <div class="mt-1">
                        @error('manufacturer_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="mb-1">
                        <label class="form-check-label">Mostrar como os melhores fabricantes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="manufacturer_top" id="manufacturer-top1" value="yes">
                        <label class="form-check-label" for="manufacturer-top1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="manufacturer_top" id="manufacturer-top2" value="no">
                        <label class="form-check-label" for="manufacturer-top2">Não</label>
                    </div>
                    <div class="mt-1">
                        @error('manufacturer_top')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="manufacturer-image" class="form-label">Selecione a Imagem do Fabricante</label>
                        <input class="form-control" type="file" name="manufacturer_image" id="manufacturer-image">
                    </div>
                    <div class="mt-1">
                        @error('manufacturer_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar Fabricante</button>
            </form>
        </div>
    </div>
</div>
@endsection
