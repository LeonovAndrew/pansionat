<h1>Подобрать пансионат</h1>

<form action="/dev/null" class="simple shadow" id="jsCallBackForm" data-metrika="<?= $post['metrika'] ?>">

    <input type="text" name="name" autocomplete="off" placeholder="Имя">

    <input type="text" name="phone" autocomplete="off" placeholder="Телефон">

    <textarea name="text" autocomplete="off" placeholder="Сообщение"></textarea>

    <button type="submit">Отправить заявку</button>

    <input type="hidden" name="modal_action" value="callback">
    <input type="hidden" name="client_ids" value="">
</form>

<p class="after">Мы перезвоним вам в течение 20 минут</p>

<script>
    $('input[name=phone]').inputmask({
        mask: '+7 (999) 999-99-99',
        shiftPositions: true,
        clearIncomplete: true,
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
</script>