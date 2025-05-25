<? use App\Helper;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

<? if (count($arResult["ITEMS"]) > 0) : ?>
    <div class="index-slider js-slider">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="index-slider__item js-show-modal" data-modal="calcPrice"
                 onclick="window.location.href = '<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>'">
                <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" class="index-slider__img-big" alt="">
                <img src="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>" class="index-slider__img-small" alt="">
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>



