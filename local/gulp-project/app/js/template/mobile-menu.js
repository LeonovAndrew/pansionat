$('.js-show-mob-menu').click(function (e) {
    $(this).toggleClass('__open');
    if ($(window).width() > 768) {
        // $('.main_menu_wrapper').toggleClass('open');
    } else {
        $('.mobile-menu').toggleClass('__show');
        $('body').toggleClass('no-scroll');
    }
});