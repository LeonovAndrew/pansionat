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
 * @var string $templateFolder
 */

$this->setFrameMode(true);

function showFeatureItem($name)
{
    switch ($name) {
        case 'Постоянный мониторинг состояния здоровья':
            $img = 'computer';
            break;

        case 'В пансионате есть лифт':
            $img = 'elevator';
            break;

        case '6-ти разовое питание':
        case '5-ти разовое питание':
        case '4-х разовое питание':
        case '3-х разовое питание':
            $img = 'diet';
            break;

        case 'Прогулки на территории':
            $img = 'walker';
            break;

        case 'Контроль за приемом лекарств':
            $img = 'report';
            break;

        case 'Специальные условия для больных с деменцией':
            $img = 'aids';
            break;

        case 'Для заселения необходимы: паспорт и полис':
            $img = 'passport';
            break;

        case 'Развлекательные мероприятия':
            $img = 'theater';
            break;

        case 'Регулярный осмотр врача':
            $img = 'nurse';
            break;

        case 'Полный гигиенический и косметический уход':
            $img = 'skin';
            break;

        case 'Медицинское и специальное оборудование':
            $img = 'bed';
            break;

        case 'Реабилитация больных':
            $img = 'healthcare-and-medical';
            break;

        case 'Лечебные процедуры':
            $img = 'drug';
            break;

        case 'Мед.персонал':
            $img = 'doctor';
            break;

        case 'Развивающие игры':
            $img = 'jigsaw';
            break;

        case 'Реабилитация после инсульта':
            $img = 'infrared';
            break;

        case 'Реабилитация после операции':
            $img = 'healthcare-and-medical';
            break;

        case 'Штатный врач':
            $img = 'nurse';
            break;

        case 'Мест в номере 2-5':
        case 'Мест в номере 2-4':
        case 'Мест в номере 3-6':
        case 'Мест в номере 2':
        case 'Мест в номере 3':
        case 'Мест в номере 4':
        case 'Мест в номере 1':
            $img = 'bed2';
            break;

        case 'Беспроводная палатная сигнализация':
            $img = 'siren';
            break;

        case 'Автостоянка':
            $img = 'parking-lot';
            break;

        case 'Большая территория для прогулок, сад, беседки':
            $img = 'brazil';
            break;

        case 'Всегда чисто и очень уютно':
            $img = 'window';
            break;

        case 'Забота и доброжелательность персонала':
            $img = 'care';
            break;

        case 'Инфраструктура для колясочников':
            $img = 'disability';
            break;

        case 'Функциональные кровати для лежачих больных':
            $img = 'bed3';
            break;

        case 'Wi-Fi':
            $img = 'internet';
            break;

        case 'Собственный транспорт для трансфера':
            $img = 'bus';
            break;

        case 'Огороженная и охраняемая территория':
            $img = 'shield';
            break;

        case 'Медицинское обслуживание':
            $img = 'medical-kit';
            break;

        case 'Круглосуточный уход (24/7)':
            $img = '24-hours';
            break;

    }


    return '<div class="img_wrapper">' . AppHelper::showIcon($img, true) . '</div><div class="text_wrapper">' . $name . '</div>';
}

?>
<div class="detail__description">
    Профессиональный уход 24/7, квалифицированный и вежливый персонал, постоянная забота о постояльцах в пансионате для
    пожилых <?= $arResult['NAME'] ?>. У нас организован досуг, профессиональный медицински присмотр и
    реабилитация. Акции, скидки и специальные предложения на размещение в <?= $arResult['NAME'] ?>.
</div>

