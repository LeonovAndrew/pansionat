<?php
// urldecode() to bitrix/modules/seo/lib/sitemapfile.php:154
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");
//require_once 'lessc.inc.php';
require_once 'Mobile_Detect.php';
require_once __DIR__ . '/helpers/appHelper.php';
require_once __DIR__ . '/helpers/ymlGenerator.php';
require_once __DIR__ . '/helpers/bitrix24.php';
require_once __DIR__ . '/autoload.php';

use Bitrix\Main\Loader;

@define("ERROR_404", "N");

function generateYMLAgent()
{
    \DesperadoHelpers\generateYML();
    return 'generateYMLAgent();';
}

function setTagsUrl()
{
    Loader::includeModule('iblock');

    $xmlFile = $_SERVER['DOCUMENT_ROOT'] . '/sitemap-iblock-9.xml';

    $xml = simplexml_load_file($xmlFile);
    if ($xml === false) {
        die("Не удалось загрузить XML файл");
    }

    foreach ($xml->url as $url) {
        $loc = (string)$url->loc;

        if (strpos($loc, '#SECTION#') !== false) {
            $parts = explode('/', rtrim($loc, '/'));
            $elementCode = end($parts);

            $res = CIBlockElement::GetList(
                [],
                [
                    'IBLOCK_ID' => 9,
                    'CODE' => $elementCode,
                    'ACTIVE' => 'Y',
                ],
                false,
                false,
                ['ID', 'PROPERTY_SECTION']
            );

            if ($element = $res->Fetch()) {
                $sectionId = $element['PROPERTY_SECTION_VALUE'];
                $newLoc = str_replace('/#SECTION#/', getSectionUrlById($sectionId), $loc);
                $url->loc = $newLoc;
            }
        }
    }

    $xml->asXML($xmlFile);

    // Удаляем все lastmod

    $xmlFile = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';

    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;

    if (!$dom->load($xmlFile)) {
        die('Ошибка загрузки XML');
    }

    $xpath = new DOMXPath($dom);
    $xpath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');

    $lastmods = $xpath->query('//sm:lastmod');

    foreach ($lastmods as $lastmod) {
        $lastmod->parentNode->removeChild($lastmod);
    }

    $dom->save($xmlFile);

    return 'setTagsUrl();';
}

function getSectionUrlById($sectionId)
{
    $res = CIBlockSection::GetByID($sectionId);

    if ($arSection = $res->GetNext()) {
        if ($arSection["IBLOCK_ID"] == 1) {
            return $arSection["SECTION_PAGE_URL"];
        }
    }

    return '';
}

//AddEventHandler("main", "OnBeforeProlog", "CompileLess", 50);
//function CompileLess()
//{
//    if (!defined("ADMIN_SECTION") && $_REQUEST['bx_html_editor_request'] != 'Y' && $_REQUEST['hlBlock'] != 'pans_features') {
//
//        $fullLess = $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/less/main.less';
//        $fullLessCompiled = $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . '/main.css';
//
//        if ($_REQUEST['clear_cache'] == 'Y') {
//            Bitrix\Main\Config\Option::set("des_cache", "timestamp", time());
//            unlink($fullLessCompiled);
//        }
//
//        $less = new lessc;
//        $less->setFormatter("compressed");
//        $less->checkedCompile($fullLess, $fullLessCompiled);
//    }
//}

