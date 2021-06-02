@extends('web.layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 mt-2 me-5">
            <h5 class="text-green-600">Alterar o Carrinho de Compra</h5>
            <div class="btn-back-cart">
                <i class="fa fa-shopping-cart"></i>
                <a href="{{ route('cart') }}">Voltar ao Carrinho</a>
            </div>
        </div>
        <div class="col-3 ps-5 mt-2 me-4">
            <h5 class="text-green-600">Endereço de Entrega</h5>
            <ul class="list-unstyled">
                <li class="mb-1">
                    {{ $customer->name }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->address }}, {{ $customer_address->number }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->complement }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->neighbourhood }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->state }} - {{ $customer_address->city }}
                </li>
                <li class="mb-1">
                    {{ $customer_address->zipcode }}
                </li>
            </ul>
        </div>
        <div class="col-5">
            @include('web.partials.cards.card-resume')
        </div>
        <div class="row">
            <h4 class="mt-4">Forma de Pagamento</h4 class="text-green-600">
            <div class="col-12 px-5">
                <div class="">
                    <form action="{{ route('create-order') }}" id="creditCardForm" method="POST" class="mt-4 needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="payment_method" value="CREDIT_CARD" />
                        <div class="row">
                            <div class="offset-3 col-6 px-5">
                                <h5 class="mb-4 text-green-600">Cartão de Crédito</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 position-relative">
                                            <label class="mb-1" for="number">Número do Cartão</label>
                                            <input id="number" name="number" type="text" class="form-control number" value="{{ old('number') }}" required />
                                            <div class="credit-cards">
                                                @include('web.partials.credit-cards.amex')
                                                @include('web.partials.credit-cards.visa')
                                                @include('web.partials.credit-cards.diners')
                                                @include('web.partials.credit-cards.elo')
                                                @include('web.partials.credit-cards.hipercard')
                                                @include('web.partials.credit-cards.mastercard')
                                            </div>
                                            <div class="invalid-feedback invalid-card">
                                                Por favor, insira o número do cartão de crédito válido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="mb-1" for="card_name">Nome Impresso do Cartão</label>
                                            <input type="text" id="card_name" name="card_name" class="form-control text-uppercase" value="{{ old('card_name') }}" required />
                                            <div class="invalid-feedback">
                                                Por favor, insira o nome impresso do cartão.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="row select">
                                            <label class="mb-1" for="exp">Validade (Mês/Ano)</label>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <select id="exp-month" name="exp_month" class="form-control form-select" required>
                                                        <option selected="true" disabled value="">Mês</option>
                                                        @foreach($credit_card->months as $month)
                                                        <option value="{{ formatLeadingZero($month) }}" {{ old('exp_month') == $month ? "selected" : "" }}>
                                                            {{ formatLeadingZero($month) }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Por favor, selecione o mês.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <select id="exp-year" name="exp_year" class="form-control form-select" required>
                                                        <option selected="true" disabled value="">Ano</option>
                                                        @foreach($credit_card->years as $year)
                                                        <option value="{{ $year }}" {{ old('exp_month') == $month ? "selected" : "" }}>
                                                            {{ $year }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Por favor, selecione o ano.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mb-3 position-relative">
                                            <label class="mb-1" for="security-code" class="required">Cod. de Segurança</label>
                                            <input id="security-code" name="security_code" maxlength="4" type="text" class="form-control security-code" required />
                                            <div class="credit-cards">
                                                @include('web.partials.credit-cards.security-code')
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor, insira o código de segurança.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="mb-1" for="installments">Parcelas</label>
                                            <select id="installments" name="installments" class="form-control form-select" required>
                                                <option selected="true" disabled value="">Número de Parcelas</option>
                                                <option value="01">1 vez</option>
                                                <option value="02">2 vezes</option>
                                                <option value="03">3 vezes</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor, seleciona a quantidade de parcelas.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" id="btn-checkout" class="btn btn-lg btn-success w-100">Concluir Pedido</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
