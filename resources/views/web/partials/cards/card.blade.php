<a href="{{ url("/produto") . "/" .  $product->product_url }}" class="card card-simple">
    <img class="card-img-top" src="{{ asset($product->product_image1) }}" alt="Card image cap">
    <div class="card-body">
        <p class="card-text mb-2">{{ $product->product_title }}</p>
        <div class="card-stars">
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
            <i class="fa fa-star text-yellow"></i>
            <span>(20)</span>
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
</a>
