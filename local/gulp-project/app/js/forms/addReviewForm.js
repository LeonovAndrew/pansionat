$('body').on('submit', '.js-addReview', function (e) {

    var timeout = 5000;
    var url = '/local/ajax/process.php'
    var error_timeout = 'Внимание! Время ожидания ответа сервера истекло';
    var error_default = 'Внимание! Произошла ошибка, попробуйте отправить информацию еще раз';

    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['name', 'email', 'text', 'pansname'];
    var _data;

    inputs.forEach(function (t) {

        var input = _self.find('input[name="' + t + '"],textarea[name="' + t + '"]');
        if (input.val() == '') {
            input.addClass('error');
            hasErrors = true;
        }
    });

    if (!hasErrors) {
        _self.find('button').attr('disabled', 'disabled');

        grecaptcha.ready(function () {
            grecaptcha.execute('6LchYzcqAAAAAAKsctUoKXHZGf9JdCrIAF2vBwQh', {action: 'send_form'})
                .then(function (token) {
                    _data = _self.serializeArray();
                    _data[_data.length] = {name: 'token', value: token};

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: _data,
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
                            if (data.msg == 'ok') {
                                _self.html('<p style="font-size: 20px;">Спасибо за Ваш отзыв!</p>')
                            } else {
                                $('#jsCallBackForm + p').html(data.error);
                            }
                        }
                    });
                });
        });
        return false;
    }
});