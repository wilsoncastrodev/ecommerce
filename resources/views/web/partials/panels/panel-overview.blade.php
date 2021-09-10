<span class="badge bg-orange px-4 mb-2">Tablet</span>
<h1 class="h1" id="product-title">{{ $product->product_title }}</h1>
<div class="stars">
    @php
        $rating = 0;

        if($product->reviews->sum('review_rating') > 0) {
            $rating = formatRating($product->reviews->sum('review_rating') / $product->reviews->count());
        }
    @endphp
    @for($i = 0; $i < 5; $i++) 
        @if($i < $rating) 
            <i class="fa fa-star text-yellow"></i>
        @else
            <i class="fa fa-star text-gray"></i>
        @endif
    @endfor
    <span>({{ $product->reviews->count() }})</span>
    <span class="text-base text-decoration-underline">Ver Avaliações</span>
</div>
<div class="product-price mt-4 mb-3">
    <div class="price">
        <small><s>De R$ {{ formatCurrency($product->product_price) }}</s></small>
    </div>
    <div class="sale-price">
        <span>Por R$ {{ formatCurrency($product->product_sale_price) }}</span>
    </div>
</div>
@include('web.partials.forms.add-cart-form')
@include('web.partials.forms.shipping-product-form')