AddEventHandler("main", "OnEndBufferContent", "ShowBannerInsideNews");
function ShowBannerInsideNews(&$content)
{

    if (!CModule::IncludeModule("iblock")) return;

    if (!defined("ADMIN_SECTION")) {

        if (strpos($content, '#SHOW_PHONES') !== false) {
            preg_match('/#SHOW_PHONES\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_PHONES\|(.+)#/', ShowPhonesByID($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_PHONES2') !== false) {
            preg_match('/#SHOW_PHONES2\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_PHONES2\|(.+)#/', ShowPhonesByID($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_PHONES3') !== false) {
            preg_match('/#SHOW_PHONES3\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_PHONES3\|(.+)#/', ShowPhonesByID($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_PHONES4') !== false) {
            preg_match('/#SHOW_PHONES4\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_PHONES4\|(.+)#/', ShowPhonesByID($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_PHONES5') !== false) {
            preg_match('/#SHOW_PHONES5\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_PHONES5\|(.+)#/', ShowPhonesByID($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_3PHONES') !== false) {
            preg_match('/#SHOW_3PHONES\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_3PHONES\|(.+)#/', ShowPhonesByID3($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_3PHONES2') !== false) {
            preg_match('/#SHOW_3PHONES2\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_3PHONES2\|(.+)#/', ShowPhonesByID3($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_3PHONES3') !== false) {
            preg_match('/#SHOW_3PHONES3\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_3PHONES3\|(.+)#/', ShowPhonesByID3($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_3PHONES4') !== false) {
            preg_match('/#SHOW_3PHONES4\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_3PHONES4\|(.+)#/', ShowPhonesByID3($ids[1]), $content);
        }

        if (strpos($content, '#SHOW_3PHONES5') !== false) {
            preg_match('/#SHOW_3PHONES5\|(.+)#/', $content, $ids);
            $content = preg_replace('/#SHOW_3PHONES5\|(.+)#/', ShowPhonesByID3($ids[1]), $content);
        }

        global $APPLICATION;

        $seoFilterRet = '';
        $seoFilterRetBot = $APPLICATION->GetPageProperty("SEO_BOT_SECTION");
        $arSelect = ["ID", "IBLOCK_ID", "NAME", 'PREVIEW_TEXT', 'DETAIL_TEXT', "CODE", "PROPERTY_H1", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION"];
        $arFilter = ["IBLOCK_ID" => 2, "ACTIVE" => "Y", 'CODE' => $_SERVER['SCRIPT_URL']];
        $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 1], $arSelect);
        if ($ob = $res->fetch()) {

            $seoFilterRet = '<div>' . $ob['PREVIEW_TEXT'] . '</div>';
            if (!empty($ob['DETAIL_TEXT']))
                $seoFilterRetBot = '<div>' . $ob['DETAIL_TEXT'] . '</div>';

        }

        if (strpos($content, '#SEO_FILTER_SECTION#') !== false) {
            preg_match('/#SEO_FILTER_SECTION#/', $content, $ids);
            $content = preg_replace('/#SEO_FILTER_SECTION#/', $seoFilterRet, $content);
        }

        if (strpos($content, '#SEO_BOTTOM_FILTER_SECTION#') !== false) {
            preg_match('/#SEO_BOTTOM_FILTER_SECTION#/', $content, $ids);
            $content = preg_replace('/#SEO_BOTTOM_FILTER_SECTION#/', $seoFilterRetBot, $content);
        }
    }
}


AddEventHandler("main", "OnEpilog", "EpilogFunc");
function EpilogFunc()
{
    if (!CModule::IncludeModule("iblock") || (ERROR_404 == 'Y')) return;
    global $APPLICATION;
    if (!defined("ADMIN_SECTION")) {

        $filterTitle = $APPLICATION->GetPageProperty("FILTER_H1");
        if (!empty($filterTitle) )
            $APPLICATION->SetTitle($filterTitle);


//        $filterTitle = $APPLICATION->GetPageProperty("FILTER_TITLE");
//
//        if (!empty($filterTitle)) {
//            $str = $filterTitle . ' - купить недорого в интернет магазине tvteam. Недорогие цены, технические характеристики и отзывы.';
//            $APPLICATION->SetPageProperty("title", $str);
//            $APPLICATION->SetPageProperty("meta_title", $str);
//            $APPLICATION->SetPageProperty("description", $str);
//        }
//
//        $filterTitle = $APPLICATION->GetPageProperty("FILTER_KEYWORDS");
//        if (!empty($filterTitle))
//            $APPLICATION->SetPageProperty("keywords", $filterTitle);

        $arSelect = ["ID", "IBLOCK_ID", "NAME", 'PREVIEW_TEXT', "CODE", "PROPERTY_H1",
            "PROPERTY_TITLE", "PROPERTY_DESCRIPTION", "PROPERTY_KEYWORDS", "PROPERTY_META_TITLE", 'PROPERTY_SEO_LINKS'];
        $arFilter = ["IBLOCK_ID" => 2, "ACTIVE" => "Y", 'CODE' => $APPLICATION->GetCurPage()];
        $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 1], $arSelect);
        if ($ob = $res->GetNextElement()) {

            $props = $ob->GetProperties();

            if (!empty($props['DESCRIPTION']['VALUE'])) {
                $APPLICATION->SetPageProperty("description", $props['DESCRIPTION']['VALUE']);
            } else {

            }

            if (!empty($props['KEYWORDS']['VALUE'])) {
                $APPLICATION->SetPageProperty("keywords", $props['KEYWORDS']['VALUE']);
            } else {

            }

            if (!empty($props['META_TITLE']['VALUE'])) {
                $APPLICATION->SetPageProperty("meta_title", $props['META_TITLE']['VALUE']);
            } else {

            }


            if (!empty($props['TITLE']['VALUE'])) {
                $APPLICATION->SetPageProperty("title", $props['TITLE']['VALUE']);
            } else {

            }

            if (!empty($props['H1']['VALUE'])) {
                $APPLICATION->SetTitle($props['H1']['VALUE']);
                $APPLICATION->SetPageProperty("add_title", '');
            } else {

            }

            if (!empty($props['SEO_LINKS']['VALUE'])) {
                $str = '<div class="cat_links_top">';
                if (is_array($props['SEO_LINKS']['VALUE'])) {
                    foreach ($props['SEO_LINKS']['VALUE'] as $link) {
                        $ex = explode('#', $link);
                        $str .= '<a href="' . $ex[1] . '">' . $ex[0] . '</a>';
                    }
                } else {
                    $ex = explode('#', $props['SEO_LINKS']['VALUE']);
                    $str .= '<a href="' . $ex[1] . '">' . $ex[0] . '</a>';
                }
                $str .= '</div>';
                $APPLICATION->SetPageProperty("catalog_seo_top_links", $str);
            }
        }
    }

    $newTitle = $APPLICATION->GetPageProperty('title_tags');
    $newDescription = $APPLICATION->GetPageProperty('description_tags');
    $newH1 = $APPLICATION->GetPageProperty('name_tags');

    if (!empty($newTitle)) {
        $APPLICATION->SetPageProperty("title", $newTitle);
        $APPLICATION->SetPageProperty("meta_title", $newTitle);
    }
    if (!empty($newDescription)) {
        $APPLICATION->SetPageProperty("description", $newDescription);
    }
    if (!empty($newH1)) {
        $APPLICATION->SetTitle($newH1);
    }

}

// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("search", "BeforeIndex", ["MyClass", "BeforeIndexHandler"]);

class MyClass
{
    // создаем обработчик события "BeforeIndex"
    static function BeforeIndexHandler($arFields)
    {
        if ($arFields["MODULE_ID"] == "iblock") {
            $set = \DesperadoHelpers\AppHelper::getPansiontSet($arFields["ITEM_ID"]);
            if (strpos($arFields["TITLE"], $set) === false)
                $arFields["TITLE"] .= " " . $set;
        }
        return $arFields;
    }
}


/*AddEventHandler("main", "OnEndBufferContent", "deleteKernelJs");
AddEventHandler("main", "OnEndBufferContent", "deleteKernelCss");*/

function deleteKernelJs(&$content)
{
    global $USER, $APPLICATION;
    if ((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/") !== false) return;
    if ($APPLICATION->GetProperty("save_kernel") == "Y") return;

    $arPatternsToRemove = [
        '/<script.+?src=".+?\/kernel_main.*\.js\?\d+"><\/script\>/',
        '/<script.+?src=".+?bitrix\/js\/main\/core\/core[^"]+"><\/script\>/',
        '/<script.+?src=".+?bitrix\/.*dexie.bitrix.*"><\/script\>/',
        '/<script.+?src=".+?bitrix\/.*main.popup.*"><\/script\>/',
        '/BX\.(setCSSList|setJSList)\(.*\)/',
        '/<script.+?>if\(\!window\.BX\)window\.BX.+?<\/script>/',
        '/<script[^>]+?>\(window\.BX\|\|top\.BX\)\.message[^<]+<\/script>/',
    ];

    $content = preg_replace($arPatternsToRemove, "", $content);
    $content = preg_replace("/\n{2,}/", "\n\n", $content);
}

function deleteKernelCss(&$content)
{
    global $USER, $APPLICATION;
    if ((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/") !== false) return;
    if ($APPLICATION->GetProperty("save_kernel") == "Y") return;

    $arPatternsToRemove = [
        '/<link.+?href=".+?kernel_main\/kernel_main\.css\?\d+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/js\/.*>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/styles.css[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/template_styles.css[^"]+"[^>]+>/',
    ];

    $content = preg_replace($arPatternsToRemove, "", $content);
    $content = preg_replace("/\n{2,}/", "\n\n", $content);
}

function getIblockId($code)
{
    $arIblock = \Bitrix\Iblock\IblockTable::getList([
        'filter' => ['CODE' => $code], // параметры фильтра
    ])->fetch();
    if ($arIblock) {
        return $arIblock["ID"];
    } else {
        return false;
    }
}

function pre($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}