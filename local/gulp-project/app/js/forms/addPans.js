$('body').on('submit', '#addNew', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['adres', 'price', 'phone', 'mest', 'site'];
    var _data;

    inputs.forEach(function (t) {
        var input = _self.find('input[name="' + t + '"]');
        if (input.val() == '') {
            input.addClass('error');
            hasErrors = true;
        }
    });

    var input = _self.find('input[name="agree"]');
    if (!input.prop("checked")) {
        input.addClass('error');
        hasErrors = true;
    }

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
                        data: $(this).serializeArray(),
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
                                _self.html('<p style="font-size: 20px;">Спасибо! Ваше обращение принято на модерацию.</p>')
                            } else {
                                $('#addNew + p').html(data.error);
                            }
                        }
                    });
                });
        });
        return false;
    }
});