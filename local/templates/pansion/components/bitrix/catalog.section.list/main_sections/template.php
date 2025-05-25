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

<div class="row main_section">
    <? foreach ($arResult['GRID'] as $gridRow): ?>
        <div class="item_wrapper">
            <div class="item">
                <ul>
                    <? foreach ($gridRow as $item): ?>
                        <li><a href="<?= $item['SECTION_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>&nbsp;<span
                                    class="cnt">(<?= $item['ELEMENT_CNT'] ?>)</span></li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    <? endforeach; ?>
</div>

