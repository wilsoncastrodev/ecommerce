const scrollingCards = () => {
    const $scrolling_wrapper = document.querySelectorAll('.scrolling-wrapper');

    if ($scrolling_wrapper) {
        $scrolling_wrapper.forEach((e) => {
            const $slider = e;

            let isDown = false,
                startX,
                scrollLeft;

            $slider.addEventListener('mousedown', (e) => {
                let rect = $slider.getBoundingClientRect();

                isDown = true;

                $slider.classList.add('active');

                startX = e.pageX - rect.left;
                scrollLeft = $slider.scrollLeft;
            });

            $slider.addEventListener('mouseleave', () => {
                isDown = false;
                $slider.classList.remove('active');
                $slider.dataset.dragging = false;
            });

            $slider.addEventListener('mouseup', () => {
                isDown = false;
                $slider.classList.remove('active');
                $slider.dataset.dragging = false;
            });

            $slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;

                let rect = $slider.getBoundingClientRect(),
                    x,
                    walk;

                e.preventDefault();

                $slider.dataset.dragging = true;
                x = e.pageX - rect.left;
                walk = (x - startX);

                $slider.scrollLeft = scrollLeft - walk;
            });
        });
    }

}

const fallbackImage = () => {
    const $images = document.querySelectorAll('img');

    let url = window.location.href, 
        url_split = url.split('public');

    $images.forEach((image) => {
        image.addEventListener('error', (e) => {
            e.target.src = url_split[0] + 'public/images/bg-gray.png';
            e.target.classList.add('img-error');
        });
    }); 
}

const backgroundDropdown = () => {
    const $btn_menu_dropdown = document.getElementById('btn-menu-dropdown');

    if ($btn_menu_dropdown) {
        const $bg_dropdown = document.getElementById('bg-dropdown'),
              $dropdown_menu = document.getElementById('dropdown-menu');

        $btn_menu_dropdown.addEventListener('mouseover', () => {
            $dropdown_menu.classList.add('show');
            $bg_dropdown.classList.remove('d-none');
        });

        $bg_dropdown.addEventListener('mouseover', () => {
            $bg_dropdown.classList.add('d-none');
            $dropdown_menu.classList.remove('show');
        })
    }
}

const searchProducts = () => {
    const $search = document.getElementById('search');

    if ($search) {
        $search.addEventListener('keyup', (e) => {
            const $bg_search = document.getElementById('bg-search'),
                  $search_form = document.getElementById('search-form'),
                  $search_form_box = document.getElementById('search-form-box');
                  
            let route = e.target.getAttribute('data-route'),
                keyword = e.target.value
                url = window.location.href, 
                url_split = url.split('public');
                
            if(keyword.length > 0) {
                $bg_search.classList.remove('d-none');
                $search_form.classList.add('active');

                axios.get(`${route}/${keyword}`)
                .then(function (response) {
                    const $quick_search = document.getElementById('quick-search');

                    if(response.data.length > 0) {
                        $quick_search.innerHTML = '';

                        $search_form_box.classList.remove('d-none')

                        Object.values(response.data).forEach((product) => {
                            $quick_search.insertAdjacentHTML('beforeend', 
                                `<a href=${url_split[0]}public/pesquisa?s=${encodeURIComponent(product.product_title)}>
                                        <li>
                                        ${product.product_title}
                                        </li>
                                </a>`
                            );
                        });
                    } else {
                        $search_form_box.classList.add('d-none')
                    } 
                })  
                .catch(function () {  
                    $search_form_box.classList.add('d-none')
                });  
            } else {
                $bg_search.classList.add('d-none');
                $search_form.classList.remove('active');
            }
        });
    }
}

searchProducts();
scrollingCards();
fallbackImage();
backgroundDropdown();
