@auth('customer')
<div class="modal" id="modal-rating" tabindex="-1" aria-labelledby="modal-rating-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form class="default-form review-form" id="review-form" method="POST" action="{{ route('store-review-product') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @auth('customer')
                        <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">
                    @endauth
                    <h5>Faça a sua avaliação</h5>
                    <div class="review-product d-flex">
                        <img src="{{ asset($product->product_image1) }}" class="flex-fill">
                        <h6 class="flex-fill">{{ $product->product_title }}</h6>
                    </div>
                    <div class="review-rating mb-2">
                        <label class="mt-3">Sua avaliação para este produto</label>
                        <div>
                            <div class="rating-group">
                                <label aria-label="1 star" class="rating-label z-index-100" for="rating-1"><i data-stars="1 star" class="fa fa-star rating-icon"></i></label>
                                <input class="rating" checked name="review_rating" id="rating-1" value="1" type="radio">
                                <label aria-label="2 stars" class="rating-label z-index-100" for="rating-2"><i data-stars="2 stars" class="fa fa-star rating-icon"></i></label>
                                <input class="rating" name="review_rating" id="rating-2" value="2" type="radio">
                                <label aria-label="3 stars" class="rating-label z-index-100" for="rating-3"><i data-stars="3 stars" class="fa fa-star rating-icon"></i></label>
                                <input class="rating" name="review_rating" id="rating-3" value="3" type="radio">
                                <label aria-label="4 stars" class="rating-label z-index-100" for="rating-4"><i data-stars="4 stars" class="fa fa-star rating-icon"></i></label>
                                <input class="rating" name="review_rating" id="rating-4" value="4" type="radio">
                                <label aria-label="5 stars" class="rating-label z-index-100" for="rating-5"><i data-stars="5 stars" class="fa fa-star rating-icon"></i></label>
                                <input class="rating" name="review_rating" id="rating-5" value="5" type="radio">
                            </div>
                            <span id="hover-rating-label">Péssimo</span>
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <label class="mb-1" for="security-code" class="text-green-900">Título da avaliação</label>
                        <input id="security-code" name="review_title" maxlength="30" type="text" class="form-control form-validated security-code" required />
                        <div class="invalid-feedback d-none">
                            Por favor, insira o código de segurança.
                        </div>
                    </div>
                    <div class="mb-4 position-relative">
                        <label class="mb-1" for="security-code" class="text-green-900">Escreva sua avaliação</label>
                        <textarea class="form-control" minlength="40" name="review_content" rows="3" aria-label=""></textarea>
                        <div class="invalid-feedback d-none">
                            Por favor, insira o código de segurança.
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-xs">
                                Avaliar
                        </button> 
                    </div>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth