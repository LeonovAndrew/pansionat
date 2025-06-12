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

$captchaValid = false;

if (isset($_REQUEST['token']) && !empty($_REQUEST['token'])) {
    $reCaptcha = new \ReCaptcha\ReCaptcha('6LchYzcqAAAAANeXs7sMAb4tieyr6NObcZg51L_8');

    $resp = $reCaptcha->setExpectedHostname('pansionat.pro')->setScoreThreshold(0.8)
        ->verify($_REQUEST['token'], $_SERVER['REMOTE_ADDR']);
    if ($resp->isSuccess()) {
        // Verified!

        if ($resp->getScore() < 0.8) {
            echo json_encode(array('msg' => 'error', 'error_code' => 'Произошла ошибка. Обратитесь к администратору'));
            die();
        } else {

        }

        $captchaValid = true;
    } else {
        echo json_encode(array('msg' => 'error', 'error_code' => 'ReCaptcha Error'));
        die();
    }
}

if (isset($_POST['modal_action']) && $captchaValid) {

    $txt = '';
    $title = '';
    $crmComment = '';
    $crmSend = false;

    switch ($post['modal_action']) {

        case 'callback':

            $txt = 'ФИО: ' . $post['name'];
            $txt .= '<br>Телефон: ' . $post['phone'];
            $txt .= '<br>Сообщение: ' . $post['text'];

            $title = 'Заказ консультации.';

            $crmComment = $post['text'];
            $crmSend = true;

            $return = array('msg' => 'ok');
            break;


        case 'makerent':


            $res = CIBlockElement::GetByID($post['id']);
            if ($ar_res = $res->GetNext())
                $nam = $ar_res['NAME'];

            $txt = 'ФИО: ' . $post['name'];
            $txt .= '<br>Телефон: ' . $post['phone'];
            $txt .= '<br>Дата заезда: ' . $post['date_in'];
            $txt .= '<br>Дата отъезда: ' . $post['date_out'];
            $txt .= '<br>Пансионат: ' . $nam;
            if ($post['alltime'] == 'on')
                $txt .= '<br>Требуется постоянное место жительства';

            $title = 'Бронь';

            $crmComment = 'Дата заезда: ' . $post['date_in'];
            $crmComment .= '<br>Дата отъезда: ' . $post['date_out'];
            $crmComment .= '<br>Пансионат: ' . $nam;
            if ($post['alltime'] == 'on')
                $crmComment .= '<br>Требуется постоянное место жительства';
            $crmSend = true;

            $return = array('msg' => 'ok');
            break;

        case 'makeCalc':

            $txt = 'ФИО: ' . $post['name'];
            $txt .= '<br>Телефон: ' . $post['phone'];
            $txt .= '<br>Возраст: ' . $post['age'];
            $txt .= '<br>Пол: ' . $post['sex'];
            $txt .= '<br>Может передвигаться: ' . $post['move'];
            $txt .= '<br>Направление: ' . $post['napr'];
            $txt .= '<br>Мест: ' . $post['mest'];

            $title = 'Расчет стоимости проживания';

            $crmComment = '<br>Возраст: ' . $post['age'];
            $crmComment .= '<br>Пол: ' . $post['sex'];
            $crmComment .= '<br>Может передвигаться: ' . $post['move'];
            $crmComment .= '<br>Направление: ' . $post['napr'];
            $crmComment .= '<br>Мест: ' . $post['mest'];
            $crmSend = true;

            $return = array('msg' => 'ok');
            break;

        case 'addNew':

            $txt = 'Категория: ' . $post['type'];
            $txt .= '<br>Адрес: ' . $post['adres'];
            $txt .= '<br>Цена (за сутки): ' . $post['price'];
            $txt .= '<br>Телефон: ' . $post['phone'];
            $txt .= '<br>Вместимость: ' . $post['mest'];
            $txt .= '<br>Сайт: ' . $post['site'];

            $title = 'Новый пансионат';

            $return = array('msg' => 'ok');
            break;

        case 'addreview':
            $el = new CIBlockElement;

            $PROP = array(
                'OB_RATING' => $post['allRating'],
                'RATING_REC' => $post['ratingRec'],
                'RATING_PLACE' => $post['ratingRasp'],
                'RATING_COMFORT' => $post['ratingKomf'],
                'RATING_YUT' => $post['ratingYut'],
                'RATING_OBSL' => $post['ratingObsl'],
                'RATING_LECH' => $post['ratingLech'],
                'NAME' => $post['name'],
                'EMAIL' => $post['email'],
                'TEXT' => $post['text'],
                'DATE' => $post['date'],
                'EL_ID' => $post['pansionat'],
                'PANS_NAME' => $post['pansname'],
            );
            global $DB;
            $arLoadProductArray = array(
                "MODIFIED_BY" => 1, // элемент изменен текущим пользователем
                "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                "IBLOCK_ID" => 4,
                "PROPERTY_VALUES" => $PROP,
                "NAME" => $post['name'],
                "ACTIVE" => "N",            // активен
                "PREVIEW_TEXT" => htmlspecialcharsbx($post['text']),
            );

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $ok = 'ok';
            } else {
                $ok = $el->LAST_ERROR;
            }

            $siteName = COption::GetOptionString('main', 'site_name');
            $link = $siteName . "/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=4&type=pansionat&ID=   " . $PRODUCT_ID;


            $txt = 'ФИО: ' . $post['name'];
            $txt .= '<br>Почта: ' . $post['email'];
            $txt .= '<br>Дата заезда: ' . $post['date'];
            $txt .= '<br>Ссылка на отзыв: <a href=\'' . $link . '\'>' . $link . '</a>';

            $title = 'Новый отзыв на сайте';


            $return = array('msg' => 'ok', 'add_el' => $ok);
            break;

        default:
            $return = array('msg' => 'error', 'error_code' => 'note switch');
    }

    if ($return['msg'] == 'ok') {

        $txt .= '<br>';
        $txt .= '<br> IP:' . $_SERVER['REMOTE_ADDR'];
        $txt .= '<br> HTTP_X_FORWARDED_FOR:' . $_SERVER['HTTP_X_FORWARDED_FOR'];
        $txt .= '<br> HTTP_CLIENT_IP:' . $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($arrFiles)) {
            CEvent::Send("BLANK", array('s1'), array('BODY' => $txt, 'TITLE' => $title), 'Y', '', $arrFiles, 'ru');
        } else {
            CEvent::Send("BLANK", array('s1'), array('BODY' => $txt, 'TITLE' => $title));
        }

        if ($crmSend === true) {
            $id = null;
            $stripPhone = str_replace([' ','(',')','-'],'',$post['phone']);

            $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : 'nocookie';

            $arFields = array(
                'NAME' => $post['name'],
                "TITLE" => $title . '. pansionat.pro',
                "PHONE" => [["VALUE" => $stripPhone, "VALUE_TYPE" => "WORK"]],
                "SOURCE_ID" => '4',
                'UF_CRM_1693815630' => $post['client_ids'],
                "COMMENTS" => $crmComment,
                'UF_CRM_1739346250' => $roistatVisitId,
            );

            $result = CurlBitrix24Contact('crm.contact.list.json', array(
                'filter' => ["PHONE" => $stripPhone],
                'select' => ["ID", "TITLE"]
            ));

            if (!empty($result['result'][0]['ID'])) {
                $id = $result['result'][0]['ID'];
            }

            $result = CurlBitrix24Contact('crm.contact.list.json', array(
                'filter' => ["PHONE" => str_replace('+', '', $stripPhone)],
                'select' => ["ID", "TITLE"]
            ));

            if (!empty($result['result'][0]['ID'])) {
                $id = $result['result'][0]['ID'];
            }

            if ($id != null) {
                $arFields['CONTACT_ID'] = $id;
            }

            $result = CurlBitrix24('crm.lead.add.json', array(
                'fields' => $arFields,
                'params' => array("REGISTER_SONET_EVENT" => "Y")
            ));

            $leadId = (is_array($result) && !empty($result["result"])) ? $result["result"] : false;
        }
    }

    echo json_encode($return);

} else {
    echo json_encode(array('msg' => 'error', 'error_code' => 'note action'));
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");