<div class="detail__wrapper" itemscope itemtype="https://schema.org/Offer">

    <meta itemprop="name" content="<?= $arResult['NAME'] ?>">
    <link itemprop="url" href="https://pansionat.pro<?= $arResult['DETAIL_PAGE_URL'] ?>">
    <meta itemprop="description" content="<?= strip_tags($arResult['PREVIEW_TEXT']) ?>">

    <div class="detail">
        <div class="detail__left">

            <div class="detail__bages">
                <div class="detail__bages-close"><?php AppHelper::showIcon('close') ?></div>

                <div class="detail__bage">
                    <div class="detail__bage-svg"><?php AppHelper::showIcon('heart-fiol') ?></div>
                    <div class="detail__bage-text">
                        <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_COMMEND']['VALUE'] ?>
                            хвалят</p>
                        <p class="sub-title">люди хвалят его в своих отзывах</p>
                    </div>
                </div>

                <? if (!empty($arResult['REVIEWS'])): ?>
                    <div class="detail__bage">
                        <div class="detail__bage-svg">

                        </div>
                        <div class="detail__bage-text">
                            <div style="max-width: 210px">
                                <div class="swiper" id="js-reviews-slider">
                                    <div class="swiper-wrapper">
                                        <? foreach ($arResult['REVIEWS'] as $item): ?>
                                            <div class="swiper-slide">
                                                <p class="text">
                                                    <?= TruncateText(strip_tags($item['PROPERTY_TEXT_VALUE']['TEXT']), 100) ?></p>
                                                <p class="title"><?= $item['NAME'] ?></p>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endif; ?>

                <div class="detail__bage">
                    <div class="detail__bage-svg"><?php AppHelper::showIcon('key') ?></div>
                    <div class="detail__bage-text">
                        <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_ORDER']['VALUE'] ?>
                            забронировали</p>
                        <p class="sub-title">за последние 2 месяца</p>
                    </div>
                </div>
            </div>

            <div class="detail__big-images">
                <div class="swiper" id="bigPhoto">
                    <div class="swiper-wrapper">
                        <meta itemprop="image" content="https://pansionat.pro<?= $item['PHOTOS'][0]['BIG'] ?>">
                        <? foreach ($arResult['PHOTOS'] as $key => $pic): ?>
                            <div class="swiper-slide">
                                <img src="<?= $pic['BIG'] ?>" alt="<?= $arResult['NAME'] ?> фото <?= ($key + 1) ?>"
                                     data-fancybox="gallery"
                                     <? if ($key == 0): ?><? else: ?>loading="lazy"<? endif; ?>>

                                <?php if ($key != 0): ?>
                                    <div class="swiper-lazy-preloader"></div><? endif; ?>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <div class="swiper-button-prev __big"></div>
                    <div class="swiper-button-next __big"></div>
                </div>
            </div>

            <div class="detail__small-images">
                <div class="swiper" id="smallPhoto">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult['PHOTOS'] as $key => $pic): ?>
                            <div class="swiper-slide">
                                <img src="<?= $pic['SMALL'] ?>" alt="">
                            </div>
                        <? endforeach; ?>
                    </div>
                    <div class="swiper-button-prev __small"></div>
                    <div class="swiper-button-next __small"></div>
                </div>
            </div>
        </div>

        <div class="detail__right">

            <div class="detail__panel">
                <div class="detail__rating">
                    <div class="inline-rating">
                        <? AppHelper::showRatingHtmlProcent(
                            $arResult['PROPERTIES']['RATING']['VALUE'],
                            $arResult['PROPERTIES']['NUM_VOTES']['VALUE'],
                            true,
                            $arResult['PROPERTIES']['PRC_REC']['VALUE']
                        ) ?>
                    </div>
                    <span class="detail__recommendet">
                                <?= $arResult['PROPERTIES']['PRC_REC']['VALUE'] ?>% рекомендуют</span>
                    <? /*
                        <span class="detail__add2fav js-favorite js-tooltip" title="Добавить в избранное"
                              data-item-id="<?= $arResult['ID'] ?>"><?php \DesperadoHelpers\AppHelper::showIcon('favorite'); ?></span>
                        */ ?>
                </div>
                <p class="detail__id-wrap">
                    id пансионата: <?= $arResult['ID'] ?>
                </p>

                <div class="detail__spec-bages">
                    <?php if ($arResult['PROPERTIES']['BAGE_PANS_CHECKED']['VALUE'] == 'Да'): ?>
                        <div class="detail__spec-bage __green"><?php \DesperadoHelpers\AppHelper::showIcon('shield'); ?>
                            Проверенный пансионат
                        </div>
                    <?php endif; ?>
                    <?php if ($arResult['PROPERTIES']['BAGE_ACTIONS']['VALUE'] == 'Да'): ?>
                        <div class="detail__spec-bage __yellow">Есть акции</div>
                    <?php endif; ?>
                    <?php if ($arResult['PROPERTIES']['BAGE_SEPC']['VALUE'] == 'Да'): ?>
                        <div class="detail__spec-bage">Cпециализированный уход</div>
                    <?php endif; ?>
                    <?php if ($arResult['PROPERTIES']['BAGE_REVIEWS']['VALUE'] == 'Да'): ?>
                        <div class="detail__spec-bage">Хорошие отзывы</div>
                    <?php endif; ?>
                </div>

                <? if (!empty($arResult['PROPERTIES']['OLD_PRICE']['VALUE']) && false): ?>
                    <p class="discount">
                        <?
                        $oldPrice = $arResult['PROPERTIES']['OLD_PRICE']['VALUE'];
                        $curPrice = $arResult['PROPERTIES']['PRICE']['VALUE'];
                        $prc = ($oldPrice - $curPrice) / ($oldPrice / 100);
                        ?>
                        <? if ($oldPrice > $curPrice): ?>
                            <span class="old_price"><?= AppHelper::CurrencyFormat($oldPrice); ?></span>
                            <span class="prc">-<?= intval($prc) ?>%</span><span
                                    class="vigoda">Выгода <?= AppHelper::CurrencyFormat(($oldPrice - $curPrice), 'RUB'); ?>
                                руб.</span>
                        <? endif; ?>

                        <? if (!empty($arResult['PROPERTIES']['SALE_END_DATE']['VALUE'])): ?>
                            <?
                            $salaDate = MakeTimeStamp($arResult['PROPERTIES']['SALE_END_DATE']['VALUE']);
                            if ($salaDate > time()) {
                                ?>
                                <br><span class="timer">До конца акции:
                                    <span class="js-countDown"
                                          data-date="<?= MakeTimeStamp($arResult['PROPERTIES']['SALE_END_DATE']['VALUE']) * 1000 ?>"></span></span>
                            <? } ?>
                        <? else: ?>
                            &nbsp;
                        <? endif; ?>
                    </p>
                <? endif; ?>

                <div class="detail__price">

                    от <span><?= AppHelper::CurrencyFormat($arResult['PROPERTIES']['PRICE']['VALUE']); ?></span>
                    руб/сутки
                    <div class="pans__price pans__price_month">от <?= AppHelper::CurrencyFormat($arResult['PROPERTIES']['PRICE']['VALUE']*30); ?>
                        руб/мес.
                    </div>
                </div>
                <?php if(!empty($arResult['PROPERTIES']['ADDRESS']['VALUE'])):?>
                    <a href="#map_section" class="pans__adress_wrap">
                        <span class="pans__adress_icon">
                            <svg width="18px" height="18px" viewBox="0 0 8.4666669 8.4666669" xmlns:svg="http://www.w3.org/2000/svg">
                                <g id="layer1" transform="translate(0,-288.53332)">
                                    <path fill="#4949e7" d="m 4.2324219,288.79688 c -1.6042437,0 -2.9101556,1.30591 -2.9101563,2.91015 -10e-7,2.82277 2.7460938,4.96875 2.7460938,4.96875 a 0.26460978,0.26460978 0 0 0 0.3300781,0 c 0,0 2.7460996,-2.14598 2.7460937,-4.96875 -3.4e-6,-1.60424 -1.3078657,-2.91015 -2.9121093,-2.91015 z m 0,0.52929 c 1.3182605,0 2.3828097,1.0626 2.3828125,2.38086 4.8e-6,2.30926 -2.0910618,4.13374 -2.3808594,4.38086 -0.2884142,-0.24588 -2.3828134,-2.0707 -2.3828125,-4.38086 5e-7,-1.31826 1.0625988,-2.38086 2.3808594,-2.38086 z" id="path929"/>
                                    <path fill="#4949e7" d="m 4.2324219,290.38477 c -0.7274912,0 -1.3222633,0.59477 -1.3222657,1.32226 -4.5e-6,0.7275 0.5947697,1.32422 1.3222657,1.32422 0.727496,0 1.3242233,-0.59672 1.3242187,-1.32422 -2.3e-6,-0.72749 -0.5967275,-1.32226 -1.3242187,-1.32226 z m 0,0.52929 c 0.4415089,0 0.7949204,0.35146 0.7949219,0.79297 2.7e-6,0.44151 -0.35341,0.79492 -0.7949219,0.79492 -0.441512,0 -0.7929715,-0.35341 -0.7929688,-0.79492 1.4e-6,-0.44151 0.3514598,-0.79297 0.7929688,-0.79297 z" id="circle931" />
                                </g>
                            </svg>
                        </span>
                        <span class="pans__adress_name">
                            <?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?>
                        </span>
                    </a>
                <?php endif;?>

                <meta itemprop="price"
                      content="<?= number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 2, '.', '') ?>">
                <meta itemprop="priceCurrency" content="RUB">
                <link itemprop="availability" href="http://schema.org/InStock">

                <div class="detail__adress">
                    <?= $arResult['PROPERTIES']['ADRESS']['VALUE'] ?>
                </div>

                <? if (!empty($arResult['SETI'])): ?>
                    <div class="detail__pans-set">Сеть пансионатов: <?= $arResult['SETI'] ?></div>
                <? endif; ?>

                <div class="detail__phone">
                    <a href="tel:+74951814393">+7 (495) 181-43-93</a> <span>Справочная служба 24/7</span>
                </div>

                <div class="detail__red-button js-show-modal"
                     onclick="yaCounter55993486.reachGoal('button_6'); return true;"
                     data-modal="callback" data-metrika="button_7">Бесплатная консультация
                </div>
                <div class="detail__fiol-button js-show-modal"
                     onclick="yaCounter55993486.reachGoal('button_8'); return true;"
                     data-modal="takerent" data-id="<?= $arResult['ID'] ?>" data-metrika="button_9">Поставить в бронь
                </div>
            </div>

            <div class="detail__bages-section">
                <div class="detail__bages-title">Это заведение любят</div>

                <div class="detail__bages-item">
                    <div class="detail__bages-svg">
                        <?php AppHelper::showIcon('heart-fiol') ?>
                    </div>
                    <div class="detail__bages-text">
                        <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_COMMEND']['VALUE'] ?>
                            хвалят</p>
                    </div>
                </div>

                <div class="detail__bages-item">
                    <div class="detail__bages-svg">
                        <?php AppHelper::showIcon('like') ?>
                    </div>
                    <div class="detail__bages-text">
                        <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_LIKE']['VALUE'] ?> нравится</p>
                        <p class="sub-title">расположение, обслуживание, уют, комфорт</p>
                    </div>
                </div>

                <div class="detail__bages-item">
                    <div class="detail__bages-svg">
                        <?php AppHelper::showIcon('key') ?>
                    </div>
                    <div class="detail__bages-text">
                        <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_ORDER']['VALUE'] ?>
                            забронировали</p>
                        <p class="sub-title">за последние 2 месяца</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo '</div>' ?>

