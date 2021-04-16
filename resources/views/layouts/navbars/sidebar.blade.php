<div class="d-flex flex-column p-3 text-white bg-dark h-100" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Ecommerce</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link text-white">
                Home
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('clientes.index') }}" class="nav-link text-white {{ request()->is('clientes*') ? 'active' : '' }}">
                Clientes
            </a>
        </li><li>
            <a href="{{ route('produtos.index') }}" class="nav-link text-white {{ request()->is('produtos*') ? 'active' : '' }}">
                Produtos
            </a>
        </li>
        <li>
            <a href="{{ route('fabricantes.index') }}" class="nav-link text-white {{ request()->is('fabricantes*') ? 'active' : '' }}">
                Fabricantes
            </a>
        </li>
        <li>
            <a href="{{ route('categorias.index') }}" class="nav-link text-white {{ request()->is('categorias-produtos*') ? '' : (request()->is('categorias*') ? 'active' : '') }}">
                Categorias
            </a>
        </li>
        <li>
            <a href="{{ route('categorias-produtos.index') }}" class="nav-link text-white {{ request()->is('categorias-produtos*') ? 'active' : '' }}">
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