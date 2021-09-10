@extends('web.layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-11">
                    @include('web.partials.panels.panel-product-image')
                </div>
                <div class="col-1">
                    @include('web.partials.panels.panel-share')
                </div>
            </div>
        </div>
        <div class="col-6 ps-4">
            @include('web.partials.panels.panel-overview')
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-7 pe-5">
            @include('web.partials.panels.panel-description')
        </div>
        <div class="col-5">
            @include('web.partials.panels.panel-reviews')
        </div>
    </div>
</div>
@endsection
