if (document.querySelector("#main-page-owl") != null) {
    head.load(
        [
            "/bitrix/templates/2015/vendor/owl/owl.carousel.min.js",
            "/bitrix/templates/2015/vendor/owl/assets/owl.carousel.css",
            "/bitrix/templates/2015/vendor/owl/assets/owl.theme.default.css",
        ], function () {
            $('#main-page-rewievs-owl').owlCarousel({
                loop: true,
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                navText: ['<i class="uk-icon-angle-left uk-icon-large"></i>', '<i class="uk-icon-angle-right uk-icon-large"></i>']
            });
        }
    );
}

if (document.querySelector(".custom_scroll") != null) {
    head.load(
        [
            "/local/templates/pansion/vendor/scrollbar/jquery.mCustomScrollbar.concat.min.js",
            "/local/templates/pansion/vendor/scrollbar/jquery.mCustomScrollbar.min.css",
        ], function () {
            $(".custom_scroll").mCustomScrollbar({
                axis: "y", // horizontal scrollbar
                theme: "dark-3"
            });
        }
    );
}

if (document.querySelector(".js-countDown") != null) {
    head.load(
        [
            "/local/templates/pansion/vendor/countdown.js",
        ], function () {
            $('.js-countDown').each(function (idx, el) {
                var date = $(el).data('date');
                var _self = $(this);

                console.log(date);

                _self.countdown({
                    date: new Date(date),
                    text: '%s дней  %s:%s:%s'
                });
            })
        }
    );
}

if (document.querySelector("#mobile_menu") != null) {
    $('.js-mobileMenu').click(function (e) {
        $('body').toggleClass('showMobileMenu');
    });

    $('.js-mobileSearch').click(function (e) {
        $('body').toggleClass('showMobileSearch');
    });

    $('.show_mobile_filter').click(function (e) {
        $('.filter').toggleClass('show');
    });
}

if (document.querySelector("#modal") != null) {

    function showModal() {
        $('#modal .content').html('');
        $('.modal_wrapper').css('display', 'flex');
    }

    function closeModal() {
        $('#modal .content').html('');
        $('.modal_wrapper').css('display', 'none');
        $('.modal_wrapper .modal').removeClass('nobg');
    }

    $('body').on('click', '.js-show-modal', function (e) {
        e.preventDefault();
        var modal = $(this).attr('data-modal');

        if (modal == 'calcPrice') {
            $('.modal_wrapper .modal').addClass('nobg');
        }


        var id = $(this).attr('data-id');
        var jsMetrika = $(this).attr('data-metrika');

        $.ajax({
            type: "POST",
            url: '/local/ajax/showModal.php',
            data: 'modal=' + modal + '&id=' + id + '&metrika=' + jsMetrika,
            success: function (data) {
                showModal();
                $('#modal .content').html(data);
            }
        });
        return false;
    });

    $('body').on('click', '#modal', function (e) {
        e.stopPropagation();
    });

    $('body').on('click', '.modal', function (e) {
        e.stopPropagation();
    });

    $('body').on('click', '#modal .close', function (e) {
        closeModal();
    });

    $('body').on('click', '.modal .close', function (e) {
        closeModal();
    });

    $('body').on('click', '#modal .close_butt', function (e) {
        closeModal();
    });

    $('body').on('click', '.modal_wrapper', function (e) {
        closeModal();
    });
}

if (document.querySelector(".js-ratingStars") != null) {
    $(".js-ratingStars").each(function (idx, el) {
        var input = $(this).find('input');
        var spans = $(this).find('span');
        var curRatimg = 0;

        function drawStarts(val) {
            $(spans).each(function (idx, el) {
                if (parseInt(val - 1) >= parseInt(idx)) {
                    $(el).removeClass('grey').addClass('yellow');
                } else {
                    $(el).removeClass('yellow').addClass('grey');
                }
            })
        }

        drawStarts(4);

        spans.hover(
            function () {
                drawStarts(parseInt($(this).index() + 1));
            },
            function () {
                drawStarts(curRatimg)
            }
        );

        spans.click(function () {
            curRatimg = $(this).index() + 1;
            drawStarts(parseInt(curRatimg));
            input.val(curRatimg);
        });
    });
}

