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

<div class="news_list row">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="item_wrapper">
            <div class="item">
                <div class="img_wrapper" style="background-image: url('<?=$item['PREVIEW_PICTURE']['SRC']?>')"></div>
                <p class="name">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?=$item['NAME']?></a>
                </p>
                <p class="description">
                    <?=$item['PREVIEW_TEXT']?>
                </p>
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="white_button">
                    Читать далее
                </a>
            </div>
        </div>
    <? endforeach; ?>
</div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>


