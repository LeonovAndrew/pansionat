<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['CHECKED'] = false;
/*pr($arResult["ITEMS"]);
die();*/
$sectionUrl=$arResult['SEF_DEL_FILTER_URL'];

$res = CIBlockSection::GetByID($arParams["SECTION_ID"]);
if($ar_res = $res->GetNext()){
    $sectionUrl=$ar_res["SECTION_PAGE_URL"];
}
$arResult["SECTION_URL"]=$sectionUrl;
foreach( $arResult["ITEMS"] as $key=>$arItem ) {
    foreach($arItem["VALUES"] as $val => $ar) {
        if ( $ar["CHECKED"] ) {
            $arResult['CHECKED'] = true;
            //break;
        }
        if($arItem["DISPLAY_TYPE"]=="A" && $arItem["VALUES"]["MIN"]["HTML_VALUE"]){

            $arResult['CHECKED'] = true;
        }
    }
}

foreach($arResult["ITEMS"] as $key => $arItem) {
    $matches = [];
    $returnResult = preg_match('/\[(.*)\]/', $arItem['NAME'], $matches);

    if (count($matches) > 1) {
        $arItem['NAME'] = CClass::getNormalNameProp($arItem['NAME']);
        $arItem['PROPERTY_GROUP'] = $matches[1];
        $arPropertyGroups[$matches[1]][] = $arItem;
        unset($arResult["ITEMS"][$key]);
    }

    unset($matches);
    unset($returnResult);
}

$arResult["PROPERTY_GROUPS"] = $arPropertyGroups;

$arResult["IS_ORDERED_PARAMS"] = "N";

if (isset($arParams["SECTION_ID"]) && isset($arParams["FILTER_SECTION_PROPERTIES_ORDER"]) &&
    isset($arParams["FILTER_SECTION_PROPERTIES_ORDER"][$arParams["SECTION_ID"]]) && is_array($arParams["FILTER_SECTION_PROPERTIES_ORDER"][$arParams["SECTION_ID"]]))
{
    $arSectionPropertiesOrder = $arParams["FILTER_SECTION_PROPERTIES_ORDER"][$arParams["SECTION_ID"]];
    $arOrderedItems = Array();

    foreach ($arSectionPropertiesOrder as $code)
    {
        $arOrderedItems[$code] = Array();
    }

    foreach ($arResult["ITEMS"] as $key => $arItem)
    {
        $code = $arItem["CODE"];

        if (in_array($code, $arSectionPropertiesOrder))
        {
            $arOrderedItems[$code] = $arItem;
            unset($arResult["ITEMS"][$key]);
        }
    }

    foreach ($arOrderedItems as $code => $arItem)
    {
        if (empty($arItem))
            unset($arOrderedItems[$key]);
    }

    if (!empty($arOrderedItems))
    {
        $arResult["ORDERED_ITEMS"] = Array();

        foreach ($arOrderedItems as $arItem)
            $arResult["ORDERED_ITEMS"][$arItem["ID"]] = $arItem;
    }

    if (!empty($arResult["ORDERED_ITEMS"]))
        $arResult["IS_ORDERED_PARAMS"] = "Y";

    unset($arSectionPropertiesOrder, $arOrderedItems, $key, $arItem, $code);
}

//Бренды монобрендов
$monobrendId=\Bitrix\Main\Config\Option::get("grain.customsettings","brand_id");
if(!empty($monobrendId) && $monobrendId != ""){
    $bransd=array();
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>SERIES_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","=PROPERTY_BRAND"=>$monobrendId);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $bransd[]=$arFields["ID"];
    }
    foreach ($arResult["ITEMS"] as $key => $arItem){
        if($arItem["CODE"] == "SERIES"){
            foreach ($arItem["VALUES"] as $keys=>$seria){
                if(!in_array($keys,$bransd)){
                    unset($arResult["ITEMS"][$key]["VALUES"][$keys]);
                }
            }
        }

    }
}
?>