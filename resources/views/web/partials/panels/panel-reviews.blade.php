<div class="panel px-3">
    <div class="panel-reviews">
        <div class="d-flex">
            <h3 class="text-green-900 d-inline-block">Avaliação dos clientes</h3>
        </div>
        <div class="review-general">
            <div class="stars-lg">
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
                <span>{{ $rating }} de 5</span>
            </div>
            <div class="review-quantity">
                @if($product->reviews->count() > 0)
                    {{ $product->reviews->count() }} clientes avaliaram este produto
                @else
                    Não há avalições para este produto
                @endif
            </div>
            
            @guest('customer')
                <form action="{{ route('login-review') }}" id="login-review" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary-alt ms-auto" id="btn-rating-form">Escreva uma Avaliação</button>
                </form>
            @else
                <button class="btn btn-outline-secondary-alt ms-auto" data-bs-toggle="modal" data-bs-target="#modal-rating" data-auth="{{ !empty(Auth::user()->name) ? 'active' : '' }}">Escreva uma Avaliação</button>
            @endguest
        </div>

        @empty(!$product->reviews)
            @foreach($product->reviews->reverse() as $review)
            <div class="review-customer mt-4">
                <div class="review-rating">
                    <div class="stars-sm d-inline-block">
                        @for($i = 0; $i < $review->review_rating; $i++)
                            <i class="fa fa-star text-yellow"></i>
                        @endfor
                    </div>
                    <div class="review-title d-inline-block ms-2">
                        <strong class="{{ $review->review_rating < 3 ? 'text-red' : 'text-green'}}">{{ $review->review_title }}</strong>
                    </div>
                </div>
                <div class="review-content mb-2">
                    {{ $review->review_content }}
                </div>
                <div class="review-footer">
                    <strong class="text-green-900 me-1">{{ $review->customer->name }}</strong>
                    <span>{{ formatDateDefault($review->created_at) }}</span>
                </div>
            </div>
            @endforeach
        @endempty
    </div>
</div>

@include('web.partials.modals.modal-rating')