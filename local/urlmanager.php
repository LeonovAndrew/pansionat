<?
GLOBAL $APPLICATION;
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
if (!CModule::IncludeModule("iblock")) return;

$tArr = parse_url($_SERVER['REQUEST_URI']);
$code = str_replace('/', '', $tArr['path']);
GLOBAL $news_id;

$find = false;
$arSelect = Array("ID", "CODE");
$arFilter = Array("IBLOCK_ID" => 3, "ACTIVE" => "Y", "CODE" => $code);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
while ($ob = $res->fetch()) {
    $find = true;
    $news_id = $ob['ID'];
}


if ($find) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/news/newsdetail.php');
} else {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/index.php');
}