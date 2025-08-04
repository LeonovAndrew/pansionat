<?php


namespace DesperadoHelpers;

use Bitrix\Iblock;

class AppHelper
{

    static $imgPath = '/local/templates/pansion2023/img/';

    static function showRatingHtml($rating = 4, $numvotes = 1, $showVotes = false, $ob = false)
    {
        if ($ob) {
            $c = '';
            $rating = floatval($rating);
            for ($i = 0; $i < 5; $i++) {
                if ($rating >= $i + 1) {
                    $c .= '<span class="rating_icon yellow"></span>';
                } elseif ($rating > $i && $rating < $i + 1) {
                    $prc = intval(($rating - $i) * 6 + 3);
                    $c .= '<span class="rating_icon yellow" style="position: absolute;width: ' . $prc . 'px;overflow: hidden"></span>';
                    $c .= '<span class="rating_icon grey"></span>';
                } else {
                    $c .= '<span class="rating_icon grey"></span>';
                }
            }
            if ($showVotes) {
                $c .= '<span class="num_votes">' . $numvotes . '</span>';
            }
            return $c;
        } else {
            $rating = floatval($rating);
            for ($i = 0; $i < 5; $i++) {
                if ($rating >= $i + 1) {
                    echo '<span class="rating_icon yellow"></span>';
                } elseif ($rating > $i && $rating < $i + 1) {
                    $prc = intval(($rating - $i) * 6 + 3);
                    echo '<span class="rating_icon yellow" style="position: absolute;width: ' . $prc . 'px;overflow: hidden"></span>';
                    echo '<span class="rating_icon grey"></span>';
                } else {
                    echo '<span class="rating_icon grey"></span>';
                }
            }
            if ($showVotes) {
                echo '<span class="num_votes">' . $numvotes . '</span>';
            }
        }

//        return 0;
    }

    static function showRatingHtmlNew($rating = 0, $numvotes = 0, $shor = true)
    {
        if (empty($rating))
            $rating = 0;
        $rating = floatval($rating);
        for ($i = 0; $i < 5; $i++) {
            if ($rating >= $i + 1) {
                echo '<span class="rating-icon">' . self::showIcon('star-filled', true) . '</span>';
            } elseif ($rating > $i && $rating < $i + 1) {
                $prc = intval(($rating - $i) * 9 + 5);
                if ($prc > 100) $prc == 95;
                echo '<span class="rating-icon">';
                echo '<span class="rating-icon" style="position: absolute;width: ' . $prc . 'px;overflow: hidden;left:0">';
                echo '<span class="rating-icon" style="position: absolute;">' . self::showIcon('star-filled', true) . '</span>';
                echo '</span>' . self::showIcon('star-blank', true) . '</span>';
            } else {
                echo '<span class="rating-icon">' . self::showIcon('star-blank', true) . '</span>';
            }
        }
        if (intval($numvotes) > 0) {
            if ($shor) {
                echo '<span class="num-votes">' . $numvotes . '</span>';
            } else {
                echo '<span class="num-votes">' . $numvotes . ' голосов</span>';
            }

        }
    }

    static function showRatingHtmlProcent($rating = 0, $numvotes = 0, $shor = true, $procent = 100)
    {
        if (empty($rating))
            $rating = 0;
        $rating = floatval($rating);
        for ($i = 0; $i < 5; $i++) {
            if ($rating >= $i + 1) {
                echo '<span class="rating-icon">' . self::showIcon('star-filled', true) . '</span>';
            } elseif ($rating > $i && $rating < $i + 1) {
                $prc = intval(($rating - $i) * 9 + 5);
                if ($prc > 100) $prc == 95;
                echo '<span class="rating-icon">';
                echo '<span class="rating-icon" style="position: absolute;width: ' . $prc . 'px;overflow: hidden;left:0">';
                echo '<span class="rating-icon" style="position: absolute;">' . self::showIcon('star-filled', true) . '</span>';
                echo '</span>' . self::showIcon('star-blank', true) . '</span>';
            } else {
                echo '<span class="rating-icon">' . self::showIcon('star-blank', true) . '</span>';
            }
        }
        $ratingVal = round((int)$procent / 100 * 5, 1);
        if (intval($numvotes) > 0) {
            if ($shor) {
                echo '<span class="num-rating">' . $ratingVal . '</span>';
                echo '<span class="num-votes">(' . $numvotes . ' отзывов)</span>';
            } else {
                echo '<span class="num-votes">' . $numvotes . ' голосов</span>';
            }

        }
    }

    static function svgAsImg($img, $height = 20)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/img/' . $img;
        $src = SITE_TEMPLATE_PATH . '/img/' . $img;

