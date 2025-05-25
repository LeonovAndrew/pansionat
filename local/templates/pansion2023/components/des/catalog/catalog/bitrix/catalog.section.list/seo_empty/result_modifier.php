<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$cp = $this->__component; // объект компонента

$arResult['META_TITLE'] = $arResult['SECTION']['UF_META_TITLE'];
$arResult['META_ROBOTS'] = $arResult['SECTION']['UF_META_ROBOTS'];
$arResult['NAME'] = $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_META_TITLE'];

if (is_object($cp))
{
    $cp->arResult['SECTIONS_CNT'] = count($arResult['SECTIONS']);
    $arResult['SECTIONS_CNT'] = $cp->arResult['SECTIONS_CNT'];
    $cp->SetResultCacheKeys(array('META_TITLE', 'META_ROBOTS', 'DESCRIPTION','SECTIONS_CNT','NAME'));
}


