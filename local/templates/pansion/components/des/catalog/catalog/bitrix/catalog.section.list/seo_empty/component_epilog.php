<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if (intval($arResult['SECTIONS_CNT']) > 0)
    $APPLICATION->SetPageProperty("HIDE_ELEMENTS", 'Y');

if ($arResult['META_TITLE'] != '') {
    $APPLICATION->SetPageProperty("meta_title", $arResult['META_TITLE']);
} else {
    $APPLICATION->SetPageProperty("meta_title", $arResult['NAME']);
}

if ($arResult['META_ROBOTS'] != '') {
    $APPLICATION->SetPageProperty("robots", $arResult['META_ROBOTS']);
}