if (document.querySelector("#map") != null) {
    head.load('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=fba57e2a-7d0a-4059-a052-cae61f80b03f', function () {
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

        var timeout = 5000;
        var error_timeout = 'Внимание! Время ожидания ответа сервера истекло';
        var error_default = 'Внимание! Произошла ошибка, попробуйте отправить информацию еще раз';

        window.showItemsBySection = function (sectionID, _self) {

            $('.onMapList li a').removeClass('active');
            $(_self).addClass('active');

            $.ajax({
                type: "POST",
                url: '/local/ajax/getPansion.php',
                data: 'section_id=' + sectionID,
                timeout: timeout,
                dataType: 'json',
                error: function (request, error) {
                    _self.find('button').removeAttr('disabled');
                    if (error == "timeout") {
                        alert(error_timeout);
                    } else {
                        alert(error_default);
                    }
                },
                success: function (data) {
                    window.clusterer.removeAll();

                    setTimeout(function () {
                        if (data.items.length) {
                            data.items.forEach(function (el) {
                                window.clusterer.add(
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
                                );
                            });
                        }
                    }, 100);
                }
            });
        }
    })
}

if (document.querySelector("#show_on_map") != null) {
    head.load('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=fba57e2a-7d0a-4059-a052-cae61f80b03f', function () {

        $('.show_on_map_button').click(function () {
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


                var clusterer = new ymaps.Clusterer({preset: 'islands#icon', clusterIconColor: '#663ab6'});

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
                                iconColor: '#663ab6'
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
    })
}

if (document.querySelector("#detail_map") != null) {
    head.load('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=fba57e2a-7d0a-4059-a052-cae61f80b03f', function () {
        ymaps.ready(init);


        function init() {
            var myMap = new ymaps.Map("detail_map", {
                center: myYaMapPlacemark[0].coords,
                zoom: 11
            }, {
                searchControlProvider: 'yandex#search'
            });

            myYaMapPlacemark.forEach(function (el) {
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
                            iconColor: '#663ab6'
                        }
                    )
                )
            })
        };
    })
}

if (document.querySelector(".js-datepicker") != null) {
    head.load(
        [
            "/local/templates/pansion/vendor/datepicker/css/datepicker.min.css",
            "/local/templates/pansion/vendor/datepicker/js/datepicker.min.js",
        ], function () {
            $('.js-datepicker').datepicker({autoClose: true});
        }
    );
}

if (document.querySelector(".detail_element") != null) {
    head.load(
        [
            "/local/templates/pansion/vendor/slick/slick.min.js",
        ], function () {
            $('.detail_element .big_images').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                adaptiveHeight: true,
                asNavFor: '.detail_element .small_images'
            });

            $('.detail_element .small_images').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                asNavFor: '.detail_element .big_images',
                dots: false,
                arrows: true,
                // centerMode: true,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    }
                ]
            });

            $('.detail_element .big_images').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                var cur = slick.$slides[nextSlide];
                // console.log(cur);
                if (cur)
                    if (cur.hasAttribute('data-lazy-src')) {
                        var attr = $(cur).attr('data-lazy-src');
                        cur.style.backgroundImage = 'url(' + attr + ')';
                        cur.removeAttribute('data-lazy-src');
                    }
                // console.log(slick);
            });

            $('.detail_element .small_images').on('beforeChange', function (event, slick, currentSlide, nextSlide) {

                for (var i = 0; i < 6; i++) {
                    var cur = slick.$slides[nextSlide + i];
                    // console.log(cur);
                    if (cur)
                        if (cur.hasAttribute('data-lazy-src')) {
                            var attr = $(cur).attr('data-lazy-src');
                            cur.style.backgroundImage = 'url(' + attr + ')';
                            cur.removeAttribute('data-lazy-src');
                        }

                }
                // console.log(slick);
            });
        }
    );

    $('.bages_images .close').click(function (e) {
        $('.bages_images').fadeOut();
    })
}