<div class="container" id="map_section" style="margin-top: 40px"><h2><?= $arResult['NAME'] ?> на карте</h2></div>

<?php if (!empty($arResult['PROPERTIES']['ADDRESS']['VALUE'])) { ?>
    <div class="container">
        <div class="map__wrap">
            <div class="detail__route">
                <div class="route__item">
                    <div class="icon-wrap">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 11.5C11.337 11.5 10.7011 11.2366 10.2322 10.7678C9.76339 10.2989 9.5 9.66304 9.5 9C9.5 8.33696 9.76339 7.70107 10.2322 7.23223C10.7011 6.76339 11.337 6.5 12 6.5C12.663 6.5 13.2989 6.76339 13.7678 7.23223C14.2366 7.70107 14.5 8.33696 14.5 9C14.5 9.3283 14.4353 9.65339 14.3097 9.95671C14.1841 10.26 13.9999 10.5356 13.7678 10.7678C13.5356 10.9999 13.26 11.1841 12.9567 11.3097C12.6534 11.4353 12.3283 11.5 12 11.5ZM12 2C10.1435 2 8.36301 2.7375 7.05025 4.05025C5.7375 5.36301 5 7.14348 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 7.14348 18.2625 5.36301 16.9497 4.05025C15.637 2.7375 13.8565 2 12 2Z"
                                  fill="#fff"/>
                        </svg>
                    </div>
                    <span><b>Адрес</b>: <?php echo $arResult['PROPERTIES']['ADDRESS']['VALUE']; ?></span>
                </div>
                <?php if (!empty($arResult['PROPERTIES']['ADDRESS_AUTO']['VALUE'])) { ?>
                    <div class="route__item">
                        <div class="icon-wrap">
                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6L3.5 1.5H14.5L16 6M14.5 11C14.1022 11 13.7206 10.842 13.4393 10.5607C13.158 10.2794 13 9.89782 13 9.5C13 9.10218 13.158 8.72064 13.4393 8.43934C13.7206 8.15804 14.1022 8 14.5 8C14.8978 8 15.2794 8.15804 15.5607 8.43934C15.842 8.72064 16 9.10218 16 9.5C16 9.89782 15.842 10.2794 15.5607 10.5607C15.2794 10.842 14.8978 11 14.5 11ZM3.5 11C3.10218 11 2.72064 10.842 2.43934 10.5607C2.15804 10.2794 2 9.89782 2 9.5C2 9.10218 2.15804 8.72064 2.43934 8.43934C2.72064 8.15804 3.10218 8 3.5 8C3.89782 8 4.27936 8.15804 4.56066 8.43934C4.84196 8.72064 5 9.10218 5 9.5C5 9.89782 4.84196 10.2794 4.56066 10.5607C4.27936 10.842 3.89782 11 3.5 11ZM15.92 1C15.72 0.42 15.16 0 14.5 0H3.5C2.84 0 2.28 0.42 2.08 1L0 7V15C0 15.2652 0.105357 15.5196 0.292893 15.7071C0.48043 15.8946 0.734784 16 1 16H2C2.26522 16 2.51957 15.8946 2.70711 15.7071C2.89464 15.5196 3 15.2652 3 15V14H15V15C15 15.2652 15.1054 15.5196 15.2929 15.7071C15.4804 15.8946 15.7348 16 16 16H17C17.2652 16 17.5196 15.8946 17.7071 15.7071C17.8946 15.5196 18 15.2652 18 15V7L15.92 1Z"
                                      fill="#fff"/>
                            </svg>
                        </div>
                        <span><b>На авто</b>: <?php echo $arResult['PROPERTIES']['ADDRESS_AUTO']['VALUE']['TEXT']; ?></span>
                    </div>
                <?php } ?>
                <?php if (!empty($arResult['PROPERTIES']['ADDRESS_BUS']['VALUE'])) { ?>
                    <div class="route__item">
                        <div class="icon-wrap">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 11H6V6H18M16.5 17C16.1022 17 15.7206 16.842 15.4393 16.5607C15.158 16.2794 15 15.8978 15 15.5C15 15.1022 15.158 14.7206 15.4393 14.4393C15.7206 14.158 16.1022 14 16.5 14C16.8978 14 17.2794 14.158 17.5607 14.4393C17.842 14.7206 18 15.1022 18 15.5C18 15.8978 17.842 16.2794 17.5607 16.5607C17.2794 16.842 16.8978 17 16.5 17ZM7.5 17C7.10218 17 6.72064 16.842 6.43934 16.5607C6.15804 16.2794 6 15.8978 6 15.5C6 15.1022 6.15804 14.7206 6.43934 14.4393C6.72064 14.158 7.10218 14 7.5 14C7.89782 14 8.27936 14.158 8.56066 14.4393C8.84196 14.7206 9 15.1022 9 15.5C9 15.8978 8.84196 16.2794 8.56066 16.5607C8.27936 16.842 7.89782 17 7.5 17ZM4 16C4 16.88 4.39 17.67 5 18.22V20C5 20.2652 5.10536 20.5196 5.29289 20.7071C5.48043 20.8946 5.73478 21 6 21H7C7.26522 21 7.51957 20.8946 7.70711 20.7071C7.89464 20.5196 8 20.2652 8 20V19H16V20C16 20.2652 16.1054 20.5196 16.2929 20.7071C16.4804 20.8946 16.7348 21 17 21H18C18.2652 21 18.5196 20.8946 18.7071 20.7071C18.8946 20.5196 19 20.2652 19 20V18.22C19.61 17.67 20 16.88 20 16V6C20 2.5 16.42 2 12 2C7.58 2 4 2.5 4 6V16Z"
                                      fill="#fff"/>
                            </svg>
                        </div>
                        <span><b>На автобусе</b>: <?php echo $arResult['PROPERTIES']['ADDRESS_BUS']['VALUE']['TEXT']; ?></span>
                    </div>
                <?php } ?>
                <?php if (!empty($arResult['PROPERTIES']['ADDRESS_ELECTRIC']['VALUE'])) { ?>
                    <div class="route__item">
                        <div class="icon-wrap">
                            <svg width="20" height="15" viewBox="0 0 20 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0C15.634 0 19.853 3.11 19.996 7.754L20 8C20 8.79565 19.6839 9.55871 19.1213 10.1213C18.5587 10.6839 17.7956 11 17 11H1C0.734784 11 0.48043 10.8946 0.292893 10.7071C0.105357 10.5196 0 10.2652 0 10V1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H9ZM5 2H2V5H5V2ZM9 2H7V5H10V2.026C9.66695 2.00856 9.3335 1.99989 9 2ZM12.001 2.257L12 5H17.04C16.061 3.663 14.351 2.694 12.001 2.257ZM19 13C19.2652 13 19.5196 13.1054 19.7071 13.2929C19.8946 13.4804 20 13.7348 20 14C20 14.2652 19.8946 14.5196 19.7071 14.7071C19.5196 14.8946 19.2652 15 19 15H1C0.734784 15 0.48043 14.8946 0.292893 14.7071C0.105357 14.5196 0 14.2652 0 14C0 13.7348 0.105357 13.4804 0.292893 13.2929C0.48043 13.1054 0.734784 13 1 13H19Z"
                                      fill="#fff"/>
                            </svg>
                        </div>
                        <span><b>На электричке</b>: <?php echo $arResult['PROPERTIES']['ADDRESS_ELECTRIC']['VALUE']['TEXT']; ?></span>
                    </div>
                <?php } ?>
            </div>
            <div id="detail_map"></div>
        </div>
    </div>
<?php } else { ?>
    <div id="detail_map"></div>
<?php } ?>

