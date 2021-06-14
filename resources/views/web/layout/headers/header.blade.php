<header>
    <nav class="navbar navbar-expand-lg navbar-light pb-0">
        <div class="container d-block">
            <div class="row mb-4">
                <div class="col-3 mt-2">
                    <a class="navbar-brand text-white" href="{{ url('/') }}">{{ env('APP_NAME', 'wCastro') }}</a>
                </div>
                <div class="col-6">
                    <form class="search-form d-flex" id="search-form" method="GET" action="{{ route('search-products') }}">
                        <input class="form-control" name="s" type="search" id="search" placeholder="Pesquisar por Produto" aria-label="Search" data-route="{{  route('quick-search-products') }}" 
                         autocomplete="off">
                        <button class="btn" type="submit" id="btn-search"><i class="fa fa-search text-white"></i></button>

                        <div class="search-form-box" id="search-form-box">
                            <h5 class="text-secondary">Você quis dizer: </h5>
                            <ul class="list-unstyled mb-0" id="quick-search"></ul>
                        </div>
                    </form>
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <div class="text-white nav-icon">
                        <a href="{{ route('cart') }}" class="d-inline-block">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="{{ route('cart') }}" class="d-inline-block me-2">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </div>

                    @guest('customer')
                        @if(Route::has('form.customer.login'))
                            <a href="{{ route('form.customer.login') }}" class="navbox text-white text-decoration-none ms-3">
                                <i class="fa fa-user me-2"></i>
                                <span>Entrar</span>
                            </a>
                        @endif
                    @else
                        <a href="" class="navbox text-white text-decoration-none ms-1 me-2">
                            <i class="fa fa-user me-1"></i>
                            <span>{{ firstName(Auth::guard('customer')->user()->name) }}</span>
                        </a>

                        <a href="{{ route('customer.logout') }}" class="navbox navbox-alt text-white px-1"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span>Sair</span>
                        </a>

                        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
            <div class="row pt-1">
                <div class="col-auto px-0 me-2">
                    <div class="btn-group">
                        <button class="btn btn-menu btn-menu-dropdown btn-secondary btn-lg" id="btn-menu-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bars me-2"></i>
                            <span class="me-2">Departamentos</span>
                        </button>
                        
                        <ul class="dropdown-menu" id="dropdown-menu">
                            @foreach ($categories as $category)
                                @empty (!$category->products->first())
                                    <a class="dropdown-item" href="{{ route('category', $category->category_slug) }}">{{ $category->category_title }}</a>
                                @endempty
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-5">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @foreach ($categories_top as $category)
                                @empty (!$category->products->first())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category', $category->category_slug) }}">{{ $category->category_title }}</a>
                                    </li>
                                @endempty
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <div class="float-end">
                        <ul class="navbar-nav btn-group z-index-none ms-5 me-auto mb-2 mb-lg-0">
                            <li class="nav-item me-3">
                                <button class="btn btn-menu btn-secondary btn-lg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Meus Pedidos</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                @guest('customer')
                                    @if(Route::has('form.customer.register'))
                                        <a href="{{ route('form.customer.register') }}" class="btn btn-menu btn-lg">
                                            <span>Cadastra-se</span>
                                        </a>
                                    @endif
                                @else
                                    <a href="" class="btn btn-menu btn-lg">
                                        <span>Minha Conta</span>
                                    </a>
                                @endguest
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>
<div class="bg-dropdown d-none" id="bg-dropdown"></div>
<div class="bg-search d-none" id="bg-search"></div>
