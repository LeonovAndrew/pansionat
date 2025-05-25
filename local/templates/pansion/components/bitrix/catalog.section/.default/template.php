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

<div class="row catalog_section line<?= $arParams['LINE_ELEMENT_COUNT'] ?>">
    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
        <? if ($key == 3 && $arParams['SHOW_FORM'] == 'Y'): ?>
            <div class="catalog_form_wrapper hide-tablet">
                <div class="catalog_form">

                    <img src="/local/templates/pansion/img/lifebuoy.svg" alt="" class="float_image">

                    <p class="title">Бесплатный подбор пансионата</p>
                    <p class="sub_title">с подробной рекомендацией по размещению и расчётом стоимости</p>

                    <form action="/dev/null" class="shadow js-simpleForm" data-metrika="button_5">
                        <div class="row">
                            <div class="item_wrapper">
                                <div class="item">
                                    <input type="text" placeholder="Ваше имя" name="name" autocomplete="off">
                                </div>
                            </div>

                            <div class="item_wrapper">
                                <div class="item">
                                    <input type="text" placeholder="Номер телефона" class="js-phone" name="phone"
                                           autocomplete="off">
                                </div>
                            </div>

                            <div class="item_wrapper">
                                <div class="item">
                                    <button>Подобрать</button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="modal_action" value="callback">
                    </form>
                </div>
            </div>
        <? endif; ?>
        <? if ($key == 4 && $arParams['SHOW_FORM'] == 'Y'): ?>
            <div class="catalog_form_wrapper show-tablet">
                <div class="catalog_form">

                    <img src="/local/templates/pansion/img/lifebuoy.svg" alt="" class="float_image">

                    <p class="title">Бесплатный подбор пансионата</p>
                    <p class="sub_title">с подробной рекомендацией по размещению и расчётом стоимости</p>

                    <form action="/dev/null" class="shadow js-simpleForm" data-metrika="button_4">
                        <div class="row">
                            <div class="item_wrapper">
                                <div class="item">
                                    <input type="text" placeholder="Ваше имя" name="name" autocomplete="off">
                                </div>
                            </div>

                            <div class="item_wrapper">
                                <div class="item">
                                    <input type="text" placeholder="Номер телефона" class="js-phone" name="phone"
                                           autocomplete="off">
                                </div>
                            </div>

                            <div class="item_wrapper">
                                <div class="item">
                                    <button>Подобрать</button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="modal_action" value="callback">
                    </form>
                </div>
            </div>
        <? endif; ?>
        <div class="item_wrapper">
            <div class="section_item" data-offer-id="<?= $item['ID'] ?>">
                <div class="img_js_wrapper">
                    <div class="js_sectionSlider">
                        <? foreach ($item['SLIDER_PICTURES'] as $key => $img): ?>
                            <? if ($key == 0): ?>
                                <div class="img_wrapper"
                                     onclick="window.location.href='<?= $item['DETAIL_PAGE_URL'] ?>'"
                                     style="background-image: url('<?= $img['SRC'] ?>')"></div>
                            <? else: ?>
                                <div class="img_wrapper"
                                     data-lazy-src="<?= $img['SRC'] ?>"
                                     onclick="window.location.href='<?= $item['DETAIL_PAGE_URL'] ?>'"></div>
                            <? endif; ?>
                        <? endforeach; ?>
                    </div>
                    <? if (count($item['SLIDER_PICTURES']) > 1): ?>
                        <div class="photo_cnt">
                            <img src="/local/templates/pansion/img/camera.svg" alt="">
                            <div class="js-text">1/<?= count($item['SLIDER_PICTURES']) ?></div>
                        </div>
                    <? endif; ?>
                    <span class="element_actions favorite js-tooltip" title="Добавить в избранное"
                          data-item-id="<?= $item['ID'] ?>"></span>
                </div>
                <div class="description">
                    <p class="name">
                        <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
                    </p>
                    <p class="rating_line">
                        <? AppHelper::showRatingHtml(
                            $item['PROPERTIES']['RATING']['VALUE'],
                            $item['PROPERTIES']['NUM_VOTES']['VALUE'],
                            true
                        ) ?>
                        <span class="recommendet">
                                <?= $item['PROPERTIES']['PRC_REC']['VALUE'] ?>% рекомендуют
                            </span>
                    </p>
                    <p class="adress">
                        <?= $item['PROPERTIES']['ADRESS']['VALUE'] ?>
                    </p>
                    <p class="discount">
                        <? if (!empty($item['PROPERTIES']['OLD_PRICE']['VALUE'])): ?>
                            <?
                            $oldPrice = $item['PROPERTIES']['OLD_PRICE']['VALUE'];
                            $curPrice = $item['PROPERTIES']['PRICE']['VALUE'];
                            $prc = ($oldPrice - $curPrice) / ($oldPrice / 100);
                            ?>
                            <? if ($oldPrice > $curPrice): ?>
                                <span class="old_price"><?= AppHelper::CurrencyFormat($oldPrice); ?></span>
                                <span class="prc">-<?= intval($prc) ?>%</span><span
                                        class="vigoda"
                                >Выгода&nbsp;<?= AppHelper::CurrencyFormat(($oldPrice - $curPrice), 'RUB'); ?>&nbsp;руб.</span>
                            <? endif; ?>
                        <? else: ?>
                            &nbsp;
                        <? endif; ?>
                    </p>
                    <p class="price">
                        от <?= AppHelper::CurrencyFormat($item['PROPERTIES']['PRICE']['VALUE']); ?> руб/сутки
                    </p>
                    <p class="timer">
                        <? if (!empty($item['PROPERTIES']['SALE_END_DATE']['VALUE'])): ?>
                            <?
                            $salaDate = MakeTimeStamp($item['PROPERTIES']['SALE_END_DATE']['VALUE']);
                            if ($salaDate > time()) {
                                ?>
                                До конца акции:
                                <span class="js-countDown"
                                      data-date="<?= MakeTimeStamp($item['PROPERTIES']['SALE_END_DATE']['VALUE']) * 1000 ?>"></span>
                            <? } ?>
                        <? endif; ?>
                    </p>
                </div>
                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="red_button">Подробнее</a>
            </div>
        </div>
    <? endforeach; ?>
</div>

<? if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
    <div class="pagination_wrapper">
        <?= $arResult['NAV_STRING'] ?>
    </div>
<? endif; ?>

