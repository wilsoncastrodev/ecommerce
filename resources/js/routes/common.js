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
    const $search = document.getElementById('search'),
          $bg_search = document.getElementById('bg-search'),
          $search_form = document.getElementById('search-form'),
          $search_form_box = document.getElementById('search-form-box');

    if ($search) {
        const quickSearch = () => {
            $search.addEventListener('keyup', (e) => {
                let route = e.target.getAttribute('data-route'),
                    keyword = e.target.value,
                    url = window.location.href, 
                    url_split = url.split('public');
                    
                if(keyword.replace(/\s/g, '').length > 0) {
                    $bg_search.classList.remove('d-none');
                    $search_form.classList.add('active');
    
                    axios.get(`${route}/${keyword}`)
                    .then(function (response) {
                        const $quick_search = document.getElementById('quick-search');
                        
                        if(response.data.length > 0) {
                            $quick_search.innerHTML = '';
    
                            $search_form_box.classList.remove('d-none');
    
                            response.data.forEach((product_title) => {
                                $quick_search.insertAdjacentHTML('beforeend', 
                                    `<a href=${url_split[0]}public/pesquisa?s=${encodeURIComponent(product_title)} class="search-item">
                                            <li>
                                            <i class="fa fa-search text-secondary"></i>
                                            ${product_title}
                                            </li>
                                    </a>`
                                );
                            });
                        } else {
                           $search_form_box.classList.add('d-none');
                        } 
                    })  
                    .catch(function () {  
                        $search_form_box.classList.add('d-none');
                    });
                } else {
                    $bg_search.classList.add('d-none');
                    $search_form.classList.remove('active');
                }
            });
        }

        const quickSearchRemoveBg = () => {
            $bg_search.addEventListener('click', () => {
                $bg_search.classList.add('d-none');
                $search_form.classList.remove('active');
            });
        }
        
        const quickSearchKeyDownItem = () => {
            document.addEventListener("keydown", function(e) {    
                const $search_item = document.querySelector(".search-item"),
                      $search_item_focus = document.querySelector(".search-item:focus");
    
                if (e.keyCode == 40 && $search_item) {    
                    e.preventDefault(); 
                    $search_item.focus();
                }
    
                if($search_item_focus) {
                    if (e.keyCode == 38 && $search_item_focus.previousSibling) {
                        e.preventDefault(); 
                        $search_item_focus.previousSibling.focus();
                    }
                }
                    
                if($search_item_focus) {
                    if (e.keyCode == 40 && $search_item_focus.nextSibling) {    
                        e.preventDefault();  
                        $search_item_focus.nextSibling.focus();
                    }
                }
            });
        }

        const validateEmptySearch = () => {
            const $btn_search = document.getElementById('btn-search');
            
            $btn_search.addEventListener('click', (e) => {
                if($search.value.replace(/\s/g, '') == '') {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        }

        quickSearch();
        quickSearchRemoveBg();
        quickSearchKeyDownItem();
        validateEmptySearch();
    }
}

const loadMoreProducts = () => {
    const $btn_load_more = document.getElementById('btn-load-more');

    if($btn_load_more) {
        let number_products = 0;

        $btn_load_more.addEventListener('click', (e) => {
            const $content_load_more = document.getElementById('content-load-more');

            let route = e.target.getAttribute('data-route'),
                total_products = e.target.getAttribute('data-total-products'),
                products_view = parseInt(e.target.getAttribute('data-products-view')),
                category_slug = e.target.getAttribute('data-category-slug'),
                s = e.target.getAttribute('data-s');

            number_products = number_products + products_view;

            axios.post(route, {
                category_slug: category_slug || null,
                number_products: number_products,
                products_view: products_view,
                s: s || null
            })
            .then((response) => {
                if(response.data) {
                    $content_load_more.insertAdjacentHTML('beforeend', response.data);
                }

                if ((number_products + products_view) >= total_products) {
                    $btn_load_more.classList.add('d-none');
                }
            });
        });
    }
}

searchProducts();
scrollingCards();
fallbackImage();
backgroundDropdown();
loadMoreProducts();