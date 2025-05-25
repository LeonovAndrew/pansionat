</div>
<? $var = \DesperadoHelpers\AppHelper::getSiteDef(); ?>
<div class="footer">
    <div class="container">
        <div class="row">

            <div class="item_wrapper">
                <div class="item">
                    <a href="/" class="footer_link">
                        <img src="/local/templates/pansion/img/house-with-hands-white.svg" alt="" height="36">
                        PANSIONAT.<span>PRO</span>
                    </a>

                    <p class="small_text">по всем вопросам</p>
                    <p class="phone"><a href="tel:<?= $var['PHONE_SHORT'] ?>"><?= $var['PHONE'] ?></a></p>
                    <p><a class="link" href="mailto:info@pansionat.pro">info@pansionat.pro</a></p>

                  <!--  <br>ИП Сушилин Дмитрий Анатольевич
                    <br>ИНН 5032319984
                    <br>КПП 503201001

                    <br>
                    <a href="/upload/dogovor.pdf" target="_blank">
                            Мед. Услуги оказывает ООО "СМП МЕД" (г. Москва, просп. Ленинский, д. 77, корп. 1)</a>
                    и другие
                    <br>
                    <a href="/upload/license.pdf" target="_blank">Лицензия № ЛО-77-01-020372 от 10 сентября 2020 года.</a>-->

                    <ul>
                       <!-- <li><a href="/about/">Контакты</a></li>-->
                        <li><a href="/news/">Новости и события</a></li>
                        <li><a href="/about/">Обратная связь</a></li>
                        <li><a href="/faq/">Вопрос-ответ</a></li>
                    </ul>
                </div>
            </div>

            <div class="item_wrapper hide-mobile">
                <div class="item">
                    <div class="like_h2">Направления</div>
                    <? $APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", array(
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                        "ROOT_MENU_TYPE" => "footer1",    // Тип меню для первого уровня
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    ); ?>
                </div>
            </div>

            <div class="item_wrapper hide-mobile">
                <div class="item">
                    <div class="like_h2">Каталог</div>
                    <? $APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", array(
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                        "ROOT_MENU_TYPE" => "footer2",    // Тип меню для первого уровня
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    ); ?>
                </div>
            </div>

            <div class="item_wrapper">
                <div class="item">
                    <div class="like_h2">По болезням</div>
                    <? $APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", array(
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                        "ROOT_MENU_TYPE" => "footer3",    // Тип меню для первого уровня
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    ); ?>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="copyright">
            © Все права защищены, <?= date('Y') ?>
            <a href="https://pansionat.pro/">Пансионаты для пожилых</a>
            <a href="/policy/">Политика конфиденцальности</a>
            <a href="/cookie/">Политика обработки cookie файлов</a>
            <!--LiveInternet counter-->
            <script type="text/javascript" data-skip-moving="true">
                document.write('<a href="//www.liveinternet.ru/click" ' +
                    'target="_blank"><img src="//counter.yadro.ru/hit?t23.6;r' +
                    escape(document.referrer) + ((typeof (screen) == 'undefined') ? '' :
                        ';s' + screen.width + '*' + screen.height + '*' + (screen.colorDepth ?
                            screen.colorDepth : screen.pixelDepth)) + ';u' + escape(document.URL) +
                    ';h' + escape(document.title.substring(0, 150)) + ';' + Math.random() +
                    '" alt="" title="LiveInternet: показано число посетителей за' +
                    ' сегодня" ' +
                    'border="0" width="88" height="15"><\/a>')
            </script><!--/LiveInternet-->
            <a href="https://jd-buro.ru" target="_blank">Сделано в JD-Buro</a>
        </div>
    </div>
</div>

<div class="modal_wrapper">
    <div class="modal" id="modal">
        <div class="close">
            <img src="<?= SITE_TEMPLATE_PATH ?>/img/close.svg" height="12" alt="">
        </div>
        <div class="content">

        </div>
    </div>
</div>

<div class="grey_wrapper">

</div>

<span class="js-show-modal makeCalcButton" data-modal="calcPrice"
      onclick="yaCounter55993486.reachGoal('CLICK_CALC'); return true;"
      data-metrika="MAKE_CALC"
>Стоимость проживания</span>

