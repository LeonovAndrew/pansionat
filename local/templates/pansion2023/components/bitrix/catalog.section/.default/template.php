<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use DesperadoHelpers\AppHelper;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |    Attention!
 * |    The following comments are for system use
 * |    and are required for the component to work correctly in ajax mode:
 * |    <!-- items-container -->
 * |    <!-- pagination-container -->
 * |    <!-- component-end -->
 */


$this->setFrameMode(true);
?>

<div class="pans__wrapper __grid-<?= $arParams['LINE_ELEMENT_COUNT'] ?>" itemscope
     itemtype="https://schema.org/OfferCatalog">

    <meta itemprop="name" content="Каталог пансионатов">
    <meta itemprop="description" content="Пансионаты для пожилых">
    <meta itemprop="image" content="https://pansiont.pro/upload/iblock/663/6637a08955e5e8466040ad91f8360561.png">

    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
        <div class="pans" data-offer-id="<?= $item['ID'] ?>" itemprop="itemListElement" itemscope
             itemtype="https://schema.org/Offer">
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="pans__img">

                <div class="js_sectionSlider swiper s<?= $item['ID'] ?>" data-id="s<?= $item['ID'] ?>">
                    <div class="swiper-wrapper">
                        <meta itemprop="image" content="https://pansionat.pro<?= $item['SLIDER_PICTURES'][0]['SRC'] ?>">
                        <? foreach ($item['SLIDER_PICTURES'] as $key => $img): ?>
                            <? if ($key == 0): ?>
                                <img class="pans__img-wrapper swiper-slide" src="<?= $img['SRC'] ?>" loading="lazy"
                                     alt="<?php echo $item['NAME']; ?>" title="<?php echo $item['NAME']; ?>">
                            <? else: ?>
                                <img class="pans__img-wrapper swiper-slide" src="<?= $img['SRC'] ?>" loading="lazy"
                                     alt="<?php echo $item['NAME']; ?>" title="<?php echo $item['NAME']; ?>">
                            <? endif; ?>
                        <? endforeach; ?>
                    </div>
                    <div class="swiper-button-next next-s<?= $item['ID'] ?>"></div>
                    <div class="swiper-button-prev prev-s<?= $item['ID'] ?>"></div>
                </div>

                <? if (count($item['SLIDER_PICTURES']) > 1): ?>
                    <div class="pans__img-cnt">
                        <div class="js-text">1 из <?= count($item['SLIDER_PICTURES']) ?></div>
                    </div>
                <? endif; ?>

                <? /*
                <div class="pans__add2fav js-favorite js-tooltip" title="Добавить в избранное"
                     data-item-id="<?= $item['ID'] ?>"><?php \DesperadoHelpers\AppHelper::showIcon('favorite'); ?></div>
                */ ?>
            </a>

            <div class="pans__description">
                <div class="pans__name">
                    <link itemprop="url" href="https://pansionat.pro<?= $item['DETAIL_PAGE_URL'] ?>">
                    <meta itemprop="name" content="<?= $item['NAME'] ?>">
                    <meta itemprop="description" content="<?= strip_tags($item['PREVIEW_TEXT']) ?>">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
                </div>
                <div class="pans__rating">
                    <div class="inline-rating">
                        <? AppHelper::showRatingHtmlNew(
                            $item['PROPERTIES']['RATING']['VALUE'],
                            $item['PROPERTIES']['NUM_VOTES']['VALUE'],
                            true
                        ) ?>
                    </div>
                    <div class="pans__recommendet">
                        <?= $item['PROPERTIES']['PRC_REC']['VALUE'] ?>% рекомендуют
                    </div>
                </div>
                <div class="pans__adress">
                    <?= $item['PROPERTIES']['ADRESS']['VALUE'] ?>
                </div>
                <div class="pans__bages">
                    <?php if ($item['PROPERTIES']['BAGE_PANS_CHECKED']['VALUE'] == 'Да'): ?>
                        <div class="pans__bage __green"><?php \DesperadoHelpers\AppHelper::showIcon('shield'); ?>
                            Проверенный пансионат
                        </div>
                    <?php endif; ?>
                    <?php if ($item['PROPERTIES']['BAGE_ACTIONS']['VALUE'] == 'Да'): ?>
                        <div class="pans__bage __yellow">Есть акции</div>
                    <?php endif; ?>
                    <?php if ($item['PROPERTIES']['BAGE_SEPC']['VALUE'] == 'Да'): ?>
                        <div class="pans__bage">Cпециализированный уход</div>
                    <?php endif; ?>
                    <?php if ($item['PROPERTIES']['BAGE_REVIEWS']['VALUE'] == 'Да'): ?>
                        <div class="pans__bage">Хорошие отзывы</div>
                    <?php endif; ?>
                </div>
                <div class="pans__actions">
                    <div class="pans__price">от <?= AppHelper::CurrencyFormat($item['PROPERTIES']['PRICE']['VALUE']); ?>
                        руб/сутки
                    </div>
                    <meta itemprop="price"
                          content="<?= number_format($item['PROPERTIES']['PRICE']['VALUE'], 2, '.', '') ?>">
                    <meta itemprop="priceCurrency" content="RUB">
                    <link itemprop="availability" href="http://schema.org/InStock">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="pans__button">Подробнее</a>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>

<? if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
    <div class="pagination_wrapper">
        <?= $arResult['NAV_STRING'] ?>
    </div>
<? endif; ?>




