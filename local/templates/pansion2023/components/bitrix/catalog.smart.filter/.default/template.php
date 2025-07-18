<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


///
//// ITS MAGICK
///
global $arrFilter;
global $SelProps;

$seelctedPropsCount = count($arrFilter);

$SelProps = array();

foreach ($arrFilter as $name => $fitem) {

    if ($name == 'FACET_OPTIONS') continue;

    $propID = str_replace('=PROPERTY_', '', $name);

    foreach ($fitem as $vals) {
        $SelProps[$propID][] = $vals;
    }
}

//echo '<pre>';
//print_r($arResult);
//echo '</pre>';

$start = '';

$res = CIBlockSection::GetByID($arParams['SECTION_ID']);
if ($ar_res = $res->GetNext())
    $start = $ar_res['CODE'];

$cannonical = $start . '/';
foreach ($SelProps as $key => $val) {

    if (count($val) > 1) {

    } else {
        $qVal = $val[0];
    }

    $cannonical .= $arResult['ITEMS'][$key]['CODE'] . '-is-' . $arResult['ITEMS'][$key]['VALUES'][$qVal]['URL_ID'] . '/';
}


//$APPLICATION->AddHeadString('<link  href="https://pansionat.pro/' . strtolower($cannonical) . '" rel="canonical" />');

function generateUrl($code, $val, $arResult, $start)
{
    global $APPLICATION;
    global $SelProps;

    $newProps = $SelProps;

    $newProps[$code][] = $val;
    ksort($newProps);

    $start = '/' . $start . '/';

    foreach ($newProps as $key => $val) {
        if (count($val) > 1) {

        } else {
            $qVal = $val[0];
        }
//        var_dump($key);
//        var_dump($val[0]);
        $start .= $arResult['ITEMS'][$key]['CODE'] . '-is-' . $arResult['ITEMS'][$key]['VALUES'][$qVal]['URL_ID'] . '/';
    }
    return strtolower($start);
}

function showZvezd($i)
{
    switch ($i) {
        case '1':
            return '1 звезда';
            break;
        case '2':
            return '2 звезды';
            break;
        case '3':
            return '3 звезды';
            break;
        case '4':
            return '4 звезды';
            break;
        case '5':
            return '5 звезд';
            break;
    }
}

?>


<div class="catalog__show-mobile-filter js-show_mobile_filter">
    Показать фильтр
</div>

<div class="catalog__map-button __full __show-mobile js-show-on-map">
    <?php \DesperadoHelpers\AppHelper::showIcon('location'); ?> Показать объекты на карте
</div>


