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
            $img = 'computer.svg';
            break;

        case 'В пансионате есть лифт':
            $img = 'elevator.svg';
            break;

        case '6-ти разовое питание':
        case '5-ти разовое питание':
        case '4-х разовое питание':
        case '3-х разовое питание':
            $img = 'diet.svg';
            break;

        case 'Прогулки на территории':
            $img = 'walker.svg';
            break;

        case 'Контроль за приемом лекарств':
            $img = 'report.svg';
            break;

        case 'Специальные условия для больных с деменцией':
            $img = 'aids.svg';
            break;

        case 'Для заселения необходимы: паспорт и полис':
            $img = 'passport.svg';
            break;

        case 'Развлекательные мероприятия':
            $img = 'theater.svg';
            break;

        case 'Регулярный осмотр врача':
            $img = 'nurse.svg';
            break;

        case 'Полный гигиенический и косметический уход':
            $img = 'skin.svg';
            break;

        case 'Медицинское и специальное оборудование':
            $img = 'bed.svg';
            break;

        case 'Реабилитация больных':
            $img = 'healthcare-and-medical.svg';
            break;

        case 'Лечебные процедуры':
            $img = 'drug.svg';
            break;

        case 'Мед.персонал':
            $img = 'doctor.svg';
            break;

        case 'Развивающие игры':
            $img = 'jigsaw.svg';
            break;

        case 'Реабилитация после инсульта':
            $img = 'infrared.svg';
            break;

        case 'Реабилитация после операции':
            $img = 'healthcare-and-medical.svg';
            break;

        case 'Штатный врач':
            $img = 'nurse.svg';
            break;

        case 'Мест в номере 2-5':
        case 'Мест в номере 2-4':
        case 'Мест в номере 3-6':
        case 'Мест в номере 2':
        case 'Мест в номере 3':
        case 'Мест в номере 4':
        case 'Мест в номере 1':
            $img = 'bed2.svg';
            break;

        case 'Беспроводная палатная сигнализация':
            $img = 'siren.svg';
            break;

        case 'Автостоянка':
            $img = 'parking-lot.svg';
            break;

        case 'Большая территория для прогулок, сад, беседки':
            $img = 'brazil.svg';
            break;

        case 'Всегда чисто и очень уютно':
            $img = 'window.svg';
            break;

        case 'Забота и доброжелательность персонала':
            $img = 'care.svg';
            break;

        case 'Инфраструктура для колясочников':
            $img = 'disability.svg';
            break;

        case 'Функциональные кровати для лежачих больных':
            $img = 'bed3.svg';
            break;

        case 'Wi-Fi':
            $img = 'internet.svg';
            break;

        case 'Собственный транспорт для трансфера':
            $img = 'bus.svg';
            break;

        case 'Огороженная и охраняемая территория':
            $img = 'shield.svg';
            break;

        case 'Медицинское обслуживание':
            $img = 'medical-kit.svg';
            break;

        case 'Круглосуточный уход (24/7)':
            $img = '24-hours.svg';
            break;

    }


    return '<div class="img_wrapper"><img src="/local/templates/pansion/img/futures/' . $img . '">
    </div><div class="text_wrapper">' . $name . '</div>';
}

