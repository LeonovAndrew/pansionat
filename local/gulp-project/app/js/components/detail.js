let detailSwiper = new Swiper("#smallPhoto", {
    loop: false,
    spaceBetween: 10,
    slidesPerView: 7,
    freeMode: true,
    watchSlidesProgress: true,
    navigation: {
        nextEl: ".swiper-button-next.__small",
        prevEl: ".swiper-button-prev.__small",
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 3,
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 4,
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 5,
        }
    }
});


let detailSwiper2 = new Swiper("#bigPhoto", {
    loop: true,
    autoHeight: true,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next.__big",
        prevEl: ".swiper-button-prev.__big",
    },
    thumbs: {
        swiper: detailSwiper,
    },
});


if (document.querySelector("#detail_map") != null) {

    function initMapDetail() {

        function init() {
            var myMap = new ymaps.Map("detail_map", {
                center: myYaMapPlacemark[0].coords,
                zoom: 11
            }, {
                searchControlProvider: 'yandex#search'
            });

            window.myYaMapPlacemark.forEach(function (el) {
                myMap.geoObjects.add(
                    new ymaps.Placemark(
                        el.coords,
                        {
                            balloonContentHeader: '',

                            balloonContentBody: '' +
                                '<div class="in_map"> ' +
                                '<a href = "' + el.url + '"><img src="' + el.picsrc + '" height="150"></a><br/>' +
                                '<a href = "' + el.url + '">' + el.name + '</a><br>' +
                                '<p class="rating_line">' + el.rating_html + '</p><br>' +
                                '<p class="price"> Цена: ' + el.price + ' руб./сутки</p>' +
                                // '<a href = "' + el.url + '">Подробнее</a><br>' +
                                '<span class="fiol_button js-show-modal" data-modal="takerent" data-id="' + el.id + '">Забронировать</span>' +
                                '</div>',


                            hintContent: el.name
                        },
                        {
                            preset: 'islands#icon',
                            iconColor: '#4949E7'
                        }
                    )
                )
            })
        }

        ymaps.ready(init);
    }

    window.addEventListener('load', function (e) {
        addScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=fba57e2a-7d0a-4059-a052-cae61f80b03f', initMapDetail);
    });
}


