$('#agreeCookie').click(function () {
    $.cookie('AGREE_COOKIE', 'Y', {path: '/'});
    $('.cookie').removeClass('_show');
});

setTimeout(function () {
    $('.cookie').addClass('_show');
}, 1000);