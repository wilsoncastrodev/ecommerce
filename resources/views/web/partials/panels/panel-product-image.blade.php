<div class="panel pt-1">
    <div class="panel-image-feature">
        <img src="{{ asset($product->product_image1) }}">
    </div>
    <div class="panel-image-thumbnails">
        @empty(!$product->product_image1)
        <img src="{{ asset($product->product_image1) }}">
        @endempty
        @empty(!$product->product_image2)
        <img src="{{ asset($product->product_image2) }}">
        @endempty
        @empty(!$product->product_image3)
        <img src="{{ asset($product->product_image3) }}">
        @endempty
    </div>
</div>
