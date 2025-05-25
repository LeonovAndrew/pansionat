function progressHandlingFunction(e) {
    if (e.lengthComputable) {
        $('progress').attr({value: e.loaded, max: e.total});
    }
}

$('.js-formQQAA2').submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var _self = $(this);

    $.ajax({
        url: '/local/templates/main2017/ajax/modal.actions.php',  //Server script to process data
        type: 'POST',
        xhr: function () {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Check if upload property exists
                myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // For handling the progress of the upload
            }
            return myXhr;
        },
        //Ajax events
        //beforeSend: beforeSendHandler,
        success: function (msg) {
            console.log(msg);
            if (msg.msg == 'ok') {
                _self.fadeOut(function () {
                    _self.next('p').fadeIn();
                });
            }
        },
        //error: errorHandler,
        // Form data
        data: formData,
        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json'
    });

    return false;
});

// *******************************************
//
//
//
// *******************************************


function showSuccessModal() {
    $('#modal .content').html('' +
        '<div class="success">' +
        '<img src="/local/templates/pansion/img/success.svg" alt="">' +
        '<h1>Спасибо!</h1>' +
        '<p>Ваша заявка уже на рассмотрении. \n' +
        'Наш менеджер скоро свяжется с вами, чтобы ответить на все вопросы.</p>' +
        '<span class="close_butt">ОК</span>' +
        '</div>');
}

$('body').on('focus', 'input.error', function () {
    $(this).removeClass('error');
});

$('body').on('change', 'input.error', function () {
    $(this).removeClass('error');
});


var timeout = 5000;
var url = '/local/ajax/process.php'
var error_timeout = 'Внимание! Время ожидания ответа сервера истекло';
var error_default = 'Внимание! Произошла ошибка, попробуйте отправить информацию еще раз';

$('body').on('submit', '#jsCallBackForm', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['phone'];
    var jsMetrika = $(this).attr('data-metrika');

    inputs.forEach(function (t) {

        var input = _self.find('input[name="' + t + '"]');
        if (input.val() == '') {
            input.addClass('error');
            hasErrors = true;
        }
    });

    if (!hasErrors) {
        _self.find('button').attr('disabled', 'disabled');
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
                }
                else {
                    alert(error_default);
                }
            },
            success: function (data) {
                if (data.msg == 'ok') {
                    showSuccessModal();
                    yaCounter55993486.reachGoal(jsMetrika);
                } else {
                    $('#jsCallBackForm + p').html(data.error);
                }
            }
        });
        return false;
    }
});

$('body').on('submit', '.js-simpleForm', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['phone'];
    var jsMetrika = $(this).attr('data-metrika');

    inputs.forEach(function (t) {

        var input = _self.find('input[name="' + t + '"]');
        if (input.val() == '') {
            input.addClass('error');
            hasErrors = true;
        }
    });

    if (!hasErrors) {
        _self.find('button').attr('disabled', 'disabled');
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
                }
                else {
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
        return false;
    }
});

$('body').on('submit', '#jsTakeRent', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['phone'];

    inputs.forEach(function (t) {

        var input = _self.find('input[name="' + t + '"]');
        if (input.val() == '') {
            input.addClass('error');
            hasErrors = true;
        }
    });

    if (!hasErrors) {
        _self.find('button').attr('disabled', 'disabled');
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
                }
                else {
                    alert(error_default);
                }
            },
            success: function (data) {
                if (data.msg == 'ok') {
                    showSuccessModal();
                    yaCounter55993486.reachGoal('button_9');
                } else {
                    $('#jsCallBackForm + p').html(data.error);
                }
            }
        });
        return false;
    }
});

$('body').on('submit', '.js-addReview', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['name', 'email'];

    inputs.forEach(function (t) {

        var input = _self.find('input[name="' + t + '"]');
        if (input.val() == '') {
            input.addClass('error');
            hasErrors = true;
        }
    });

    if (!hasErrors) {
        _self.find('button').attr('disabled', 'disabled');
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
                }
                else {
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
        return false;
    }
});

$('body').on('submit', '#addNew', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;
    var inputs = ['adres', 'price', 'phone', 'mest', 'site'];

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
                }
                else {
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
        return false;
    }
});

$('body').on('submit', '#main_form', function (e) {
    e.preventDefault();

    var _self = $(this);
    var hasErrors = false;

    if (!hasErrors) {
        _self.find('button').attr('disabled', 'disabled');

        $.ajax({
            type: "POST",
            url: '/local/ajax/getPansion.php',
            data: _self.serializeArray(),
            timeout: timeout,
            dataType: 'json',
            error: function (request, error) {
                _self.find('button').removeAttr('disabled');
                if (error == "timeout") {
                    alert(error_timeout);
                }
                else {
                    alert(error_default);
                }
            },
            success: function (data) {
                window.clusterer.removeAll();

                setTimeout(function () {
                    if (data.items)
                        data.items.forEach(function (el) {
                            window.clusterer.add(
                                new ymaps.Placemark(
                                    el.coords,
                                    {
                                        balloonContentHeader: '',

                                        balloonContentBody: '' +
                                        '<div class="in_map"> ' +
                                        '<a href = "' + el.url + '"><img src="' + el.picsrc + '" height="150"></a><br/>' +
                                        '<a href = "' + el.url + '">' + el.name + '</a><br>' +
                                        '<p class="rating_line">' + el.rating_html + '</p><br>' +
                                        '<p class="price"> Цена: ' + el.price + ' руб./сутки</p>' +
                                        // '<a href = "' + el.url + '">Подробнее</a><br>' +
                                        '<span class="fiol_button js-show-modal" data-modal="takerent" data-id="' + el.id + '">Забронировать</span>' +
                                        '</div>',


                                        hintContent: el.name
                                    },
                                    {
                                        preset: 'islands#icon',
                                        iconColor: '#663ab6'
                                    }
                                )
                            );
                        });
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#map").offset().top
                    }, 500);
                    _self.find('button').removeAttr('disabled');
                }, 100);
            }
        });

        return false;
    }
});

$('body').on('click', '#main_form #clear_filter', function () {
    $('select[name=napr]').val('');
    $('select[name=section_id]').val('');
    $('select[name=fizsost]').val('');
    $('select[name=psihsost]').val('');
    $('input[name=rating\\[\\]]').prop('checked','');
});