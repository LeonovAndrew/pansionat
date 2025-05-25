<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var $arItem array */



?>
<?php if (count($arItem['VALUES']) > 1 ) { ?>
    <?php
    $arEmptyVal=array(); $arChekVal=array(); $arSortVal=array();
    foreach ($arItem['VALUES'] as $key=>$VALUE){
        if($VALUE["CHECKED"]){
            $arChekVal[$key]=$VALUE;
        }elseif($VALUE["DISABLED"]){
            $arEmptyVal[$key]=$VALUE;
        }else{
            $arSortVal[$key]=$VALUE;
        }
    }
    unset($arItem['VALUES']);
    $arItem['VALUES']=$arChekVal + $arSortVal + $arEmptyVal;

    ?>
    <div class="filter-item <?php if($arItem["ACTIVE"]=="Y"):?> active<?php endif;?>">
        <div class="filter-head icon" style="--icon: url('/local/templates/monobrands/dist/img/icon/icon-arrow-bottom.svg')"><?php echo $arItem['NAME']; ?></div>
        <div class="filter-item__container">
            <div class="filter-list">
                <?php foreach ($arItem['VALUES'] as $arValue) { ?>
                    <div class="filter-element filter-list__element<?php if($arValue['DISABLED']):?> disabled<?php endif;?>">
                        <div class="filter-element__icon">
                            <input
                                    <?php if($arValue['DISABLED']):?>disabled<?php endif;?>
                                    class="input-action"
                                    type="checkbox"
                                    id="<?php echo $arValue['CONTROL_ID']; ?>"
                                    name="<?php echo $arValue['CONTROL_NAME']; ?>"
                                    value="<?php echo $arValue['HTML_VALUE']; ?>"
                                <?php echo $arValue['CHECKED'] ? 'checked="checked"' : ''; ?>>
                            <span class="filter-element__check icon" style="--icon: url('<?=SITE_TEMPLATE_PATH?>/dist/img/icon/icon-check.svg')"></span>
                        </div>
                        <label class="filter-element__label" for="<?php echo $arValue['CONTROL_ID']; ?>" aria-label="<?php echo $arValue['HTML_VALUE']; ?>">
                            <span class="filter-element__text"><?php echo $arValue['VALUE']; ?></span>
                            <span class="filter-element__count"><?php echo ($arValue['ELEMENT_COUNT']) ? $arValue['ELEMENT_COUNT'] :""; ?></span>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>