<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


foreach ($arResult['ITEMS'] as &$item) {
    if (!empty($item['PROPERTIES']['EL_ID']['VALUE'])) {

        $id = $item['PROPERTIES']['EL_ID']['VALUE'];


        $res = CIBlockElement::GetByID($id);
        if ($ar_res = $res->GetNext()) {
            $item['PANS'] = $ar_res;
        }
    }
}