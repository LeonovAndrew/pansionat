<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("title", "Страница не найдена");
$APPLICATION->AddChainItem("Страница не найдена");
?>
<?php global $APPLICATION, $USER; ?>


    <div class="page404">
        <div class="page404__title">404</div>
        <div class="page404__text">Упс... Такой страницы больше нет. Возможно, она была удалена или информация на ней
            устарела.
        </div>
        <div class="page404__text">Вы можете перейти на <a href="/">Главную</a> или посетить наш
            <a href="/pansionaty-dlya-pozhilykh/">Каталог пансионатов</a></div>
    </div>
</div>

    <div itemscope itemtype="https://schema.org/OfferCatalog">
        <meta itemprop="name" content="Каталог пансионатов">
        <meta itemprop="description" content="Пансионаты для пожилых">
        <meta itemprop="image" content="https://pansiont.pro/upload/iblock/663/6637a08955e5e8466040ad91f8360561.png">

        <div class="block __blue-bg">
            <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/index-page-tab1.php"
                    )
                ); ?>
            </div>
        </div>

        <div class="block">
            <div class="container">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH . "/include/index-page-tab2.php"
                    )
                ); ?>
            </div>
        </div>
    </div>

    <style>
        h1 {
            display: none !important;
        }
    </style>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");