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


$smallFile = CFile::ResizeImageGet(
    $arResult['PREVIEW_PICTURE'],
    array('width' => 200, 'height' => 200),
    BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);


?>

<div class="small-detail__wrapper">
    <div class="small-detail">
        <div class="small-detail__img-wrapper">
            <img src="<?= $smallFile['src'] ?>" alt="<?= $arResult['NAME'] ?>">
        </div>
        <div class="small-detail__content">
            <div class="small-detail__bages">

            </div>
            <div class="small-detail__adres">
                <?= $arResult['PROPERTIES']['ADRESS']['VALUE'] ?>
            </div>
            <div class="small-detail__actions">
                <div class="small-detail__price">
                    от <span><?= AppHelper::CurrencyFormat($arResult['PROPERTIES']['PRICE']['VALUE']); ?></span>
                    руб/сутки
                </div>
                <a href="<?= $arResult['DETAIL_PAGE_URL'] ?>" class="small-detail__link">Подробнее о пансионате</a>
                <div class="small-detail__red-button"
                     data-modal="callback" data-metrika="button_7">Бесплатная консультация
                </div>
                <div class="small-detail__fiol-button" data-modal="takerent" data-id="<?= $arResult['ID'] ?>"
                     data-metrika="button_9">Забронировать
                </div>
            </div>
        </div>
    </div>
</div>

<div style="margin: 40px 0"></div>

<div class="detail__reviews">
    <div class="detail__reviews-left">
        <?
        global $revFilter;
        $revFilter = ['PROPERTY_EL_ID' => $arResult['ID']];
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "reviews",
            array(
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
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "DETAIL_PICTURE",
                    1 => "",
                ),
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
                "PROPERTY_CODE" => array(
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
                ),
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
                "COMPONENT_TEMPLATE" => "reviews"
            ),
            false
        ); ?>

        <a name="addReview" id="addReview"></a>
        <div class="add-review">

            <div class="h2">Написать отзыв</div>

            <form action="/dev/null" class="simple js-addReview">

                <div class="add-review__row">
                    <div class="add-review__row-quarter">
                        <div class="add-review__title">Общая оценка</div>
                    </div>

                    <div class="add-review__row-quarter">
                        <div class="inline-rating js-ratingStars">
                            <? AppHelper::showRatingHtmlNew(4) ?>
                            <input type="hidden" name="allRating" value="4">
                        </div>
                    </div>

                    <div class="add-review__row-half"></div>
                </div>

                <div class="add-review__row">
                    <div class="add-review__row-quarter">
                        <div class="add-review__title">Дата прибывания</div>
                    </div>

                    <div class="add-review__row-quarter">
                        <input type="text" class="js-datepicker" value="<?= date("d.m.Y"); ?>" name="date"
                               autocomplete="off">
                    </div>

                    <div class="add-review__row-half"></div>
                </div>

                <div class="add-review__title">Оценки</div>

                <div class="add-review__row-flex">
                    <div class="add-review__row-flex-item">
                        <div class="add-review__sub-title">Рекомендую</div>
                        <div class="inline-rating js-ratingStars">
                            <? AppHelper::showRatingHtmlNew(4) ?>
                            <input type="hidden" name="ratingRec" value="4">
                        </div>
                    </div>

                    <div class="add-review__row-flex-item">
                        <div class="add-review__row-flex-item">
                            <div class="add-review__sub-title">Расположение</div>
                            <div class="inline-rating js-ratingStars">
                                <? AppHelper::showRatingHtmlNew(4) ?>
                                <input type="hidden" name="ratingRasp" value="4">
                            </div>
                        </div>
                    </div>

                    <div class="add-review__row-flex-item">
                        <div class="add-review__row-flex-item">
                            <div class="add-review__sub-title">Комфорт</div>
                            <div class="inline-rating js-ratingStars">
                                <? AppHelper::showRatingHtmlNew(4) ?>
                                <input type="hidden" name="ratingKomf" value="4">
                            </div>
                        </div>
                    </div>

                    <div class="add-review__row-flex-item">
                        <div class="add-review__row-flex-item">
                            <div class="add-review__sub-title">Уют</div>
                            <div class="inline-rating js-ratingStars">
                                <? AppHelper::showRatingHtmlNew(4) ?>
                                <input type="hidden" name="ratingYut" value="4">
                            </div>
                        </div>
                    </div>

                    <div class="add-review__row-flex-item">
                        <div class="add-review__row-flex-item">
                            <div class="add-review__sub-title">Обслуживание</div>
                            <div class="inline-rating js-ratingStars">
                                <? AppHelper::showRatingHtmlNew(4) ?>
                                <input type="hidden" name="ratingObsl" value="4">
                            </div>
                        </div>
                    </div>

                    <div class="add-review__row-flex-item">
                        <div class="add-review__row-flex-item">
                            <div class="add-review__sub-title">Лечение</div>
                            <div class="inline-rating js-ratingStars">
                                <? AppHelper::showRatingHtmlNew(4) ?>
                                <input type="hidden" name="ratingLech" value="4">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-review__row">
                    <div class="add-review__row-half">
                        <input type="text" name="name" placeholder="Ваше имя" autocomplete="off">
                    </div>

                    <div class="add-review__row-half">
                        <input type="text" name="email" placeholder="Эл. почта" autocomplete="off">
                    </div>
                </div>

                <div class="add-review__row">
                    <div class="add-review__row-full">
                        <textarea name="text" placeholder="Что вам понравилось" autocomplete="off"></textarea>
                    </div>
                </div>

                <input type="hidden" name="modal_action" value="addreview">
                <input type="hidden" name="pansionat" value="<?= $arResult['ID'] ?>">

                <div class="add-review__row-actions">
                    <button>Отправить отзыв</button>
                </div>

            </form>

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
                $val = $arResult['PROPERTIES']['SR_RATING_PLACE']['VALUE'];
                $prc = (int)$val / (5 / 100);
                ?>
                Расположение
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = $arResult['PROPERTIES']['SR_RATING_OBSL']['VALUE'];
                $prc = (int)$val / (5 / 100);
                ?>
                Обслуживание
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = $arResult['PROPERTIES']['SR_RATING_UYT']['VALUE'];
                $prc = (int)$val / (5 / 100);
                ?>
                Уют
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = $arResult['PROPERTIES']['SR_RATING_KOMFORT']['VALUE'];
                $prc = (int)$val / (5 / 100);
                ?>
                Комфорт
                <span><?= $val ?></span>
                <div class="grey"></div>
                <div class="fiol" style="width: <?= $prc ?>%"></div>
            </div>
            <div class="detail__reviews-panel-line">
                <?
                $val = $arResult['PROPERTIES']['SR_RATING_LECH']['VALUE'];
                $prc = (int)$val / (5 / 100);
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
