<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Bitrix\Iblock\Elements\ElementTagsTable;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

$APPLICATION->SetPageProperty("title", "Пансионаты для пожилых - цены, фото, отзывы в Москве и Подмосковье. 400 пансионатов в Pansionat.pro");
$APPLICATION->SetPageProperty("meta_title", "Пансионаты для пожилых - цены, фото, отзывы в Москве и Подмосковье. 400 пансионатов в Pansionat.pro");
$APPLICATION->SetPageProperty("description", "400 пансионатов для пожилых в Pansionat.pro в Москве и Подмосковье. Адреса, телефоны и цены на размещение в пансионаты для пожилых людей.");
$APPLICATION->SetPageProperty("keywords", "пансионаты для пожилых людей пансионат дом престарелых Москва Подмосковья частные социальные реабилитация каталог цены отзывы фото бронь");
$APPLICATION->SetTitle("Пансионаты для пожилых - цены, фото, отзывы в Москве и Подмосковье. 400 пансионатов в Pansionat.pro");
?>

<?php
$paramSeoTag = false;
$smartFilter = "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/";

$curPage = $APPLICATION ->GetCurPage();
$parts = explode('/', trim($curPage, '/'));

$tags = ElementTagsTable::getList([
    'select' => ['ID', 'CODE','NAME','FILTER_SMART_'=>'FILTER_SMART','FILTER_URL_PAGE_'=>'FILTER_URL_PAGE' ],
    'filter' => ['ACTIVE' => 'Y','CODE' => $parts[1]],
])->fetch();
if(!empty($tags)){
    $smartFilter = "#SECTION_CODE#/#SMART_FILTER_PATH#/";
    $paramSeoTag = true;
}

if(!empty($parts) && count($parts) > 3){
    $smartFilter = "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/";
}
?>

