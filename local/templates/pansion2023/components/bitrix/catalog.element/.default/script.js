document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.licenses-slider', {
        slidesPerView: 6,
        spaceBetween: 20,
        loop: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1280: {
                slidesPerView: 6,
            },
            1024: {
                slidesPerView: 5,
            },
            768: {
                slidesPerView: 3,
            },
            200: {
                slidesPerView: 1,
            }
        }
    });
});
