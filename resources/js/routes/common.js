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

scrollingCards();
fallbackImage();
backgroundDropdown();
