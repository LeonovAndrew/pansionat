<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";


GLOBAL $arrFilter;

$arrFilterCopy = $arrFilter;
unset($arrFilterCopy['FACET_OPTIONS']);
$seelctedPropsCount = count($arrFilterCopy);

$propsTitle = '';
$zpt = false;
$usedProp = false;
foreach ($arResult['ITEMS'] as $prop) {
    $propName = $prop['NAME'];
    $propVals = array();

    foreach ($prop['VALUES'] as $val) {
        if ($val['CHECKED']) {
            $propVals[] = $val['VALUE'];
            $usedProp = true;
        }
    }

    if (!empty($propVals)) {

        if ($zpt) {
            $title .= ', ';
            $propsTitle .= ', ';
        } else {
            $zpt = true;
        }

        $hint = $prop['FILTER_HINT'];
        if (!empty($hint)) {

//            $hint = mb_convert_encoding($hint,'utf-8');
            $hint = str_replace(array('\n', '\r\n', PHP_EOL, '\r'), '', strip_tags($hint));
            $propName = $hint;

            if (strpos($hint, '?') !== false) {
                if (count($propVals) > 1) {
                    $str = ' ' . str_replace('?', implode(', ', $propVals), $hint);
                } else {
                    $str = ' ' . str_replace('?', str_replace('\n', '', $propVals[0]), $hint);
                }

            } else {
                if (count($propVals) > 1) {
                    $str = ' ' . $hint . ' ' . implode(', ', $propVals);
                } else {
                    $str = ' ' . $hint . ' ' . $propVals[0];
                }
            }

        } else {
            $propName = '';
            if (count($propVals) > 1) {
                $str = ' ' . implode(', ', $propVals);
            } else {
                $str = ' ' . $propVals[0];
            }

        }
//
//        if (count($propVals) > 1) {
//            $title .= strtolower(' ' . $propName . ' ' . implode(', ', $propVals));
//            $propsTitle .= strtolower(' ' . $propName . ' ' . implode(', ', $propVals));
//        } else {
//
//        }

        $title .= ($str);
        $propsTitle .= ($str);
        $keywords .= str_replace(',', '', $str);
    }
}
if ($seelctedPropsCount > 0) {
//$APPLICATION->SetPageProperty("FILTER_H1", ($title));

    $res = CIBlockSection::GetByID($arParams['SECTION_ID']);
    if ($ar_res = $res->GetNext())
        $arResult['SECTION_TITLE'] = $ar_res['NAME'];

    $key = $arResult['SECTION_TITLE'] . ' ' . $keywords;

//    var_dump($key);

    $APPLICATION->SetPageProperty("add_title", ($propsTitle));
    $APPLICATION->SetPageProperty("FILTER_H1", $arResult['SECTION_TITLE'] . ' ' . $propsTitle);
//    $APPLICATION->SetPageProperty("FILTER_TITLE_2",  $arResult['SECTION_TITLE'] . ' ' . $propsTitle);
//    $APPLICATION->SetPageProperty("FILTER_KEYWORDS",$key.' цена, '.$key.' купить, '.$key.' продажа, '.$key.' интернет магазин, '.$key.' технические характеристики, ' );
//    $APPLICATION->AddChainItem($arResult['SECTION_TITLE'] . ' ' . $propsTitle, $arResult['FILTER_URL']);
//
//
//    $str = '<div style="margin:20px 0">' . $arResult['SECTION_TITLE'] . ' ' . $propsTitle . ' по выгодным ценам с быстрой доставкой по Москве и области,
//     технические характеристики , отзывы и инструкции по применению. Вы можете купить
//     ' . $arResult['SECTION_TITLE'] . ' ' . $propsTitle . ' и оплатить наличными,
//     безналичным расчетом и онлайн прямо сейчас. Наши технические специалисты помогут настроить, установить и
//     подключить ваше устройство в день доставки. Мы заботимся о наших клиентах и даем 100% гарантию возврата товара
//     в течении 30 дней.</div>';
//
//
//
//    $APPLICATION->SetPageProperty("SEO_BOT_SECTION", $str);
}

//
//$des = '
//Купить телевизоры Samsung ' . strtolower($APPLICATION->GetPageProperty("FILTER_PROPS")) . '.
//Каталог телевизоров ' . strtolower($APPLICATION->GetPageProperty("FILTER_PROPS")) . ' с выгодными ценами.
//Бесплатная доставка дополнит комфорт при покупки и вы сможете наслаждаться вашим телевизором уже сегодня.
//';
//
//if (CSite::InDir('/all-bt/')) {
//    $des = '
//Купить бытовую технику Samsung ' . strtolower($APPLICATION->GetPageProperty("FILTER_PROPS")) . '.
//Каталог бытовой техники ' . strtolower($APPLICATION->GetPageProperty("FILTER_PROPS")) . ' с выгодными ценами.
//Бесплатная доставка дополнит комфорт при покупки и вы сможете наслаждаться вашим телевизором уже сегодня.
//';
//}
//$str = 'Купить телевизор Samsung ' . strtolower($APPLICATION->GetPageProperty("FILTER_PROPS")) . '. Низкие цены, гарантия, отзывы, доставка.';
////$APPLICATION->SetPageProperty("meta_title", ($str));
////$meta = $APPLICATION->GetPageProperty("meta_title");
//
//$APPLICATION->SetPageProperty("FILTER_DESCRIPTION", ($des));
//
//$h1 = $APPLICATION->GetPageProperty("FILTER_H1");
//
//if (CSite::InDir('/all-bt/')) {
//    $APPLICATION->AddChainItem('Бытовая техника ' . $propsTitle, $_SERVER['REQUEST_URI']);
//    $APPLICATION->SetPageProperty("FILTER_TITLE", ('Бытовая техника Samsung ' . $propsTitle));
//    $APPLICATION->SetPageProperty("FILTER_KEYWORDS", ('Бытовая техника Samsung ' . $propsTitle));
//} elseif (CSite::InDir('/bytovaya-tekhnika/')) {
////    $APPLICATION->AddChainItem('Бытовая техника');
////    $APPLICATION->SetPageProperty("FILTER_TITLE", ('Бытовая техника Samsung ' . $propsTitle));
////    $APPLICATION->SetPageProperty("FILTER_KEYWORDS", ('Бытовая техника Samsung ' . $propsTitle));
//} elseif (CSite::InDir('/allmodels/')) {
//
//    $str = 'Купить телевизор Samsung ' . strtolower($APPLICATION->GetPageProperty("FILTER_PROPS")) . '. Низкие цены, гарантия, отзывы, доставка.';
//    $APPLICATION->AddChainItem($h1, $_SERVER['REQUEST_URI']);
//    $APPLICATION->SetPageProperty("FILTER_TITLE", ($title));
//    $APPLICATION->SetPageProperty("meta_title", ($str));
//    $APPLICATION->SetPageProperty("FILTER_KEYWORDS", ($title));
//}


function num2word($num, $words)
{
    $num = $num % 100;
    if ($num > 19) {
        $num = $num % 10;
    }
    switch ($num) {
        case 1: {
            return($words[0]);
        }
        case 2: case 3: case 4: {
        return($words[1]);
    }
        default: {
            return($words[2]);
        }
    }
}