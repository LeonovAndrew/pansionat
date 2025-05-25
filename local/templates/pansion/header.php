<!DOCTYPE html>
<html lang="ru">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <?
    $APPLICATION->ShowMeta("meta_title", "title");
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowMeta("keywords");
    $APPLICATION->ShowMeta("description");
    $ts = \Bitrix\Main\Config\Option::get('des_cache', 'timestamp')
    ?>
    <script data-skip-moving="true">window.cache_ts = '<?= $ts ?>'</script>
    <link rel="stylesheet" href="/local/templates/pansion/main.css?<?= $ts ?>">
    <meta name="yandex-verification" content="dc0ac0c4eb607d58"/>
    <meta name="yandex-verification" content="638d97160b54ab51"/>

    <?
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    $var = \DesperadoHelpers\AppHelper::getSiteDef();
    ?>
</head>
<body>
<? if ($USER->IsAdmin()) $APPLICATION->ShowPanel(); ?>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="item_wrapper">
                <a href="/" class="main_link">
                    <img src="/local/templates/pansion/img/house-with-hands-yellow.svg" alt="" height="36">
                    PANSIONAT.<span>PRO</span>
                </a>

                <span class="show-mobile js-mobileMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>

                <span class="show-mobile js-mobileSearch">
                    <img src="/local/templates/pansion/img/search.svg" alt="">
                </span>


                <div class="phone_wrapper hide-mobile"><a class="phone" href="tel:<?=$var['PHONE_SHORT']?>"><?=$var['PHONE']?></a><br><a
                            class="link js-show-modal" data-modal="callback" href="javascript:void(0)"
                            onclick="yaCounter55993486.reachGoal('button_1'); return true;" data-metrika="button_2">Заказать
                        звонок</a></div>
            </div>
            <div class="item_wrapper hide-mobile">
                <form action="/" class="header_search" id="title-search">
                    <input type="text" id="title-search-input" name="q" placeholder="Найти на сайте" autocomplete="off">
                    <button type="submit"><img src="/local/templates/pansion/img/search.svg" alt=""></button>
                </form>
            </div>
            <div class="item_wrapper hide-mobile">
                <div class="action_links">
                    <a href="/favorites/">
                        <span id="num_fav">0</span>
                        <img src="/local/templates/pansion/img/favorite.svg" alt="">
                        Избранное
                    </a>

                    <!--                    <a href="/favorites/">-->
                    <!--                        <img src="/local/templates/pansion/img/growth.svg" alt="">-->
                    <!--                        Сравнение-->
                    <!--                    </a>-->
                </div>
            </div>
        </div>
    </div>

    <div id="mobile_menu">
        <div class="scroll">
            <span class="logo"><img src="/local/templates/pansion/img/house-with-hands-yellow.svg" alt="" height="36">
            PANSIONAT.PRO</span><br>

            <a class="phone" href="tel:<?=$var['PHONE_SHORT']?>"><?=$var['PHONE']?></a>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/doma-prestarelykh/">Дома престарелых</a></li>
                <li><a href="/pansionaty-dlya-veteranov/">Пансионаты для ветеранов</a></li>
                <li><a href="/pansionaty-dlya-pozhilykh/">Пансионаты для пожилых</a></li>
                <li><a href="/faq/">Вопрос-ответ</a></li>
                <li><a href="/">Главная</a></li>
                <li><a href="/about/">О нас</a></li>
            </ul>
        </div>
    </div>


    <div class="mobile_search">
        <form action="/" class="header_search" id="title-search2">
            <input type="text" name="q" id="title-search-input2" placeholder="Найти на сайте" autocomplete="off">
            <button type="submit"><img src="/local/templates/pansion/img/search.svg" alt=""></button>
        </form>
    </div>
</div>
<div class="container">
    <div class="main_menu">
        <? $var = \DesperadoHelpers\AppHelper::getSiteDef(); ?>
        <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_menu", Array(
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
        <a href="/addnew/" class="add_new">
            <span>+</span> Добавить пансионат
        </a>
    </div>
</div>

<div class="container">

    <? if (!CSite::InDir('/index.php')): ?>
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "brdc", Array(
            "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
            "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
            "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
        ),
            false
        ); ?>
        <h1><? $APPLICATION->ShowTitle(false) ?></h1>
    <? endif; ?>