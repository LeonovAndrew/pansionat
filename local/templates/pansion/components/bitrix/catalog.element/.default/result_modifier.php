<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */
$cp = $this->__component;
$arResult['SETI'] = \DesperadoHelpers\AppHelper::getPansiontSet($arResult['ID']);
$arResult['META_TITLE'] = $arResult['PROPERTIES']['META_TITLE']['VALUE'];
$arResult['META_ROBOTS'] = $arResult['PROPERTIES']['META_ROBOTS']['VALUE'];
$arResult['M_NAME'] = $arResult['IPROPERTY_VALUES']['ELEMENT_META_TITLE'];

if (is_object($cp)) {
    $cp->SetResultCacheKeys(array('NAME', 'SETI', 'META_TITLE', 'META_ROBOTS', 'M_NAME'));
}

$file = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array('width' => 1000, 'height' => 667), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$sliderPictures[] = array(
    'SRC' => $file['src']
);;
if (count($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['VALUE']) > 0) {
    if (count($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['VALUE']) > 1) {
        foreach ($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'] as $pic) {
            $file = CFile::ResizeImageGet($pic, array('width' => 1000, 'height' => 667), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            $sliderPictures[] = array(
                'SRC' => $file['src']
            );

        }
    } else {
        $file = CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']['FILE_VALUE'], array('width' => 1000, 'height' => 667), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        $sliderPictures[] = array(
            'SRC' => $file['src']
        );
    }
}

$arResult['SLIDER_PICTURES'] = $sliderPictures;


$arSelect = Array("ID", "NAME", 'PREVIEW_PICTURE', 'PROPERTY_OB_RATING', 'PROPERTY_RATING_REC', 'PROPERTY_RATING_PLACE',
    'PROPERTY_RATING_COMFORT', 'PROPERTY_RATING_YUT', 'PROPERTY_RATING_OBSL', 'PROPERTY_RATING_LECH', 'PROPERTY_NAME',
    'PROPERTY_EMAIL', 'PROPERTY_TEXT', 'PROPERTY_DATE', 'PROPERTY_EL_ID');

$arFilter = Array("IBLOCK_ID" => 4, "ACTIVE" => "Y", "PROPERTY_EL_ID" => $arResult['ID']);

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 10), $arSelect);
while ($ob = $res->fetch()) {
    $arResult['REVIEWS'][] = $ob;
}

// ***********************************
//
//  Генерим ссылки на разделы
//
// ***********************************


function prepareData2Prop(&$arResult, $sectionLink, $propCode)
{

    $tmp = [];
    $prop = $arResult['PROPERTIES'][$propCode];
    $propValue = $prop['VALUE_ENUM'];
    $propCode = strtolower($prop['CODE']);

    if (is_array($propValue)) {
        foreach ($prop['VALUE_ENUM'] as $key => $val) {
            $pTmp = [];
            $pTmp['NAME'] = $val;
            $xmlID = $prop['VALUE_XML_ID'][$key];
            $pTmp['XML_ID'] = $xmlID;
            $pTmp['LINK'] = $sectionLink . 'filter/' . $propCode . '-is-' . $xmlID . '/';
            $tmp[] = $pTmp;
        }

        return $tmp;
    } else {
        $tmp['NAME'] = $prop['VALUE_ENUM'];
        $xmlID = $prop['VALUE_XML_ID'];
        $tmp['XML_ID'] = $xmlID;
        $tmp['LINK'] = $sectionLink . 'filter/' . $propCode . '-is-' . $xmlID . '/';

        return array($tmp);
    }
}

$skipIDS = [1, 2, 3, 4, 96, 97];
$sectArrRes = [];

