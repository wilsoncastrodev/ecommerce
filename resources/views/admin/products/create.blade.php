@extends('layouts.app-admin')

@section('content')
<div class="container">
    @include('partials.messages.success')
    @include('partials.messages.error')
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title', ['title' => 'Adicionar Produto'])
        </div>
    </div>
    <div class="row pt-5 mb-5">
        <div class="col">
            <form method="POST" action="{{ route('admin.produtos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="product-title">Título do Produto</label>
                            <input id="product-title" name="product_title" type="text" class="form-control" />
                            @error('product_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-url">Slug do Produto</label>
                            <input type="text" id="product-url" name="product_url" class="form-control" />
                            @error('product_url')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-description" class="required">Descrição do Produto</label>
                            <textarea id="product-description" name="product_description" rows="5" class="form-control"></textarea>
                            @error('product_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-features" class="required">Características do Produto</label>
                            <textarea id="product-features" name="product_features" rows="5" class="form-control"></textarea>
                            @error('product_features')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-price">Preço do Produto</label>
                            <input type="currency" id="product-price" name="product_price" class="form-control" />
                            @error('product_price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-sale-price">Preço de Venda do Produto</label>
                            <input type="currency" id="product-sale-price" name="product_sale_price" class="form-control" />
                            @error('product_sale_price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    Peso e dimensões
                                </div>
                                <div class="row px-3">
                                    <div class="col-6 mb-3">
                                        <div class="mb-3">
                                            <label for="product-weight">Peso do Produto</label>
                                            <input type="number" id="product-weight" name="product_weight" class="form-control" />
                                            @error('product_weight')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-height">Altura do Produto</label>
                                            <input type="number" id="product-height" name="product_height" class="form-control" />
                                            @error('product_height')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="product-width">Largura do Produto</label>
                                            <input type="number" id="product-width" name="product_width" class="form-control" />
                                            @error('product_width')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-lenght">Comprimento do Produto</label>
                                            <input type="number" id="product-lenght" name="product_lenght" class="form-control" />
                                            @error('product_lenght')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    Gestão de Estoque
                                </div>
                                <div class="row px-3">
                                    <div class="col-12 mb-3">
                                        <div>
                                            <label class="form-check-label mt-3" for="stock-enabled">Habilitar gerenciamento de estoque no nível do produto?</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="stock-enabled-yes" name="stock_enabled" type="radio" class="form-check-input" value="yes" />
                                            <label class="form-check-label" for="stock-enabled-yes">Sim</label>
                                        </div>
                                        <div class="form-check form-check-inline ">
                                            <input id="stock-enabled-no" name="stock_enabled" type="radio" class="form-check-input" value="no" />
                                            <label class="form-check-label" for="stock-enabled-no">Não</label>
                                        </div>
                                        <div>
                                            @error('stock_enabled')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="hidden-stock-yes">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="select">
                                                        <label for="stock-status">Status de Estoque</label>
                                                        <div class="mb-3">
                                                            <select id="stock-status" name="stock_status" class="form-control form-select" aria-label="Status de Estoque">
                                                                <option value="in_stock">Em Estoque</option>
                                                                <option value="out_stock">Fora de Estoque</option>
                                                                <option value="on_backorder">Em Espera</option>
                                                            </select>
                                                            @error('stock_status')
                                                            <span class="text-danger">{{ $message }}</span>
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
                                                        <label for="stock-quantity">Quantidade em estoque</label>
                                                        <input type="number" id="stock-quantity" name="stock_quantity" class="form-control" />
                                                        @error('stock_quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="select">
                                                        <label for="allow-backorders">Permitir pedidos em espera?</label>
                                                        <div class="mb-3">
                                                            <select id="allow-backorders" name="allow_backorders" class="form-control form-select" aria-label="Permitir pedidos em espera?">
                                                                <option value="no" selected>Não Permitir</option>
                                                                <option value="notify">Permitir, mas notificar o cliente</option>
                                                                <option value="yes">Permitir</option>
                                                            </select>
                                                            @error('allow_backorders')
                                                            <span class="text-danger">{{ $message }}</span>
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
                                <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="select">
                            <label for="product-featured">Produto em Destaque?</label>
                            <div class="mb-3">
                                <select feature="product-featured" name="product_featured" class="form-control form-select" aria-label="Selecione uma Opção">
                                    <option selected="true" disabled>Selecione uma Opção</option>
                                    <option value="yes">Sim</option>
                                    <option value="no">Não</option>
                                </select>
                                @error('product_featured')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="select">
                            <label for="manufacturer-id">Selecione um Fabricante</label>
                            <div class="mb-3">
                                <select id="manufacturer-id" name="manufacturer_id" class="form-control form-select" aria-label="Selecione um Fabricante">
                                    <option selected="true" disabled>Selecione Fabricante</option>
                                    @foreach($manufacturers as $manufacturer)
                                    @php(extract($manufacturer))
                                    <option value="{{ $id }}">{{ $manufacturer_title }}</option>
                                    @endforeach
                                </select>
                                @error('manufacturer_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="select">
                            <label for="category-id">Selecione uma Categoria</label>
                            <div class="mb-3">
                                <select id="category-id" name="category_id" class="form-control form-select" aria-label="Selecione uma Categoria">
                                    <option selected="true" disabled>Selecione Categoria</option>+
                                    @foreach($categories as $category)
                                    @php(extract($category))
                                    <option value="{{ $id }}">{{ $category_title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="select">
                            <label for="product-category-id">Selecione uma Subcategoria</label>
                            <div class="mb-3">
                                <select id="product-category-id" name="product_category_id" class="form-control form-select" aria-label="Selecione uma SubCategoria">
                                    <option selected="true" disabled>Selecione uma Subcategoria</option>
                                    @foreach($products_categories as $product_category)
                                    @php(extract($product_category))
                                    <option value="{{ $id }}">{{ $product_category_title }}</option>
                                    @endforeach
                                </select>
                                @error('product_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="file-upload">
                            <label for="product-image1">Imagem do Produto 1</label>
                            <div class="custom-file">
                                <div class="mb-3">
                                    <input id="product-image1" name="product_image[]" type="file" class="custom-file-input form-control d-block " aria-label="Imagem do Produto 1" />
                                    @error('product_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="file-upload">
                            <label for="product-image2">Imagem do Produto 2</label>
                            <div class="custom-file">
                                <div class="mb-3">
                                    <input id="product-image2" name="product_image[]" type="file" class="custom-file-input form-control" aria-label="Imagem do Produto 2" />
                                    @error('product_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="file-upload">
                            <label for="product-image3">Imagem do Produto 3</label>
                            <div class="custom-file">
                                <div class="mb-3">
                                    <input id="product-image3" name="product_image[]" type="file" class="custom-file-input form-control" aria-label="Imagem do Produto 3" />
                                    @error('product_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="file-upload">
                            <label for="product-image4">Imagem do Produto 4</label>
                            <div class="custom-file">
                                <div class="mb-4">
                                    <input id="product-image4" name="product_image[]" type="file" class="custom-file-input form-control" aria-label="Imagem do Produto 4" />
                                    @error('product_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="product-seo-description" class="required">Descrição de SEO do Produto</label>
                            <textarea id="product-seo-description" name="product_seo_description" rows="5" class="form-control"></textarea>
                            @error('product_seo_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-keywords">Palavras-Chave SEO do Produto</label>
                            <input type="text" id="product-keywords" name="product_keywords" class="form-control" />
                            @error('product_keywords')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-label">Rótulo do Produto</label>
                            <input type="text" id="product-label" name="product_label" class="form-control" />
                            @error('product_label')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