        if (file_exists($file))
            echo '<img src="' . $src . '" height="' . $height . '">';
        else
            echo '';
    }

    static function inlineSVG($img)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/img/' . $img;

        if (file_exists($file))
            echo file_get_contents($file);
        else
            echo '';
    }

    static function showIcon($name, $return = false)
    {
        if ($return) {
            return '<svg><use xlink:href="#icon-' . $name . '"></use></svg>';
        } else {
            echo '<svg><use xlink:href="#icon-' . $name . '"></use></svg>';
        }
    }

    static function CurrencyFormat($num)
    {
        return number_format($num, 0, '.', ' ');
    }

    static function getPansiontSet($elID)
    {
        $db_old_groups = \CIBlockElement::GetElementGroups($elID, true);
        while ($ar_group = $db_old_groups->Fetch()) {
            $ar_new_groups[] = $ar_group["ID"];

            $nav = \CIBlockSection::GetNavChain(false, $ar_group["ID"]);
            while ($arSectionPath = $nav->GetNext()) {

                if ($arSectionPath['ID'] == 4) {
                    $res = \CIBlockSection::GetByID($ar_group["ID"]);
                    if ($ar_res = $res->GetNext())
                        return $ar_res['NAME'];
                }
            }
        }

        return '';
    }

    static function getPansiontSetID($elID)
    {
        $db_old_groups = \CIBlockElement::GetElementGroups($elID, true);
        while ($ar_group = $db_old_groups->Fetch()) {
            $ar_new_groups[] = $ar_group["ID"];

            $nav = \CIBlockSection::GetNavChain(false, $ar_group["ID"]);
            while ($arSectionPath = $nav->GetNext()) {

                if ($arSectionPath['ID'] == 4) {
                    $res = \CIBlockSection::GetByID($ar_group["ID"]);
                    if ($ar_res = $res->GetNext())
                        return $ar_res['ID'];
                }
            }
        }

        return '';
    }

    static function getPansiontCityID($elID)
    {
        $db_old_groups = \CIBlockElement::GetElementGroups($elID, true);
        while ($ar_group = $db_old_groups->Fetch()) {
            $ar_new_groups[] = $ar_group["ID"];

            $nav = \CIBlockSection::GetNavChain(false, $ar_group["ID"]);
            while ($arSectionPath = $nav->GetNext()) {

                if ($arSectionPath['ID'] == 159) {
                    $res = \CIBlockSection::GetByID($ar_group["ID"]);
                    if ($ar_res = $res->GetNext())
                        return $ar_res['ID'];
                }
            }
        }

        return '';
    }

    static function getPansiontTypeID($elID)
    {
        $db_old_groups = \CIBlockElement::GetElementGroups($elID, true);
        while ($ar_group = $db_old_groups->Fetch()) {
            $ar_new_groups[] = $ar_group["ID"];

            $nav = \CIBlockSection::GetNavChain(false, $ar_group["ID"]);
            while ($arSectionPath = $nav->GetNext()) {

                if ($arSectionPath['ID'] == 1) {
                    $res = \CIBlockSection::GetByID($ar_group["ID"]);
                    if ($ar_res = $res->GetNext())
                        return $ar_res['ID'];
                }
            }
        }

        return '';
    }

    static function isSectionPansShosse($id)
    {
        $nav = \CIBlockSection::GetNavChain(false, $id);
        while ($arSectionPath = $nav->GetNext()) {

            if ($arSectionPath['ID'] == 258) {
                return true;
            }
        }

        return false;
    }

    static function isSectionPansMetro($id)
    {
        $nav = \CIBlockSection::GetNavChain(false, $id);
        while ($arSectionPath = $nav->GetNext()) {

            if ($arSectionPath['ID'] == 299) {
                return true;
            }
        }

        return false;
    }

    static function isSectionPansSet($id)
    {
        $nav = \CIBlockSection::GetNavChain(false, $id);
        while ($arSectionPath = $nav->GetNext()) {

            if ($arSectionPath['ID'] == 4) {
                return true;
            }
        }

        return false;
    }

    static function isSectionPansRaion($id)
    {
        $nav = \CIBlockSection::GetNavChain(false, $id);
        while ($arSectionPath = $nav->GetNext()) {

            if ($arSectionPath['ID'] == 3) {
                return true;
            }
        }

        return false;
    }

    static function isSectionPansCity($id)
    {
        $nav = \CIBlockSection::GetNavChain(false, $id);
        while ($arSectionPath = $nav->GetNext()) {

            if ($arSectionPath['ID'] == 159) {
                return true;
            }
        }

        return false;
    }

    static function getSiteDef()
    {
        switch ($_SERVER['SERVER_NAME']) {
//            case 'sochi.pansionat.pro':
//                return array(
//                    'MENU_IBLOCK_ID' => 6,
//                    'MENU_SECTION_ID' => 114,
//                    'SHOW_MAIN_FORM' => false,
//                    'SETI_SECTION_ID' => 113,
//                    'DLYA_POJILIH_SECTION_ID' => 128,
//                    'DLYA_VETERANOV_SECTION_ID' => 130,
//                    'DLYA_PRESTARELYH_SECTION_ID' => 129,
//                    'HOSPISY_SECTION_ID' => 131,
//                    'RAIONY_SECTION_ID' => 112,
//                    'BOLEZNY_SECTION_ID' => 116,
//                    'SOSTOYANIE_SECTION_ID' => 115,
//                    'GORODA_SECTION_ID' => 159,
//                    'MAP_CENTER' => json_encode([43.59,39.72]),
//                    'PHONE' => '+7 (495) 181-43-93',
//                    'PHONE_SHORT' => '+74951814393',
//                );
//                break;

            default:
                return array(
                    'MENU_IBLOCK_ID' => 1,
                    'MENU_SECTION_ID' => 1,
                    'SHOW_MAIN_FORM' => true,
                    'SETI_SECTION_ID' => 4,
                    'DLYA_POJILIH_SECTION_ID' => 5,
                    'DLYA_VETERANOV_SECTION_ID' => 6,
                    'DLYA_PRESTARELYH_SECTION_ID' => 7,
                    'HOSPISY_SECTION_ID' => 8,
                    'RAIONY_SECTION_ID' => 3,
                    'BOLEZNY_SECTION_ID' => 2,
                    'SOSTOYANIE_SECTION_ID' => 97,
                    'GORODA_SECTION_ID' => 159,
                    'MAP_CENTER' => json_encode([55.76, 37.34]),
                    'PHONE' => '+7 (495) 181-43-93',
                    'PHONE_SHORT' => '+74951814393',
                );
        }
    }
}