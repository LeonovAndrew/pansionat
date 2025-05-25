let vendorPath = "/local/templates/pansion2023/static/vendor/"

window.addScript = function (src, callback) {
    var s = document.createElement('script');
    s.setAttribute('src', src);
    s.onload = callback;
    document.body.appendChild(s);
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

window.addEventListener('load', function (e) {
    addScript(vendorPath + 'fancybox.umd.js', function () {
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    });
});

// $(document).ready(function () {
//     $('.js-select').select2({
//         minimumResultsForSearch: Infinity
//     });
// });
//
// Fancybox.bind("[data-fancybox]", {
//     // Your custom options
// });

// if (document.querySelector("#myCarousel") != null) {
//     // document.addEventListener('DOMContentLoaded', function () {
//     //     requirejs(['fancybox', 'carousel'], function (e, c) {
//     // console.log(c);
//
//
//     Carousel.defaults.adaptiveHeight = false;
//     const container = document.getElementById("myCarousel");
//     const options = {
//         Dots: false,
//         Thumbs: {
//             type: "classic",
//         },
//         on: {
//             change: (instance) => {
//                 // Current page
//                 const page = instance.page;
//                 // Page count
//                 const pages = instance.pages.length;
//                 // Current page slides
//                 const slides = instance.pages[page].slides;
//                 setTimeout(function () {
//                     let img = slides[0].el.getElementsByTagName('img')[0].clientHeight;
//                     if (img > 1)
//                         document.getElementById('myCarousel').style.height = (img + 1) + 'px';
//                 }, 50)
//                 // console.log(img);
//                 // console.log(document.getElementById('myCarousel'));
//             },
//         },
//     };
//     // let Thumbs = c.Thumbs;
//     new Carousel(container, options, {Thumbs});
//     // });
//     // });
// }

// window.addEventListener('load', function (e) {
//     let divs = document.querySelectorAll('.js-openFaq');
//     for (var i = 0; i < divs.length; i++) {
//         divs[i].addEventListener('click', function () {
//             this.parentElement.classList.toggle('__open');
//         })
//     }
// })


// if (document.querySelector("#mapDetail") != null) {
//     window.addEventListener('load', function (e) {
//         // requirejs(['yaMap'], function (e) {
//         ymaps.ready(init);
//
//         function init() {
//             window.myMap = new ymaps.Map("mapDetail", {
//                 center: [55.79, 37.004],
//                 zoom: 9
//             }, {
//                 searchControlProvider: 'yandex#search'
//             });
//             window.clusterer = new ymaps.Clusterer({preset: 'islands#icon', clusterIconColor: '#8ABF3D'});
//             window.myYaMapPlacemarks2.forEach(function (el) {
//                 clusterer.add(
//                     new ymaps.Placemark(
//                         el.coords,
//                         {
//                             balloonContentHeader: '',
//                             balloonContentBody: '' +
//                                 '<div class="in_map"> ' +
//                                 '<p class="name">' + el.name + '</p>' +
//                                 // '<p class="adres">' + el.adress + '</p>' +
//                                 '</div>',
//
//
//                             hintContent: el.name
//                         },
//                         {
//                             preset: 'islands#icon',
//                             iconColor: '#8ABF3D'
//                         }
//                     )
//                 )
//             });
//             clusterer.options.set({
//                 gridSize: 86
//             });
//             window.myMap.geoObjects.add(clusterer);
//         }
//
//         // })
//     })
// }
//
// document.addEventListener("DOMContentLoaded", function (event) {
//     let jsMenuButton = document.querySelector('.js-mobileMenu');
//     jsMenuButton.addEventListener('click', function () {
//         document.querySelector('.hamburger').classList.toggle('__open');
//         document.querySelector('.mobile-line').classList.toggle('__open');
//         document.querySelector('.mobile-menu__wrapper').classList.toggle('__open');
//         document.querySelector('body').classList.toggle('no-scroll');
//     })
// });

//
// document.addEventListener("DOMContentLoaded", function (event) {
//     let h = window.innerHeight;
//     if (h > 600) {
//         document.querySelector(".top-slide").style.height = (h - 120) + 'px';
//     }
// });
//
// window.addEventListener('load', function (e) {
//     let divs = document.querySelectorAll('.what-we-do__item');
//     for (var i = 0; i < divs.length; i++) {
//         divs[i].addEventListener('click', function () {
//             this.classList.toggle('__open');
//         })
//     }
// })
//

//
//
//
// window.addEventListener('load', function (e) {
//     let divs = document.querySelectorAll('.js-closeMobileMenu');
//     for (var i = 0; i < divs.length; i++) {
//         divs[i].addEventListener('click', function () {
//             document.querySelector('.hamburger').classList.remove('__open');
//             document.querySelector('.mobile-popup').classList.remove('__open');
//         })
//     }
// })

//
// $("#animated-thumbnails")
//     .justifiedGallery({
//         captions: false,
//         lastRow: "nojustify",
//         rowHeight: 235,
//         margins: 5
//     })