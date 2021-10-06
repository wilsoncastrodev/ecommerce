<div class="sidebar-admin d-flex flex-column p-3 text-white vh-100">
    <a href="/" class="navbar-brand text-white text-decoration-none me-0">
        <span>wCastro</span>
    </a>
    <hr class="mx-5 px-5">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->is('admin') ? 'active' : '' }}">
                Painel Administrativo
            </a>
        </li>
        <li>
            <a href="{{ route('admin.clientes.index') }}" class="nav-link text-white {{ request()->is('admin/clientes*') ? 'active' : '' }}">
                Clientes
            </a>
        </li>
        <li>
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
            <a href="{{ route('admin.categorias.index') }}" class="nav-link text-white {{ request()->is('admin/subcategory*') ? '' : (request()->is('admin/categorias*') ? 'active' : '') }}">
                Categorias
            </a>
        </li>
        <li>
            <a href="{{ route('admin.usuarios.index') }}" class="nav-link text-white {{ request()->is('admin/usuarios*') ? 'active' : '' }}">
                Usuários
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('admin.subcategory.index') }}" class="nav-link text-white {{ request()->is('admin/subcategory*') ? 'active' : '' }}">
                Subcategorias
            </a>
        </li> --}}
    </ul>
    <hr>
    <a href="{{ route('logout') }}" class="text-center px-1"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="text-white font-weight-bold">Sair</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
