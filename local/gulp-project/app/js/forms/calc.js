window.calcCurStep = 1;
// $('.steps_wrapper').height($('#step' + window.calcCurStep).height());
$('.steps_wrapper').height(335);

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


function checkStep() {
    if (window.calcCurStep == 1) {
        $('.calc_form_wrapper .move_back').fadeOut();
    } else {
        $('.calc_form_wrapper .move_back').fadeIn();
    }

    $('#cur_step').html(window.calcCurStep);

    if (window.calcCurStep == 6) {
        $('.calc_form_wrapper .move_back').fadeOut();
        $('.calc_form_wrapper .move_formard').fadeOut();
        $('.calc_form_wrapper button').fadeIn();

        $('.calc_form_wrapper h2').html('Введите номер телефона, мы вышлем на него информацию или перезвоним.');
        $('.calc_form_wrapper p.steps').html('');
    }

    if ($('#step' + window.calcCurStep + ' input[type=radio]:checked').val()) {
        $('.calc_form_wrapper .move_formard').removeClass('disabled');
    } else {
        $('.calc_form_wrapper .move_formard').addClass('disabled');
    }
}

function showNextStep() {
    $('#step' + window.calcCurStep).removeClass('active').addClass('prev');
    window.calcCurStep += 1;
    // $('.steps_wrapper').height($('#step' + window.calcCurStep).height());
    $('.steps_wrapper').height(335);
    $('#step' + window.calcCurStep).removeClass('next').addClass('active');
    checkStep();
};

function showPrevStep() {
    if (window.calcCurStep > 1) {
        $('#step' + window.calcCurStep).removeClass('active').addClass('next');
        window.calcCurStep -= 1;
        // $('.steps_wrapper').height($('#step' + window.calcCurStep).height());
        $('.steps_wrapper').height(335);
        $('#step' + window.calcCurStep).removeClass('prev').addClass('active');
        checkStep();
    }
};

$('body').on('click', '.calc_form_wrapper .move_formard', function (e) {
    if (!$(this).hasClass('disabled'))
        showNextStep();
});

$('body').on('click', '.calc_form_wrapper .move_back', function (e) {
    showPrevStep();
});


$('body').on('change', '.step.active input[type=radio]', function (e) {
    setTimeout(function () {
        showNextStep();
    }, 400)
});

$('body').on('submit', '#jsMakeCalc', function (e) {
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
                    // console.log($(this).serializeArray());
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
                                showSuccessModal();
                                yaCounter55993486.reachGoal(jsMetrika);
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