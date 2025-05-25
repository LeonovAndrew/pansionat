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

<div class="news__wrapper">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="news">
            <div class="news__img" style="background-image: url('<?= $item['PREVIEW_PICTURE']['SRC'] ?>')"></div>
            <div class="news__name">
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $item['NAME'] ?>"><?= $item['NAME'] ?></a>
            </div>
            <div class="news__description">
                <?= $item['PREVIEW_TEXT'] ?>
            </div>
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="news__link">
                Читать далее
            </a>
        </div>
    <? endforeach; ?>
</div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>


