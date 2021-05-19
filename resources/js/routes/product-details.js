import socialMediaLinks from 'social-media-links';

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
                console.log(response);
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

buttonsQuantity();
shareLinks();
checkShipping();