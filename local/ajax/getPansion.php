<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;

if (!CModule::IncludeModule("iblock")) return;

$arrFiles = array();
$post = array();

foreach ($_REQUEST as $key => $item) {
    if (is_array($item)) {
        foreach ($item as $i_key => $i_val) {
            $post[$key][$i_key] = htmlspecialcharsbx($i_val);
        }
    } else {
        $post[$key] = htmlspecialcharsbx($item);
    }
}


if (!empty($_FILES['file'])) {
    if ($_FILES['file']['error'] == 0) {
        move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $_FILES['file']['name']);
//      $arrFiles[] = CFile::SaveFile(CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $_FILES['file']['name']),'attachments');
        $arrFiles[] = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $_FILES['file']['name'];
    }
}

$setionID = htmlspecialchars($_REQUEST['section_id']);
$var = \DesperadoHelpers\AppHelper::getSiteDef();
$arSelect = Array("ID", "NAME", "CODE", "PROPERTY_YAMAP_PLACE", "DETAIL_PAGE_URL", "PREVIEW_PICTURE","PROPERTY_ADRESS","PROPERTY_PRICE","PROPERTY_RATING");
$arFilter = Array("IBLOCK_ID" => $var['MENU_IBLOCK_ID'], "ACTIVE" => "Y", 'INCLUDE_SUBSECTIONS');

if (!empty($setionID)) {
    $arFilter['SECTION_ID'] = $setionID;
}

if (!empty($post['rasp'])) {
    $arFilter['PROPERTY_RAIONY'] = $post['rasp'];
}

if (!empty($post['fizsost'])) {
    $arFilter['PROPERTY_FIZICHESKOE_SOSTOYANIE'] = $post['fizsost'];
}

if (!empty($post['psihsost'])) {
    $arFilter['PROPERTY_PSIHOLOGICHESKOE_SOSTOYANIE'] = $post['psihsost'];
}

if (!empty($post['napr'])) {
    if (is_array($post['napr'])) {
        $tmp = array('LOGIC'=> "OR");
        foreach ($post['napr'] as $item) {
            $tmp[] = array('PROPERTY_NAPRAVLENIYA' => $item);
        }
        $arFilter[] = $tmp;
    } else {
        $arFilter['PROPERTY_NAPRAVLENIYA'] = $post['napr'];
    }
}

if (!empty($post['medob'])) {
    if (is_array($post['medob'])) {
        $tmp = array('LOGIC'=> "OR");
        foreach ($post['medob'] as $item) {
            $tmp[] = array('PROPERTY_MEDICINSKOE_OBSLUZHIVANIE' => $item);
        }
        $arFilter[] = $tmp;
    } else {
        $arFilter['PROPERTY_MEDICINSKOE_OBSLUZHIVANIE'] = $post['medob'];
    }
}

if (!empty($post['rating'])) {
    if (is_array($post['rating'])) {
        $tmp = array('LOGIC'=> "OR");
        foreach ($post['rating'] as $item) {
            $tmp[] = array('PROPERTY_RATING' => $item);
        }
        $arFilter[] = $tmp;
    } else {
        $arFilter['PROPERTY_RATING'] = $post['rating'];
    }
}




$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 5000), $arSelect);
while ($ob = $res->fetch()) {
//    print_r($ob);
    $coords = explode(',', $ob['PROPERTY_YAMAP_PLACE_VALUE']);
    $items [] = array(
        'coords' => array($coords[0], $coords[1]),
        'name' => $ob['NAME'],
        'id' => $ob['ID'],
        'url' => '/pansionat-' . $ob['CODE'] . '/',
        'picsrc' => CFile::GetPath($ob['PREVIEW_PICTURE']),
        'price' => $ob['PROPERTY_PRICE_VALUE'],
        'adress' => $ob['PROPERTY_ADRESS_VALUE'],
        'rating' => $ob['PROPERTY_RATING_VALUE'],
        'rating_html' => \DesperadoHelpers\AppHelper::showRatingHtml($ob['PROPERTY_RATING_VALUE'],0,false,true)
    );
}


echo json_encode(array('items' => $items, 'cnt' => count($items),'filter'=>$arFilter));


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");