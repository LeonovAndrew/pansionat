<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<ul>
    <? foreach ($arResult['SECTIONS'] as $item): ?>
        <li><a href="<?= $item['SECTION_PAGE_URL'] ?>"><?= $item['NAME'] ?></a></li>
    <? endforeach; ?>
    <li><a href="/otzyvy/">Отзывы</a></li>
    <li><a href="/gallery/">Галерея</a></li>
</ul>
