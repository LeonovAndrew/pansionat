if (document.querySelector("#map") != null) {

    function initMap() {
        ymaps.ready(init);
        function init() {
            window.myMap = new ymaps.Map("map", {
                center: window.mapCenter,
                zoom: 9
            }, {
                searchControlProvider: 'yandex#search'
            });

            window.clusterer = new ymaps.Clusterer({preset: 'islands#icon', clusterIconColor: '#663ab6'});

            myYaMapPlacemarks.forEach(function (el) {
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
                            iconColor: '#663ab6'
                        }
                    )
                )
            });


            clusterer.options.set({
                gridSize: 86
            });

            window.myMap.geoObjects.add(clusterer);
        };
    }

    addScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=fba57e2a-7d0a-4059-a052-cae61f80b03f', initMap)

    // var timeout = 5000;
    // var error_timeout = 'Внимание! Время ожидания ответа сервера истекло';
    // var error_default = 'Внимание! Произошла ошибка, попробуйте отправить информацию еще раз';

    // window.showItemsBySection = function (sectionID, _self) {
    //
    //     $('.onMapList li a').removeClass('active');
    //     $(_self).addClass('active');
    //
    //     $.ajax({
    //         type: "POST",
    //         url: '/local/ajax/getPansion.php',
    //         data: 'section_id=' + sectionID,
    //         timeout: timeout,
    //         dataType: 'json',
    //         error: function (request, error) {
    //             _self.find('button').removeAttr('disabled');
    //             if (error == "timeout") {
    //                 alert(error_timeout);
    //             } else {
    //                 alert(error_default);
    //             }
    //         },
    //         success: function (data) {
    //             window.clusterer.removeAll();
    //
    //             setTimeout(function () {
    //                 if (data.items.length) {
    //                     data.items.forEach(function (el) {
    //                         window.clusterer.add(
    //                             new ymaps.Placemark(
    //                                 el.coords,
    //                                 {
    //                                     balloonContentHeader: '',
    //
    //                                     balloonContentBody: '' +
    //                                         '<div class="in_map"> ' +
    //                                         '<a href = "' + el.url + '"><img src="' + el.picsrc + '" height="150"></a><br/>' +
    //                                         '<a href = "' + el.url + '">' + el.name + '</a><br>' +
    //                                         '<p class="rating_line">' + el.rating_html + '</p><br>' +
    //                                         '<p class="price"> Цена: ' + el.price + ' руб./сутки</p>' +
    //                                         // '<a href = "' + el.url + '">Подробнее</a><br>' +
    //                                         '<span class="fiol_button js-show-modal" data-modal="takerent" data-id="' + el.id + '">Забронировать</span>' +
    //                                         '</div>',
    //
    //
    //                                     hintContent: el.name
    //                                 },
    //                                 {
    //                                     preset: 'islands#icon',
    //                                     iconColor: '#663ab6'
    //                                 }
    //                             )
    //                         );
    //                     });
    //                 }
    //             }, 100);
    //         }
    //     });
    // }

}