<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */
//
//$component = $this->getComponent();
//$arParams = $component->applyTemplateModifications();

if (!empty($arParams['SORT_ARR'])) {
    $order = $arParams['SORT_ARR'];
    usort($arResult['ITEMS'], function ($a, $b) use ($order) {
        $pos_a = array_search($a['ID'], $order);
        $pos_b = array_search($b['ID'], $order);
        return $pos_a - $pos_b;
    });
}

foreach ($arResult['ITEMS'] as &$item) {
    $sliderPictures = array();
    $file = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width' => 400, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
    $sliderPictures[] = array('SRC' => $file['src']);
    if (!empty($item['PROPERTIES']['MORE_PHOTO']['VALUE']))
        if (count($item['PROPERTIES']['MORE_PHOTO']['VALUE']) > 0) {
            if (count($item['PROPERTIES']['MORE_PHOTO']['VALUE']) > 0) {
                foreach ($item['PROPERTIES']['MORE_PHOTO']['VALUE'] as $pic) {
                    $file = CFile::ResizeImageGet($pic, array('width' => 400, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                    $sliderPictures[] = array('SRC' => $file['src']);
                }
            } else {
                $file = CFile::ResizeImageGet($item['PROPERTIES']['MORE_PHOTO']['FILE_VALUE'], array('width' => 400, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
                $sliderPictures[] = array('SRC' => $file['src']);
            }
        }

    $item['SLIDER_PICTURES'] = $sliderPictures;
}