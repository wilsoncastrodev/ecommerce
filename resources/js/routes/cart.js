const checkShipping = () => {
    document.getElementById('check-shipping').addEventListener("click", () => {
        const $shippingForm = document.forms.shippingForm;

        let route = $shippingForm.route.value,
            cart = $shippingForm.cart.value,
            zipcode = $shippingForm.zipcode.value;

        axios.post(route, {
            zipcode: zipcode,
            cart_id: cart
        })
        .then((response) => {
            let messageSedex = document.getElementById('message-sedex');

            if(response.data[0].name == 'Sedex') {
                messageSedex.classList.remove('d-none');
                messageSedex.innerHTML = "Preço do Sedex: R$ " + response.data[0].price.toLocaleString('pt-br', {minimumFractionDigits: 2});
            }
        });
    });
}

checkShipping();