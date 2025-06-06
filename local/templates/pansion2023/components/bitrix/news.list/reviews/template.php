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

$arNotLink = [
    '/pansionat-pansionat-dlya-pozhilykh-osen-zhizni-pushkino/',
    '/pansionat-pansionat-dlya-pozhilykh-osen-zhizni-pushkino/',
    '/pansionat-dlya-pozhilykh-lyudey-v-afanasovo/',
    '/pansionat-dlya-pozhilykh-kiselikha-nika/',
    '/pansionat-dlya-pozhilykh-nemchinovka/',
    '/pansionat-pansionat-dlya-pozhilykh-osen-zhizni-saltykovka/',
    '/pansionat-pansionat-dlya-pozhilykh-medvezhi-ozera/',
    '/pansionat-pansionat-dlya-pozhilykh-osen-zhizni-drozdovo/',
    '/pansionat-pansionat-dlya-pozhilykh-osen-zhizni-drozdovo/',
    '/pansionat-dlya-pozhilykh-liniya-zhizni-mytishchi/',
    '/pansionat-dlya-pozhilykh-mytishchi-osen-zhizni/',
    '/pansionat-dlya-pozhilykh-mytishchi-osen-zhizni/',
];
?>

<?php if (count($arResult["ITEMS"]) > 0) : ?>
    <div class="review__wrapper">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="review" id="<?= $arItem['ID'] ?>" itemscope itemprop="review" itemtype="http://schema.org/Review">

                <?php if ($arParams['USE_PANS'] == 'Y' && !empty($arItem['PANS'])): ?>
                    <div class="review__pans-wrapper">
                        <div class="review__pans-img">
                            <?
                            $file = CFile::ResizeImageGet($arItem['PANS']['PREVIEW_PICTURE'], array('width'=>400, 'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                            ?>
                            <img src="<?= $file['src']?>" alt="">
                        </div>
                        <div class="review__pans-text">
                            <p><?=$arItem['PANS']['NAME']?></p>
                            <?php if(!in_array($arItem['PANS']['DETAIL_PAGE_URL'], $arNotLink)):?>
                                <p><a href="<?=$arItem['PANS']['DETAIL_PAGE_URL']?>">Подробнее о пансионате</a></p>
                            <?php endif;?>
                        </div>
                    </div>
                <? endif; ?>

                <meta name="url" content="https://<?= SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) ?>">
                <meta itemprop="author" content="<?= $arItem['NAME'] ?>">
                <meta itemprop="ratingValue" content="<?= $arItem['PROPERTIES']['OB_RATING']['VALUE'] ?>">
                <meta itemprop="worstRating" content="1">
                <meta itemprop="bestRating" content="5">

                <div class="review__top">
                    <div class="review__name" itemprop="name"><?= $arItem['NAME'] ?></div>
                    <div class="review__rating">
                        <div class="inline-rating"><? \DesperadoHelpers\AppHelper::showRatingHtmlNew($arItem['PROPERTIES']['OB_RATING']['VALUE']) ?></div>
                    </div>
                    <div class="review__date"
                         itemprop="datePublished"><?= $arItem['PROPERTIES']['DATE']['VALUE'] ?></div>
                </div>
                <div class="review__text" itemprop="reviewBody">
                    <?= htmlspecialcharsBack($arItem['PROPERTIES']['TEXT']['VALUE']['TEXT']) ?>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<?php else: ?>
    <p>У этого пансионата нет ни одного отзыва.</p>
<?php endif; ?>

<? if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
    <div class="pagination_wrapper">
        <?= $arResult['NAV_STRING'] ?>
    </div>
<? endif; ?>
