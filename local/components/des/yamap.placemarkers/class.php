<?php
namespace Des\Components;

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;

class YamapPlacemarks extends \CBitrixComponent
{
    /**
     * Подготовка параметров компонента
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams)
    {
        $arParams['IBLOCK_ID'] = (int)$arParams['IBLOCK_ID'];
        $arParams['CACHE_TIME'] = isset($arParams['CACHE_TIME']) ? (int)$arParams['CACHE_TIME'] : 3600;
        $arParams['MAP_CENTER'] = $arParams['MAP_CENTER'] ?? '55.751574, 37.573856';

        return $arParams;
    }

    /**
     * Основная логика компонента
     */
    public function executeComponent()
    {
        try {
            if (!Loader::includeModule('iblock')) {
                throw new \Exception('Модуль iblock не установлен');
            }

            if ($this->startResultCache()) {
                $this->getElements();
                $this->prepareResult();
                $this->includeComponentTemplate();
            }
        } catch (\Exception $e) {
            $this->abortResultCache();
            ShowError($e->getMessage());
        }
    }

    /**
     * Получение элементов инфоблока
     */
    protected function getElements()
    {
        $filter = [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y',
            '!PROPERTY_YAMAP_PLACE' => false
        ];

        $select = [
            'ID',
            'NAME',
            'DETAIL_PAGE_URL',
            'PREVIEW_PICTURE',
            'PROPERTY_YAMAP_PLACE',
            'PROPERTY_PRICE',
            'PROPERTY_ADRESS',
            'PROPERTY_RATING'
        ];

        $dbItems = \CIBlockElement::GetList(
            ['SORT' => 'ASC', 'NAME' => 'ASC'],
            $filter,
            false,
            false,
            $select
        );

        while ($item = $dbItems->GetNext()) {
            $this->arResult['ITEMS'][] = $item;
        }
    }

    /**
     * Подготовка данных для вывода
     */
    protected function prepareResult()
    {
        $this->arResult['MAP_CENTER'] = $this->arParams['MAP_CENTER'];

        foreach ($this->arResult['ITEMS'] as &$item) {
            $item['PREVIEW_PICTURE'] = \CFile::GetFileArray($item['PREVIEW_PICTURE']);
        }
        unset($item);
    }
}