<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
global $APPLICATION;
$APPLICATION->RestartBuffer();
unset($arResult["COMBO"]);

$curPage=$APPLICATION->GetCurPage();
$curPageParam=$APPLICATION->GetCurPageParam();

$curSectionUrl=$curPage;


if(!empty($arParams["SECTION_ID"])){
    $resObSect = CIBlockSection::GetByID($arParams["SECTION_ID"]);
    if($arResCurSec = $resObSect->GetNext()){
        $curSectionUrl=$arResCurSec["SECTION_PAGE_URL"];
    }
}


if(strpos($arResult['SEF_DEL_FILTER_URL'], "/clear/") !== false){
    $curPage=$curSectionUrl;
}
$sec_url = str_replace('/clear/', '/', $arResult['SEF_DEL_FILTER_URL']);
$FILTER_URL = str_replace($sec_url, '/', $arResult['FILTER_URL']);

$arr = explode('/', $FILTER_URL);

$count = count($arr) - 1;
unset($arr[0]);
unset($arr[$count]);


$FILTER_URL = implode('%2F', $arr);

$arResult['FILTER_URL'] = '?filter='.$FILTER_URL;

if($FILTER_URL=="clear"){
    $arResult['FILTER_URL']="";
}
if (isset($_GET['sort'])){
    $arResult['FILTER_URL'] .= '&sort='.$_GET['sort'];
}
if (isset($_GET['order'])){
    $arResult['FILTER_URL'] .= '&order='.$_GET['order'];
}



$arResult['FILTER_URL'] = customFixUri($arResult['FILTER_URL'], true);
$arResult['FILTER_AJAX_URL'] = customFixUri($arResult['FILTER_AJAX_URL'], true);
$arResult['SEF_SET_FILTER_URL'] = customFixUri($arResult['SEF_SET_FILTER_URL'], true);

$arFilterUrl=$arResult['SEF_SET_FILTER_URL'];
$arFilterUrl=substr($arFilterUrl,1,-1);
$arFilterUrl = explode("/", $arFilterUrl);

$seria=array();

$seria["empty"]=false;


/*if(strpos($arResult['FILTER_URL'], "%2F") === false){

    foreach ($arFilterUrl as $filterItems){
        if (strpos($filterItems,"-or-")=== false) {
            $arFilterSeo = Array('IBLOCK_ID' => SEO_FILTER_IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y',"UF_FILTER_URL_PAGE"=>$filterItems);
            $db_list = CIBlockSection::GetList(Array("DEPTH_LEVEL"=>"DESC"), $arFilterSeo, false,Array('UF_FILTER_FOR_SEC'));
            if($ar_result = $db_list->GetNext()){
                $res = CIBlockSection::GetByID($ar_result["UF_FILTER_FOR_SEC"]);
                if($ar_res = $res->GetNext()){
                    if($curPage==$ar_res["SECTION_PAGE_URL"]){
                        //pr($ar_res);
                        $arResult['FILTER_URL']=$ar_result["CODE"]."/";
                    }
                }
            }
        }
    }
}*/
$brandIblockID=getIblockId("vendors");
if(!empty($brandIblockID)){
    if(strpos($arResult['FILTER_URL'], "%2F") !== false || strpos($arResult['FILTER_URL'], "or") !== false){

        foreach ($arFilterUrl as $filterItems){
            $arFilterSeo = Array('IBLOCK_ID' => $brandIblockID, 'GLOBAL_ACTIVE'=>'Y',"CODE"=>$filterItems);
            $db_list = CIBlockSection::GetList(Array("DEPTH_LEVEL"=>"DESC"), $arFilterSeo, false,Array('UF_FILTER_FOR_SEC'));
            if($ar_result = $db_list->GetNext()){
                $res = CIBlockSection::GetByID($ar_result["UF_FILTER_FOR_SEC"]);
                if($ar_res = $res->GetNext()){
                    if($curPage==$ar_res["SECTION_PAGE_URL"].$ar_result["CODE"]."/"){
                        //pr($ar_res);
                        //$arResult['FILTER_URL']=$ar_result["CODE"]."/";
                        $curPage=str_replace($ar_result["CODE"]."/","", $curPage);
                    }
                }
            }
        }
    }
}

if(strpos($arResult['FILTER_URL'], "%2F") === false){

    foreach ($arFilterUrl as $filterItems){
        //pr($filterItems,1);
        if (strpos($filterItems,"series-is-") !== false && strpos($filterItems,"-or-")=== false) {
            $seria["empty"]=true;
            $seria["item"]=$filterItems;
            $seria["name"]=str_replace("series-is-", "", $filterItems);
        }
    }
}

if($seria["empty"]){

    /*$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM");
    $arFilter = Array("IBLOCK_ID"=>SERIES_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_POPULAR"=>"Y", "CODE"=>$seria["name"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
    if($ob = $res->GetNextElement())
    {
        $arResult['FILTER_URL']=$seria["name"]."/";
    }*/
    $arResult['FILTER_URL']=$seria["name"]."/";


}
$countSeria=0;
$seriaChek=array();
foreach ($arResult["ITEMS"] as $items){
    if($items["CODE"]!="SERIES") continue;
    foreach ($items["VALUES"] as $VALUE){
        if($VALUE["CHECKED"]){
            $countSeria++;
            $seriaChek[]=$VALUE["URL_ID"];
        }
    }
}

if( $countSeria>=2){
    foreach ($seriaChek as $seriaItem){
        $curPage=str_replace($seriaItem."/","", $curPage);
    }
}
if(strpos($arResult['FILTER_URL'], "%2F") !== false || strpos($arResult['FILTER_URL'], "or") !== false){
    foreach ($arResult["ITEMS"] as $items){
        if($items["CODE"]!="SERIES") continue;
        foreach ($items["VALUES"] as $VALUE){
            $curPage=str_replace($VALUE["URL_ID"]."/","", $curPage);
        }
    }
}


if(!$countSeria){
    foreach ($arResult["ITEMS"] as $items){
        if($items["CODE"]!="SERIES") continue;
        foreach ($items["VALUES"] as $VALUE){
            $curPage=str_replace($VALUE["URL_ID"]."/","", $curPage);
        }
    }
}

$arResult['URL']=$curPage;
$arResult['FORM_ACTION']=$curPage;
echo Bitrix\Main\Web\Json::encode($arResult);
?>