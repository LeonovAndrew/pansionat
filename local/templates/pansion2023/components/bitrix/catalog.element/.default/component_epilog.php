<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;

$APPLICATION->SetPageProperty("title", $arResult['NAME'] . " - адрес, цены на размещение, отзывы. Сеть пансионатов " . $arResult['SETI']);
$APPLICATION->SetPageProperty("description", $arResult['NAME'] . " условия бронирования и цены, подробный адрес на карте, отзывы о пансионате сети " . $arResult['SETI'] . '. Скидки при онлайн бронировании на длительное проживание.');
$APPLICATION->SetPageProperty("keywords", $arResult['NAME'] . " адрес, цены на размещение, отзывы, Сеть пансионатов " . $arResult['SETI']);

if ($arResult['META_TITLE'] != '') {
    $APPLICATION->SetPageProperty("meta_title", $arResult['META_TITLE']);
} else {
    $APPLICATION->SetPageProperty("meta_title", $arResult['NAME'] . " - адрес, цены на размещение, отзывы. Сеть пансионатов " . $arResult['SETI']);
}

if ($arResult['META_ROBOTS'] != '') {
    $APPLICATION->SetPageProperty("robots", $arResult['META_ROBOTS']);
}