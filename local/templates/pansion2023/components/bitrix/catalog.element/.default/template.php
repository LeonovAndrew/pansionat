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
                        <? AppHelper::showRatingHtmlNew(
                            $arResult['PROPERTIES']['RATING']['VALUE'],
                            $arResult['PROPERTIES']['NUM_VOTES']['VALUE'],
                            true
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
                </div>

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
<div class="container" style="margin-top: 40px"><h2><?= $arResult['NAME'] ?> на карте</h2></div>
<div id="detail_map"></div>
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

<h2 style="margin: 40px 0">Отзывы о <?= $arResult['NAME'] ?></h2>

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