<div class="filter">

    <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>"
          method="get" class="simple">
        <? foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                   value="<? echo $arItem["HTML_VALUE"] ?>"/>
        <? endforeach; ?>

        <? foreach ($arResult["ITEMS"] as $key => $arItem)//prices
        {
            $key = $arItem["ENCODED_ID"];
            if (isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    continue;

                $step_num = 4;
                $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
                $prices = array();
                if (Bitrix\Main\Loader::includeModule("currency")) {
                    for ($i = 0; $i < $step_num; $i++) {
                        $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
                    }
                    $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
                } else {
                    $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                    for ($i = 0; $i < $step_num; $i++) {
                        $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $precision, ".", "");
                    }
                    $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                }
                ?>
                <div class="<?
                if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<? else: ?>col-lg-12<? endif ?> bx-filter-parameters-box bx-active">
                    <span class="bx-filter-container-modef"></span>
                    <div class="bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
                                <span><?= $arItem["NAME"] ?> <i data-role="prop_angle" class="fa fa-angle-<?
                                    if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>up<? else: ?>down<? endif ?>"></i></span>
                    </div>
                    <div class="bx-filter-block" data-role="bx_filter_block">
                        <div class="row bx-filter-parameters-box-container">
                            <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                                <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></i>
                                <div class="bx-filter-input-container">
                                    <input
                                            class="min-price"
                                            type="text"
                                            name="<?
                                            echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                            id="<?
                                            echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                            value="<?
                                            echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>
                            <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                                <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_TO") ?></i>
                                <div class="bx-filter-input-container">
                                    <input
                                            class="max-price"
                                            type="text"
                                            name="<?
                                            echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                            id="<?
                                            echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                            value="<?
                                            echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                            size="5"
                                            onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                            </div>

                            <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                                <div class="bx-ui-slider-track" id="drag_track_<?= $key ?>">
                                    <?
                                    for ($i = 0; $i <= $step_num; $i++):?>
                                        <div class="bx-ui-slider-part p<?= $i + 1 ?>">
                                            <span><?= $prices[$i] ?></span></div>
                                    <? endfor; ?>

                                    <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;"
                                         id="colorUnavailableActive_<?= $key ?>"></div>
                                    <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;"
                                         id="colorAvailableInactive_<?= $key ?>"></div>
                                    <div class="bx-ui-slider-pricebar-v" style="left: 0;right: 0;"
                                         id="colorAvailableActive_<?= $key ?>"></div>
                                    <div class="bx-ui-slider-range" id="drag_tracker_<?= $key ?>"
                                         style="left: 0%; right: 0%;">
                                        <a class="bx-ui-slider-handle left" style="left:0;"
                                           href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
                                        <a class="bx-ui-slider-handle right" style="right:0;"
                                           href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?
            $arJsParams = array(
                "leftSlider" => 'left_slider_' . $key,
                "rightSlider" => 'right_slider_' . $key,
                "tracker" => "drag_tracker_" . $key,
                "trackerWrap" => "drag_track_" . $key,
                "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                "precision" => $precision,
                "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                "colorAvailableActive" => 'colorAvailableActive_' . $key,
                "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
            );
            ?>
                <script type="text/javascript">
                    BX.ready(function () {
                        window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                    });
                </script>
            <?endif;
        }

        //not prices
        foreach ($arResult["ITEMS"] as $key => $arItem) {
            if (
                empty($arItem["VALUES"])
                || isset($arItem["PRICE"])
            )
                continue;

            if (
                $arItem["DISPLAY_TYPE"] == "A"
                && (
                    $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                )
            )
                continue;

            $CurPropSelected = array_key_exists($arItem['ID'], $SelProps);
            ?>
            <div class="filter_block <?
            if ($arItem["DISPLAY_EXPANDED"] == "Y"): ?> open<? endif ?>">
                <div class="filter_title">
                    <?
                    if (strstr($arItem["NAME"], '[') !== false) {
                        $matches = null;
                        $returnValue = preg_match('/(?P<name>.*)\\[(.*)\\]/', $arItem["NAME"], $matches);
                        echo $matches['name'];
                    } else {
                        echo $arItem["NAME"];
                    }
                    ?>

                </div>

                <div class="filter_values expand_<?= $arItem['ID'] ?>">
                    <?
                    $arCur = current($arItem["VALUES"]);
                    $cnt = 0;
                    $useExpand = false;
                    switch ($arItem["DISPLAY_TYPE"]) {
                    case "A"://NUMBERS_WITH_SLIDER
                        ?>

                        <div class="price_inputs">
                            <div class="min-price-wrapper">
                                От

                                <input
                                        class="min-price"
                                        type="text"
                                        name="<?
                                        echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                        id="<?
                                        echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                        value="<?
                                        echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                        placeholder="<?
                                        echo $arItem["VALUES"]["MIN"]["VALUE"] ?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"

                                />
                            </div>

                            <div class="max-price-wrapper">
                                До
                                <input
                                        class="max-price"
                                        type="text"
                                        name="<?
                                        echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                        id="<?
                                        echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                        value="<?
                                        echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                        size="5"
                                        placeholder="<?
                                        echo $arItem["VALUES"]["MAX"]["VALUE"] ?>"
                                        onkeyup="smartFilter.keyup(this)"
                                />
                            </div>
                        </div>
                        <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                            <div class="bx-ui-slider-track" id="drag_track_<?= $key ?>">
                                <?
                                $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                                $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                $value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                ?>

                                <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;"
                                     id="colorUnavailableActive_<?= $key ?>"></div>
                                <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;"
                                     id="colorAvailableInactive_<?= $key ?>"></div>
                                <div class="bx-ui-slider-pricebar-v" style="left: 0;right: 0;"
                                     id="colorAvailableActive_<?= $key ?>"></div>
                                <div class="bx-ui-slider-range" id="drag_tracker_<?= $key ?>"
                                     style="left: 0;right: 0;">
                                    <a class="bx-ui-slider-handle left" style="left:0;"
                                       href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
                                    <a class="bx-ui-slider-handle right" style="right:0;"
                                       href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
                                </div>
                            </div>
                        </div>
                    <?
                    $arJsParams = array(
                        "leftSlider" => 'left_slider_' . $key,
                        "rightSlider" => 'right_slider_' . $key,
                        "tracker" => "drag_tracker_" . $key,
                        "trackerWrap" => "drag_track_" . $key,
                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                        "precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0,
                        "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                        "colorAvailableActive" => 'colorAvailableActive_' . $key,
                        "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                    );
                    ?>
                        <script type="text/javascript">
                            BX.ready(function () {
                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                            });
                        </script>
                    <?
                    break;
                    case "B"://NUMBERS
                    ?>
                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                            <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></i>
                            <div class="bx-filter-input-container">
                                <input
                                        class="min-price"
                                        type="text"
                                        name="<?
                                        echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                        id="<?
                                        echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                        value="<?
                                        echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                />
                            </div>
                        </div>
                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                            <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_TO") ?></i>
                            <div class="bx-filter-input-container">
                                <input
                                        class="max-price"
                                        type="text"
                                        name="<?
                                        echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                        id="<?
                                        echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                        value="<?
                                        echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                />
                            </div>
                        </div>
                    <?
                    break;
                    case "G"://CHECKBOXES_WITH_PICTURES
                    ?>
                        <div class="col-xs-12">
                            <div class="bx-filter-param-btn-inline">
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):?>
                                    <input
                                            style="display: none"
                                            type="checkbox"
                                            name="<?= $ar["CONTROL_NAME"] ?>"
                                            id="<?= $ar["CONTROL_ID"] ?>"
                                            value="<?= $ar["HTML_VALUE"] ?>"
                                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    />
                                    <?
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class .= " bx-active";
                                    if ($ar["DISABLED"])
                                        $class .= " disabled";
                                    ?>
                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                           class="bx-filter-param-label <?= $class ?>"
                                           onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?
                                                    if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                        <span class="bx-filter-btn-color-icon"
                                                              style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                    <? endif ?>
												</span>
                                    </label>
                                <? endforeach ?>
                            </div>
                        </div>
                    <?
                    break;
                    case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                    ?>
                        <div class="col-xs-12">
                            <div class="bx-filter-param-btn-block">
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):?>
                                    <input
                                            style="display: none"
                                            type="checkbox"
                                            name="<?= $ar["CONTROL_NAME"] ?>"
                                            id="<?= $ar["CONTROL_ID"] ?>"
                                            value="<?= $ar["HTML_VALUE"] ?>"
                                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    />
                                    <?
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class .= " bx-active";
                                    if ($ar["DISABLED"])
                                        $class .= " disabled";
                                    ?>
                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                           class="bx-filter-param-label<?= $class ?>"
                                           onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?
                                                    if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                        <span class="bx-filter-btn-color-icon"
                                                              style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                    <? endif ?>
												</span>
                                        <span class="bx-filter-param-text"
                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                ?> (<span
                                                    data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                            endif; ?></span>
                                    </label>
                                <? endforeach ?>
                            </div>
                        </div>
                    <?
                    break;
                    case "P"://DROPDOWN
                    $checkedItemExist = false;
                    ?>
                        <div class="col-xs-12">
                            <div class="bx-filter-select-container">
                                <div class="bx-filter-select-block"
                                     onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                    <div class="bx-filter-select-text" data-role="currentOption">
                                        <?
                                        foreach ($arItem["VALUES"] as $val => $ar) {
                                            if ($ar["CHECKED"]) {
                                                echo $ar["VALUE"];
                                                $checkedItemExist = true;
                                            }
                                        }
                                        if (!$checkedItemExist) {
                                            echo GetMessage("CT_BCSF_FILTER_ALL");
                                        }
                                        ?>
                                    </div>
                                    <div class="bx-filter-select-arrow"></div>
                                    <input
                                            style="display: none"
                                            type="radio"
                                            name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                            value=""
                                    />
                                    <?
                                    foreach ($arItem["VALUES"] as $val => $ar):?>
                                        <input
                                                style="display: none"
                                                type="radio"
                                                name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                id="<?= $ar["CONTROL_ID"] ?>"
                                                value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                        />
                                    <? endforeach ?>
                                    <div class="bx-filter-select-popup" data-role="dropdownContent"
                                         style="display: none;">
                                        <ul>
                                            <li>
                                                <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                       class="bx-filter-param-label"
                                                       data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                </label>
                                            </li>
                                            <?
                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                $class = "";
                                                if ($ar["CHECKED"])
                                                    $class .= " selected";
                                                if ($ar["DISABLED"])
                                                    $class .= " disabled";
                                                ?>
                                                <li>
                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                           class="bx-filter-param-label<?= $class ?>"
                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?= $ar["VALUE"] ?></label>
                                                </li>
                                            <? endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?
                    break;
                    case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                    ?>
                        <div class="col-xs-12">
                            <div class="bx-filter-select-container">
                                <div class="bx-filter-select-block"
                                     onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                    <div class="bx-filter-select-text fix" data-role="currentOption">
                                        <?
                                        $checkedItemExist = false;
                                        foreach ($arItem["VALUES"] as $val => $ar):
                                            if ($ar["CHECKED"]) {
                                                ?>
                                                <?
                                                if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                    <span class="bx-filter-btn-color-icon"
                                                          style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                <? endif ?>
                                                <span class="bx-filter-param-text">
																<?= $ar["VALUE"] ?>
															</span>
                                                <?
                                                $checkedItemExist = true;
                                            }
                                        endforeach;
                                        if (!$checkedItemExist) {
                                            ?><span class="bx-filter-btn-color-icon all"></span> <?
                                            echo GetMessage("CT_BCSF_FILTER_ALL");
                                        }
                                        ?>
                                    </div>
                                    <div class="bx-filter-select-arrow"></div>
                                    <input
                                            style="display: none"
                                            type="radio"
                                            name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                            value=""
                                    />
                                    <?
                                    foreach ($arItem["VALUES"] as $val => $ar):?>
                                        <input
                                                style="display: none"
                                                type="radio"
                                                name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                id="<?= $ar["CONTROL_ID"] ?>"
                                                value="<?= $ar["HTML_VALUE_ALT"] ?>"
                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                        />
                                    <? endforeach ?>
                                    <div class="bx-filter-select-popup" data-role="dropdownContent"
                                         style="display: none">
                                        <ul>
                                            <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                                <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                       class="bx-filter-param-label"
                                                       data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                    <span class="bx-filter-btn-color-icon all"></span>
                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                </label>
                                            </li>
                                            <?
                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                $class = "";
                                                if ($ar["CHECKED"])
                                                    $class .= " selected";
                                                if ($ar["DISABLED"])
                                                    $class .= " disabled";
                                                ?>
                                                <li>
                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                           class="bx-filter-param-label<?= $class ?>"
                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')">
                                                        <?
                                                        if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                            <span class="bx-filter-btn-color-icon"
                                                                  style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                        <? endif ?>
                                                        <span class="bx-filter-param-text">
																	<?= $ar["VALUE"] ?>
																</span>
                                                    </label>
                                                </li>
                                            <? endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?
                    break;
                    case "K"://RADIO_BUTTONS
                    ?>
                        <div class="col-xs-12">
                            <div class="radio">
                                <label class="bx-filter-param-label"
                                       for="<? echo "all_" . $arCur["CONTROL_ID"] ?>">
												<span class="bx-filter-input-checkbox">
													<input
                                                            type="radio"
                                                            value=""
                                                            name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                            onclick="smartFilter.click(this)"
                                                    />
													<span class="bx-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
												</span>
                                </label>
                            </div>
                            <?
                            foreach ($arItem["VALUES"] as $val => $ar):?>
                                <div class="radio">
                                    <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                           class="bx-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled' : '' ?>">
														<input
                                                                type="radio"
                                                                value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                                name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                                id="<? echo $ar["CONTROL_ID"] ?>"
                                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                onclick="smartFilter.click(this)"
                                                        />
														<span class="bx-filter-param-text"
                                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                ?>&nbsp;(<span
                                                                    data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif; ?></span>
													</span>
                                    </label>
                                </div>
                            <? endforeach; ?>
                        </div>
                    <?
                    break;
                    case "U"://CALENDAR
                    ?>
                        <div class="col-xs-12">
                            <div class="bx-filter-parameters-box-container-block">
                                <div class="bx-filter-input-container bx-filter-calendar-container">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:main.calendar',
                                        '',
                                        array(
                                            'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                            'SHOW_INPUT' => 'Y',
                                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                            'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                            'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                            'SHOW_TIME' => 'N',
                                            'HIDE_TIMEBAR' => 'Y',
                                        ),
                                        null,
                                        array('HIDE_ICONS' => 'Y')
                                    ); ?>
                                </div>
                            </div>
                            <div class="bx-filter-parameters-box-container-block">
                                <div class="bx-filter-input-container bx-filter-calendar-container">
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        'bitrix:main.calendar',
                                        '',
                                        array(
                                            'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                            'SHOW_INPUT' => 'Y',
                                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                            'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                            'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                            'SHOW_TIME' => 'N',
                                            'HIDE_TIMEBAR' => 'Y',
                                        ),
                                        null,
                                        array('HIDE_ICONS' => 'Y')
                                    ); ?>
                                </div>
                            </div>
                        </div>
                    <?
                    break;
                    default://CHECKBOXES
                    foreach ($arItem["VALUES"] as $val => $ar){
                    ?>

                    <?
                    $cnt++;
                    if ($cnt == 7) {
                        $useExpand = true;
                        ?><?
                    }
                    ?>
                        <div class="filter_val <?if ($useExpand) echo '__close'?>">
                            <input
                                    type="checkbox"
                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    onclick="smartFilter.click(this)"
                            />

                            <label for="<? echo $ar["CONTROL_ID"] ?>">
                                <? if ((!$CurPropSelected && $seelctedPropsCount < 2 && $ar["ELEMENT_COUNT"] > 0) && false) : ?>
                                    <a href="<?= generateUrl($arItem['ID'], $val, $arResult, $start); ?>">
                                        <?= $ar["VALUE"] ?><span>(<? echo $ar["ELEMENT_COUNT"]; ?>)</span>
                                    </a>
                                <? else: ?>
                                    <? if ($arItem['ID'] == 1): ?>
                                        <?= showZvezd($ar["VALUE"]) ?>
                                        <span class="rating_line">
                                            <? \DesperadoHelpers\AppHelper::showRatingHtml($ar["VALUE"]) ?>
                                        </span>
                                        <span>(<? echo $ar["ELEMENT_COUNT"]; ?>)</span>
                                    <? else: ?>
                                        <?= $ar["VALUE"] ?><span>(<? echo $ar["ELEMENT_COUNT"]; ?>)</span>
                                    <? endif; ?>
                                <? endif; ?>

                            </label>
                        </div>

                        <?
                    }
                    }
                    ?>

                    <? if ($useExpand): ?>
                        <?
                        $val = count($arItem['VALUES']) - 6;
                        switch ($val) {

                        }
                        ?>
                        <div class="expand-more" data-id="<?= $arItem['ID'] ?>"> + Показать еще <?= $val; ?></div>
                    <? endif; ?>
                </div>
            </div>
            <?
        }
        ?>

        <input
                class="set_filter red_button"
                type="submit"
                id="set_filter"
                name="set_filter"
                value="Применить"
        />
        <input
                class="clear_filter"
                type="submit"
                id="del_filter"
                name="del_filter"
                value="Очистить фильтр"
        />

        <div class="bx-filter-popup-result <? if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"] ?>"
             id="modef" style="display: none !important;height: 0 !important;overflow: hidden;">
            <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
            <span class="arrow"></span>
            <br/>
            <a href="<? echo $arResult["FILTER_URL"] ?>"
               target=""><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
        </div>

    </form>
</div>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=Bitrix\Main\Web\Json::encode($arResult["JS_FILTER_PARAMS"])?>);
</script>