?>
<div itemscope itemtype="https://schema.org/Place">
    <meta itemprop="name" content="<?= $arResult['NAME'] ?>">
    <div class="row detail_element">

        <div class="item_wrapper left_section">
            <div class="item">

                <div class="bages_images">
                    <div class="close">
                        <img src="/local/templates/pansion/img/close.svg" height="12" alt="">
                    </div>
                    <div class="bage_item">
                        <div class="img_wrapper">
                            <img src="/local/templates/pansion/img/speech-bubble.svg" alt="">
                        </div>
                        <div class="text_wrapper">
                            <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_COMMEND']['VALUE'] ?>
                                хвалят</p>
                            <p class="sub_title">люди хвалят его в своих отзывах</p>
                        </div>
                    </div>
                    <? if (!empty($arResult['REVIEWS'])): ?>
                        <div class="bage_item">
                            <div class="img_wrapper">

                            </div>
                            <div class="text_wrapper">
                                <div style="max-width: 210px">
                                    <div class="js-reviews-slider">
                                        <? foreach ($arResult['REVIEWS'] as $item): ?>
                                            <div>
                                                <p class="text"><?= TruncateText(strip_tags(htmlspecialcharsBack($item['PROPERTY_TEXT_VALUE']['TEXT'])), 100) ?></p>
                                                <p class="title"><?= $item['NAME'] ?></p>
                                            </div>
                                        <? endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                    <div class="bage_item">
                        <div class="img_wrapper">
                            <img src="/local/templates/pansion/img/key.svg" alt="">
                        </div>
                        <div class="text_wrapper">
                            <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_ORDER']['VALUE'] ?>
                                забронировали</p>
                            <p class="sub_title">за последние 2 месяца</p>
                        </div>
                    </div>
                </div>

                <div class="big_images">
                    <? foreach ($arResult['SLIDER_PICTURES'] as $key => $pic): ?>
                        <div class="big_pic_wrapper"
                             href="<?= $pic['SRC'] ?>"
                             data-fancybox="gallery"
                            <? if ($key == 0): ?>
                                style="background-image: url('<?= $pic['SRC'] ?>')"
                                itemprop="image" src="<?= $pic['SRC'] ?>"
                            <? else: ?>
                                data-lazy-src="<?= $pic['SRC'] ?>"
                            <? endif; ?>
                        >
                        </div>
                    <? endforeach; ?>
                </div>

                <div class="small_images">
                    <? foreach ($arResult['SLIDER_PICTURES'] as $key => $pic): ?>
                        <div class="small_pic_wrapper"
                            <? if ($key < 6): ?>
                                style="background-image: url('<?= $pic['SRC'] ?>')"
                            <? else: ?>
                                data-lazy-src="<?= $pic['SRC'] ?>"
                            <? endif; ?>
                        ></div>

                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <div class="item_wrapper right_section">
            <div class="item">
                <div class="info_section">
                    <p class="rating_line">
                        <? AppHelper::showRatingHtml(
                            $arResult['PROPERTIES']['RATING']['VALUE'],
                            $arResult['PROPERTIES']['NUM_VOTES']['VALUE'],
                            true
                        ) ?>
                        <span class="recommendet">
                        <?= $arResult['PROPERTIES']['PRC_REC']['VALUE'] ?>% рекомендуют
                    </span>

                        <!--                    <span class="element_actions compare" data-item-id="-->
                        <? //=$arResult['ID']?><!--"></span>-->
                        <span class="element_actions favorite js-tooltip" title="Добавить в избранное"
                              data-item-id="<?= $arResult['ID'] ?>"></span>

                    </p>
                    <p class="id_wrap">
                        id пансионата: <?= $arResult['ID'] ?>
                    </p>

                    <? if (!empty($arResult['PROPERTIES']['OLD_PRICE']['VALUE'])): ?>
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

                    <p class="price">
                        <meta itemprop="url"
                              content="https://<?= SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) ?>">
                        от <span><?= AppHelper::CurrencyFormat($arResult['PROPERTIES']['PRICE']['VALUE']); ?></span>
                        руб/сутки
                    </p>
                    <p class="adress" itemprop="address">
                        <?= $arResult['PROPERTIES']['ADRESS']['VALUE'] ?>
                    </p>
                    <? if (!empty($arResult['SETI'])): ?>
                        <p class="pans_set">Сеть пансионатов: <?= $arResult['SETI'] ?></p>
                    <? endif; ?>
                    <p class="phone">
                        <a href="tel:+74951814393">+7 (495) 181-43-93</a> <span>Справочная служба 24/7</span>
                    </p>

                    <span class="red_button js-show-modal"
                          onclick="yaCounter55993486.reachGoal('button_6'); return true;"
                          data-modal="callback" data-metrika="button_7">Бесплатная консультация</span>
                    <span class="fiol_button js-show-modal"
                          onclick="yaCounter55993486.reachGoal('button_8'); return true;"
                          data-modal="takerent" data-metrika="button_9" data-id="<?= $arResult['ID'] ?>">Поставить в бронь</span>
                </div>

                <div class="bages_section">
                    <p class="title">Это заведение любят</p>

                    <div class="bage_item">
                        <div class="img_wrapper">
                            <img src="/local/templates/pansion/img/speech-bubble.svg" alt="">
                        </div>
                        <div class="text_wrapper">
                            <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_COMMEND']['VALUE'] ?>
                                хвалят</p>
                        </div>
                    </div>

                    <div class="bage_item">
                        <div class="img_wrapper">
                            <img src="/local/templates/pansion/img/like.svg" alt="">
                        </div>
                        <div class="text_wrapper">
                            <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_LIKE']['VALUE'] ?> нравится</p>
                            <p class="sub_title">расположение, обслуживание, уют, комфорт</p>
                        </div>
                    </div>

                    <div class="bage_item">
                        <div class="img_wrapper">
                            <img src="/local/templates/pansion/img/key.svg" alt="">
                        </div>
                        <div class="text_wrapper">
                            <p class="title"><?= $arResult['PROPERTIES']['THIS_PLACE_ORDER']['VALUE'] ?>
                                забронировали</p>
                            <p class="sub_title">за последние 2 месяца</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? // echo '</div>' ?>
    <div id="detail_map">

    </div>
    <script>
        myYaMapPlacemark = [
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
    <div itemprop="geo" itemscope="" itemtype="https://schema.org/GeoCoordinates" style="display: none">
        <meta itemprop="latitude" content="<?=$coords[0]?>">
        <meta itemprop="longitude" content="<?=$coords[1]?>">
    </div>
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

    <div class="detail_fiol_wrapper">
        <div class="container">

            <p class="title">Нужна консультация? <a href="tel:+74951814393">+7 (495) 181-43-93</a></p>

            <form action="/dev/null" class="white js-simpleForm" data-metrika="button_4">
                <div class="row">
                    <div class="item_wrapper">
                        <div class="item">
                            <input type="text" name="name" placeholder="Ваше имя" autocomplete="off">
                        </div>
                    </div>

                    <div class="item_wrapper">
                        <div class="item">
                            <input type="text" name="phone" class="js-phone" placeholder="Номер телефона"
                                   autocomplete="off">
                        </div>
                    </div>

                    <div class="item_wrapper">
                        <div class="item">
                            <button>Получить консультацию</button>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="modal_action" value="callback">
            </form>
        </div>
    </div>
    <? // echo '<div class="container">' ?>

    <div class="detail_element_info">
        <h2>Удобства и описание пансионата</h2>
        <div class="text">
            <?= $arResult['PREVIEW_TEXT'] ?>

            <ul class="text_ul">
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
                        <li><?= $cProp['NAME'] ?> -
                            <? foreach ($arResult['LINK_BUILDER'][$cProp['CODE']] as $k => $curLink): ?>
                                <? if ($k != 0): ?>, <? endif; ?>
                                <a href="<?= $curLink['LINK'] ?>"><?= $curLink['NAME'] ?></a>
                            <? endforeach; ?>
                        </li>
                    <? endif; ?>
                <? endforeach; ?>
            </ul>
        </div>

        <div class="row features">
            <? foreach ($arResult['PROPERTIES']['OSOBENNOSTI']['VALUE'] as $item): ?>
                <div class="item_wrapper">
                    <div class="item">
                        <?= showFeatureItem($item); ?>
                    </div>
                </div>
            <? endforeach; ?>
        </div>

        <div class="text">
            <?= $arResult['DETAIL_TEXT'] ?>
        </div>
    </div>

    <? if (!empty($arResult['PROPERTIES']['SAME_PANS']['VALUE'])): ?>
        <div class="like_h2">Похожие предложения</div>

        <?
        global $arrFilter;
        $arrFilter = array('ID' => array('234', '235', '236', '237', '238', '239', '240', '1', '4', '5', '10', '14', '18', '19', '20', '6', '7', '8', '9'));
        ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "",
            array(
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
                "LABEL_PROP" => array(),
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
                "PAGE_ELEMENT_COUNT" => "4",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PROPERTY_CODE_MOBILE" => array(),
                "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                "RCM_TYPE" => "personal",
                "SECTION_CODE" => "",
                "SECTION_ID" => "",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array("", ""),
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
                "USE_PRODUCT_QUANTITY" => "N"
            )
        ); ?>
    <? endif; ?>

    <?

    $t = $_COOKIE['BX_VIEWED_ID'];

    if (strlen($t) > 0) {

        ?>
        <div class="like_h2">Вы недавно смотрели</div><?
        $vafId = explode(',', $t);

        global $arrFilter;

        $arrFilter = array('ID' => $vafId);

        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "",
            array(
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
                "LABEL_PROP" => array(),
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
                "PAGE_ELEMENT_COUNT" => "4",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PROPERTY_CODE_MOBILE" => array(),
                "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                "RCM_TYPE" => "personal",
                "SECTION_CODE" => "",
                "SECTION_ID" => "",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array("", ""),
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
                "USE_PRODUCT_QUANTITY" => "N"
            )
        );

    }
    ?>


    <div class="like_h2">Отзывы</div>

    <div class="element_reviews_wrapper row">
        <div class="item_wrapper left_section">
            <div class="item">
                <? if (empty($arResult['REVIEWS'])): ?>
                    <p>У этого пансионата нет ни одного отзыва.</p>
                <? endif; ?>
                <? foreach ($arResult['REVIEWS'] as $item): ?>

                    <div class="reviews_item" id="<?= $item['ID'] ?>" itemscope itemprop="review"
                         itemtype="http://schema.org/Review">
                        <meta name="url"
                              content="https://<?= SITE_SERVER_NAME . $APPLICATION->GetCurPage(false) ?>">
                        <p class="name">
                            <b itemprop="name"><?= $item['PROPERTY_NAME_VALUE'] ?></b>
                            <meta itemprop="author" content="<?= $item['PROPERTY_NAME_VALUE'] ?>">
                            <span itemprop="datePublished"><?= $item['PROPERTY_DATE_VALUE'] ?></span>
                        </p>
                        <p class="rating_line" itemprop="reviewRating" itemscope
                           itemtype="http://schema.org/Rating">
                            <? AppHelper::showRatingHtml($item['PROPERTY_OB_RATING_VALUE']) ?>
                            <meta itemprop="ratingValue"
                                  content="<?= $item['PROPERTY_OB_RATING_VALUE'] ?>">
                            <meta itemprop="worstRating" content="1">
                            <meta itemprop="bestRating" content="5">
                        </p>
                        <p class="text" itemprop="reviewBody">
                            <?= htmlspecialcharsBack($item['PROPERTY_TEXT_VALUE']['TEXT']) ?>
                        </p>
                    </div>

                <? endforeach; ?>

                <div class="like_h2 text_center">Написать отзыв</div>

                <form action="/dev/null" class="shadow js-addReview">

                    <div class="row top_row">
                        <div class="item_wrapper">
                            <div class="item">
                                <p class="title">Общая оценка</p>
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <p class="rating_line js-ratingStars">
                                    <? AppHelper::showRatingHtml(4) ?>
                                    <input type="hidden" name="allRating" value="4">
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row top_row">
                        <div class="item_wrapper">
                            <div class="item">
                                <p class="title" style="line-height: 46px">Дата прибывания</p>
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <input type="text" class="js-datepicker" value="<?= date("d.m.Y"); ?>" name="date"
                                       autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <p class="title">Оценки</p>

                    <div class="row rating_row">
                        <div class="item_wrapper">
                            <div class="item">
                                <p>Рекомендую</p>
                                <p class="rating_line js-ratingStars">
                                    <? AppHelper::showRatingHtml(4) ?>
                                    <input type="hidden" name="ratingRec" value="4">
                                </p>
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <p>Расположение</p>
                                <p class="rating_line js-ratingStars">
                                    <? AppHelper::showRatingHtml(4) ?>
                                    <input type="hidden" name="ratingRasp" value="4">
                                </p>
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <p>Комфорт</p>
                                <p class="rating_line js-ratingStars">
                                    <? AppHelper::showRatingHtml(4) ?>
                                    <input type="hidden" name="ratingKomf" value="4">
                                </p>
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <p>Уют</p>
                                <p class="rating_line js-ratingStars">
                                    <? AppHelper::showRatingHtml(4) ?>
                                    <input type="hidden" name="ratingYut" value="4">
                                </p>
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <p>Обслуживание</p>
                                <p class="rating_line js-ratingStars">
                                    <? AppHelper::showRatingHtml(4) ?>
                                    <input type="hidden" name="ratingObsl" value="4">
                                </p>
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <p>Лечение</p>
                                <p class="rating_line js-ratingStars">
                                    <? AppHelper::showRatingHtml(4) ?>
                                    <input type="hidden" name="ratingLech" value="4">
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row input_row">
                        <div class="item_wrapper">
                            <div class="item">
                                <input type="text" name="name" placeholder="Ваше имя" autocomplete="off">
                            </div>
                        </div>

                        <div class="item_wrapper">
                            <div class="item">
                                <input type="text" name="email" placeholder="Эл. почта" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row text_row">
                        <div class="item_wrapper">
                            <textarea name="text" placeholder="Что вам понравилось" autocomplete="off"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="modal_action" value="addreview">
                    <input type="hidden" name="pansionat" value="<?= $arResult['ID'] ?>">

                    <button>Отправить отзыв</button>

                </form>
            </div>
        </div>

        <div class="item_wrapper right_section">
            <div class="item">
                <div class="rating_bottom">
                    <div class="title">
                        <img src="/local/templates/pansion/img/quote.svg" alt="">
                        <?= $arResult['PROPERTIES']['PRC_REC']['VALUE'] ?>% людей рекомендуют это заведение
                    </div>

                    <div class="line">
                        <?
                        $val = $arResult['PROPERTIES']['SR_RATING_PLACE']['VALUE'];
                        $prc = $val / (5 / 100);
                        ?>
                        Расположение
                        <span><?= $val ?></span>
                        <div class="grey"></div>
                        <div class="fiol" style="width: <?= $prc ?>%"></div>
                    </div>

                    <div class="line">
                        <?
                        $val = $arResult['PROPERTIES']['SR_RATING_OBSL']['VALUE'];
                        $prc = $val / (5 / 100);
                        ?>
                        Обслуживание
                        <span><?= $val ?></span>
                        <div class="grey"></div>
                        <div class="fiol" style="width: <?= $prc ?>%"></div>
                    </div>

                    <div class="line">
                        <?
                        $val = $arResult['PROPERTIES']['SR_RATING_UYT']['VALUE'];
                        $prc = $val / (5 / 100);
                        ?>
                        Уют
                        <span><?= $val ?></span>
                        <div class="grey"></div>
                        <div class="fiol" style="width: <?= $prc ?>%"></div>
                    </div>

                    <div class="line">
                        <?
                        $val = $arResult['PROPERTIES']['SR_RATING_KOMFORT']['VALUE'];
                        $prc = $val / (5 / 100);
                        ?>
                        Комфорт
                        <span><?= $val ?></span>
                        <div class="grey"></div>
                        <div class="fiol" style="width: <?= $prc ?>%"></div>
                    </div>

                    <div class="line">
                        <?
                        $val = $arResult['PROPERTIES']['SR_RATING_LECH']['VALUE'];
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
    </div>

    <script>

        document.addEventListener("Add2Viewed", function () {
            window.addToViewed(<?=$arResult['ID']?>);
        });
    </script>
</div>
