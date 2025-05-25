<?php

namespace DesperadoHelpers;

use Bitrix\Iblock;


function generateYML()
{
    if (!\CModule::IncludeModule("iblock")) return;

    $ret = '<yml_catalog date="' . date("Y-m-d H:i") . '">' . PHP_EOL;
    $ret .= '<shop>' . PHP_EOL;
    $ret .= '<name>pansionat.pro</name>' . PHP_EOL;
    $ret .= '<company>pansionat.pro</company>' . PHP_EOL;
    $ret .= '<url>https://pansionat.pro</url>' . PHP_EOL;
    $ret .= '<platform>1C-Bitrix</platform>' . PHP_EOL;
    $ret .= '<currencies>' . PHP_EOL;
    $ret .= '<currency id="RUB" rate="1"/>' . PHP_EOL;
    $ret .= '</currencies>' . PHP_EOL;
    $ret .= '<categories>' . PHP_EOL;


    $arFilter = array('IBLOCK_ID' => 1, 'SECTION_ID' => 1);
    $rsSections = \CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
    while ($arSction = $rsSections->Fetch()) {
        if ($arSction['ID'] == 7) continue;
        $ret .= '<category id="' . $arSction['ID'] . '">' . $arSction['NAME'] . '</category>' . PHP_EOL;
    }

    $ret .= '</categories>' . PHP_EOL;
    $ret .= '<offers>' . PHP_EOL;

    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL", "PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID" => 1, "ACTIVE" => "Y");
    $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 20000), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();

        $ret .= '<offer id="' . $arFields['ID'] . '" available="true">' . PHP_EOL;
        $ret .= '<url>https://pansionat.pro' . $arFields['DETAIL_PAGE_URL'] . '</url>' . PHP_EOL;
        if (!empty($arProps['OLD_PRICE']['VALUE']) && $arProps['OLD_PRICE']['VALUE'] > $arProps['PRICE']['VALUE']) {
            $ret .= '<oldprice>' . $arProps['OLD_PRICE']['VALUE'] . '</oldprice>' . PHP_EOL;
        }
        $ret .= '<price>' . intval($arProps['PRICE']['VALUE']) . '</price>' . PHP_EOL;
        $ret .= '<currencyId>RUB</currencyId>' . PHP_EOL;
        $ret .= '<categoryId>' . \DesperadoHelpers\AppHelper::getPansiontTypeID($arFields['ID']) . '</categoryId>' . PHP_EOL;
        $ret .= '<picture>https://pansionat.pro' . \CFile::GetPath($arFields['PREVIEW_PICTURE']) . '</picture>' . PHP_EOL;
        $ret .= '<name>' . $arFields['NAME'] . '</name>' . PHP_EOL;
        if (!empty($arFields['PREVIEW_TEXT'])) {
            $ret .= '<description>' . htmlspecialchars(strip_tags($arFields['PREVIEW_TEXT'])) . '</description>' . PHP_EOL;
        } else {
            $ret .= '<description>' . $arFields['NAME'] . ' ' . $arProps['ADRESS']['VALUE'] . '</description>' . PHP_EOL;
        }
//        $ret .= '<sales_notes>Оплата: наличные, кредит, б/н расчет для юр.лиц.</sales_notes>' . PHP_EOL;
        $ret .= '<country_of_origin>Россия</country_of_origin>' . PHP_EOL;
//        $ret .= '<manufacturer_warranty>true</manufacturer_warranty>' . PHP_EOL;
        $ret .= '</offer>' . PHP_EOL;

//        print_r($arFields);
//        print_r($arProps);
    }

    $ret .= '</offers>' . PHP_EOL;
    $ret .= '</shop>' . PHP_EOL;
    $ret .= '</yml_catalog>' . PHP_EOL;

//    var_dump($ret);

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/upload/pans.xml', $ret);
}