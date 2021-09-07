var hiddenStock = () => {
    document.getElementsByName('stock_enabled').forEach((e) => {
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

hiddenStock();



