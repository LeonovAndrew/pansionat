<div class="calc_form_wrapper">

    <h2>Расчет стоимости проживания</h2>
    <p class="steps">Шаг <span id="cur_step">1</span> из 5</p>

    <form action="/dev/null" id="jsMakeCalc" style="margin-top: 10px" class="simple shadow"
          data-metrika="<?= $post['metrika'] ?>">

        <div class="steps_wrapper">
            <div class="step active" id="step1">
                <h1>Укажите возраст гостя</h1>

                <div class="radio_button">
                    <input type="radio" name="age" value="55-70" id="age55">
                    <label for="age55">55-70</label>
                </div>

                <div class="radio_button">
                    <input type="radio" name="age" value="70-85" id="age70">
                    <label for="age70">70-85</label>
                </div>

                <div class="radio_button">
                    <input type="radio" name="age" value="85-99" id="age85">
                    <label for="age85">85-99</label>
                </div>
            </div>

            <div class="step next" id="step2">
                <h1>Укажите пол гостя</h1>

                <div class="radio_button">
                    <input type="radio" name="sex" value="Мужчина" id="sexM">
                    <label for="sexM">Мужчина</label>
                </div>

                <div class="radio_button">
                    <input type="radio" name="sex" value="Женщина" id="sexJ">
                    <label for="sexJ">Женщина</label>
                </div>
            </div>

            <div class="step next" id="step3">
                <h1>Может ли пожилой человек самостоятельно передвигаться?</h1>

                <div class="radio_button">
                    <input type="radio" name="move" value="Да" id="moveY">
                    <label for="moveY">Да</label>
                </div>

                <div class="radio_button">
                    <input type="radio" name="move" value="Нет" id="moveN">
                    <label for="moveN">Нет</label>
                </div>
            </div>

            <div class="step next" id="step4">
                <h1>Выберите расположение пансионата</h1>

                <div class="radio_button half">
                    <input type="radio" name="napr" value="Север" id="naprSev">
                    <label for="naprSev">Север</label>
                </div>

                <div class="radio_button half">
                    <input type="radio" name="napr" value="Юг" id="naprUg">
                    <label for="naprUg">Юг</label>
                </div>

                <div class="radio_button half">
                    <input type="radio" name="napr" value="Запад" id="naprZap">
                    <label for="naprZap">Запад</label>
                </div>

                <div class="radio_button half">
                    <input type="radio" name="napr" value="Восток" id="naprVost">
                    <label for="naprVost">Восток</label>
                </div>

                <div class="radio_button half">
                    <input type="radio" name="napr" value="Центр" id="naprCentr">
                    <label for="naprCentr">Центр</label>
                </div>
            </div>

            <div class="step next" id="step5">
                <h1>Выберите количество мест в комнате</h1>

                <div class="radio_button half">
                    <input type="radio" name="mest" value="1" id="mest1">
                    <label for="mest1">1</label>
                </div>

                <div class="radio_button half">
                    <input type="radio" name="mest" value="2" id="mest2">
                    <label for="mest2">2</label>
                </div>

                <div class="radio_button half">
                    <input type="radio" name="mest" value="3" id="mest3">
                    <label for="mest3">3</label>
                </div>

                <div class="radio_button half">
                    <input type="radio" name="mest" value="4" id="mest4">
                    <label for="mest4">4</label>
                </div>
            </div>

            <div class="step next" id="step6">
                <h1>Спецпредложение:</h1>
                <blockquote>
                    <?
                    $arr = [
                        'января',
                        'февраля',
                        'марта',
                        'апреля',
                        'мая',
                        'июня',
                        'июля',
                        'августа',
                        'сентября',
                        'октября',
                        'ноября',
                        'декабря'
                    ];
                    ?>
                    Также до <?= date('t') . ' ' . $arr[date('n') - 1] ?> действует акция:
                    7 дней бесплатного проживания в любом
                    пансионате
                </blockquote>

                <blockquote>+ промокод на скидку "3000 руб."</blockquote>

                <input type="text" name="name" autocomplete="off" placeholder="Имя">

                <input type="text" name="phone" autocomplete="off" placeholder="Телефон">
            </div>
        </div>

        <div class="bottom_buttons">
            <div class="clearfix">
                                <span class="move_back" style="display: none"><img
                                        src="/local/templates/pansion/img/left-arrow.svg"
                                        alt=""></span>
                <span class="move_formard disabled">Далее <img
                        src="/local/templates/pansion/img/right-arrow.svg"
                        alt=""></span>
            </div>

            <input type="hidden" name="modal_action" value="makeCalc">
            <input type="hidden" name="client_ids" value="">
            <button class="fiol_button" style="display: none">Получить предложение</button>
        </div>
    </form>
</div>

<script>
    window.calcCurStep = 1;
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