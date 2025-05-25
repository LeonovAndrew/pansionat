window.phoneInputMsak = function () {
    $('input[name=phone]').inputmask({
        mask: '+7 (999) 999-99-99',
        shiftPositions: true,
        clearIncomplete: true,
        onBeforePaste: function (value, opts) {
            let start2 = value.slice(0, 2);
            if (start2 == '+7' || start2 == '+8') {
                console.log(value)
                console.log(value.slice(2))
                return value.slice(2);
            }
            if (value[0] == 7 || value[0] == 8) {
                console.log(value)
                console.log(value.slice(1))
                return value.slice(1);
            }
        },
        onKeyDown: function (event, buffer, caretPos, opts) {
            if (caretPos == 18) {
                var keyPressed = event.key;
                var firskDigitOfNumber = $(this).val()[4];
                if (firskDigitOfNumber == '7' || firskDigitOfNumber == '8') {
                    var number = $(this).val();
                    var newStr = number.substring(0, 4) + number.substring(5, number.length) + keyPressed;
                    $(this).inputmask("setvalue", newStr);
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    window.phoneInputMsak();
});

