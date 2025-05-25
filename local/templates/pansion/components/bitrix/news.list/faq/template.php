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


<div class="columns" itemscope itemtype="https://schema.org/FAQPage">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="question" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="question_header">
                <div class="question_wapper">
                    <div class="question_svg">
                        <svg width="30" height="30" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="question_color" fill-rule="evenodd" clip-rule="evenodd" d="M0 7.5C0 3.35786 3.35786 0 7.5 0C11.6421 0 15 3.35786 15 7.5C15 11.6421 11.6421 15 7.5 15C3.35786 15 0 11.6421 0 7.5ZM5.5 6C5.5 4.89543 6.39543 4 7.5 4H8.1C9.14934 4 10 4.85066 10 5.9V6C10 7.10457 9.10457 8 8 8V9H7V7H8C8.55228 7 9 6.55228 9 6V5.9C9 5.40294 8.59706 5 8.1 5H7.5C6.94772 5 6.5 5.44772 6.5 6H5.5ZM7 11V10H8V11H7Z" fill="#663AB6"/>
                        </svg>
                    </div>
                    <h3 itemprop="name"><?= $item['NAME'] ?></h3>
                </div>
                <img src="/local/templates/pansion/img/arrow-yellow.svg" class="quest_pic" height="24px" width="24px">
            </div>
            <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">

                <div class="warning"  itemprop="text">
                    <div class="warning_img">
                        <div class="warning_img_wapper">
                            <img src="/local/templates/pansion/img/warning.svg" height="38" width="3">
                        </div>
                    </div>
                    <p><?= $item['PREVIEW_TEXT'] ?></p>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>