<header>
    <nav class="navbar navbar-expand-lg navbar-light pb-2 pt-0">
        <div class="container d-block">
            <div class="row">
                <div class="col-3 mt-2">
                    <a class="navbar-brand text-white" href="{{ url('/') }}">{{ env('APP_NAME', 'wCastro') }}</a>
                </div>
                <div class="col-9 d-flex justify-content-end">
                    @guest('customer')
                    @if(Route::has('form.customer.login'))
                    <a href="{{ route('form.customer.login') }}" class="navbox navbox-login text-white text-decoration-none ms-3">
                        <i class="fa fa-user me-2"></i>
                        <span>Entrar</span>
                    </a>
                    @endif
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    @include('web.partials.messages.info')
</header>
