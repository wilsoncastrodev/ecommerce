import creditCardType from 'credit-card-type';
import Inputmask from "inputmask";

const validateFormCreditCard = () => {

    const addFieldsMask = () => {
        const $credit_card_form = document.getElementById('creditCardForm');

        if($credit_card_form) {
            const $number = document.getElementById('number');

            Inputmask({"mask": "9999 9999 9999 9999", "placeholder": ""}).mask($number);
        }
    }

    const validateCreditCard = () => {
        const $credit_card_form = document.getElementById('creditCardForm');

        if($credit_card_form) {
            const $number = document.getElementById('number'),
                  $invalid_card = document.querySelector('.invalid-card');

            $number.addEventListener('keyup', () => {    
                let credit_card = creditCardType($number.value.replace(/ /g,'')),
                    icon_credit_card;

                Array.from(document.getElementsByClassName('credit-card')).forEach((e) => {
                    e.style.display = 'none';
                });

                $number.classList.add('invalid');
                $invalid_card.classList.add('invalid-number');

                if($number.value != '') {
                    if(credit_card[0]) {
                        icon_credit_card = document.getElementById('credit-card-' +  credit_card[0].type);

                        if(icon_credit_card) {
                            icon_credit_card.style.display = 'block';
                            $number.classList.add('valid');
                            $number.classList.remove('invalid');
                            $invalid_card.classList.remove('invalid-number');
                        }
                    } else {
                        $credit_card_form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                        });
                    }
                }
            });
        }
    }

    const validateFieldsEmpty = () => {
        const $input = document.querySelectorAll('.form-control'), 
              $forms = document.querySelectorAll('.needs-validation'),
              $number = document.getElementById('number'),
              $credit_card_form = document.getElementById('creditCardForm');

        if($credit_card_form) {
            $input.forEach((input) => {
                input.addEventListener('keydown', (e) => {
                    e.target.classList.remove('form-validated');
                    e.target.nextElementSibling.classList.remove('d-none');
                });
            });
    
            Array.prototype.slice.call($forms).forEach(function ($form) {
                $form.addEventListener('submit', function (event) {
                    $input.forEach((input) => {
                        input.classList.remove('form-validated');
                        input.nextElementSibling.classList.remove('d-none');
                    });
    
                    if (!$form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        if($number.classList.contains('valid')) {
                            $form.submit();
                        }
                    }
    
                    $form.classList.add('was-validated')
                    
                }, false);
            });
        }
    }

    validateFieldsEmpty();
    addFieldsMask();
    validateCreditCard();
}

validateFormCreditCard();