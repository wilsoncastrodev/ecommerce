<header>
    <nav class="navbar navbar-expand-lg navbar-light pb-0">
        <div class="container d-block">
            <div class="row mb-4">
                <div class="col-3 mt-2">
                    <a class="navbar-brand text-white" href="/">wCastro</a>
                </div>
                <div class="col-6">
                    <form class="d-flex">
                        <input class="form-control" type="search" placeholder="Pesquisar por Produto" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"><i class="fa fa-search text-white"></i></button>
                    </form>
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <div class="text-white ms-4 me-3 nav-icon">
                        <a href="{{ route('cart') }}" class="d-inline-block">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="{{ route('cart') }}" class="d-inline-block me-2">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </div>

                    @auth
                        <div>Teste</div>
                    @else
                        @guest('customer')
                            @if(Route::has('form.customer.login'))
                                <a href="{{ route('form.customer.login') }}" class="navbox text-white text-decoration-none">
                                    <i class="fa fa-user me-2"></i>
                                    <span>Entrar</span>
                                </a>
                            @endif
                        @endguest
                    @endauth
                </div>
            </div>
            <div class="row pt-1">
                <div class="col-2 px-0">
                    <div class="btn-group">
                        <button class="btn btn-menu btn-menu-dropdown btn-secondary btn-lg px-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bars me-2"></i>
                            <span class="me-2">Departamentos</span>
                        </button>
                        <ul class="dropdown-menu">
                            ...
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-4">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-5 me-auto mb-2 mb-lg-0">
                            <li class="nav-item me-3">
                                <button class="btn btn-menu btn-secondary btn-lg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Meus Pedidos</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                @auth
                                    <div>Teste</div>
                                @else
                                    @guest('customer')
                                        @if(Route::has('form.customer.register'))
                                            <a href="{{ route('form.customer.register') }}" class="btn btn-menu btn-lg">
                                                <span>Cadastra-se</span>
                                            </a>
                                        @endif
                                    @endguest
                                @endauth
                                
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
