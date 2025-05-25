<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>
<?php global $APPLICATION, $USER; ?>


    <div class="page404">
        <div class="page404__title">404</div>
        <div class="page404__text">Упс... Такой страницы больше нет. Возможно, она была удалена или информация на ней
            устарела.
        </div>
        <div class="page404__text">Вы можете перейти на <a href="/">Главную</a> или посетить наш
            <a href="/pansionaty-dlya-pozhilykh/">Каталог пансионатов</a></div>
        <div class="page404__img">
            <img src="/local/templates/pansion2023/static/img/404.png" alt="">
        </div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");