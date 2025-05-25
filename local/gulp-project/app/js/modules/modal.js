function showModal() {
    $('.modal_wrapper .content').html('');
    $('.modal_wrapper').css('display', 'flex');
}

function closeModal() {
    $('.modal_wrapper .content').html('');
    $('.modal_wrapper').css('display', 'none');
}

document.addEventListener('DOMContentLoaded', function () {
    // requirejs(["jquery"], function () {
        $('body').on('click', '[data-modal]', function (e) {
            e.preventDefault();
            var modal = $(this).attr('data-modal');
            var id = $(this).attr('data-id');
            var jsMetrika = $(this).attr('data-metrika');
            var url = $(this).attr('data-url');

            $.ajax({
                type: "POST",
                url: '/local/ajax/showModal.php',
                data: 'modal=' + modal + '&id=' + id + '&metrika=' + jsMetrika + '&url=' + url,
                success: function (data) {
                    showModal();
                    $('.modal_wrapper .content').html(data);
                    $('.modal_wrapper').find('input[name=client_ids]').val(yaCounter55993486.getClientID());
                }
            });
            return false;
        });

        $('body').on('click', '#modal', function (e) {
            e.stopPropagation();
        });

        $('body').on('click', '#modal .js-close-modal', function (e) {
            closeModal();
        });

        $('body').on('click', '.modal_wrapper', function (e) {
            closeModal();
        });

    // })
});