$elGroupsDb = \CIBlockElement::GetElementGroups($arResult['ID'], true);
while ($ar_group = $elGroupsDb->Fetch()) {
    $elGroups[] = $ar_group['ID'];
    $id = $ar_group['ID'];
    if (!in_array($id, $skipIDS)) {

        $nav = \CIBlockSection::GetNavChain(false, $id);
        while ($arSectionPath = $nav->GetNext()) {

            switch ($arSectionPath['ID']) {
                case 4:
                    $QQcode = 'SETI';
                    break;
                case 3:
                    $QQcode = 'RAIONY';
                    break;
                case 2:
                    $QQcode = 'DLYZ_BOLNYH';
                    break;
                case 1:
                    $QQcode = 'TYPE';
                    break;
                case 96:
                    $QQcode = 'NAPRAVLENIYA';
                    break;
                case 97:
                    $QQcode = 'SOSTOYANIE';
                    break;
                case 159:
                    $QQcode = 'CITY';
                    break;
                default:
                    $QQcode = '';
            }

            if (!empty($QQcode)) {
                $resQ = CIBlockSection::GetByID($id);
                if ($ar_resQ = $resQ->GetNext()) {

                    $code = $ar_resQ['CODE'];
                    $sectionLink = '/' . $code . '/';

                    $arResult['LINK_BUILDER'][$QQcode][] = [
                        'NAME' => $ar_resQ['NAME'],
                        'LINK' => $sectionLink,
                    ];
                }
            }
        }
    }
}


$typeID = \DesperadoHelpers\AppHelper::getPansiontTypeID($arResult['ID']);
$res = CIBlockSection::GetByID($typeID);
if ($ar_res = $res->GetNext()) {

//    $typeID = \DesperadoHelpers\AppHelper::getPansiontSetID($arResult['ID']);
//    $resQ = CIBlockSection::GetByID($typeID);
//    if ($ar_resQ = $resQ->GetNext()) {
//        // Сеть пансионата
//        $arResult['LINK_BUILDER']['SETI']['NAME'] = $ar_resQ['NAME'];
//        $code = $ar_resQ['CODE'];
//        $arResult['LINK_BUILDER']['SETI']['CODE'] = $code;
//        $sectionLink = '/' . $code . '/';
//        $arResult['LINK_BUILDER']['SETI']['LINK'] = $sectionLink;
//    }
//
//    $typeID = \DesperadoHelpers\AppHelper::getPansiontCityID($arResult['ID']);
//    $resQ = CIBlockSection::GetByID($typeID);
//
//    if ($ar_resQ = $resQ->GetNext()) {
//        // Город пансионата
//        $arResult['LINK_BUILDER']['CITY']['NAME'] = $ar_resQ['NAME'];
//        $code = $ar_resQ['CODE'];
//        $arResult['LINK_BUILDER']['CITY']['CODE'] = $code;
//        $sectionLink = '/' . $code . '/';
//        $arResult['LINK_BUILDER']['CITY']['LINK'] = $sectionLink;
//    }
//
//    // Категория пансионата
//    $arResult['LINK_BUILDER']['SECTION']['NAME'] = $ar_res['NAME'];
//    $code = $ar_res['CODE'];
//    $arResult['LINK_BUILDER']['SECTION']['CODE'] = $code;
//    $sectionLink = '/' . $code . '/';
//    $arResult['LINK_BUILDER']['SECTION']['LINK'] = $sectionLink;
//
//    // Районы
//    $arResult['LINK_BUILDER']['RAIONY'] = prepareData2Prop($arResult, $sectionLink, 'RAIONY');
//
//    // Тип пансионата
//    $arResult['LINK_BUILDER']['TYPE'] = prepareData2Prop($arResult, $sectionLink, 'TYPE');
//
//    // Направления
//    $arResult['LINK_BUILDER']['NAPRAVLENIYA'] = prepareData2Prop($arResult, $sectionLink, 'NAPRAVLENIYA');
//
//    // Психологическое состояние
//    $arResult['LINK_BUILDER']['PSIHOLOGICHESKOE_SOSTOYANIE'] =
//        prepareData2Prop($arResult, $sectionLink, 'PSIHOLOGICHESKOE_SOSTOYANIE');
//
//    // Физическое состояние
//    $arResult['LINK_BUILDER']['FIZICHESKOE_SOSTOYANIE'] =
//        prepareData2Prop($arResult, $sectionLink, 'FIZICHESKOE_SOSTOYANIE');
//
//    // С заболеваниями
//    $arResult['LINK_BUILDER']['DLYZ_BOLNYH'] =
//        prepareData2Prop($arResult, $sectionLink, 'DLYZ_BOLNYH');
//
//    // Медицинское обслуживание
//    $arResult['LINK_BUILDER']['MEDICINSKOE_OBSLUZHIVANIE'] =
//        prepareData2Prop($arResult, $sectionLink, 'MEDICINSKOE_OBSLUZHIVANIE');
}