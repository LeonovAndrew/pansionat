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

<div class="seti__wrapper">
    <div class="seti">
        <? foreach ($arResult['SECTIONS'] as $item): ?>
            <a class="seti__item" href="<?= $item['SECTION_PAGE_URL'] ?>"><?= $item['NAME'] ?>
                (<?= $item['ELEMENT_CNT'] ?>)</a>
        <? endforeach; ?>
    </div>
</div>