<?php echo '<div class="container">' ?>

<script>
    window.myYaMapPlacemark = [
        <?$coords = explode(',', $arResult['PROPERTIES']['YAMAP_PLACE']['VALUE'])?>
        {
            coords: [<?=$coords[0]?>, <?=$coords[1]?>],
            name: '<?=$arResult['NAME']?>',
            id: '<?=$arResult['ID']?>',
            url: '<?=$arResult['DETAIL_PAGE_URL']?>',
            picsrc: '<?=$arResult['PREVIEW_PICTURE']['SRC']?>',
            price: '<?=$arResult['PROPERTIES']['PRICE']['VALUE'];?>',
            adress: '<?=$arResult['PROPERTIES']['ADRESS']['VALUE'];?>',
            rating: '<?=$arResult['PROPERTIES']['RATING']['VALUE'];?>',
            rating_html: '<?=\DesperadoHelpers\AppHelper::showRatingHtml($arResult['PROPERTIES']['RATING']['VALUE'], 0, false);?>',
        }
    ];
</script>


<script type="application/ld+json">
    {
        "@context" : "https://schema.org",
        "@type" : "Place",
        "name" : "<?= $arResult['NAME'] ?>",
            "url" : "https://pansionat.pro<?= $arResult['DETAIL_PAGE_URL'] ?>",
            "email" : "info@pansionat.pro",
            "telephone" : "+7 (495) 181-43-93",
            "image": [
                "https://pansionat.pro<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>"
               ],
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "<?= $coords[0] ?>",
                "longitude": "<?= $coords[1] ?>"
              },
            "address"	: {
                "@type" : "PostalAddress",
                "name" : "<?= $arResult['PROPERTIES']['ADRESS']['VALUE']; ?>"
            }
        }

