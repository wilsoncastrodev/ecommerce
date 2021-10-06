var hiddenStock = () => {
    $stock_enabled = document.getElementsByName('stock_enabled');
    
    $stock_enabled.forEach((e) => {
        e.addEventListener("change", (e) => {
          let value = e.target.value;
          
          if(value == 'yes') {
            document.getElementById('hidden-stock-yes').classList.add('d-none');
            document.getElementById('hidden-stock-no').classList.remove('d-none');
          }
    
          if(value == 'no') {
            document.getElementById('hidden-stock-no').classList.add('d-none');
            document.getElementById('hidden-stock-yes').classList.remove('d-none');
          }
        });
    });
}

var hiddenStockLoad = () => {
  $stock_enabled = document.querySelector('input[name="stock_enabled"]:checked');
  
  if($stock_enabled) {
    let value = $stock_enabled.value;

    if(value == 'yes') {
      document.getElementById('hidden-stock-yes').classList.add('d-none');
      document.getElementById('hidden-stock-no').classList.remove('d-none');
    }
  
    if(value == 'no') {
      document.getElementById('hidden-stock-no').classList.add('d-none');
      document.getElementById('hidden-stock-yes').classList.remove('d-none');
    }
  }
}

hiddenStock();
hiddenStockLoad();



