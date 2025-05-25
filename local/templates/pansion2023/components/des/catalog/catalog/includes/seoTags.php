<?php

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Iblock\Elements\ElementTagsTable;
use Bitrix\Iblock\InheritedProperty\ElementValues;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */


$arTagVals = [];

if(!empty($arResult["VARIABLES"]["SMART_FILTER_PATH"]) && !empty($arResult["VARIABLES"]["SECTION_CODE"])){
    $section = \CIBlockSection::GetList(
        [],
        [
            '=CODE' => $arResult["VARIABLES"]["SECTION_CODE"],
            '=IBLOCK_ID' => $arParams["IBLOCK_ID"]
        ],
        false,
        ['ID','CODE',"NAME"],
        ['nTopCount' => 1]
    )->Fetch();

    if (!empty($section['ID'])) {
        $sectionId = $section['ID'];

        $arTag = ElementTagsTable::getList([
            'select' => [
                'ID', 'CODE', 'NAME', 'TEXT_BEFORE_'=>'TEXT_BEFORE',
                'TEXT_AFTER_'=>'TEXT_AFTER',
                'TITLE_'=>'TITLE',
                'DESCR_'=>'DESCR',
                'FILTER_SMART_' => 'FILTER_SMART',
                'FILTER_URL_PAGE_' => 'FILTER_URL_PAGE',
                'SECTION_' => 'SECTION',
                'CANONICAL_' => 'CANONICAL',
                'NOINDEX_' => 'NOINDEX',
                'SINONIM_' => 'SINONIM'
            ],
            'filter' => ['ACTIVE' => 'Y', 'CODE' => $arResult["VARIABLES"]["SMART_FILTER_PATH"], "SECTION_VALUE" => $sectionId],
        ])->fetch();

        if (!empty($arTag)) {
            $seoFromElement = new ElementValues(9, $arTag["ID"]);
            $pageProperties = $seoFromElement->getValues();

            if (!empty($arResult["VARIABLES"]["SMART_FILTER_PATH"])) {
                $arResult["VARIABLES"]["SMART_FILTER_PATH"] = $arTag['FILTER_SMART_VALUE'];
                $arTagVals['TEXT_AFTER'] = unserialize($arTag['TEXT_AFTER_VALUE']);
                $arTagVals['TEXT_BEFORE'] = unserialize($arTag['TEXT_BEFORE_VALUE']);
                $arTagVals['TITLE'] = $arTag['TITLE_VALUE'];
                $arTagVals['DESCR'] = $arTag['DESCR_VALUE'];
                $arTagVals['NAME'] = $arTag['NAME'];
                $arTagVals['CANONICAL'] = $arTag['CANONICAL_VALUE'];
                $arTagVals['NOINDEX'] = $arTag['NOINDEX_VALUE'];
            }

            if(!empty($pageProperties['ELEMENT_META_TITLE']) && empty($arTagVals['TITLE'])){
                $arTagVals['TITLE'] = $pageProperties['ELEMENT_META_TITLE'];
            }
            if(!empty($pageProperties['ELEMENT_META_DESCRIPTION']) && empty($arTagVals['DESCR'])){
                $arTagVals['DESCR'] = $pageProperties['ELEMENT_META_DESCRIPTION'];
            }

        }
    }
}

if($arParams['PARAM_SEO_TAG'] && empty($arTag)){
    \Bitrix\Iblock\Component\Tools::process404(
        ""
        ,($arParams["SET_STATUS_404"] === "Y")
        ,($arParams["SET_STATUS_404"] === "Y")
        ,($arParams["SHOW_404"] === "Y")
        ,$arParams["FILE_404"]
    );
}

