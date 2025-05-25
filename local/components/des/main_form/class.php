<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */

/** @global CMain $APPLICATION */
class CatalogSectionParfum extends CBitrixComponent
{

    public function executeComponent()
    {
        \Bitrix\Main\Loader::IncludeModule("iblock");
        global $USER;

        $cache_id = serialize(array($this->arParams, ($this->arParams['CACHE_GROUPS'] === 'N' ? false : $USER->GetGroups())));
        $obCache = new CPHPCache;
        if ($obCache->InitCache($this->arParams['CACHE_TIME'] ?: 30 * 60, $cache_id, '/')) {
            $vars = $obCache->GetVars();
            $this->arResult = $vars['arResult'];
        } elseif ($obCache->StartDataCache()) {

            $this->Qmain();
            $obCache->EndDataCache(array(
                'arResult' => $this->arResult,
            ));
        }

        $this->IncludeComponentTemplate();
    }

    private function Qmain()
    {

        $arResult = &$this->arResult;
//        $arFilter = array('IBLOCK_ID' => 1, 'SECTION_ID' => '3');
//        $rsSect = CIBlockSection::GetList(array(), $arFilter);
//        while ($arSect = $rsSect->fetch()) {
//            $arResult['RASPOLIJENIE'][] = $arSect;
//        }

        $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 1, "CODE" => "RAIONY"));
        while ($enum_fields = $property_enums->GetNext()) {
            $arResult['RASPOLIJENIE'][] = $enum_fields;
        }


        $arFilter = array('IBLOCK_ID' => 1, 'SECTION_ID' => '1');
        $rsSect = CIBlockSection::GetList(array(), $arFilter);
        while ($arSect = $rsSect->fetch()) {
            $arResult['PANS_TYPE'][] = $arSect;
        }

        $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 1, "CODE" => "FIZICHESKOE_SOSTOYANIE"));
        while ($enum_fields = $property_enums->GetNext()) {
            $arResult['FIZICHESKOE_SOSTOYANIE'][] = $enum_fields;
        }

        $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 1, "CODE" => "PSIHOLOGICHESKOE_SOSTOYANIE"));
        while ($enum_fields = $property_enums->GetNext()) {
            $arResult['PSIHOLOGICHESKOE_SOSTOYANIE'][] = $enum_fields;
        }

        // **********************************

//        $arFilter = array('IBLOCK_ID' => 1, 'SECTION_ID' => '96');
//        $rsSect = CIBlockSection::GetList(array(), $arFilter);
//        while ($arSect = $rsSect->fetch()) {
//            $arResult['NAPRAVLENIYA'][] = $arSect;
//        }

        $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 1, "CODE" => "NAPRAVLENIYA"));
        while ($enum_fields = $property_enums->GetNext()) {
            $arResult['NAPRAVLENIYA'][] = $enum_fields;
        }

        $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 1, "CODE" => "MEDICINSKOE_OBSLUZHIVANIE"));
        while ($enum_fields = $property_enums->GetNext()) {
            $arResult['MEDICINSKOE_OBSLUZHIVANIE'][] = $enum_fields;
        }

        $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 1, "CODE" => "DLYZ_BOLNYH"));
        while ($enum_fields = $property_enums->GetNext()) {
            $arResult['DLYZ_BOLNYH'][] = $enum_fields;
        }

        $property_enums = CIBlockPropertyEnum::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 1, "CODE" => "RATING"));
        while ($enum_fields = $property_enums->GetNext()) {
            $arResult['RATING'][] = $enum_fields;
        }
    }
}
