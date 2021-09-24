<div class="d-flex flex-column p-3 text-white bg-dark vh-100" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Ecommerce</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->is('admin') ? 'active' : '' }}">
                Home
            </a>
        </li>
        <li>
            <a href="{{ route('admin.clientes.index') }}" class="nav-link text-white {{ request()->is('admin/clientes*') ? 'active' : '' }}">
                Clientes
            </a>
        </li><li>
            <a href="{{ route('admin.produtos.index') }}" class="nav-link text-white {{ request()->is('admin/produtos*') ? 'active' : '' }}">
                Produtos
            </a>
        </li>
        <li>
            <a href="{{ route('admin.fabricantes.index') }}" class="nav-link text-white {{ request()->is('admin/fabricantes*') ? 'active' : '' }}">
                Fabricantes
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categorias.index') }}" class="nav-link text-white {{ request()->is('admin/categorias-produtos*') ? '' : (request()->is('admin/categorias*') ? 'active' : '') }}">
                Categorias
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categorias-produtos.index') }}" class="nav-link text-white {{ request()->is('admin/categorias-produtos*') ? 'active' : '' }}">
                Categorias do Produto
            </a>
        </li>
    </ul>
</div>