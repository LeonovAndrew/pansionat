<?php
use \Bitrix\Main\Config\Option;
?>
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
    <?php if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
        <script src="https://www.google.com/recaptcha/api.js?render=6LchYzcqAAAAAAKsctUoKXHZGf9JdCrIAF2vBwQh"></script>
        <script src="/local/templates/pansion2023/script.js"></script>
    <?php endif; ?>
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
<?php if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false) : ?>
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
<?php endif; ?>
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
            <div class="main-menu__map location-btn">
                <svg>
                    <use xlink:href="#icon-location"></use>
                </svg>
                Город
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
            <?php
            $telegramLink = Option::get("grain.customsettings","telegram");
            $whatsappLink = Option::get("grain.customsettings","whatsapp");
            ?>
            <?php if(!empty($telegramLink) || !empty($whatsappLink) ):?>
            <div class="header_icon_wrap">
                <?php if(!empty($whatsappLink)):?>
                    <a href="<?=$whatsappLink?>" class="header-icon whatsapp" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16"><path fill="#fff" d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144l-2.494.654l.666-2.433l-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931a6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646c-.182-.065-.315-.099-.445.099c-.133.197-.513.646-.627.775c-.114.133-.232.148-.43.05c-.197-.1-.836-.308-1.592-.985c-.59-.525-.985-1.175-1.103-1.372c-.114-.198-.011-.304.088-.403c.087-.088.197-.232.296-.346c.1-.114.133-.198.198-.33c.065-.134.034-.248-.015-.347c-.05-.099-.445-1.076-.612-1.47c-.16-.389-.323-.335-.445-.34c-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992c.47.205.84.326 1.129.418c.475.152.904.129 1.246.08c.38-.058 1.171-.48 1.338-.943c.164-.464.164-.86.114-.943c-.049-.084-.182-.133-.38-.232"/></svg>
                    </a>
                <?php endif;?>
                <?php if(!empty($telegramLink)):?>
                    <a href="<?=$telegramLink?>" class="header-icon telegram" target="_blank">
                        <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="#fff" d="m12 24c6.617 0 12-5.383 12-12s-5.383-12-12-12-12 5.383-12 12 5.383 12 12 12zm0-22.5c5.79 0 10.5 4.71 10.5 10.5s-4.71 10.5-10.5 10.5-10.5-4.71-10.5-10.5 4.71-10.5 10.5-10.5z"></path><path fill="#fff" d="m7.896 14.155 1.568-.681-.44.441c-.141.141-.22.332-.22.53v2.935c0 .672.812.998 1.28.53l1.574-1.574 3.43 1.715c.444.222.981-.041 1.073-.537l1.957-10.761c.103-.579-.467-1.047-1.012-.833l-12.716 4.977c-.57.222-.646 1.002-.13 1.331l2.934 1.872c.21.134.475.155.702.055zm8.506-6.347-1.537 8.455-3.02-1.509c-.292-.146-.64-.085-.865.141l-.676.676v-.813l3.007-3.007c.583-.583-.073-1.545-.829-1.218l-4.817 2.09-1.354-.864z"></path></svg>
                    </a>
                <?php endif;?>
            </div>
            <?php endif;?>
            <div class="header__button" data-modal="podbor" data-metrika="button_4">
                Бесплатная консультация
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
            <?php $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_menu", [
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
                "SECTION_FIELDS" => [    // Поля разделов
                    0 => "",
                    1 => "",
                ],
                "SECTION_ID" => $var['MENU_SECTION_ID'],    // ID раздела
                "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
                "SECTION_USER_FIELDS" => [    // Свойства разделов
                    0 => "",
                    1 => "",
                ],
                "SHOW_PARENT_NAME" => "Y",    // Показывать название раздела
                "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
                "VIEW_MODE" => "LINE",    // Вид списка подразделов
                "COMPONENT_TEMPLATE" => ".default",
            ],
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
            <li class="mobile-menu__link"><a href="/gallery/">Галерея</a></li>
            <li class="mobile-menu__link"><a href="/about/">Контакты</a></li>
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
    <?php $APPLICATION->IncludeComponent("bitrix:breadcrumb", "brdc", [
        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
    ],
        false
    ); ?>
    <?php $current_url = $APPLICATION->GetCurPage(); ?>
    <?php if (strpos($current_url, '/otzyvy-') === false): ?>
        <h1><?php $APPLICATION->ShowTitle(false) ?></h1>
    <?php else: ?>
        <h1>Отзывы о <?php $APPLICATION->ShowTitle(false) ?></h1>
    <?php endif; ?>
    <?php endif; ?>
