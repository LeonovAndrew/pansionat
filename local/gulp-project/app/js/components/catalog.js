if (document.querySelector("#show_on_map") != null) {

    $('.js-show-on-map').click(function () {
        if (window.mapInited != true) {
            setTimeout(function () {
                initMap();
            }, 300);
            window.mapInited = true;
        }
        $('#show_on_map').toggleClass('open');
    });

    function initMap() {
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("show_on_map", {
                center: window.mapCenter,
                zoom: 9
            }, {
                searchControlProvider: 'yandex#search'
            });


            var clusterer = new ymaps.Clusterer({preset: 'islands#icon', clusterIconColor: '#4949e7'});

            myYaMapPlacemarksSection.forEach(function (el) {
                clusterer.add(
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
                            iconColor: '#4949e7'
                        }
                    )
                )
            });


            clusterer.options.set({
                gridSize: 64
            });

            myMap.geoObjects.add(clusterer);
        }
    }
    addScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=fba57e2a-7d0a-4059-a052-cae61f80b03f',initMap)
}

$('.expand-more').click(function () {
    let id = $(this).attr('data-id');
    $('.expand_' + id + ' .filter_val.__close').toggleClass('__open');

    var text = $(this).text();
    var attrText = $(this).attr('text');

    if (text == " - Скрыть") {
        $(this).text(attrText);
    } else {
        $(this).attr('text',text);
        $(this).text(" - Скрыть");
    }
});

$('.js-show_mobile_filter').click(function (e) {
    $('.filter').toggleClass('show');
});

