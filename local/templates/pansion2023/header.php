<!DOCTYPE html>
<html lang="ru">
<head>

    <?php global $APPLICATION, $USER; ?>
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <?php
    $APPLICATION->ShowMeta("meta_title", "title");
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowMeta("keywords");
    $APPLICATION->ShowMeta("description");
    $ts = \Bitrix\Main\Config\Option::get('des_cache', 'timestamp')
    ?>
    <script data-skip-moving="true">window.cache_ts = '<?= $ts ?>'</script>
    <link rel="stylesheet" href="/local/templates/pansion2023/static/app.min.css?<?= $ts ?>">
    <script src="https://www.google.com/recaptcha/api.js?render=6LchYzcqAAAAAAKsctUoKXHZGf9JdCrIAF2vBwQh"></script>
    <meta name="yandex-verification" content="dc0ac0c4eb607d58"/>
    <meta name="yandex-verification" content="638d97160b54ab51"/>
    <?php
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    $var = \DesperadoHelpers\AppHelper::getSiteDef();
    ?>
</head>
<body>
<?php if ($USER->IsAdmin()) $APPLICATION->ShowPanel(); ?>

<script data-skip-moving="true">
    var div = document.createElement("div");
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "<?= SITE_TEMPLATE_PATH ?>/static/sprite.svg", true);
    ajax.send();
    ajax.onload = function (e) {
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
        div.style.height = '0';
    };
    window.cache_ts = '<?= $ts ?>';
</script>

<div class="header__wrapper">
    <div class="container">
        <div class="header">
            <div class="header__logo">
                <?php if (CSite::InDir('/index.php') && empty($_REQUEST['q'])): ?>
                    <?php \DesperadoHelpers\AppHelper::showIcon('logo'); ?>
                <?php else: ?>
                    <a href="/">
                        <?php \DesperadoHelpers\AppHelper::showIcon('logo'); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="header__search">
                <form action="/" class="header__search-from" id="title-search">
                    <span class="header__search-icon">
                        <?php \DesperadoHelpers\AppHelper::showIcon('search-sliders'); ?></span>
                    <input type="text" id="title-search-input" name="q"
                           placeholder="Поиск по более чем 400 пансионатов" autocomplete="off">
                    <button><?php \DesperadoHelpers\AppHelper::showIcon('search'); ?></button>
                </form>
            </div>
            <div class="header__phone">
                <a class="header__phone-number" href="tel:<?= $var['PHONE_SHORT'] ?>"><?= $var['PHONE'] ?></a>
                <div class="header__callback-button" data-modal="callback" data-metrika="button_2">Заказать звонок</div>
            </div>
            <div class="header__button" data-modal="podbor" data-metrika="button_4">
                Подобрать пансионат
            </div>
        </div>
    </div>
</div>

<div class="main-menu__wrapper">
    <div class="container">
        <div class="main-menu">
            <a href="/find/map/" class="main-menu__map">
                <?php \DesperadoHelpers\AppHelper::showIcon('location'); ?> На карте</a>
            <?php $var = \DesperadoHelpers\AppHelper::getSiteDef(); ?>
            <?php $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_menu", array(
                "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                "CACHE_GROUPS" => "Y",    // Учитывать права доступа
                "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                "CACHE_TYPE" => "A",    // Тип кеширования
                "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
                "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
                "IBLOCK_ID" => $var['MENU_IBLOCK_ID'],    // Инфоблок
                "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
                "SECTION_CODE" => "",    // Код раздела
                "SECTION_FIELDS" => array(    // Поля разделов
                    0 => "",
                    1 => "",
                ),
                "SECTION_ID" => $var['MENU_SECTION_ID'],    // ID раздела
                "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                "SECTION_USER_FIELDS" => array(    // Свойства разделов
                    0 => "",
                    1 => "",
                ),
                "SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
                "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
                "VIEW_MODE" => "LINE",    // Вид списка подразделов
                "COMPONENT_TEMPLATE" => ".default"
            ),
                false
            ); ?>
        </div>
    </div>
</div>

<div class="mobile-header__wrapper">
    <div class="container">
        <div class="mobile-header">
            <div class="mobile-header__logo">
                <?php if (CSite::InDir('/index.php')): ?>
                    <?php \DesperadoHelpers\AppHelper::showIcon('logo'); ?>
                <?php else: ?>
                    <a href="/">
                        <?php \DesperadoHelpers\AppHelper::showIcon('logo'); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="mobile-header__phone">
                <a class="mobile-header__phone-number" href="tel:<?= $var['PHONE_SHORT'] ?>">
                    <?php \DesperadoHelpers\AppHelper::showIcon('phone'); ?>
                </a>
            </div>
            <div class="mobile-header__search">
                <a href="/find/">
                    <?php \DesperadoHelpers\AppHelper::showIcon('search'); ?>
                </a>
            </div>
            <div class="mobile-header__menu js-show-mob-menu">
                <?php \DesperadoHelpers\AppHelper::showIcon('app-menu'); ?>
            </div>
        </div>
    </div>
</div>


<div class="mobile-menu">
    <div class="mobile-menu__header"></div>
    <div class="mobile-menu__links-wrapper">
        <ul class="mobile-menu__links">
            <li class="mobile-menu__link"><a href="/pansionaty-dlya-pozhilykh/">Пансионаты для пожилых</a></li>
            <li class="mobile-menu__link"><a href="/doma-prestarelykh/">Дома престарелых</a></li>
            <li class="mobile-menu__link"><a href="/pansionaty-dlya-veteranov/">Пансионаты для ветеранов</a></li>
            <li class="mobile-menu__link"><a href="/khospisy/">Хосписы</a></li>
            <li class="mobile-menu__link"><a href="/kak-vybrat-pansionat/">Как выбрать пансионат</a></li>
            <li class="mobile-menu__link"><a href="/addnew/">Добавить пансионат</a></li>
            <li class="mobile-menu__link"><a href="/otzyvy/">Отзывы</a></li>
            <li class="mobile-menu__link"><a href="/faq/">Вопросы — ответы</a></li>
            <li class="mobile-menu__link"><a href="/news/">Новости</a></li>
            <li class="mobile-menu__link"><a href="/kontakty/">Контакты</a></li>
        </ul>
    </div>
    <div class="mobile-menu__footer">
        <div class="mobile-menu__footer-phone">
            <a href="tel:<?= $var['PHONE_SHORT'] ?>"><?= $var['PHONE'] ?></a>
        </div>
        <div class="mobile-menu__footer-button-wrapper">
            <div class="mobile-menu__footer-button" data-modal="callback" data-metrika="button_2">Заказать звонок</div>
        </div>
    </div>
</div>


<?php if (!CSite::InDir('/index.php')): ?>
<div class="container">
    <?php $APPLICATION->IncludeComponent("bitrix:breadcrumb", "brdc", array(
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    ); ?>
    <h1><?php $APPLICATION->ShowTitle(false) ?></h1>
<?php endif; ?>