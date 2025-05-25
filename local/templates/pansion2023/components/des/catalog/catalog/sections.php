<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
$var = \DesperadoHelpers\AppHelper::getSiteDef();
?>

<div class="index-slide" style="background-image: url('/local/templates/pansion2023/static/img/hello.jpg')">
    <div class="container">
        <div class="index-slide__text">
            <div class="index-slide__title">Проверенные пансионаты для пожилых и дома престарелых</div>
            <div class="index-slide__sub-title">Более 400 домов престарелых по Москве и области</div>
        </div>
    </div>
</div>


<div class="block __small-margin">
    <div class="container">

        <? $APPLICATION->IncludeComponent(
            "des:main_form",
            "",
            array()
        ); ?>

    </div>
</div>

<div class="block">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH . "/include/pluses-6.php"
            )
        ); ?>
    </div>
</div>

<?php /*
<div class="block">
    <div class="container">
        <div class="adaptive-link">
            <div class="adaptive-link__big">
                <img src="/local/templates/pansion2023/static/img/main-page/b3big.png" alt="">
            </div>
            <div class="adaptive-link__small">
                <img src="/local/templates/pansion2023/static/img/main-page/b3small.png" alt="">
            </div>
        </div>
    </div>
</div> */ ?>

<div class="block">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/mainpage_top.php"
            )
        ); ?>
    </div>
</div>
<div itemscope itemtype="https://schema.org/OfferCatalog">
    <meta itemprop="name" content="Каталог пансионатов">
    <meta itemprop="description" content="Пансионаты для пожилых">
    <meta itemprop="image" content="https://pansiont.pro/upload/iblock/663/6637a08955e5e8466040ad91f8360561.png">

    <div class="block __blue-bg">
        <div class="container">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/index-page-tab1.php"
                )
            ); ?>
        </div>
    </div>

    <div class="block">
        <div class="container">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/index-page-tab2.php"
                )
            ); ?>
        </div>
    </div>
</div>
<div class="block">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH . "/include/pluses-4.php"
            )
        ); ?>
    </div>
</div>


<div class="block">
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "befor_footer", array(
            "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
            "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
            "CACHE_GROUPS" => "Y",    // Учитывать права доступа
            "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
            "CACHE_TYPE" => "A",    // Тип кеширования
            "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
            "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],    // Инфоблок
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
            "SHOW_PARENT_NAME" => "Y",
            "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
            "VIEW_MODE" => "LINE",
            "COMPONENT_TEMPLATE" => ".default"
        ),
            false
        ); ?>
    </div>
</div>

<div class="block">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/mainpage-new.php"
            )
        ); ?>
    </div>
</div>

<div class="block">
    <div class="container">
        <h2>Подберите пансионат для престарелых с учетом заболеваний и районов проживания:</h2>

        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH . "/include/index-page-tab3.php"
            )
        ); ?>
    </div>
</div>

<div class="block">
    <div class="container">
        <h2>Полезная информация для пожилых</h2>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "news_list",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "3",
                "IBLOCK_TYPE" => "pansionat",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "3",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "round",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "news_list"
            ),
            false
        ); ?>
        <div class="news-button-wrapper">
            <a href="/news/" class="all-news-button">Все статьи</a>
        </div>
    </div>
</div>

<div class="block">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH . "/include/form-index.php"
            )
        ); ?>
    </div>
</div>

<div class="block">
    <div class="container">
        <h2>Сети пансионатов</h2>

        <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections_seti", array(
            "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
            "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
            "CACHE_GROUPS" => "Y",    // Учитывать права доступа
            "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
            "CACHE_TYPE" => "A",    // Тип кеширования
            "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
            "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
            "IBLOCK_ID" => 1,    // Инфоблок
            "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
            "SECTION_CODE" => "",    // Код раздела
            "SECTION_FIELDS" => array(    // Поля разделов
                0 => "",
                1 => "",
            ),
            "SECTION_ID" => $var['SETI_SECTION_ID'],    // ID раздела
            "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
            "SECTION_USER_FIELDS" => array(    // Свойства разделов
                0 => "",
                1 => "",
            ),
            "SHOW_PARENT_NAME" => "Y",
            "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
            "VIEW_MODE" => "LINE",
            "COMPONENT_TEMPLATE" => "main_menu"
        ),
            false
        ); ?>
    </div>
</div>



