<?php
$cp = $this->__component;

$arResult['META_TITLE'] = $arResult['PROPERTIES']['META_TITLE']['VALUE'];
$arResult['META_ROBOTS'] = $arResult['PROPERTIES']['META_ROBOTS']['VALUE'];

if (is_object($cp)) {
    $cp->SetResultCacheKeys(array('META_TITLE', 'META_ROBOTS', 'DESCRIPTION'));
}