</script>
<div class="block">
    <div class="container">
        <h3 class="h2">
            Документы для заселения
        </h3>
        <div class="detail_dock_wrap">
            <div class="detail_dock_item">
                <img src="/local/templates/pansion2023/static/img/pasp.jpg" alt="Паспорт" class="detail_dock_item_img">
                <span class="detail_dock_item_wrap">
                    <span class="detail_dock_item_name">
                        Паспорт
                    </span>
                </span>
            </div>
            <div class="detail_dock_item">
                <img src="/local/templates/pansion2023/static/img/polis2.jpg" alt="Полис ОМС" class="detail_dock_item_img">
                <span class="detail_dock_item_wrap">
                    <span class="detail_dock_item_name">
                        Полис ОМС
                    </span>
                </span>
            </div>
            <div class="detail_dock_item">
                <img src="/local/templates/pansion2023/static/img/snils.jpg" alt="СНИЛС" class="detail_dock_item_img">
                <span class="detail_dock_item_wrap">
                    <span class="detail_dock_item_name">
                        СНИЛС
                    </span>
                </span>
            </div>
            <div class="detail_dock_item">
                <img src="/local/templates/pansion2023/static/img/vipiska.jpg" alt="Выписка" class="detail_dock_item_img">
                <span class="detail_dock_item_wrap">
                    <span class="detail_dock_item_name">
                        Выписка (при наличии)
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($arResult['PROPERTIES']['LICENSES']['VALUE'])): ?>
<div class="block">
    <div class="container">
        <h3 class="h2">
            Лицензии
        </h3>
        <div class="licenses-slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($arResult['PROPERTIES']['LICENSES']['VALUE'] as $fileId): ?>
                    <?php
                    // Получаем данные файла по ID
                    $file = CFile::GetFileArray($fileId);
                    ?>
                    <div class="license-slide swiper-slide">

                        <img src="<?= $file['SRC'] ?>" alt="Лицензия" data-fancybox="licenses"/>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<?php endif;?>
