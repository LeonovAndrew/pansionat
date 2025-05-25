<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->RestartBuffer();
unset($arResult["COMBO"]);
//echo CUtil::PHPToJSObject($arResult, true);


$curSection = str_replace("clear/", "", $arResult['SEF_DEL_FILTER_URL']) ;


if(!empty($arResult['FILTER_URL']) && strpos($arResult['FILTER_URL'], "filter/") === false){
    $arResult['FILTER_URL'] = str_replace($curSection, $curSection."filter/", $arResult['FILTER_URL']);
}
if(!empty($arResult['SEF_SET_FILTER_URL']) && strpos($arResult['SEF_SET_FILTER_URL'],"filter/") === false){
    $arResult['SEF_SET_FILTER_URL'] = str_replace($curSection, $curSection."filter/", $arResult['SEF_SET_FILTER_URL']);
}
if(!empty($arResult['FILTER_AJAX_URL']) && strpos($arResult['FILTER_AJAX_URL'], "filter/") === false){
    $arResult['FILTER_AJAX_URL'] = str_replace($curSection, $curSection."filter/", $arResult['FILTER_AJAX_URL']);
}


echo Bitrix\Main\Web\Json::encode($arResult);
?>