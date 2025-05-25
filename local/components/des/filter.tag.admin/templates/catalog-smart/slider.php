<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var $arItem array */
?>
<?php if (count($arItem['VALUES']) > 1 ) { ?>
    <?php
    $arItem["VALUES"]["MIN"]["VALUE"] = (int)$arItem["VALUES"]["MIN"]["VALUE"];
    $arItem["VALUES"]["MAX"]["VALUE"] = (int)$arItem["VALUES"]["MAX"]["VALUE"];
    ?>
    <div class="filter-item <?= $arItem["DISPLAY_EXPANDED"] != "Y" ? "" : "active" ?>">
        <div class="filter-head icon" style="--icon: url('<?=SITE_TEMPLATE_PATH?>/dist/img/icon/icon-arrow-bottom.svg')">
            <?=$arItem["NAME"]?>
        </div>
        <?php
        $curMinPrice=$arItem["VALUES"]["MIN"]["VALUE"];
        if(!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"])){
            $curMinPrice=$arItem["VALUES"]["MIN"]["HTML_VALUE"];
        }elseif (!empty($arItem["VALUES"]["MIN"]["FILTERED_VALUE"])){
            $curMinPrice=$arItem["VALUES"]["MIN"]["FILTERED_VALUE"];
        }

        $curMaxPrice=$arItem["VALUES"]["MAX"]["VALUE"];
        if(!empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])){
            $curMaxPrice=$arItem["VALUES"]["MAX"]["HTML_VALUE"];
        }elseif (!empty($arItem["VALUES"]["MAX"]["FILTERED_VALUE"])){
            $curMaxPrice=$arItem["VALUES"]["MAX"]["FILTERED_VALUE"];
        }
        ?>
        <div class="filter-item__container">
            <div class="slider-inputs-range inputs-range<?=$arItem["ID"]?>">
                <div class="slider-inputs">
                    <div class="slider-inputs__item">
                        от <?=$curMinPrice?>
                        <input type="text" class="slider-input slider-input-start" id="slider-input-start<?=$arItem["ID"]?>"
                               placeholder="<?=$curMinPrice?>"
                               data-price-min="<?=$curMinPrice?>"
                               data-price-min-def="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"
                               data-checked="<?= !empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) ? "Y" : "N" ;?>"
                               name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                               value=""
                        >

                    </div>
                    <div class="slider-inputs__item">
                        до <?=$curMaxPrice?>
                        <input type="text" class="slider-input slider-input-end" id="slider-input-end<?=$arItem["ID"]?>"
                               placeholder="<?=$curMaxPrice?>"
                               data-price-max="<?=$curMaxPrice?>"
                               data-price-max-def="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
                               name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                               value=""
                        >

                    </div>
                </div>
                <div class="js-range-slider" data-id="<?=$arItem["ID"]?>" id="slider<?=$arItem["ID"]?>"></div>
            </div>
        </div>
    </div>


<?php } ?>