<div class="block">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            [
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH . "/include/form-index.php",
            ]
        ); ?>
    </div>
</div>

<h2>Описание <?= $arResult['NAME'] ?></h2>

<div class="detail__text">
    <?= $arResult['PREVIEW_TEXT'] ?>

    <div class="detail__link-list">
        <?
        $propArr = [
            ['NAME' => 'Сеть пансионатов', 'SETI' => 'RAIONY'],
            ['NAME' => 'Населенный пункт', 'CODE' => 'CITY'],
            ['NAME' => 'Районы', 'CODE' => 'RAIONY'],
            ['NAME' => 'Тип', 'CODE' => 'TYPE'],
            ['NAME' => 'Направления', 'CODE' => 'NAPRAVLENIYA'],
            ['NAME' => 'Cостояние пожилого', 'CODE' => 'SOSTOYANIE'],
            ['NAME' => 'Лечение заболеваний у пожилых', 'CODE' => 'DLYZ_BOLNYH'],
        ]
        ?>
        <? foreach ($propArr as $cProp): ?>
            <? if (!empty($arResult['LINK_BUILDER'][$cProp['CODE']])): ?>
                <div class="detail__links-line">
                    <div class="detail__link-name"><?= $cProp['NAME'] ?></div>
                    <div class="detail__links">
                        <? foreach ($arResult['LINK_BUILDER'][$cProp['CODE']] as $k => $curLink): ?>
                            <? if ($k != 0): ?>, <? endif; ?>
                            <a href="<?= $curLink['LINK'] ?>"
                               class="detail__link-item"><?= $curLink['NAME'] ?></a>
                        <? endforeach; ?>
                    </div>
                </div>
            <? endif; ?>
        <? endforeach; ?>
    </div>
