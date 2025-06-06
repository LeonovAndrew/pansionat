<?php if (!CSite::InDir('/index.php')): ?>
    </div>
<?php endif; ?>
<? $var = \DesperadoHelpers\AppHelper::getSiteDef(); ?>
<div class="footer__wrapper">
    <div class="container">
        <div class="footer">

            <div class="footer__row">

                <div class="footer__logo">
                    <? \DesperadoHelpers\AppHelper::showIcon('logo'); ?>
                </div>

                <div class="footer__phone"><a href="tel:<?= $var['PHONE_SHORT'] ?>"><?= $var['PHONE'] ?></a></div>
                <div class="footer__mail"><a class="link" href="mailto:info@pansionat.pro">info@pansionat.pro</a>
                </div>

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
                    <li><a href="/kak-vybrat-pansionat/">Как выбрать пансионат</a></li>
                    <li><a href="/news/">Новости и события</a></li>
                    <li><a href="/about/">Обратная связь</a></li>
                    <li><a href="/faq/">Вопрос-ответ</a></li>
                    <li><a href="/addnew/">Добавить пансионат</a></li>
                    <li><a href="/map.php">Карта сайта</a></li>
                </ul>
            </div>

            <div class="footer__row __hide-mobile">
                <div class="footer__title">Направления</div>
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

            <div class="footer__row __hide-mobile">
                <div class="footer__title">Каталог</div>
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

            <div class="footer__row">
                <div class="footer__title">По болезням</div>
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

<div class="copyright__wrapper">
    <div class="container">
        <div class="copyright">
            <a href="https://jd-buro.ru" class="dev" target="_blank">Сделано
                в <?php \DesperadoHelpers\AppHelper::showIcon('dev-logo'); ?> JD-Buro</a>

            © Все права защищены, <?= date('Y') ?>
            <?php if (CSite::InDir('/index.php')): ?>
                Пансионаты для пожилых
            <?php else: ?>
                <a href="https://pansionat.pro/">Пансионаты для пожилых</a>
            <?php endif; ?>
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

        </div>
    </div>
</div>

<div class="modal_wrapper">
    <div class="modal" id="modal">
        <div class="close js-close-modal">
            <?php \DesperadoHelpers\AppHelper::showIcon('close'); ?>
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
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => SITE_TEMPLATE_PATH . "/include/cookie.php"
    )
); ?>
<?php if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) :?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => SITE_TEMPLATE_PATH . "/include/footer-counters.php"
    )
); ?>

<script data-skip-movinf="true" src="/local/templates/pansion2023/static/main.min.js?ts=<?= $ts ?>"></script>
<script data-skip-movinf="true" src="/local/templates/pansion2023/static/vendor/lazyload.min.js?ts=<?= $ts ?>"></script>

<!-- Roistat Counter Start -->
<script>
    (function(w, d, s, h, id) {
        w.roistatProjectId = id; w.roistatHost = h;
        var p = d.location.protocol == "https:" ? "https://" : "http://";
        var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init?referrer="+encodeURIComponent(d.location.href);
        var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
    })(window, document, 'script', 'cloud.roistat.com', 'c77a940ca203e081b9eb8351beab46fb');
</script>
<!-- Roistat Counter End -->


<!-- BEGIN WHATSAPP INTEGRATION WITH ROISTAT -->
<div class="js-whatsapp-message-container" style="display:none;">Отправьте, пожалуйста, данное сообщение и задайте после него свой вопрос. Ваш номер обращения: {roistat_visit}</div>
<script>
    (function() {
        if (window.roistat !== undefined) {
            handler();
        } else {
            var pastCallback = typeof window.onRoistatAllModulesLoaded === "function" ? window.onRoistatAllModulesLoaded : null;
            window.onRoistatAllModulesLoaded = function () {
                if (pastCallback !== null) {
                    pastCallback();
                }
                handler();
            };
        }

        function handler() {
            function init() {
                appendMessageToLinks();

                var delays = [1000, 5000, 15000];
                setTimeout(function func(i) {
                    if (i === undefined) {
                        i = 0;
                    }
                    appendMessageToLinks();
                    i++;
                    if (typeof delays[i] !== 'undefined') {
                        setTimeout(func, delays[i], i);
                    }
                }, delays[0]);
            }

            function replaceQueryParam(url, param, value) {
                var explodedUrl = url.split('?');
                var baseUrl = explodedUrl[0] || '';
                var query = '?' + (explodedUrl[1] || '');
                var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
                var queryWithoutParameter = query.replace(regex, "$1").replace(/&$/, '');
                return baseUrl + (queryWithoutParameter.length > 2 ? queryWithoutParameter  + '&' : '?') + (value ? param + "=" + value : '');
            }

            function appendMessageToLinks() {
                var message = document.querySelector('.js-whatsapp-message-container').textContent;
                var text = message.replace(/{roistat_visit}/g, window.roistatGetCookie('roistat_visit'));
                text = encodeURI(text);
                var linkElements = document.querySelectorAll('[href*="//wa.me"], [href*="//api.whatsapp.com/send"], [href*="//web.whatsapp.com/send"], [href^="whatsapp://send"]');
                for (var elementKey in linkElements) {
                    if (linkElements.hasOwnProperty(elementKey)) {
                        var element = linkElements[elementKey];
                        element.href = replaceQueryParam(element.href, 'text', text);
                    }
                }
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', init);
            } else {
                init();
            }
        };
    })();
</script>
<!-- END WHATSAPP INTEGRATION WITH ROISTAT -->
<?php endif;?>
 <a href="https://pansionaty-stavropol.ru" title="Пансионаты для пожилых Ставрополь" alt="Пансионаты Ставрополь"></a>
</body>
</html>