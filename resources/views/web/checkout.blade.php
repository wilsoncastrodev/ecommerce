@extends('web.layout.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-3">
            @include('web.partials.cards.card-back-cart')
        </div>
        <div class="col-4">
            @include('web.partials.cards.card-address')
        </div>
        <div class="col-5">
            @include('web.partials.cards.card-resume')
        </div>
    </div>
    <h2 class="mt-5 mb-4">Formas de Pagamento</h2>
    <div class="row">
        <div class="col-12">
            @include('web.partials.forms.credit-card-form')
        </div>
    </div>
</div>
@endsection
