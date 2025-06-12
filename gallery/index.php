<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Галерея");

$res = CIBlockElement::GetList(
    ['ID' => 'ASC'],
    [
        'IBLOCK_ID' => 1,
        'ACTIVE' => 'Y',
        '!PROPERTY_MORE_PHOTO' => false, // Только элементы с заполненным свойством
    ],
    false,
    ['nPageSize' => 140],
    ['ID', 'NAME', 'PROPERTY_MORE_PHOTO']
);

$arPhotos = [];

while ($arElement = $res->Fetch()) {
    if (!empty($arElement['PROPERTY_MORE_PHOTO_VALUE'])) {
        $arPhotos[] = [
            'SRC' => CFile::ResizeImageGet($arElement['PROPERTY_MORE_PHOTO_VALUE'], ['width' => 512, 'height' => 512], BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true)['src'],
            'NAME' => $arElement['NAME'],
        ];
    }
}
?>
    <div class="img-wrap">
        <?php foreach ($arPhotos as $arPhoto) { ?>
            <a href="<?php echo $arPhoto['SRC']; ?>" data-fancybox="gallery">
                <img data-src="<?php echo $arPhoto['SRC']; ?>" alt="<?php echo $arPhoto['NAME']; ?>" loading="lazy"
                     decoding="async">
            </a>
        <?php } ?>
    </div>

    <script src="/local/templates/pansion2023/lazyload.js"></script>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const images = document.querySelectorAll("img");

            lazyload(images);
        });
    </script>

    <style>
        img[data-src] {
            opacity: 0 !important;
        }

        img[src] {
            opacity: 1 !important;
        }
    </style>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>