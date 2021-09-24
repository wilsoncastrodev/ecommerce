@extends('web.layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4 mb-5">
        <div class="col-md-8">
            <div class="card card-alt p-0">
                <div class="card-header card-header-alt">
                    <h2 class="text-white mt-4">Crie sua conta</h2>
                    <div class="d-inline-block float-end">
                        <i class="fa fa-user me-2 text-white"></i>
                    </div>
                </div>

                @if ($errors->any())
                    @if (count($errors) >= 1)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Ocorreu alguns erros ao criar a sua conta.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                @endif

                <div class="card-body">
                    <form method="POST" class="default-form register-form needs-validation was-validated" novalidate id="registerForm" action="{{ route('customer.register') }}">
                        @csrf

                        <h5 class="mt-2 mb-4 text-green-600">Dados de Acesso</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6 pe-3">
                                        <div class="form-group mb-3">
                                            <label for="email" class="mb-2 text-green-600 text-md-right">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 ps-3">
                                        <div class="form-group mb-3">
                                            <label for="password" class="mb-2 text-green-600 text-md-right">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-4 text-green-600">Dados Pessoais</h5>
                        <div class="row mt-4 mb-3">
                            <div class="col-6 pe-3">
                                <div class="form-group mb-3">
                                    <label for="name" class="mb-2 text-green-600 text-md-right">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="cpf" class="mb-2 text-green-600 text-md-right">CPF</label>
                                    <input id="cpf" type="cpf" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf">

                                    @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 ps-3">
                                <div class="form-group mb-3">
                                    <label for="phone" class="mb-2 text-green-600 text-md-right">Telefone</label>
                                    <input id="phone" type="text" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="birthday" class="mb-2 text-green-600 text-md-right">Data de Nascimento</label>
                                    <input id="birthday" type="text" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday">

                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-4 text-green-600">Endereço</h5>
                        <div class="row mt-4">
                            <div class="col-6 pe-3">
                                <div class="form-group mb-3">
                                    <label for="zipcode" class="mb-2 text-green-600 text-md-right">CEP</label>
                                    <input id="zipcode" type="text" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="zipcode" value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>

                                    @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="neighbourhood" class="mb-2 text-green-600 text-md-right">Bairro</label>
                                    <input id="neighbourhood" type="text" class="form-control form-validated" readonly data-route="{{ route('register-validate') }}" name="neighbourhood" value="{{ old('neighbourhood') }}" required autocomplete="neighbourhood">

                                    @error('neighbourhood')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group mb-3">
                                            <label for="city" class="mb-2 text-green-600 text-md-right">Cidade</label>
                                            <input id="city" type="text" class="form-control form-validated" readonly data-route="{{ route('register-validate') }}" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>

                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group mb-3">
                                            <label for="state" class="mb-2 text-green-600 text-md-right">Estado</label>
                                            <input id="state" type="text" class="form-control form-validated" readonly data-route="{{ route('register-validate') }}" name="state" value="{{ old('state') }}" required autocomplete="state" autofocus>

                                            @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                            </div>

                            <div class="col-6 ps-3">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="form-group mb-3">
                                            <label for="address" class="mb-2 text-green-600 text-md-right">Endereço</label>
                                            <input id="address" type="text" class="form-control form-validated" readonly data-route="{{ route('register-validate') }}" name="address" value="{{ old('address') }}" required autocomplete="address">

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-3">
                                            <label for="number" class="mb-2 text-green-600 text-md-right">Número</label>
                                            <input id="number" type="text" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="number" value="{{ old('number') }}" required autocomplete="number">

                                            @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="complement" class="mb-2 text-green-600 text-md-right">Complemento</label>
                                            <input id="complement" type="text" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="complement" value="{{ old('complement') }}" required autocomplete="complement">

                                            @error('complement')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="reference" class="mb-2 text-green-600 text-md-right">Referência</label>
                                            <input id="reference" type="text" class="form-control form-validated" data-route="{{ route('register-validate') }}" name="reference" value="{{ old('reference') }}" required autocomplete="reference" autofocus>

                                            @error('reference')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-end mb-0 mt-4">
                            <button type="submit" class="btn btn btn-success btn-xs">
                                Cadastrar sua Conta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
