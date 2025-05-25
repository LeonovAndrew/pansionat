<?php
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss('https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css');
Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js');


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css">

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        new SlimSelect({
            select: document.querySelector('select[name="IBLOCK_SECTION[]"]'),
            searchPlaceholder: 'Поиск...',
        })
    });
</script>
