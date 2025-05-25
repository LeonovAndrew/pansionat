if (document.querySelector(".js-ratingStars") != null) {
    $(".js-ratingStars").each(function (idx, el) {
        var input = $(this).find('input');
        var spans = $(this).find('span');
        var curRatimg = 0;

        function drawStarts(val) {
            $(spans).each(function (idx, el) {
                if (parseInt(val - 1) >= parseInt(idx)) {
                    $(el).removeClass('grey').addClass('yellow').find('use').attr('xlink:href','#icon-star-filled');
                } else {
                    $(el).removeClass('yellow').addClass('grey').find('use').attr('xlink:href','#icon-star-blank');
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