</div>

<div class="detail__features">
    <? foreach ($arResult['PROPERTIES']['OSOBENNOSTI']['VALUE'] as $item): ?>
        <div class="detail__feature-item">
            <?= showFeatureItem($item); ?>
        </div>
    <? endforeach; ?>
</div>

<div class="detail__text">
    <?= $arResult['DETAIL_TEXT'] ?>
</div>

<? if (!empty($arResult['PROPERTIES']['SAME_PANS']['VALUE'])): ?>
    <h3 class="h2">Похожие пансионаты</h3>

    <?
    global $arrFilter;
    $arrFilter = ['ID' => ['234', '235', '236', '237', '238', '239', '240', '1', '4', '5', '10', '14', '18', '19', '20', '6', '7', '8', '9']];
    ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "",
        [
            "ACTION_VARIABLE" => "action",
            "ADD_PICT_PROP" => "-",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "BACKGROUND_IMAGE" => "-",
            "BASKET_URL" => "/personal/basket.php",
            "BROWSER_TITLE" => "-",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COMPATIBLE_MODE" => "Y",
            "DETAIL_URL" => "",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_COMPARE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_SORT_FIELD" => "RAND",
            "ELEMENT_SORT_FIELD2" => "ID",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_ORDER2" => "desc",
            "ENLARGE_PRODUCT" => "STRICT",
            "FILTER_NAME" => "arrFilter",
            "IBLOCK_ID" => "1",
            "IBLOCK_TYPE" => "pansionat",
            "INCLUDE_SUBSECTIONS" => "Y",
            "LABEL_PROP" => [],
            "LAZY_LOAD" => "N",
            "LINE_ELEMENT_COUNT" => "4",
            "LOAD_ON_SCROLL" => "N",
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "OFFERS_LIMIT" => "5",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Товары",
            "PAGE_ELEMENT_COUNT" => "3",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRICE_CODE" => [],
            "PRICE_VAT_INCLUDE" => "Y",
            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "PROPERTY_CODE_MOBILE" => [],
            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
            "RCM_TYPE" => "personal",
            "SECTION_CODE" => "",
            "SECTION_ID" => "",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SECTION_URL" => "",
            "SECTION_USER_FIELDS" => ["", ""],
            "SEF_MODE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
            "SHOW_FROM_SECTION" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "SHOW_SLIDER" => "Y",
            "SLIDER_INTERVAL" => "3000",
            "SLIDER_PROGRESS" => "N",
            "TEMPLATE_THEME" => "blue",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_PRICE_COUNT" => "N",
            "USE_PRODUCT_QUANTITY" => "N",
        ]
    ); ?>
<? endif; ?>

