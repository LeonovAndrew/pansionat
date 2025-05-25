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

foreach ($_REQUEST as $key => $item) {
    if (is_array($item)) {
        foreach ($item as $i_key => $i_val) {
            $post[$key][$i_key] = htmlspecialcharsbx($i_val);
        }
    } else {
        $post[$key] = htmlspecialcharsbx($item);
    }
}
?>

<div class="search">
    <form class="search__form" id="search_form" action="/find/" method="get">
        <div class="search__row __max">
            <div class="select-wrapper">
                <select name="rasp" id="">
                    <option value="">Район</option>
                    <? foreach ($arResult['RASPOLIJENIE'] as $item): ?>
                        <option value="<?= $item['ID'] ?>"
                            <? if ($item['ID'] == $post['rasp']) echo ' selected' ?>><?= $item['VALUE'] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <div class="search__row __max">
            <div class="select-wrapper">
                <select name="section_id" id="">
                    <option value="">Выберите тип</option>
                    <? foreach ($arResult['PANS_TYPE'] as $item): ?>
                        <option value="<?= $item['ID'] ?>"
                            <? if ($item['ID'] == $post['section_id']) echo ' selected' ?>><?= $item['NAME'] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <div class="search__row __max">
            <div class="select-wrapper">
                <select name="zabol" id="">
                    <option value="">Заболевание</option>
                    <? foreach ($arResult['DLYZ_BOLNYH'] as $item): ?>
                        <option value="<?= $item['ID'] ?>"
                            <? if ($item['ID'] == $post['zabol']) echo ' selected' ?>><?= $item['VALUE'] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <div class="search__row">
            <div class="search__map-button js-map-button">На карте</div>
        </div>
        <div class="search__row">
            <button class="search__button">Найти</button>
        </div>
    </form>
</div>

