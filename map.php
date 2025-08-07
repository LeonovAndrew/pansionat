<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
$APPLICATION->SetPageProperty('description', 'Карта сайта. 400 пансионатов для пожилых в Pansionat.pro в Москве и Подмосковье. Адреса, телефоны и цены на размещение в пансионаты для пожилых людей.');
$APPLICATION->AddChainItem("Карта сайта", "/map.php");

use Bitrix\Iblock\Elements\ElementTagsTable;

$arItems = ElementTagsTable::getList([
    'filter' => [
        'ACTIVE' => 'Y',
    ],
    'select' => [
        'ID',
        'NAME',
        'CODE',
        'FILTER_SMART_' => 'FILTER_SMART',
        'GROUP_' => 'GROUP',
    ],
])->fetchAll();

$arTagsGroupName = [
    592 => 'Сети пансионатов',
    593 => 'Районы',
    594 => 'Болезни',
    595 => 'Состояние',
    596 => 'Расположение',
    597 => 'Особенности',
    598 => 'Шоссе',
    599 => 'Города',
    600 => 'Другое',
];

function parseFilterFromUrl($url, $iblockId): array
{
    $parts = explode('/filter/', $url);
    if (count($parts) < 2) return [];

    $filterPart = rtrim($parts[1], '/');
    $sections = explode('/', $filterPart);

    $filter = [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
    ];

    foreach ($sections as $section) {
        if (empty($section)) continue;

        $propertyParts = explode('-is-', $section, 2);
        if (count($propertyParts) < 2) continue;

        $propertyCode = strtoupper($propertyParts[0]);
        $values = explode('-or-', $propertyParts[1]);

        $processedValues = [];
        foreach ($values as $value) {
            $dbEnum = CIBlockPropertyEnum::GetList(
                [],
                [
                    "XML_ID" => str_replace('-', ' ', $value),
                ]
            );

            if ($arEnum = $dbEnum->Fetch()) {
                $processedValues[] = $arEnum['VALUE'];
            }
        }

        $filter["PROPERTY_{$propertyCode}_VALUE"] = count($processedValues) > 1
            ? $processedValues
            : $processedValues[0];
    }

    return $filter;
}

$arTags = [];

foreach ($arItems as $iKey => $arItem) {
    $filter = parseFilterFromUrl($arItem['FILTER_SMART_VALUE'], 1);

    $count = CIBlockElement::GetList(
        [],
        $filter,
        [],
        false,
        ["ID"]
    );

    $parts = explode('/', trim($arItem['FILTER_SMART_VALUE'], '/'));
    $result = '/' . $parts[0] . '/';

    $arItems[$iKey]['ELEMENT_CNT'] = $count;
    $arItems[$iKey]['SECTION_PAGE_URL'] = $result . $arItem['CODE'] . '/';

    $arTags[$arTagsGroupName[$arItem['GROUP_VALUE'] ?: 591]][] = $arItems[$iKey];
}
?>

    <div class="like_h2">Сети пансионатов</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "4",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Сети пансионатов'],
],
    false
); ?>

    <div class="like_h2">Районы</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "3",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Районы'],
],
    false
); ?>


    <div class="like_h2">Болезни</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "2",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Болезни'],
],
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

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "97",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Состояние'],
],
    false
); ?>

    <div class="like_h2">Расположение</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "245",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Расположение'],
],
    false
); ?>

    <div class="like_h2">Особенности</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "249",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Особенности'],
],
    false
); ?>

    <div class="like_h2">Шоссе</div>

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "258",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Шоссе'],
],
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

<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_sections", [
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
    "SECTION_FIELDS" => [    // Поля разделов
        0 => "",
        1 => "",
    ],
    "SECTION_ID" => "159",    // ID раздела
    "SECTION_URL" => "",    // URL, ведущий на страницу с содержимым раздела
    "SECTION_USER_FIELDS" => [    // Свойства разделов
        0 => "",
        1 => "",
    ],
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "2",    // Максимальная отображаемая глубина разделов
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "main_menu",
    'TAG' => $arTags['Города'],
],
    false
); ?>

<?php if (!empty($arTags['Другое'])) { ?>
    <div class="like_h2">Другое</div>

    <?php
    $rowIDX = 0;
    foreach ($arTags['Другое'] as $item) {
        $arTags['Другое']['GRID'][$rowIDX][] = $item;
        $rowIDX++;
        if ($rowIDX > 3) {
            $rowIDX = 0;
        }
    }
    ?>
    <div class="main-section__wrapper">
        <? foreach ($arTags['Другое']['GRID'] as $gridRow): ?>
            <div class="main-section">
                <? foreach ($gridRow as $item): ?>
                    <a class="main-section__link" href="<?= $item['SECTION_PAGE_URL'] ?>"><?= $item['NAME'] ?>
                        <span class="cnt"><?= $item['ELEMENT_CNT'] ?></span></a>
                <? endforeach; ?>
            </div>
        <? endforeach; ?>
    </div>

    <?php
}
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>