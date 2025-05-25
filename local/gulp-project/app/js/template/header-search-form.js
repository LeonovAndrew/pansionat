$('#title-search input').focus(function () {
    $('#title-search').addClass('active');
});

$('#title-search').focusout(function () {
    $('#title-search').removeClass('active');
});