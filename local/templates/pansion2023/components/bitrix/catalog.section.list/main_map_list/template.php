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

<ul class="onMapList">
    <li><a href="javascript:void(0)" onclick="showItemsBySection('',this)" class="active">Все пансионаты</a></li>

    <? foreach ($arResult['SECTIONS'] as $item): ?>

        <li><a href="javascript:void(0)" onclick="showItemsBySection(<?=$item['ID']?>,this)"><?= $item['NAME'] ?></a></li>

    <? endforeach; ?>
</ul>
