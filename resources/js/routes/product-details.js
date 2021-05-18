var buttonsQuantity = () => {
    const $btn_minus = document.getElementById('btn-minus'),
          $btn_plus = document.getElementById('btn-plus'),
          $field_quantity = document.getElementById('quantity');
    
    if($btn_minus) {
        $btn_minus.addEventListener("click", () => {
            let quantity = parseInt($field_quantity.value);
    
            if(quantity > 1) $field_quantity.value = quantity - 1;
        });
    }
    
    if($btn_plus) {
        $btn_plus.addEventListener("click", () => {
            let quantity = parseInt($field_quantity.value),
            max = $field_quantity.getAttribute('data-max');
    
            if(max >= 99) max = 99;
            if(quantity < max) $field_quantity.value = quantity + 1;
        });
    }

    if($field_quantity) {
        $field_quantity.addEventListener("change", (e) => {
            let quantity = e.target.value;
            max = $field_quantity.getAttribute('data-max');
    
            if(quantity < 1) $field_quantity.value = 0;
            if(quantity > max) $field_quantity.value = max;
        });
    }
}

buttonsQuantity();