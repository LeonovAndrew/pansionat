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

<div class="main-section__wrapper">
    <? foreach ($arResult['GRID'] as $gridRow): ?>
        <div class="main-section">
            <? foreach ($gridRow as $item): ?>
                <a class="main-section__link" href="<?= $item['SECTION_PAGE_URL'] ?>"><?= $item['NAME'] ?>
                    <span class="cnt"><?= $item['ELEMENT_CNT'] ?></span></a>
            <? endforeach; ?>
        </div>
    <? endforeach; ?>
</div>

