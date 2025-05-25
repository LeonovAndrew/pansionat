<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->SetPageProperty("title", "Отзывы о ". $arResult['NAME']);
$APPLICATION->SetPageProperty("description", "Отзывы о ". $arResult['NAME']);
$APPLICATION->SetPageProperty("keywords", "Отзывы о ". $arResult['NAME']);

if ($arResult['META_TITLE'] != '') {
    $APPLICATION->SetPageProperty("meta_title", $arResult['META_TITLE']);
} else {
    $APPLICATION->SetPageProperty("meta_title", $arResult['NAME'] . " - адрес, цены на размещение, отзывы. Сеть пансионатов " . $arResult['SETI']);
}

if ($arResult['META_ROBOTS'] != '') {
    $APPLICATION->SetPageProperty("robots", $arResult['META_ROBOTS']);
}