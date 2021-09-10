<a href="{{ route('product', $product->product_url) }}">
    <div class="card card-simple p-0 {{ $i == 1 ? 'ms-0' : '' }}">
        <img class="card-img-top" src="{{ asset($product->product_image1) }}" alt="Card image cap">
        <div class="card-body">
            <p class="card-text mb-2">{{ limitText($product->product_title) }}</p>
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
            </div>
            <div class="card-content-price">
                <div class="card-price">
                    <small><s>De R$ {{ formatCurrency($product->product_price) }}</s></small>
                </div>
                <div class="card-sale-price">
                    <span>Por R$ {{ formatCurrency($product->product_sale_price) }}</span>
                </div>
            </div>
        </div>
    </div>
</a>