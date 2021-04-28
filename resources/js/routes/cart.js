var checkShipping = () => {
    document.getElementById('check-shipping').addEventListener("click", () => {
        const $shippingForm = document.forms.shippingForm;

        let route = $shippingForm.route.value,
            cart = $shippingForm.cart.value,
            cep = $shippingForm.cep.value;

        axios.post(route, {
            cep: cep,
            cart_id: cart
        })
        .then((response) => {
            let messagePac = document.getElementById('message-pac'),
                messageSedex = document.getElementById('message-sedex');

            if(response.data[0].name == 'Sedex') {
                messageSedex.classList.remove('d-none');
                messageSedex.innerHTML = "Preço do Sedex: " + response.data[0].price;
            }
            
            if(response.data[1].name == 'PAC') {
                messagePac.classList.remove('d-none');
                messagePac.innerHTML = "Preço do PAC: " + response.data[0].price;
            }
        });
    });
}

checkShipping();