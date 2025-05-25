$('body').on('submit', '.js-simpleForm', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['phone'];
    var jsMetrika = $(this).attr('data-metrika');
    var _data;

    inputs.forEach(function (t) {

        var input = _self.find('input[name="' + t + '"]');
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
                                yaCounter55993486.reachGoal(jsMetrika);
                                _self.html('<p style="font-size: 20px;">Спасибо!<br>Наш менеджер скоро свяжется с вами, чтобы ответить на все вопросы.</p>')
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