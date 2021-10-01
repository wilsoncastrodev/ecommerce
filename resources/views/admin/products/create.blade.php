@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Produto'])
        </div>
    </div>
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row pt-3 mb-5">
        <div class="col">
            <form method="POST" class="form-admin" action="{{ route('admin.produtos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-7">
                        <div class="mb-3">
                            <div class="card">
                                <h5 class="mt-2 mb-4 text-blue-100">Informações do Produto</h5>
                                <div class="row px-3">
                                    <div class="col-12 mb-3">
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-title">Título do Produto</label>
                                            <input id="product-title" name="product_title" type="text" class="form-control" value="{{ old('product_title') }}" />
                                            @error('product_title')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-url">Slug do Produto</label>
                                            <input type="text" id="product-url" name="product_url" class="form-control" value="{{ old('product_url') }}" />
                                            @error('product_url')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-description" class="required">Descrição do Produto</label>
                                            <textarea id="product-description" name="product_description" rows="5" class="form-control">{{ old('product_description') }}</textarea>
                                            @error('product_description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-features" class="required">Características do Produto</label>
                                            <textarea id="product-features" name="product_features" rows="5" class="form-control" >{{ old('product_features') }}</textarea>
                                            @error('product_features')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-price">Preço do Produto</label>
                                            <input type="currency" id="product-price" name="product_price" class="form-control" value="{{ old('product_price') }}" />
                                            @error('product_price')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-sale-price">Preço de Venda do Produto</label>
                                            <input type="currency" id="product-sale-price" name="product_sale_price" class="form-control" value="{{ old('product_sale_price') }}" />
                                            @error('product_sale_price')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="card">
                                <h5 class="mt-2 mb-4 text-blue-100">Peso e dimensões</h5>
                                <div class="row px-3">
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-weight">Peso do Produto</label>
                                            <input type="number" id="product-weight" name="product_weight" class="form-control" min="0.3" max="30" step="0.01" value="{{ old('product_weight') }}" />
                                            @error('product_weight')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-height">Altura do Produto</label>
                                            <input type="number" id="product-height" name="product_height" min="1" max="100" class="form-control" value="{{ old('product_height') }}" />
                                            @error('product_height')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-width">Largura do Produto</label>
                                            <input type="number" id="product-width" name="product_width" min="10" max="100" class="form-control" value="{{ old('product_width') }}" />
                                            @error('product_width')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-lenght">Comprimento do Produto</label>
                                            <input type="number" id="product-lenght" name="product_lenght" min="15" max="100" class="form-control" value="{{ old('product_lenght') }}" />
                                            @error('product_lenght')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="card">
                                <h5 class="mt-2 mb-4 text-blue-100">Gerenciamento de Estoque</h5>
                                <div class="row px-3">
                                    <div class="col-12 mb-3">
                                        <div class="mb-2">
                                            <label class="form-check-label" for="stock-enabled">Habilitar gerenciamento de estoque no nível do produto?</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="stock-enabled-yes" name="stock_enabled" type="radio" class="form-check-input" value="yes"/>
                                            <label class="form-check-label" for="stock-enabled-yes">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline ">
                                            <input id="stock-enabled-no" name="stock_enabled" type="radio" class="form-check-input" value="no"/>
                                            <label class="form-check-label" for="stock-enabled-no">Não</label>
                                        </div>
                                        <div>
                                            @error('stock_enabled')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="hidden-stock-yes">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="select">
                                                        <label class="mb-2" for="stock-status">Status de Estoque</label>
                                                        <div class="mb-3">
                                                            <select id="stock-status" name="stock_status" class="form-control form-select" aria-label="Status de Estoque">
                                                                <option value="in_stock">Em Estoque</option>
                                                                <option value="out_stock">Sem Estoque</option>
                                                                <option value="on_backorder">Em Espera</option>
                                                            </select>
                                                            @error('stock_status')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="hidden-stock-no" class="d-none">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="mb-2" for="stock-quantity">Quantidade em estoque</label>
                                                        <input type="number" id="stock-quantity" name="stock_quantity" class="form-control" value="{{ old('stock_quantity') }}" />
                                                        @error('stock_quantity')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="select">
                                                        <label class="mb-2" for="allow-backorders">Permitir pedidos em espera?</label>
                                                        <div class="mb-3">
                                                            <select id="allow-backorders" name="allow_backorders" class="form-control form-select" aria-label="Permitir pedidos em espera?">
                                                                <option value="no" selected>Não Permitir</option>
                                                                <option value="notify">Permitir, mas notificar o cliente</option>
                                                                <option value="yes">Permitir</option>
                                                            </select>
                                                            @error('allow_backorders')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-admin btn-admin-primary btn-lg">Cadastrar Produto</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="mb-3">
                            <div class="card">
                                <div class="row px-3">
                                    <div class="col-12 mb-3">
                                        <h5 class="mt-2 mb-4 text-blue-100">Outras Informações do Produto</h5>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-seo-description" class="required">Descrição para o SEO do Produto</label>
                                            <textarea id="product-seo-description" name="product_seo_description" rows="5" class="form-control" >{{ old('product_seo_description') }}</textarea>
                                            @error('product_seo_description')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-2" for="product-keywords">Palavras-Chave o SEO do Produto</label>
                                            <input type="text" id="product-keywords" name="product_keywords" class="form-control" value="{{ old('product_keywords') }}" />
                                            @error('product_keywords')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="select">
                                            <label class="mb-2" for="product-status">Status do Produto</label>
                                            <div class="mb-3">
                                                <select id="product-status" feature="product-status" name="product_status" class="form-control form-select" aria-label="Selecione uma Opção">
                                                    <option selected="true" disabled>Selecione uma Opção</option>
                                                    <option value="active">Ativado</option>
                                                    <option value="deactivate">Desativado</option>
                                                </select>
                                                @error('product_status')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="select">
                                            <label class="mb-2" for="product-featured">Produto em Destaque?</label>
                                            <div class="mb-3">
                                                <select id="product-featured" name="product_featured" class="form-control form-select" aria-label="Selecione uma Opção">
                                                    <option selected="true" disabled>Selecione uma Opção</option>
                                                    <option value="yes">Sim</option>
                                                    <option value="no">Não</option>
                                                </select>
                                                @error('product_featured')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="select">
                                            <label class="mb-2" for="manufacturer-id">Selecione um Fabricante</label>
                                            <div class="mb-3">
                                                <select id="manufacturer-id" name="manufacturer_id" class="form-control form-select" aria-label="Selecione um Fabricante">
                                                    <option selected="true" disabled>Selecione Fabricante</option>
                                                    @foreach($manufacturers as $manufacturer)
                                                    @php(extract($manufacturer))
                                                    <option value="{{ $id }}">{{ $manufacturer_title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('manufacturer_id')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="select">
                                            <label class="mb-2" for="category-id">Selecione uma Categoria</label>
                                            <div class="mb-3">
                                                <select id="category-id" name="category_id" class="form-control form-select" aria-label="Selecione uma Categoria">
                                                    <option selected="true" disabled>Selecione Categoria</option>+
                                                    @foreach($categories as $category)
                                                    @php(extract($category))
                                                    <option value="{{ $id }}">{{ $category_title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="select">
                                            <label class="mb-2" for="product-category-id">Selecione uma Subcategoria</label>
                                            <div class="mb-3">
                                                <select id="product-category-id" name="product_category_id" class="form-control form-select" aria-label="Selecione uma SubCategoria">
                                                    <option selected="true" disabled>Selecione uma Subcategoria</option>
                                                    @foreach($products_categories as $product_category)
                                                    @php(extract($product_category))
                                                    <option value="{{ $id }}">{{ $product_category_title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product_category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="card">
                                <div class="row px-3 mt-3">
                                    <div class="col-12 mb-3">
                                        <h5 class="mt-2 mb-4 text-blue-100">Imagens do Produto</h5>
                                        <div class="file-upload">
                                            <label class="mb-2" for="product-image1">Imagem do Produto 1</label>
                                            <div class="custom-file">
                                                <div class="mb-3">
                                                    <input id="product-image1" name="product_image[]" type="file" class="custom-file-input form-control form-control-lg d-block " aria-label="Imagem do Produto 1" />
                                                    @error('product_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="file-upload">
                                            <label class="mb-2" for="product-image2">Imagem do Produto 2</label>
                                            <div class="custom-file">
                                                <div class="mb-3">
                                                    <input id="product-image2" name="product_image[]" type="file" class="custom-file-input form-control form-control-lg" aria-label="Imagem do Produto 2" />
                                                    @error('product_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="file-upload">
                                            <label class="mb-2" for="product-image3">Imagem do Produto 3</label>
                                            <div class="custom-file">
                                                <div class="mb-3">
                                                    <input id="product-image3" name="product_image[]" type="file" class="custom-file-input form-control form-control-lg" aria-label="Imagem do Produto 3" />
                                                    @error('product_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
