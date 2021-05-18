var scrollingCards = () => {
    const $scrolling_wrapper = document.querySelectorAll(".scrolling-wrapper");

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

scrollingCards();