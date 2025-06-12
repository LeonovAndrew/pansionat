<?php
/** @var array $arParams */
/** @var array $arResult */

$var = \DesperadoHelpers\AppHelper::getSiteDef();
?>
<div id="show_on_map" class="open">

</div>

<script>
myYaMapPlacemarksSection = [
        <? foreach ($arResult['ITEMS'] as $item): ?>
    <?$coords = explode(',', $item['PROPERTY_YAMAP_PLACE_VALUE'])?>
    {
    coords: [<?=$coords[0]?>,<?=$coords[1]?>],
    name: '<?=$item['NAME']?>',
    id: '<?=$item['ID']?>',
    url: '<?=$item['DETAIL_PAGE_URL']?>',
    picsrc: '<?=$item['PREVIEW_PICTURE']['SRC']?>',
    price: '<?=$item['PROPERTY_PRICE_VALUE'];?>',
    adress: '<?=$item['PROPERTY_ADRESS_VALUE'];?>',
    rating: '<?=$item['PROPERTY_RATING_VALUE'];?>',
    rating_html: '<?=\DesperadoHelpers\AppHelper::showRatingHtml($item['PROPERTY_RATING_VALUE'],0,false);?>',
    },
<? endforeach; ?>
    ];

        window.mapCenter = JSON.parse('<?=($var['MAP_CENTER'])?>');
    </script>
