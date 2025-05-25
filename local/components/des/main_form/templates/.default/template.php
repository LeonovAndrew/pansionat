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

if (!function_exists('showZvezd')) {
    function showZvezd($i)
    {
        switch ($i) {
            case '1':
                return '1 звезда';
                break;
            case '2':
                return '2 звезды';
                break;
            case '3':
                return '3 звезды';
                break;
            case '4':
                return '4 звезды';
                break;
            case '5':
                return '5 звезд';
                break;
        }
    }
}
?>

<form action="/dev/null" id="main_form" class="shadow">
    <div class="row">
        <div class="item_wrapper quarter">
            <p class="title">Направления</p>
            <select name="napr" id="">
                <option value="">Выберите направление</option>
                <? foreach ($arResult['NAPRAVLENIYA'] as $item): ?>
                    <option value="<?= $item['ID'] ?>"><?= $item['VALUE'] ?></option>
                <? endforeach; ?>
            </select>
        </div>

        <div class="item_wrapper quarter">
            <p class="title">Тип учреждения</p>
            <select name="section_id" id="">
                <option value="">Выберите тип</option>
                <? foreach ($arResult['PANS_TYPE'] as $item): ?>
                    <option value="<?= $item['ID'] ?>"><?= $item['NAME'] ?></option>
                <? endforeach; ?>
            </select>
        </div>

        <div class="item_wrapper quarter">
            <p class="title">Физическое состояние</p>
            <select name="fizsost" id="">
                <option value="">Выберите состояние</option>
                <? foreach ($arResult['FIZICHESKOE_SOSTOYANIE'] as $item): ?>
                    <option value="<?= $item['ID'] ?>"><?= $item['VALUE'] ?></option>
                <? endforeach; ?>
            </select>
        </div>

        <div class="item_wrapper quarter">
            <p class="title">Психическое состояние</p>
            <select name="psihsost" id="">
                <option value="">Выберите состояние</option>
                <? foreach ($arResult['PSIHOLOGICHESKOE_SOSTOYANIE'] as $item): ?>
                    <option value="<?= $item['ID'] ?>"><?= $item['VALUE'] ?></option>
                <? endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">

        <div class="item_wrapper full" style="display: none">
            <div class="panel">
                <p class="title">Рейтинг пансионата</p>
                <? foreach ($arResult['RATING'] as $item): ?>
                    <? if ($item['VALUE'] == 1 || $item['VALUE'] == 2) continue ?>
                    <div class="filter_val">
                        <input type="checkbox" value="<?= $item['ID'] ?>" name="rating[]" id="napr<?= $item['ID'] ?>">
                        <label for="napr<?= $item['ID'] ?>">
                            <?= showZvezd($item["VALUE"]) ?>
                            <span class="rating_line">
                                            <? \DesperadoHelpers\AppHelper::showRatingHtml($item["VALUE"]) ?>



                                        </span></label>
                    </div>
                <? endforeach; ?>
            </div>


        </div>

        <div class="item_wrapper full">
            <div class="right">
                <input class="clear_filter" type="button" id="clear_filter" name="del_filter" value="Очистить фильтр">
                <button class="red_button" type="submit">Показать на карте</button>
            </div>
        </div>
    </div>


    <div class="row">

    </div>
</form>