if (document.querySelector(".js-slider") != null) {
    head.load(
        [
            "/local/templates/pansion/vendor/slick/slick.min.js",
        ], function () {
            $('.js-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                fade: true,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        }
    );
}

if (document.querySelector(".js_sectionSlider") != null) {
    head.load(
        [
            "/local/templates/pansion/vendor/slick/slick.min.js",
        ], function () {
            $('.js_sectionSlider').each(function (idx, el) {
                $(el).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                    fade: true,
                    // lazyLoad: 'ondemand',
                    adaptiveHeight: false
                });

                var $status = $(el).parent().find('.js-text');

                $(el).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                    var cur = slick.$slides[nextSlide];
                    // console.log(cur);
                    if (cur.hasAttribute('data-lazy-src')) {
                        var attr = $(cur).attr('data-lazy-src');
                        cur.style.backgroundImage = 'url(' + attr + ')';
                        cur.removeAttribute('data-lazy-src');
                    }
                    // console.log(slick);
                });

                $(el).on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
                    //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
                    var i = (currentSlide ? currentSlide : 0) + 1;
                    $status.text(i + ' из ' + slick.slideCount);

                });
            })
        }
    );
}

if (document.querySelector(".js-reviews-slider") != null) {
    head.load(
        [
            "/local/templates/pansion/vendor/slick/slick.min.js",
        ], function () {
            $('.js-reviews-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                fade: true,
                adaptiveHeight: true
            });


        }
    );
}

$('.tabs_wrapper .tab_button').click(function () {
    var id = $(this).data('id');
    $(this).closest('.tabs_wrapper').find('.tab_button').removeClass('active');
    $(this).closest('.tabs_wrapper').find('.tab').removeClass('active');

    $(this).addClass('active');
    $(this).closest('.tabs_wrapper').find('#' + id).addClass('active');
    setTimeout(function () {
        $('.js_sectionSlider').slick('refresh')
    }, 300);
});

$('input.js-phone').inputmask({
    mask: '+7 (999) 999-99-99',
    shiftPositions: true,
    clearIncomplete: true,
    onKeyDown: function (event, buffer, caretPos, opts) {
        if (caretPos == 18) {
            var keyPressed = event.key;
            var firskDigitOfNumber = $(this).val()[4];
            if (firskDigitOfNumber == '7' || firskDigitOfNumber == '8') {
                var number = $(this).val();
                var newStr = number.substring(0, 4) + number.substring(5, number.length) + keyPressed;
                $(this).inputmask("setvalue", newStr);
            }
        }
    }
});


if (document.querySelector('.element_actions.favorite') != null) {


    function addToFavorite(id, _self) {
        var fav = [];
        if ($.cookie('BX_FAV_ID') != undefined) {
            fav = $.cookie('BX_FAV_ID').split(',');
            fav = fav.filter(function (n) {
                return (n != undefined && n != '')
            });
        }

        id = String(id);
        if (fav.indexOf(id) == -1) {
            fav.push(id);
        }

        $.cookie('BX_FAV_ID', fav.join(), {path: '/'});
    }

    $('body').on('click', '.element_actions.favorite', function (event) {
        event.preventDefault();
        var id = $(this).attr('data-item-id');
        if ($(this).hasClass('favorited')) {
            deleteFromFavorite(id, this);
            $(this).removeClass('favorited');
            $(this).tooltipster('content', 'Добавить в избранное');
        } else {
            addToFavorite(id, this);
        }

        updateFravoriteItemsCNT();

        // if ($(this).hasClass('favorited')) {
        //     location.href = '/personal/delayed/';
        // } else {
        //     addToFavorite(id, this);
        //     updateFravoriteItemsCNT(this, id);
        //     onSuccessAddToDelay(this, id);
        // }
    });

    function deleteFromFavorite(id, _self) {

        var fav = [];

        if ($.cookie('BX_FAV_ID') != undefined) {
            fav = $.cookie('BX_FAV_ID').split(',');
            fav = fav.filter(function (n) {
                return (n != undefined && n != '')
            });
        }

        var index = fav.indexOf(id.toString());

        if (index != -1) {
            fav.splice(index, 1);
        }

        if (fav.length > 0) {
            $.cookie('BX_FAV_ID', fav.join(), {path: '/'});
        } else {
            $.cookie('BX_FAV_ID', '', {path: '/'});
        }
    }

    function updateFravoriteItemsCNT() {

        if ($.cookie('BX_FAV_ID') != undefined && $.cookie('BX_FAV_ID').length > 0) {
            var q = $.cookie('BX_FAV_ID').split(',');
            q = q.filter(function (n) {
                return (n != undefined && n != '')
            });

            $('#num_fav').html(q.length);

            if (q.length > 0) {
                $('#num_fav').fadeIn();
            } else {
                $('#num_fav').fadeOut();
            }

            q.forEach(function (item, i, arr) {
                if ($('.element_actions.favorite[data-item-id=' + item + ']').length) {
                    $('.element_actions.favorite[data-item-id=' + item + ']').addClass('favorited');
                    $('.element_actions.favorite[data-item-id=' + item + ']').tooltipster('content', 'Удалить из избранного');
                }
            })
        }
    }

    head.load('/local/templates/pansion/vendor/tooltipster/js/tooltipster.bundle.min.js', function () {
        $('.js-tooltip').tooltipster({
            theme: 'tooltipster-borderless'
        });
        updateFravoriteItemsCNT();
    });
}

