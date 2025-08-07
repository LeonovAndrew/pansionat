<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;

if (empty($arResult))
    return "";

$strReturn = '';

// Начало микроразметки BreadcrumbList
$strReturn .= '<div class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    $arSkip = ['Типы пансионатов', 'Пансионаты по болезням', 'Пансионаты по районам - пансионаты для пожилых',
        'Сети пансионатов - пансионаты для пожилых и престарелых', 'Направления', 'Состояние', 'Города', 'Пансионаты Шоссе',
        'Расположение', 'Пансионаты Сети пансионатов', 'Особенности'];

    if (in_array($title, $arSkip)) continue;

    $arrow = ($index > 0 ? ' > ' : '');

    if (empty($arResult[$index]["LINK"]) && !empty($arResult[$index + 1])) {
        $res = CIBlockElement::GetList(
            [],
            [
                "NAME" => $title,
                "ACTIVE" => "Y",
            ],
            false,
            false,
            ["ID", "DETAIL_PAGE_URL"] // нужные поля
        );

        if ($element = $res->GetNext()) {
            $arResult[$index]["LINK"] = $element["DETAIL_PAGE_URL"];
        }
    }

    if ($arResult[$index]["LINK"] <> "") {
        $strReturn .= '
            <span class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                ' . $arrow . '
                <a href="' . $arResult[$index]["LINK"] . '" itemprop="item" title="' . $title . '">
                    <span itemprop="name">' . $title . '</span>
                </a>
                <meta itemprop="position" content="' . ($index + 1) . '" />
            </span>';
    } else {
        $strReturn .= '
            <span class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                ' . $arrow . '
                <span itemprop="name">' . $title . '</span>
                <meta itemprop="position" content="' . ($index + 1) . '" />
            </span>';
    }
}

$strReturn .= '</div>';

return $strReturn;