<?
$t = $_COOKIE['BX_VIEWED_ID'];
if (strlen($t) > 0) {

    ?>
    <div class="h2">Вы недавно смотрели</div><?
    $vafId = explode(',', $t);

    global $arrFilter;

    $arrFilter = ['ID' => $vafId];

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "",
        [
            "ACTION_VARIABLE" => "action",
            "ADD_PICT_PROP" => "-",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "BACKGROUND_IMAGE" => "-",
            "BASKET_URL" => "/personal/basket.php",
            "BROWSER_TITLE" => "-",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COMPATIBLE_MODE" => "Y",
            "DETAIL_URL" => "",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_COMPARE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_SORT_FIELD" => "id",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_ORDER2" => "desc",
            "ENLARGE_PRODUCT" => "STRICT",
            "FILTER_NAME" => "arrFilter",
            "IBLOCK_ID" => "1",
            "IBLOCK_TYPE" => "pansionat",
            "INCLUDE_SUBSECTIONS" => "Y",
            "LABEL_PROP" => [],
            "LAZY_LOAD" => "N",
            "LINE_ELEMENT_COUNT" => "4",
            "LOAD_ON_SCROLL" => "N",
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "OFFERS_LIMIT" => "5",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Товары",
            "PAGE_ELEMENT_COUNT" => "3",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRICE_CODE" => [],
            "PRICE_VAT_INCLUDE" => "Y",
            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "PROPERTY_CODE_MOBILE" => [],
            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
            "RCM_TYPE" => "personal",
            "SECTION_CODE" => "",
            "SECTION_ID" => "",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SECTION_URL" => "",
            "SECTION_USER_FIELDS" => ["", ""],
            "SEF_MODE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
            "SHOW_FROM_SECTION" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "SHOW_SLIDER" => "Y",
            "SLIDER_INTERVAL" => "3000",
            "SLIDER_PROGRESS" => "N",
            "TEMPLATE_THEME" => "blue",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_PRICE_COUNT" => "N",
            "SORT_ARR" => $vafId,
            "USE_PRODUCT_QUANTITY" => "N",
        ]
    );

}
?>

<div class="h2-title">Отзывы о <?= $arResult['NAME'] ?></div>

<div class="detail__reviews">
    <div class="detail__reviews-left">
        <?
        global $revFilter;
        $revFilter = ['PROPERTY_EL_ID' => $arResult['ID']];
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "reviews",
            [
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => [
                    0 => "DETAIL_PICTURE",
                    1 => "",
                ],
                "FILTER_NAME" => "revFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "4",
                "IBLOCK_TYPE" => "pansionat",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "round",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => [
                    0 => "DATE",
                    1 => "NAME",
                    2 => "OB_RATING",
                    3 => "RATING_COMFORT",
                    4 => "RATING_LECH",
                    5 => "RATING_OBSL",
                    6 => "RATING_PLACE",
                    7 => "RATING_REC",
                    8 => "RATING_YUT",
                    9 => "TEXT",
                    10 => "EMAIL",
                    11 => "",
                ],
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "reviews",
            ],
            false
        ); ?>

        <div class="detail__reviews-buttons-wrapper">
            <a href="/otzyvy-<?= $arResult['CODE'] ?>/" class="detail__reviews-all-button">Смотреть все отзывы</a>
            <a href="/otzyvy-<?= $arResult['CODE'] ?>/#addReview" class="detail__reviews-add-button">Добавить отзыв</a>
        </div>
    </div>

    <div class="detail__reviews-right">
        <div class="detail__reviews-panel">
            <div class="detail__reviews-panel-title">
                <?php \DesperadoHelpers\AppHelper::showIcon('quote'); ?>
                <?= $arResult['PROPERTIES']['PRC_REC']['VALUE'] ?>% людей рекомендуют это заведение
            </div>

            <div class="detail__reviews-panel-line">
                <?
                $val = (int)$arResult['PROPERTIES']['SR_RATING_PLACE']['VALUE'];
                $prc = $val / (5 / 100);
                ?>
                Расположение
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = (int)$arResult['PROPERTIES']['SR_RATING_OBSL']['VALUE'];
                $prc = $val / (5 / 100);
                ?>
                Обслуживание
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = (int)$arResult['PROPERTIES']['SR_RATING_UYT']['VALUE'];
                $prc = $val / (5 / 100);
                ?>
                Уют
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = (int)$arResult['PROPERTIES']['SR_RATING_KOMFORT']['VALUE'];
                $prc = $val / (5 / 100);
                ?>
                Комфорт
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = (int)$arResult['PROPERTIES']['SR_RATING_LECH']['VALUE'];
                $prc = $val / (5 / 100);
                ?>
                Лечение
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
        </div>
    </div>
</div>

<script>document.addEventListener("Add2Viewed", function () {
        window.addToViewed(<?=$arResult['ID']?>);
    });</script>
