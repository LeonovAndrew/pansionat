<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$var = \DesperadoHelpers\AppHelper::getSiteDef();
?>

<script>
    myYaMapPlacemarks = [
        <? foreach ($arResult['ITEMS'] as $item): ?>
        <?$coords = explode(',', $item['PROPERTIES']['YAMAP_PLACE']['VALUE'])?>
        {
            coords: [<?=$coords[0]?>,<?=$coords[1]?>],
            name: '<?=$item['NAME']?>',
            id: '<?=$item['ID']?>',
            url: '<?=$item['DETAIL_PAGE_URL']?>',
            picsrc: '<?=$item['PREVIEW_PICTURE']['SRC']?>',
            price: '<?=$item['PROPERTIES']['PRICE']['VALUE'];?>',
            adress: '<?=$item['PROPERTIES']['ADRESS']['VALUE'];?>',
            rating: '<?=$item['PROPERTIES']['RATING']['VALUE'];?>',
            rating_html: '<?=\DesperadoHelpers\AppHelper::showRatingHtml($item['PROPERTIES']['RATING']['VALUE'],0,false);?>',
        },
        <? endforeach; ?>
    ];

    window.mapCenter = JSON.parse('<?=($var['MAP_CENTER'])?>');
</script>