if (document.querySelector('.element_actions.compare') != null) {
    function addToCompare(id, _self) {

        var fav = [];

        if ($.cookie('BX_CMP_ID') != undefined) {
            fav = $.cookie('BX_CMP_ID').split(',');
            fav = fav.filter(function (n) {
                return (n != undefined && n != '')
            });
        }

        id = String(id);
        if (fav.indexOf(id) == -1) {
            fav.push(id);
        }

        $.cookie('BX_CMP_ID', fav.join(), {path: '/'});
    }

    $('body').on('click', '.element_actions.compare', function (event) {
        event.preventDefault();
        var id = $(this).attr('data-item-id');
        $(this).addClass('compared');
        addToFavorite(id, this);

        // if ($(this).hasClass('favorited')) {
        //     location.href = '/personal/delayed/';
        // } else {
        //     addToFavorite(id, this);
        //     updateFravoriteItemsCNT(this, id);
        //     onSuccessAddToDelay(this, id);
        // }
    });
}

window.addToViewed = function (id) {
    var fav = [];

    if ($.cookie('BX_VIEWED_ID') != undefined) {
        fav = $.cookie('BX_VIEWED_ID').split(',');
        fav = fav.filter(function (n) {
            return (n != undefined && n != '')
        });
    }

    id = String(id);
    var idx = fav.indexOf(id);

    if (idx == -1) {
        fav.unshift(id);
    } else {
        fav.splice(idx, 1);
        fav.unshift(id);
    }

    $.cookie('BX_VIEWED_ID', fav.join(), {path: '/'});
};

$('body').on('click', '.actionClearFavorites', function (event) {
    deleteAllFavorite();
});

function deleteAllFavorite() {
    $.cookie('BX_FAV_ID', '', {path: '/'});
    location.reload();
}

// FIXED TOP

var Htop = $('.header').offset().top;
$(window).scroll(function (event) {
    var y = $(this).scrollTop();

    if (y > Htop)
        $('body').addClass('fixed');
    else
        $('body').removeClass('fixed');

});

$('#title-search input').focus(function () {
    $('#title-search').addClass('active');
});

$('#title-search').focusout(function () {
    $('#title-search').removeClass('active');
});

$('a[href^="#"]').click(function () {
    $('html, body').animate({
        scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top - 85
    }, 500);
    return false;
});

$('#agreeCookie').click(function () {
    $.cookie('AGREE_COOKIE', 'Y', {path: '/'});
    $('.cookie').removeClass('_show');
});

setTimeout(function () {
    $('.cookie').addClass('_show');
}, 1000);

$('.expand-more').click(function () {
    let id = $(this).attr('data-id');
    $('.expand_' + id).toggleClass('_open');

    var text = $(this).text();
    var attrText = $(this).attr('text');

    if (text == " - Скрыть") {
        $(this).text(attrText);
    } else {
        $(this).attr('text',text);
        $(this).text(" - Скрыть");
    }
});

$('.question_header').click(function (e) {
    $(this).parent().toggleClass('open');
});