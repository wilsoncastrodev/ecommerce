<header class="header-admin">
    <nav class="navbar navbar-admin navbar-expand-lg navbar-light pb-2 pt-0">
        <div class="container d-block">
            <div class="row">
                <div class="col-12 mt-4 text-end">
                    <a href="{{ route('logout') }}" class="px-1"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="text-base font-weight-bold">Sair</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>