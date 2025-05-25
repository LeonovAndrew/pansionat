<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var $arItem array */
?>
<?php if (count($arItem['VALUES']) > 1 ) { ?>
    <div class="filter-item active">
        <div class="filter-head icon" style="--icon: url('<?=SITE_TEMPLATE_PATH?>/dist/img/icon/icon-arrow-bottom.svg')"><?php echo $arItem['NAME']; ?></div>
        <div class="filter-item__container">
            <?php foreach ($arItem['VALUES'] as $arValue) { ?>
                <div class="filter-element filter-list__element">
                    <div class="filter-element__icon">
                        <input
                                class="input-action"
                                type="radio"
                                id="<?php echo $arValue['CONTROL_ID']; ?>"
                                name="<?php echo $arValue['CONTROL_NAME']; ?>"
                                value="<?php echo $arValue['HTML_VALUE']; ?>"
                            <?php echo $arValue['CHECKED'] ? 'checked="checked"' : ''; ?>>
                        <span class="filter-element__check icon" style="--icon: url('<?=SITE_TEMPLATE_PATH?>/dist/img/icon/icon-check.svg')"></span>
                    </div>
                    <label class="filter-element__label" for="<?php echo $arValue['CONTROL_ID']; ?>" aria-label="<?php echo $arValue['HTML_VALUE']; ?>">
                        <span class="filter-element__text"><?php echo $arValue['VALUE']; ?></span>
                        <span class="filter-element__count"><?php echo $arValue['ELEMENT_COUNT']; ?></span>
                    </label>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>