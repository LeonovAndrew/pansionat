<?php
/**
 * Created by PhpStorm.
 * User: Desperado
 * Date: 25.09.2019
 * Time: 18:31
 */

if (!empty($arParams['TAG'])) {
    $arResult['SECTIONS'] = array_merge($arResult['SECTIONS'], $arParams['TAG']);
}

$rowIDX = 0;
foreach ($arResult['SECTIONS'] as $item) {
    $arResult['GRID'][$rowIDX][] = $item;
    $rowIDX++;
    if ($rowIDX > 3) {
        $rowIDX = 0;
    }
}
