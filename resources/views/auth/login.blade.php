@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center py-3">
        <div class="col-md-5 px-5">
            <div class="card card-alt p-0">
                <div class="card-header bg-blue-100">
                    <h2 class="text-white mt-4">Identificação</h2>
                    <div class="d-inline-block float-end">
                        <i class="fa fa-user me-2 text-white"></i>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="default-form">
                        @csrf

                        <div class="form-group row mt-2 mb-4">
                            <div class="">
                                <label class="mb-2 text-green-600" for="email">E-mail</label>
                                <input id="email" type="email" placeholder="Digite o seu o E-mail" class="form-control px-3 d-block @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @if($errors->any())
                                    <span class="text-danger">
                                        <strong><small>{{ $errors->first('auth_error') }}</small></strong>
                                    </span>
                                @endif
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-2 text-green-600" for="password">Senha</label>
                            <input id="password" type="password" placeholder="Digite a sua Senha" class="form-control px-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label text-green-600" for="remember">
                                    <small>{{ __('Remember Me') }}</small>
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-end mt-2">
                            <button type="submit" class="btn btn-success btn-xs">
                                Continuar
                            </button>    
                        </div>
                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}

                        @include('partials.messages.auth')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