<? $APPLICATION->IncludeComponent(
    "des:catalog",
    "catalog",
    array(
        "ACTION_VARIABLE" => "action",
        "PARAM_SEO_TAG" => $paramSeoTag,
        "ADD_ELEMENT_CHAIN" => "Y",
        "ADD_PICT_PROP" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BASKET_URL" => "/personal/basket.php",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
        "DETAIL_BACKGROUND_IMAGE" => "-",
        "DETAIL_BRAND_USE" => "N",
        "DETAIL_BROWSER_TITLE" => "-",
        "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
        "DETAIL_DETAIL_PICTURE_MODE" => array(
            0 => "POPUP",
            1 => "MAGNIFIER",
        ),
        "DETAIL_DISPLAY_NAME" => "Y",
        "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
        "DETAIL_IMAGE_RESOLUTION" => "16by9",
        "DETAIL_META_DESCRIPTION" => "-",
        "DETAIL_META_KEYWORDS" => "-",
        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
        "DETAIL_SET_CANONICAL_URL" => "N",
        "DETAIL_SHOW_POPULAR" => "Y",
        "DETAIL_SHOW_SLIDER" => "N",
        "DETAIL_SHOW_VIEWED" => "Y",
        "DETAIL_STRICT_SECTION_CHECK" => "N",
        "DETAIL_USE_COMMENTS" => "N",
        "DETAIL_USE_VOTE_RATING" => "N",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_HIDE_ON_MOBILE" => "N",
        "FILTER_VIEW_MODE" => "VERTICAL",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "pansionat",
        "INCLUDE_SUBSECTIONS" => "Y",
        "INSTANT_RELOAD" => "N",
        "LABEL_PROP" => array(),
        "LAZY_LOAD" => "N",
        "LINE_ELEMENT_COUNT" => "3",
        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
        "LINK_IBLOCK_ID" => "",
        "LINK_IBLOCK_TYPE" => "",
        "LINK_PROPERTY_SID" => "",
        "LIST_BROWSER_TITLE" => "-",
        "LIST_ENLARGE_PRODUCT" => "STRICT",
        "LIST_META_DESCRIPTION" => "-",
        "LIST_META_KEYWORDS" => "-",
        "LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
        "LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "LIST_SHOW_SLIDER" => "Y",
        "LIST_SLIDER_INTERVAL" => "3000",
        "LIST_SLIDER_PROGRESS" => "N",
        "LOAD_ON_SCROLL" => "N",
        "MESSAGE_404" => "",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнение",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "round",
        "PAGER_TITLE" => "Товары",
        "PAGE_ELEMENT_COUNT" => "12",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "SEARCH_CHECK_DATES" => "Y",
        "SEARCH_NO_WORD_LOGIC" => "Y",
        "SEARCH_PAGE_RESULT_COUNT" => "50",
        "SEARCH_RESTART" => "N",
        "SEARCH_USE_LANGUAGE_GUESS" => "Y",
        "SECTIONS_SHOW_PARENT_NAME" => "Y",
        "SECTIONS_VIEW_MODE" => "LIST",
        "SECTION_BACKGROUND_IMAGE" => "-",
        "SECTION_COUNT_ELEMENTS" => "Y",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_TOP_DEPTH" => "2",
        "SEF_FOLDER" => "/",
        "SEF_MODE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "Y",
        "SHOW_404" => "Y",
        "SHOW_DEACTIVATED" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_TOP_ELEMENTS" => "Y",
        "SIDEBAR_DETAIL_SHOW" => "N",
        "SIDEBAR_PATH" => "",
        "SIDEBAR_SECTION_SHOW" => "Y",
        "TEMPLATE_THEME" => "blue",
        "TOP_ELEMENT_COUNT" => "9",
        "TOP_ELEMENT_SORT_FIELD" => "sort",
        "TOP_ELEMENT_SORT_FIELD2" => "id",
        "TOP_ELEMENT_SORT_ORDER" => "asc",
        "TOP_ELEMENT_SORT_ORDER2" => "desc",
        "TOP_ENLARGE_PRODUCT" => "STRICT",
        "TOP_LINE_ELEMENT_COUNT" => "3",
        "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
        "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "TOP_SHOW_SLIDER" => "Y",
        "TOP_SLIDER_INTERVAL" => "3000",
        "TOP_SLIDER_PROGRESS" => "N",
        "TOP_VIEW_MODE" => "SECTION",
        "USER_CONSENT" => "N",
        "USER_CONSENT_ID" => "0",
        "USER_CONSENT_IS_CHECKED" => "Y",
        "USER_CONSENT_IS_LOADED" => "N",
        "USE_COMPARE" => "N",
        "USE_ELEMENT_COUNTER" => "Y",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "USE_FILTER" => "Y",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "USE_REVIEW" => "N",
        "USE_STORE" => "N",
        "COMPONENT_TEMPLATE" => "catalog",
        "LIST_PROPERTY_CODE_MOBILE" => array(),
        "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(),
        "FILTER_NAME" => "",
        "FILTER_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_PRICE_CODE" => array(),
        "FILE_404" => "",
        "SEF_URL_TEMPLATES" => array(
            "sections" => "",
            "section" => "#SECTION_CODE#/",
            "element" => "pansionat-#ELEMENT_CODE#/",
            "compare" => "compare.php?action=#ACTION_CODE#",
            "smart_filter" => $smartFilter,
        ),
        "VARIABLE_ALIASES" => array(
            "compare" => array(
                "ACTION_CODE" => "action",
            ),
        )
    ),
    false
); ?>

<? if (CSite::InDir('/index.php')): ?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Pansionat.pro – справочник по подбору пансионатов для пожилых",
            "url": "https://pansionat.pro/",
            "logo": "https://pansionat.pro/local/templates/pansion/img/house-with-hands-yellow.svg",
            "email": "info@pansionat.pro",
            "telephone": "+7 (495) 181-43-93",
            "address": {
                "@type": "PostalAddress",
                "name": "Россия, Москва"
            }
        }
    </script>
<? endif; ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>