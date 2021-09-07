
import cep from 'cep-promise';
import Inputmask from 'inputmask';
import CPF from 'cpf';

const validateFormRegister = () => {
    const addFieldsMask = () => {
        const $register_form = document.getElementById('registerForm');

        if ($register_form) {
            const $phone = document.getElementById('phone'),
                  $cpf = document.getElementById('cpf'),
                  $birthday = document.getElementById('birthday'),
                  $zipcode = document.getElementById('zipcode');

            Inputmask({ 'mask': '(99)9999-9999[9]', 'placeholder': ' ', 'showMaskOnHover': false }).mask($phone);
            Inputmask({ 'mask': '999.999.999-99', 'placeholder': ' ', 'showMaskOnHover': false }).mask($cpf);
            Inputmask({ 'mask': '99/99/9999', 'placeholder': ' ', 'showMaskOnHover': false }).mask($birthday);
            Inputmask({ 'mask': '99999-999', 'placeholder': ' ', 'showMaskOnHover': false }).mask($zipcode);
        }
    }

    const getAddressCep = () => {
        const $address = document.getElementById('address'),
            $neighbourhood = document.getElementById('neighbourhood'),
            $city = document.getElementById('city'),
            $state = document.getElementById('state'),
            $zipcode = document.getElementById('zipcode'),
            $register_form = document.getElementById('registerForm');

        if ($register_form) {
            $zipcode.addEventListener('keyup', (e) => {
                let zipcode_lenght = e.target.value.replace(/\s/g, '').length;

                if (zipcode_lenght > 8) {
                    cep(e.target.value)
                        .then((response) => {
                            $address.value = response.street;
                            $neighbourhood.value = response.neighborhood;
                            $city.value = response.city;
                            $state.value = response.state;
                        })
                        .catch(err => {
                            if(err) {
                                $address.value = '';
                                $neighbourhood.value = '';
                                $city.value = '';
                                $state.value = '';
                                e.target.classList.add('invalid') 
                            }
                        });
                }
            });
        }
    }

    const validateFieldsEmpty = () => {
        const $input = document.querySelectorAll('input');

        $input.forEach((input) => {
            input.addEventListener('keydown', (e) => {
                e.target.classList.remove('form-validated');
            });
        });

        const $forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call($forms).forEach(function ($form) {
            $form.addEventListener('submit', function (event) {
                const $invalid = document.querySelectorAll('.invalid'),
                      $invalid_cpf = document.querySelectorAll('.invalid-cpf');

                $input.forEach((input) => {
                    input.classList.remove('form-validated');
                });

                if (!$form.checkValidity() || $invalid.length || $invalid_cpf.length) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                $form.classList.add('was-validated')

            }, false);
        });
    }

    const validateFields = () => {
        const $register_form = document.getElementById('registerForm');

        if ($register_form) {
            const $input = document.querySelectorAll('input');

            $input.forEach((input) => {
                input.addEventListener('keyup', (e) => {
                    let route = e.target.getAttribute('data-route'),
                        name = e.target.getAttribute('name'),
                        value = e.target.value;

                    axios.post(route, {
                        [name]: value
                    })
                    .then(function (response) {
                        !response.data.error.length ? e.target.classList.remove('invalid') : e.target.classList.add('invalid');
                    })
                });
            });
        }
    }

    const validateCPF = () => {
        const $register_form = document.getElementById('registerForm');

        if($register_form) {
            const $cpf = document.getElementById('cpf');

            $cpf.addEventListener('keyup', (e) => {
                let cpf_lenght = e.target.value.replace(/\s/g, '').length;

                if(cpf_lenght > 13) {
                    CPF.isValid(e.target.value) ? e.target.classList.remove('invalid-cpf') : e.target.classList.add('invalid-cpf');
                }
            });
        }
    }

    validateCPF();
    validateFields();
    validateFieldsEmpty();
    getAddressCep();
    addFieldsMask();
}


validateFormRegister();