// document.addEventListener('DOMContentLoaded', function () {
//     // requirejs(['jquery'], function ($) {
//         $('.js-next-step').click(function () {
//             let el = $('.mini-form__step.__active');
//             let nextEl = el.next();
//
//             el.addClass('__hide').removeClass('__active');
//             nextEl.removeClass('__hide');
//             setTimeout(function () {
//                 nextEl.addClass('__active');
//                 $('.mini-form__step.__active .select2-container').css('width', '100%');
//             }, 10)
//
//             if (nextEl.hasClass('js-last')) {
//                 $('.button').fadeOut(20, function () {
//                     $('button').fadeIn(20);
//                 });
//             }
//         });
//     // });
// });