<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подбор пансионата по параметрам");
?>
<?php

foreach ($_REQUEST as $key => $item) {
    if (is_array($item)) {
        foreach ($item as $i_key => $i_val) {
            $post[$key][$i_key] = htmlspecialcharsbx($i_val);
        }
    } else {
        $post[$key] = htmlspecialcharsbx($item);
    }
}

GLOBAL $arrFilter;

if (!empty($post['section_id'])) {
    $arrFilter['SECTION_ID'] = intval($post['section_id']);
}

if (!empty($post['rasp'])) {
    $arrFilter['PROPERTY_RAIONY'] = intval($post['rasp']);
}

if (!empty($post['fizsost'])) {
    $arrFilter['PROPERTY_FIZICHESKOE_SOSTOYANIE'] = intval($post['fizsost']);
}

if (!empty($post['zabol'])) {
    $arrFilter['PROPERTY_DLYZ_BOLNYH'] = intval($post['zabol']);
}

if (!empty($post['psihsost'])) {
    $arrFilter['PROPERTY_PSIHOLOGICHESKOE_SOSTOYANIE'] = intval($post['psihsost']);
}

if (!empty($post['napr'])) {
    if (is_array($post['napr'])) {
        $tmp = array('LOGIC'=> "OR");
        foreach ($post['napr'] as $item) {
            $tmp[] = array('PROPERTY_NAPRAVLENIYA' => $item);
        }
        $arrFilter[] = $tmp;
    } else {
        $arrFilter['PROPERTY_NAPRAVLENIYA'] = $post['napr'];
    }
}

if (!empty($post['medob'])) {
    if (is_array($post['medob'])) {
        $tmp = array('LOGIC'=> "OR");
        foreach ($post['medob'] as $item) {
            $tmp[] = array('PROPERTY_MEDICINSKOE_OBSLUZHIVANIE' => $item);
        }
        $arrFilter[] = $tmp;
    } else {
        $arrFilter['PROPERTY_MEDICINSKOE_OBSLUZHIVANIE'] = $post['medob'];
    }
}

if (!empty($post['rating'])) {
    if (is_array($post['rating'])) {
        $tmp = array('LOGIC'=> "OR");
        foreach ($post['rating'] as $item) {
            $tmp[] = array('PROPERTY_RATING' => $item);
        }
        $arrFilter[] = $tmp;
    } else {
        $arrFilter['PROPERTY_RATING'] = $post['rating'];
    }
}

?>

<? $APPLICATION->IncludeComponent(
    "des:main_form",
    "",
    Array()
); ?>

<? $APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "BACKGROUND_IMAGE" => "-",
        "BASKET_URL" => "/personal/basket.php",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_COMPARE" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "STRICT",
        "FILTER_NAME" => "arrFilter",
        "IBLOCK_ID" => 1,
        "IBLOCK_TYPE" => "pansionat",
        "INCLUDE_SUBSECTIONS" => "Y",
        "LABEL_PROP" => array(),
        "LAZY_LOAD" => "N",
        "LINE_ELEMENT_COUNT" => "3",
        "LOAD_ON_SCROLL" => "N",
        "MESSAGE_404" => "",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "OFFERS_LIMIT" => "5",
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
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
        "PROPERTY_CODE_MOBILE" => array(),
        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
        "RCM_TYPE" => "personal",
        "SECTION_CODE" => "",
        "SECTION_ID" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array("", ""),
        "SEF_MODE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SHOW_ALL_WO_SECTION" => "Y",
        "SHOW_FROM_SECTION" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "N",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N"
    )
); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>