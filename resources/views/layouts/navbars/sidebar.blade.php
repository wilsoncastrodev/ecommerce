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
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>