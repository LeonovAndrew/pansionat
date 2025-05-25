<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
$APPLICATION->AddChainItem("Карта сайта", "/map.php");
?>

<div class="like_h2">Сети пансионатов</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "4",    // ID раздела
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

<div class="like_h2">Районы</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "3",    // ID раздела
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


<div class="like_h2">Болезни</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "2",    // ID раздела
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
<?php /*
<div class="like_h2">Направления</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "96",    // ID раздела
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
*/ ?>
<div class="like_h2">Состояние</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "97",    // ID раздела
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

<div class="like_h2">Расположение</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "245",    // ID раздела
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

<div class="like_h2">Особенности</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "249",    // ID раздела
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

<div class="like_h2">Шоссе</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "258",    // ID раздела
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

<?php /*
<div class="like_h2">Метро</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "299",    // ID раздела
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
); ?> */ ?>

<div class="like_h2">Города</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "COUNT_ELEMENTS" => "Y",    // Показывать количество элементов в разделе
    "FILTER_NAME" => "sectionsFilter",    // Имя массива со значениями фильтра разделов
    "IBLOCK_ID" => "1",    // Инфоблок
    "IBLOCK_TYPE" => "pansionat",    // Тип инфоблока
    "SECTION_CODE" => "",    // Код раздела
    "SECTION_FIELDS" => array(    // Поля разделов
        0 => "",
        1 => "",
    ),
    "SECTION_ID" => "159",    // ID раздела
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



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>