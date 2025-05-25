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


<div class="index-sections">
    <? foreach ($arResult['SECTIONS'] as $item): ?>
        <div class="index-sections__item">
            <div class="index-sections__item-img" style="background-image: url('<?= $item['PICTURE']['SRC'] ?>')"
                 onclick="window.location.href='<?= $item['SECTION_PAGE_URL'] ?>'">

            </div>
            <div class="index-sections__item-text">
                <a href="<?= $item['SECTION_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
                <span><?= $item['ELEMENT_CNT'] ?></span>
            </div>
        </div>
    <? endforeach; ?>
</div>
