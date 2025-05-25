<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Iblock\Elements\ElementTagsTable;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

global $USER;

if (!$USER->IsAdmin()) LocalRedirect('/');

$arTags = ElementTagsTable::getList([
    'filter' => [
        'ACTIVE' => 'Y',
    ],
    'select' => [
        'ID',
        'NAME',
        'CODE',
        'TITLE_' => 'TITLE',
        'CANONICAL_' => 'CANONICAL',
        'NOINDEX_' => 'NOINDEX',
        'ANCOR_' => 'ANCOR',
        'SINONIM_' => 'SINONIM',
        'SECTION_' => 'SECTION',
        'POPULAR_' => 'POPULAR',
    ],
])->fetchAll();

foreach ($arTags as $arTag) {
    $arCsv[$arTag['ID']] = [
        'Url' => getSectionUrlById($arTag['SECTION_VALUE']) . $arTag['CODE'] . '/',
        'H1' => $arTag['NAME'],
        'Title' => $arTag['TITLE_VALUE'],
        'Canonical' => !empty($arTag['CANONICAL_VALUE']) ? 'Y' : 'N',
        'Meta noindex' => !empty($arTag['NOINDEX_VALUE']) ? 'Y' : 'N',
        'Anchor' => $arTag['ANCOR_VALUE'],
        'Popular' => !empty($arTag['POPULAR_VALUE']) ? 'Y' : 'N',
    ];
}

$file = fopen($_SERVER['DOCUMENT_ROOT'] . '/seoTagsTable.csv', 'w');
fputs($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
fputcsv($file, ['Url', 'H1', 'Title', 'Canonical', 'Meta noindex', 'Anchor', 'Popular'], ";");

foreach ($arCsv as $sValue) {
    fputcsv($file, $sValue, ";");
}

fclose($file);

echo "<a href='/seoTagsTable.csv' download>Скачать файл</a>";

if (!empty($arCsv)) { ?>
    <br>
    <br>
    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
        <tr style="background-color: #f2f2f2;">
            <th>Url</th>
            <th>H1</th>
            <th>Title</th>
            <th>Canonical</th>
            <th>Meta noindex</th>
            <th>Anchor</th>
            <th>Popular</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arCsv as $id => $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['Url']) ?></td>
                <td><?= htmlspecialchars($item['H1']) ?></td>
                <td><?= htmlspecialchars($item['Title']) ?></td>
                <td><?= htmlspecialchars($item['Canonical']) ?></td>
                <td><?= htmlspecialchars($item['Meta noindex']) ?></td>
                <td><?= htmlspecialchars($item['Anchor']) ?></td>
                <td><?= htmlspecialchars($item['Popular']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
}