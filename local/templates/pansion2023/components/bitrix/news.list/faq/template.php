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

<?php /*
<div class="anchors">
    <ul class="anchors_list">
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <li><a href="#<?= $item['CODE'] ?>">
                    <?= $item['NAME'] ?></a></li>
        <? endforeach; ?>
    </ul>
</div> */ ?>


<div class="faq__wrapper" itemscope itemtype="https://schema.org/FAQPage">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="faq" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="faq__question">
                <h3 itemprop="name"><?= $item['NAME'] ?></h3>

                <div class="faq__question-icons">
                    <div class="faq_plus"><?php \DesperadoHelpers\AppHelper::showIcon('add'); ?></div>
                    <div class="faq_minus"><?php \DesperadoHelpers\AppHelper::showIcon('remove'); ?></div>
                </div>
            </div>

            <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div class="faq__text" itemprop="text">
                    <?= $item['PREVIEW_TEXT'] ?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>