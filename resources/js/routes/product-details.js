import socialMediaLinks from 'social-media-links';
import { Modal } from 'bootstrap';

const buttonsQuantity = () => {
    const $btn_minus = document.getElementById('btn-minus'),
          $btn_plus = document.getElementById('btn-plus'),
          $field_quantity = document.getElementById('quantity'),
          $quantity_product_form = document.getElementById('quantity-product-form');

    if ($quantity_product_form) {
        $btn_minus.addEventListener("click", () => {
            let quantity = parseInt($field_quantity.value);

            if (quantity > 1) $field_quantity.value = quantity - 1;
        });

        $btn_plus.addEventListener("click", () => {
            let quantity = parseInt($field_quantity.value),
                max = $field_quantity.getAttribute('data-max');

            if (max >= 99) max = 99;
            if (quantity < max) $field_quantity.value = quantity + 1;
        });

        $field_quantity.addEventListener("change", (e) => {
            let quantity = e.target.value;
            max = $field_quantity.getAttribute('data-max');

            if (quantity < 1) $field_quantity.value = 0;
            if (quantity > max) $field_quantity.value = max;
        });
    }
}

const checkShipping = () => {
    const $shipping_product_form = document.getElementById('shippingProductForm'),
          $zipcode = document.getElementById('zipcode'),
          $product_quantity = document.getElementById('quantity');

    if ($shipping_product_form) {
        $zipcode.addEventListener("keyup", (e) => {
            e.preventDefault();

            const $shippingForm = document.forms.shippingProductForm;

            let route = $shippingForm.route.value,
                cart = $shippingForm.cart ? $shippingForm.cart.value : null,
                zipcode = $shippingForm.zipcode.value,
                product = null;

            if ($product_quantity) {
                let product_id = $shippingForm.product_id.value,
                    product_quantity = $product_quantity.value;

                product = {
                    'product_id': product_id,
                    'product_quantity': product_quantity
                }
            }

            axios.post(route, {
                zipcode: zipcode,
                cart_id: cart,
                product: product
            })
            .then((response) => {
                const $shipping_message = document.getElementById('shipping-message'),
                      $sedex_price = document.getElementById('sedex-price'),
                      $sedex_deadline = document.getElementById('sedex-deadline');

                if (response.data[0].name == 'Sedex') {
                    $shipping_message.classList.remove('d-none');
                    $sedex_price.innerText = "R$ " + response.data[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                    $sedex_deadline.innerText = response.data[0].deadline;
                }
            });
        });
    }
}

const shareLinks = () => {
    const $share_links = document.getElementById('share-links');

    if ($share_links) {
        const $icon_share_email = document.getElementById('icon-share-email'),
              $icon_share_facebook = document.getElementById('icon-share-facebook'),
              $icon_share_twitter = document.getElementById('icon-share-twitter'),
              $icon_share_whatsapp = document.getElementById('icon-share-whatsapp'),
              $product_title = document.getElementById('product-title');

        let url = window.location.href;

        let shareTwitter,
            shareFacebook,
            shareEmail;

        shareTwitter = {
            account: 'email',
            url: url,
            title: $product_title.innerText,
            via: 'coolaccount44',
            hashtags: [
                'coolhashtag',
                'anothercoolhashtag'
            ]
        };
        
        shareFacebook = {
            account: 'facebook',
            url: url,
            title: $product_title.innerText,
            via: 'coolaccount44',
            hashtags: [
                'coolhashtag',
                'anothercoolhashtag'
            ]
        };
        
        shareEmail = {
            account: 'twitter',
            url: url,
            title: $product_title.innerText,
            via: 'coolaccount44',
            hashtags: [
                'coolhashtag',
                'anothercoolhashtag'
            ]
        };
        
        $icon_share_email.href = socialMediaLinks.create(shareTwitter);
        $icon_share_facebook.href = socialMediaLinks.create(shareFacebook);
        $icon_share_twitter.href = socialMediaLinks.create(shareEmail);
        $icon_share_whatsapp.href = "";
    }
}

const showReviewForm = () => {
    const $login_review = document.getElementById('login-review');
    
    if($login_review) {
        $login_review.addEventListener('submit', (e) => {
            e.preventDefault();
            e.stopPropagation();

            localStorage.setItem('modal_review', 'active');

            $login_review.submit();
        });
    }

    const openModalReview = () => {
        let modal_review = localStorage.getItem('modal_review');
        const $modal_rating = document.getElementById('modal-rating');
        
        if ($modal_rating) {
            if(modal_review == 'active') {
                const $modal_review = new Modal($modal_rating);

                $modal_review.show();

                localStorage.setItem('modal_review', 'desactive');
            }
        }
    }

    const hoverRatingLabel = () => {
        const $rating_label = document.querySelectorAll('.rating-icon');

        if ($rating_label) {
            $rating_label.forEach((e) => {
                e.addEventListener('mouseover', (event) => {
                    const $hover_rating_label = document.getElementById('hover-rating-label');

                    let rating_value = event.target.getAttribute('data-stars');

                    event.target.parentNode.nextElementSibling.checked = true;

                    if (rating_value == '1 star') {
                        $hover_rating_label.innerHTML = 'Péssimo';
                    }
                    
                    if (rating_value == '2 stars') {
                        $hover_rating_label.innerHTML = 'Ruim';
                    }
                    
                    if (rating_value == '3 stars') {
                        $hover_rating_label.innerHTML = 'Bom';
                    }
                    
                    if (rating_value == '4 stars') {
                        $hover_rating_label.innerHTML = 'Ótimo';
                    }
                    
                    if (rating_value == '5 stars') {
                        $hover_rating_label.innerHTML = 'Excelente';
                    }
                });
            });
        }
    }

    hoverRatingLabel();
    openModalReview();
}

buttonsQuantity();
shareLinks();
checkShipping();
showReviewForm();