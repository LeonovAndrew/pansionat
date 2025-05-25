$('.tabs .tabs__button').click(function () {
    let id = $(this).data('id');
    $(this).closest('.tabs').find('.tabs__button').removeClass('__active');
    $(this).closest('.tabs').find('.tabs__item').removeClass('__active');

    $(this).addClass('__active');
    $(this).closest('.tabs').find('#' + id).addClass('__active');
    // setTimeout(function () {
    //     if ($('.js_sectionSlider').length)
    //         $('.js_sectionSlider').slick('refresh')
    // }, 300);
    let content = $(this).closest('.tabs').find('.tabs__content');
    let cur = $(this).closest('.tabs').find('.tabs__item.__active').children();

    // console.log(content.styles.height);
    // console.log( $(cur).height());

    $(content).height($(cur).height() + 'px');

});
