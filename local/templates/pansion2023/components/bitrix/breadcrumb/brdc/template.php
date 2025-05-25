<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';


$strReturn .= '<div class="breadcrumb">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arSkip = array('Типы пансионатов','Пансионаты по болезням','Пансионаты по районам - пансионаты для пожилых',
        'Сети пансионатов - пансионаты для пожилых и престарелых','Направления','Состояние','Города','Пансионаты Шоссе',
        'Расположение','Пансионаты Сети пансионатов','Особенности');

	if (in_array($title,$arSkip)) continue;

	$arrow = ($index > 0? ' > ' : '');

	if($arResult[$index]["LINK"] <> "" )
	{
		$strReturn .= '
			<span class="breadcrumb-item" id="bx_breadcrumb_'.$index.'" >
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">
					<span>'.$title.'</span>
				</a>
			</span>';
	}
	else
	{
		$strReturn .= '
			<span class="breadcrumb-item">
				'.$arrow.'
				<span>'.$title.'</span>
			</span>';
	}
}

$strReturn .= '</div>';

return $strReturn;
