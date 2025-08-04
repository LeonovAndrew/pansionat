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
    <meta itemprop="image" content="https://pansionat.pro/upload/iblock/663/6637a08955e5e8466040ad91f8360561.png">

    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
        <div class="pans" data-offer-id="<?= $item['ID'] ?>" itemprop="itemListElement" itemscope
             itemtype="https://schema.org/Offer">
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="pans__img">

                <div class="js_sectionSlider swiper s<?= $item['ID'] ?>" data-id="s<?= $item['ID'] ?>">
                    <div class="swiper-wrapper">
                        <meta itemprop="image" content="https://pansionat.pro<?= $item['SLIDER_PICTURES'][0]['SRC'] ?>">
                        <? foreach ($item['SLIDER_PICTURES'] as $iKeySecond => $img): ?>
                            <?php if ($iKeySecond > 10) continue; ?>
                            <? if ($iKeySecond == 0): ?>
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
                    <div class="swiper-pagination"></div>
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
                    <?php if(!empty($item['PROPERTIES']['ADDRESS']['VALUE'])):?>
                        <a href="<?= $item['DETAIL_PAGE_URL'] ?>#map_section" class="pans__adress_wrap">
                            <span class="pans__adress_icon">
                                <svg width="18px" height="18px" viewBox="0 0 8.4666669 8.4666669" fill="#4949e7" xmlns:svg="http://www.w3.org/2000/svg">
                                    <g id="layer1" transform="translate(0,-288.53332)">
                                        <path fill="#4949e7" d="m 4.2324219,288.79688 c -1.6042437,0 -2.9101556,1.30591 -2.9101563,2.91015 -10e-7,2.82277 2.7460938,4.96875 2.7460938,4.96875 a 0.26460978,0.26460978 0 0 0 0.3300781,0 c 0,0 2.7460996,-2.14598 2.7460937,-4.96875 -3.4e-6,-1.60424 -1.3078657,-2.91015 -2.9121093,-2.91015 z m 0,0.52929 c 1.3182605,0 2.3828097,1.0626 2.3828125,2.38086 4.8e-6,2.30926 -2.0910618,4.13374 -2.3808594,4.38086 -0.2884142,-0.24588 -2.3828134,-2.0707 -2.3828125,-4.38086 5e-7,-1.31826 1.0625988,-2.38086 2.3808594,-2.38086 z" id="path929"/>
                                        <path fill="#4949e7" d="m 4.2324219,290.38477 c -0.7274912,0 -1.3222633,0.59477 -1.3222657,1.32226 -4.5e-6,0.7275 0.5947697,1.32422 1.3222657,1.32422 0.727496,0 1.3242233,-0.59672 1.3242187,-1.32422 -2.3e-6,-0.72749 -0.5967275,-1.32226 -1.3242187,-1.32226 z m 0,0.52929 c 0.4415089,0 0.7949204,0.35146 0.7949219,0.79297 2.7e-6,0.44151 -0.35341,0.79492 -0.7949219,0.79492 -0.441512,0 -0.7929715,-0.35341 -0.7929688,-0.79492 1.4e-6,-0.44151 0.3514598,-0.79297 0.7929688,-0.79297 z" id="circle931" />
                                    </g>
                                </svg>
                            </span>
                            <span class="pans__adress_name">
                                <?=$item['PROPERTIES']['ADDRESS']['VALUE']?>
                            </span>
                        </a>
                    <?php endif;?>
                </div>

                <div class="pans__rating">
                    <div class="inline-rating">
                        <? AppHelper::showRatingHtmlProcent(
                            $item['PROPERTIES']['RATING']['VALUE'],
                            $item['PROPERTIES']['NUM_VOTES']['VALUE'],
                            true,
                            $item['PROPERTIES']['PRC_REC']['VALUE']
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
                    <div class="pans__actions_wrap">
                        <div class="pans__price">от <?= AppHelper::CurrencyFormat($item['PROPERTIES']['PRICE']['VALUE']); ?>
                            руб/сутки
                        </div>
                        <div class="pans__price pans__price_month">от <?= AppHelper::CurrencyFormat($item['PROPERTIES']['PRICE']['VALUE']*30); ?>
                            руб/мес.
                        </div>
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




