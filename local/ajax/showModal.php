<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;

if (!CModule::IncludeModule("iblock")) return;

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


if (file_exists('./modals_template/' . $post['modal'] . '.php')) {
    require_once './modals_template/' . $post['modal'] . '.php';
} else {
    ?>
    Ошибка обработки "Modal".
    <?
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");