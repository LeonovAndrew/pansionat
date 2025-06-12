window.addEventListener('DOMContentLoaded', () => {
    const popupBtn = document.querySelector('.location-btn');
    const popup = document.querySelector('.popup');
    const popupClose = popup.querySelector('.popup-close');

    popupBtn.addEventListener('click', () => {
        popup.classList.add('active');
    });

    popupClose.addEventListener('click', () => {
        popup.classList.remove('active');
    });

    popup.addEventListener('click', (event) => {
        if (event.target === popup) {
            popup.classList.remove('active');
        }
    });
});

window.addEventListener('load', () => {
    if (document.querySelector('.reviews-main')) {
        $.ajax({
            type: "POST",
            url: '/local/components/proger/review.main/templates/ajax.php',
            success: function (obRes) {
                document.querySelector('.reviews-main').outerHTML = obRes;

                const swiper = new Swiper('.reviews-main', {
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            }
        });
    }
});