import Inputmask from 'inputmask';

const checkShipping = () => {
    const $check_shipping = document.getElementById('shippingCartForm'),
          $zipcode = document.getElementById('zipcode');

    if ($check_shipping) {
        $zipcode.addEventListener('keyup', (e) => {
            let zipcode_lenght = e.target.value.replace(/[^0-9]/g, '').length;

            if (zipcode_lenght > 7) {
                const $shippingForm = document.forms.shippingCartForm;

                let route = $shippingForm.route.value,
                    cart = $shippingForm.cart ? $shippingForm.cart.value : null,
                    zipcode = $shippingForm.zipcode.value.replace(/[^0-9]/g, '');

                axios.post(route, {
                    zipcode: zipcode,
                    cart_id: cart,
                    cart_page: true,
                })
                .then((response) => {
                    const $shipping_message = document.getElementById('shipping-message'),
                          $shipping = document.getElementById('shipping'),
                          $sedex_price = document.getElementById('sedex-price'),
                          $sedex_deadline = document.getElementById('sedex-deadline'),
                          $sedex_shipping = document.getElementById('sedex-shipping');
                    
                    const $subtotal = document.getElementById('subtotal'),
                          $total = document.getElementById('total');
                    
                    $subtotal.innerText = 'R$ ' + response.data.order_subtotal.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                    $total.innerText = 'R$ ' + response.data.order_total.toLocaleString('pt-br', { minimumFractionDigits: 2 });

                    if (response.data.shipping[0].name == 'Sedex') {
                        $shipping.classList.remove('d-none');
                        $shipping.classList.add('d-flex');
                        $shipping_message.classList.remove('d-none');
                        $sedex_price.innerText = 'R$ ' + response.data.shipping[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                        $sedex_deadline.innerText = response.data.shipping[0].deadline;
                        $sedex_shipping.innerText = 'R$ ' + response.data.shipping[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                    }
                });
            }
        });
    }
}

const addFieldsMask = () => {
    const $register_form = document.getElementById('shippingCartForm');

    if ($register_form) {
        const $zip = document.getElementById('zipcode');

        Inputmask({ 'mask': '99999-999', 'placeholder': ' ', 'showMaskOnHover': false }).mask($zip);
    }
}

const buttonsQuantity = () => {
    const $quantity_cart_form = document.getElementById('quantity-cart-form'),
          $shippingForm = document.forms.shippingCartForm;

    let i = 1;

    if ($quantity_cart_form) {
        Array.from(document.getElementsByClassName('quantity-form')).forEach(() => {
            const $btn_minus = document.getElementById('btn-minus-' + i),
                  $btn_plus = document.getElementById('btn-plus-' + i),
                  $field_quantity = document.getElementById('quantity-' + i);

            let max = $field_quantity.getAttribute('data-max'),
                data = {
                    'route' : $field_quantity.getAttribute('data-route'),
                    'cart' : $field_quantity.getAttribute('data-cart'),
                    'product' : $field_quantity.getAttribute('data-product'),
                    'zipcode' : '',
                    'quantity' : ''
            };

            $btn_minus.addEventListener('click', () => {
                data.quantity = parseInt($field_quantity.value) - 1;
                data.zipcode = $shippingForm.zipcode.value;

                if (data.quantity >= 1) {
                    $field_quantity.value = data.quantity;
                    updateQuantity(data);
                }     
            });

            $btn_plus.addEventListener('click', () => {
                data.zipcode = $shippingForm.zipcode.value;

                if (max >= 99) max = 99;

                if (data.quantity < max) {
                    data.quantity = parseInt($field_quantity.value) + 1,
                    $field_quantity.value = data.quantity;
                    updateQuantity(data);
                }    
            });

            $field_quantity.addEventListener('change', (e) => {
                data.quantity = e.target.value;

                if (data.quantity < 1) $field_quantity.value = 0;
                if (data.quantity > max) $field_quantity.value = max;
            });

            i++;
        });
    }

    const updateQuantity = (data) => {
        axios.post(data.route, {
            cart_id: data.cart,
            product_id: data.product,
            quantity: data.quantity,
            zipcode: data.zipcode,
            cart_page: true,
        })
        .then((response) => {
            const $subtotal = document.getElementById('subtotal'),
                  $total = document.getElementById('total');
            
            const $shipping_message = document.getElementById('shipping-message'),
                  $sedex_price = document.getElementById('sedex-price'),
                  $sedex_deadline = document.getElementById('sedex-deadline'),
                  $sedex_shipping = document.getElementById('sedex-shipping');

            $subtotal.innerText = 'R$ ' + response.data.order_subtotal.toLocaleString('pt-br', { minimumFractionDigits: 2 });
            $total.innerText = 'R$ ' + response.data.order_total.toLocaleString('pt-br', { minimumFractionDigits: 2 });

            if(response.data.shipping) {
                if (response.data.shipping[0].name == 'Sedex') {
                    $shipping_message.classList.remove('d-none');
                    $sedex_price.innerText = 'R$ ' + response.data.shipping[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                    $sedex_deadline.innerText = response.data.shipping[0].deadline;
                    $sedex_shipping.innerText = 'R$ ' + response.data.shipping[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                }
            }
        });
    }
}

const deleteProduct = () => {
    const $deleteProduct = document.getElementById('delete-product');

    if($deleteProduct) {
        Array.from(document.getElementsByClassName('delete-product')).forEach((e) => {
            e.addEventListener('click', (e) => {
                e.preventDefault();

                const $zipcode = document.getElementById('zipcode');

                let route = e.target.getAttribute('data-route'),
                    product = e.target.getAttribute('data-product'),
                    cart = e.target.getAttribute('data-cart'),
                    zipcode = $zipcode.value;
        
                axios.post(route, {
                    product_id: product,
                    cart_id: cart,
                    zipcode: zipcode,
                    cart_page: true,
                })
                .then((response) => {
                    const $subtotal = document.getElementById('subtotal'),
                          $total = document.getElementById('total'),
                          $product = document.getElementById('product-' + product);
                    
                    const $cart_product = document.getElementById('cart-product'),
                          $cart_item = document.querySelectorAll('.cart-item'),
                          $cart_empty = document.getElementById('cart-empty');

                    const $shipping_message = document.getElementById('shipping-message'),
                          $sedex_price = document.getElementById('sedex-price'),
                          $sedex_deadline = document.getElementById('sedex-deadline'),
                          $sedex_shipping = document.getElementById('sedex-shipping');
                    
                    $subtotal.innerText = 'R$ ' + response.data.order_subtotal.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                    $total.innerText = 'R$ ' + response.data.order_total.toLocaleString('pt-br', { minimumFractionDigits: 2 });

                    if(response.data.shipping) {
                        if (response.data.shipping[0].name == 'Sedex') {
                            $shipping_message.classList.remove('d-none');
                            $sedex_price.innerText = 'R$ ' + response.data.shipping[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                            $sedex_deadline.innerText = response.data.shipping[0].deadline;
                            $sedex_shipping.innerText = 'R$ ' + response.data.shipping[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                        }
                    }

                    $product.remove();

                    if($cart_item.length <= 1) {
                        $cart_product.classList.add('d-none');
                        $cart_empty.classList.remove('d-none');
                    }
                });
            });
        });
    }
};

deleteProduct();
checkShipping();
buttonsQuantity();
addFieldsMask();