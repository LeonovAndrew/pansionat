<?php
if ($arResult['META_TITLE'] != '') {
    $APPLICATION->SetPageProperty("meta_title", $arResult['META_TITLE']);
} else {
    $APPLICATION->SetPageProperty("meta_title", $arResult['NAME']);
}

if ($arResult['META_ROBOTS'] != '') {
    $APPLICATION->SetPageProperty("robots", $arResult['META_ROBOTS']);
}