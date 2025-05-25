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
?>


<div class="before_footer_menu row">
    <? foreach ($arResult['SECTIONS'] as $item): ?>
        <div class="item_wrapper">
            <div class="item">
                <div class="img_wrapper" style="background-image: url('<?= $item['PICTURE']['SRC'] ?>')"
                     onclick="window.location.href='<?= $item['SECTION_PAGE_URL'] ?>'">

                </div>
                <div class="text_wrapper">
                    <a href="<?= $item['SECTION_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
                    <span><?= $item['ELEMENT_CNT'] ?></span>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>
