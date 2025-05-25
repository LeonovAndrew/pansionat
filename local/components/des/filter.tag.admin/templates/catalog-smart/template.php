
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$clearFilterPath = preg_replace('/(filter.+)/', '', $arResult['SEF_DEL_FILTER_URL']);

/** @var $arResult array */

$isShowFilter = false;
$isActiveFilter = false;

CJSCore::Init(array("jquery"));
$params = array();
if(!empty($arParams["FILTER"])){
    parse_str($arParams["FILTER"], $params);
}

foreach ($arResult['ITEMS'] as $key => $arItem) {
    if (!empty($arItem['VALUES']) && $arItem['ID'] != 1) $isShowFilter = true;

    foreach ($arItem['VALUES'] as $valKey => $value) {

        if(array_key_exists($value["CONTROL_ID"], $params )){
            $value['CHECKED']=1;
            $arResult['ITEMS'][$key]['VALUES'][$valKey]['CHECKED']=1;
            $arResult['ITEMS'][$key]["ACTIVE"]="Y";

        }
        if ($value['CHECKED'] == 1) $isActiveFilter = true;
    }
}
$arPricesProperties = [];
foreach ($arResult["ITEMS"] as $key => $arItem) {
    if (
        $arItem["CODE"] == 'DISCOUNTED_PRICE_BASE' ||
        $arItem["CODE"] == 'DISCOUNTED_PRICE_AUTHORIZE_BASE' ||
        $arItem["CODE"] == 'DISCOUNTED_PRICE_SPB' ||
        $arItem["CODE"] == 'DISCOUNTED_PRICE_AUTHORIZE_SPB'
    ) {
        $arPricesProperties[] = $arItem;
        unset($arResult["ITEMS"][$key]);
    }
}

?>
<form id="form-filter" class="ddd">
    <?php if ($isShowFilter) : ?>
        <?php
        /**************************/
        global $USER;
        $checkSMS = false;
        if ($USER->IsAuthorized()) {
            $checkSMS = in_array(2, $USER->GetUserGroupArray());
        }
        $priceType = array_keys($arResult["PRICES"]);

        foreach ($arPricesProperties as $key => $arItem):

            if (in_array("BASE", $priceType) || in_array("EKB", $priceType) || in_array("KRAS", $priceType)) {
                if ($checkSMS && $arItem["CODE"] != 'DISCOUNTED_PRICE_AUTHORIZE_BASE') {
                    continue;
                } else if (!$checkSMS && $arItem["CODE"] != 'DISCOUNTED_PRICE_BASE') {
                    continue;
                }
            } else if (in_array("SPB", $priceType)) {
                if ($checkSMS && $arItem["CODE"] != 'DISCOUNTED_PRICE_AUTHORIZE_SPB') {
                    continue;
                } else if (!$checkSMS && $arItem["CODE"] != 'DISCOUNTED_PRICE_SPB') {
                    continue;
                }
            } else {
                continue;
            }
            if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) {
                continue;
            }
            $arItem["DISPLAY_EXPANDED"] = 'Y';
            $arItem["VALUES"]["MIN"]["VALUE"] = (int)$arItem["VALUES"]["MIN"]["VALUE"];
            $arItem["VALUES"]["MAX"]["VALUE"] = (int)$arItem["VALUES"]["MAX"]["VALUE"];
            if (isset($arChecked[$arItem["ID"]])) {
                continue;
            }
            $arChecked[$arItem["ID"]] = $arItem["ID"];
            //include 'price.php';

        endforeach;
        /*************************************************/

        foreach ($arResult['ITEMS'] as $arItem) {
            if ($arItem['DISPLAY_TYPE'] == 'F') {
                include 'check.php';
            } else if ($arItem['DISPLAY_TYPE'] == 'K') {
                //include 'radio.php';
            } else if ($arItem['DISPLAY_TYPE'] == 'A') {
                //include 'slider.php';
            }
        }
        ?>
    <?php endif; ?>
</form>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        window.filter = new window.SmartFilter("<?php echo $APPLICATION->GetCurPageParam(); ?>");
    });
</script>
