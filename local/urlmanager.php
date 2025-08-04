<?
global $APPLICATION;
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
if (!CModule::IncludeModule("iblock")) return;

$tArr = parse_url($_SERVER['REQUEST_URI']);
$code = str_replace(['/blog/', '/'], '', $tArr['path']);
global $news_id;

$find = false;
$arSelect = ["ID", "CODE"];
$arFilter = ["IBLOCK_ID" => 3, "ACTIVE" => "Y", "CODE" => $code];
$res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 50], $arSelect);

while ($ob = $res->fetch()) {
    $find = true;
    $news_id = $ob['ID'];
}

if ($find) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/blog/newsdetail.php');
} else {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/index.php');
}