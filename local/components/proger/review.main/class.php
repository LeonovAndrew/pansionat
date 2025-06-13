<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class ReviewMain extends CBitrixComponent
{
    public function executeComponent()
    {
        $obResult = \CIBlockElement::GetList([], ['ACTIVE' => 'Y', 'IBLOCK_ID' => 4, '!PROPERTY_EL_ID_VALUE' => '', '>PROPERTY_OB_RATING' => 4], false, ['nPageSize' => $this->arParams['COUNT']], ['ID', '*', 'PROPERTY_*']);

        while ($obElement = $obResult->GetNextElement()) {
            $arFields = $obElement->GetFields();
            $arProperties = $obElement->GetProperties();

            if (!empty($arProperties['EL_ID']['VALUE'])) {
                $obResultElement = \CIBlockElement::GetList([], ['ID' => $arProperties['EL_ID']['VALUE'], 'ACTIVE' => 'Y', '!PREVIEW_PICTURE' => '',], false, [], ['ID', '*', 'PROPERTY_*']);

                while ($obPansElement = $obResultElement->GetNextElement()) {
                    $arFieldsElement = $obPansElement->GetFields();

                    if (!empty($arFieldsElement)) {
                        $this->arResult['ITEMS'][$arFields['ID']] = $arFields;
                        $this->arResult['ITEMS'][$arFields['ID']]['PROPERTIES'] = $arProperties;
                        $this->arResult['ITEMS'][$arFields['ID']]['PANS'] = $arFieldsElement;
                    }
                }
            }
        }

        $this->IncludeComponentTemplate();
    }
}
