<h1>Поставить в бронь</h1>

<form action="/dev/null" class="simple shadow" id="jsTakeRent">

    <input type="text" name="name" autocomplete="off" placeholder="Имя">

    <input type="text" name="phone" autocomplete="off" placeholder="Телефон">

    <div class="row">
        <div class="item_wrapper">
            <p class="sub_title">Дата заезда</p>
            <input name="date_in" class="js-datepicker" autocomplete="off" value="<?= date("d.m.Y"); ?>">
        </div>

        <div class="item_wrapper">
            <p class="sub_title">Дата отъезда</p>
            <input name="date_out" class="js-datepicker" autocomplete="off" value="<?= date("d.m.Y"); ?>">
        </div>
    </div>

    <div style="position: relative;">
        <input type="checkbox" name="alltime" id="alltime">
        <label for="alltime">Постоянное место жительства</label>
    </div>

    <button type="submit">Забронировать</button>

    <input type="hidden" name="modal_action" value="makerent">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
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

    addScript(vendorPath + 'datepicker.js', function () {
        $('.js-datepicker').datepicker({autoClose: true});
    });
    // $('.js-datepicker').datepicker({autoClose:true});
</script>