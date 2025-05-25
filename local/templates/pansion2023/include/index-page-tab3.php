<?php
$var = \DesperadoHelpers\AppHelper::getSiteDef();
?>
<div class="tabs">
    <div class="tabs__wrapper">
        <div class="tabs__button __active" data-id="topTab31">Пансионаты&nbsp;по&nbsp;районам</div>
        <div class="tabs__button" data-id="topTab32">Пансионаты&nbsp;по&nbsp;болезням</div>
        <div class="tabs__button" data-id="topTab33">Пансионаты&nbsp;по&nbsp;состоянию</div>
        <div class="tabs__button" data-id="topTab34">Расположение</div>
        <div class="tabs__button" data-id="topTab35">Особенности</div>
    </div>
    <div class="tabs__content-wrapper">
        <div class="tabs__content">
            <div class="tabs__item __active" id="topTab31">
                <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
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
                    "SECTION_ID" => $var['RAIONY_SECTION_ID'],    // ID раздела
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
            <div class="tabs__item" id="topTab32">
                <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
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
                    "SECTION_ID" => $var['BOLEZNY_SECTION_ID'],    // ID раздела
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
            <div class="tabs__item" id="topTab33">
                <? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", array(
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
                    "SECTION_ID" => $var['SOSTOYANIE_SECTION_ID'],    // ID раздела
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
            <div class="tabs__item" id="topTab34">
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
            </div>
            <div class="tabs__item" id="topTab35">
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
            </div>
        </div>
    </div>
</div>