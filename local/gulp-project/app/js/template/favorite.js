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

$('body').on('click', '.js-favorite', function (event) {
    event.preventDefault();
    var id = $(this).attr('data-item-id');
    if ($(this).hasClass('__favorited')) {
        deleteFromFavorite(id, this);
        $(this).removeClass('__favorited');
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
            if ($('.js-favorite[data-item-id=' + item + ']').length) {
                $('.js-favorite[data-item-id=' + item + ']').addClass('__favorited');
                $('.js-favorite[data-item-id=' + item + ']').tooltipster('content', 'Удалить из избранного');
            }
        })
    }
}

$('.js-tooltip').tooltipster({
    theme: 'tooltipster-borderless'
});

updateFravoriteItemsCNT();

$('body').on('click', '.actionClearFavorites', function (event) {
    deleteAllFavorite();
});

function deleteAllFavorite() {
    $.cookie('BX_FAV_ID', '', {path: '/'});
    location.reload();
}