<? $APPLICATION->IncludeComponent(
    "bitrix:search.title",
    "fast-search",
    array(
        "CATEGORY_0" => array(
            0 => "iblock_pansionat",
        ),
        "CATEGORY_0_TITLE" => "",
        "CATEGORY_0_iblock_pansionat" => array(
            0 => "1",
        ),
        "CHECK_DATES" => "N",
        "CONTAINER_ID" => "title-search",
        "INPUT_ID" => "title-search-input",
        "NUM_CATEGORIES" => "1",
        "ORDER" => "date",
        "PAGE" => "/",
        "SHOW_INPUT" => "N",
        "SHOW_OTHERS" => "N",
        "TOP_COUNT" => "5",
        "USE_LANGUAGE_GUESS" => "N",
        "COMPONENT_TEMPLATE" => "fast-search",
        "PRICE_CODE" => array(),
        "PRICE_VAT_INCLUDE" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "",
        "SHOW_PREVIEW" => "Y",
        "PREVIEW_WIDTH" => "75",
        "PREVIEW_HEIGHT" => "75"
    ),
    false
); ?>

<? $APPLICATION->IncludeComponent(
    "bitrix:search.title",
    "fast-search",
    array(
        "CATEGORY_0" => array(
            0 => "iblock_pansionat",
        ),
        "CATEGORY_0_TITLE" => "",
        "CATEGORY_0_iblock_pansionat" => array(
            0 => "1",
        ),
        "CHECK_DATES" => "N",
        "CONTAINER_ID" => "title-search2",
        "INPUT_ID" => "title-search-input2",
        "NUM_CATEGORIES" => "1",
        "ORDER" => "date",
        "PAGE" => "/",
        "SHOW_INPUT" => "N",
        "SHOW_OTHERS" => "N",
        "TOP_COUNT" => "5",
        "USE_LANGUAGE_GUESS" => "N",
        "COMPONENT_TEMPLATE" => "fast-search",
        "PRICE_CODE" => array(),
        "PRICE_VAT_INCLUDE" => "Y",
        "PREVIEW_TRUNCATE_LEN" => "",
        "SHOW_PREVIEW" => "Y",
        "PREVIEW_WIDTH" => "75",
        "PREVIEW_HEIGHT" => "75"
    ),
    false
); ?>

<? if ($_COOKIE['AGREE_COOKIE'] != 'Y'): ?>
    <div class="cookie">
        <div class="cookie__text">
            Мы используем <a href="/cookie/">cookie файлы</a> с целью улучшить сайт на основе ваших предпочтений и интересов.
        </div>
        <div class="cookie__button" id="agreeCookie">
            ОК
        </div>
    </div>
<? endif; ?>

<script data-skip-movinf="true" src="/local/templates/pansion/vendor/head.min.js"></script>
<script data-skip-movinf="true" src="/local/templates/pansion/script.js?ts=<?= $ts ?>"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter55993486 = new Ya.Metrika({
                    id: 55993486,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/55993486" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<!-- HotLog -->
<span id="hotlog_counter"></span>
<span id="hotlog_dyn"></span>
<script type="text/javascript"> var hot_s = document.createElement('script');
    hot_s.type = 'text/javascript';
    hot_s.async = true;
    hot_s.src = 'https://js.hotlog.ru/dcounter/2583405.js';
    hot_d = document.getElementById('hotlog_dyn');
    hot_d.appendChild(hot_s);
</script>
<noscript>
    <a href="http://click.hotlog.ru/?2583405" target="_blank">
        <img src="http://hit5.hotlog.ru/cgi-bin/hotlog/count?s=2583405&im=68" border="0"
             title="HotLog" alt="HotLog"></a>
</noscript>
<!-- /HotLog -->
<!-- Top100 (Kraken) Counter -->
<script>
    (function (w, d, c) {
        (w[c] = w[c] || []).push(function () {
            var options = {
                project: 6866456,
            };
            try {
                w.top100Counter = new top100(options);
            } catch (e) {
            }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src =
            (d.location.protocol == "https:" ? "https:" : "http:") +
            "//st.top100.ru/top100/top100.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(window, document, "_top100q");
</script>
<noscript>
    <img src="//counter.rambler.ru/top100.cnt?pid=6866456" alt="Топ-100"/>
</noscript>
<!-- END Top100 (Kraken) Counter -->
 <a href="https://pansionaty-stavropol.ru" title="Пансионаты для пожилых Ставрополь" alt="Пансионаты Ставрополь"></a>

</body>
</html>