const checkShipping = () => {
    const $check_shipping = document.getElementById('check-shipping'),
          $product_quantity = document.getElementById('quantity');

    if ($check_shipping) {
        $check_shipping.addEventListener("click", (e) => {
            e.preventDefault();
            
            const $shippingForm = document.forms.shippingForm;

            let route = $shippingForm.route.value,
                cart = $shippingForm.product_id.value,
                product_id = $shippingForm.product_id.value,
                zipcode = $shippingForm.zipcode.value,
                product_quantity = $product_quantity.value,
                product = null;

            if ($product_quantity) {
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
                      $sedex_deadline = document.getElementById('sedex-deadline'),
                      $pac_price = document.getElementById('pac-price'),
                      $pac_deadline = document.getElementById('pac-deadline');

                if (response.data[0].name == 'Sedex') {
                    $shipping_message.classList.remove('d-none');
                    $sedex_price.innerText = "R$ " + response.data[0].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                    $sedex_deadline.innerText = response.data[0].deadline;
                }
                
                if (response.data[1].name == 'PAC') {
                    $shipping_message.classList.remove('d-none');
                    $pac_price.innerText = "R$ " + response.data[1].price.toLocaleString('pt-br', { minimumFractionDigits: 2 });
                    $pac_deadline.innerText = response.data[1].deadline;
                }
            });
        });
    }
}

checkShipping();
