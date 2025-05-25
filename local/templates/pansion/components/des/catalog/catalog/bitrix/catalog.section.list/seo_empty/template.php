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
global $APPLICATION;
$uri = $APPLICATION->GetCurUri();
if (strpos($uri, '/filter/') === false):
    ?>

    <div class="seo_text">
        <? if (!empty($arResult['SECTION']['UF_SEO_TEXT_TOP'])): ?>
            <?= htmlspecialcharsBack($arResult['SECTION']['UF_SEO_TEXT_TOP']); ?>
        <? elseif (\DesperadoHelpers\AppHelper::isSectionPansSet($arResult['SECTION']['ID'])): ?>
            Пансионаты для пожилых сети <?= $arResult['SECTION']['NAME'] ?> - адреса пансионатов с ценами и условиями бронирования, отзывы о пансионатах и цены на
            размещение. <?= $arResult['SECTION']['NAME'] ?> - это реабилитация, лечение и постоянное проживание с такими заболеваниями как деменция и альцгеймера,
            специальный уход для лежачих, после инсульта, инфаркта, перелома шейки бедра и многих других.
        <? elseif (\DesperadoHelpers\AppHelper::isSectionPansMetro($arResult['SECTION']['ID'])): ?>
            Каталог пансионатов для пожилых метро <?= $arResult['SECTION']['NAME'] ?> с точными адресами, ценами
            на бронирование и отзывами. Условия проживания и бронирования. Пансионаты
            для пожилых рядом с метро <?= $arResult['SECTION']['NAME'] ?> - это реабилитация, лечение
            и постоянное проживание с такими заболеваниями как деменция и
            альцгеймера, специальный уход для лежачих, после инсульта, инфаркта,
            перелома шейки бедра и многих других.
        <? elseif (\DesperadoHelpers\AppHelper::isSectionPansShosse($arResult['SECTION']['ID'])): ?>
            Каталог пансионатов для пожилых <?= $arResult['SECTION']['NAME'] ?> с точными адресами,
            ценами на бронирование и отзывами. Условия проживания и бронирования.
            Пансионаты для пожилых рядом с <?= $arResult['SECTION']['NAME'] ?> - это реабилитация, лечение
            и постоянное проживание с такими заболеваниями как деменция и альцгеймера,
            специальный уход для лежачих, после инсульта, инфаркта, перелома шейки
            бедра и многих других.
        <? elseif (\DesperadoHelpers\AppHelper::isSectionPansCity($arResult['SECTION']['ID'])): ?>

            <?
            $APPLICATION->SetPageProperty("title", 'Пансионаты для пожилых в г.  ' . $arResult['SECTION']['NAME']);
            $APPLICATION->SetPageProperty('FILTER_H1', 'Пансионаты для пожилых в г.  ' . $arResult['SECTION']['NAME']);
            $APPLICATION->SetPageProperty("description",
                'Пансионаты ' . $arResult['SECTION']['NAME'] . '. Цены на пансионаты, отзывы, фото, онлайн бронирование. 
                Каталог содержит 400 частных и социальных пансионатов для реабилитации, лечения и отдыха. Пансионаты.ПРО');
            ?>

            У нас представлены лучшие пансионаты для пожилых в городе  <?= $arResult['SECTION']['NAME'] ?> : частные,
            государственные специализированные так и обзего типа. Наши учреждения
            гостепреимно примут вашего родственника. В наших пансионатах просторные комнаты,
            мы обеспечваем полноценный уход и круглосуточную помощь и все это по низкой цене.
        <? endif; ?>
    </div>

    <? $this->SetViewTarget('seo_bottom'); ?>
    <? if (\DesperadoHelpers\AppHelper::isSectionPansCity($arResult['SECTION']['ID'])): ?>
    <h2>Дома престарелых в г. <?= $arResult['SECTION']['NAME'] ?></h2>

    Пожилые люди нуждаются в заботе, уходе, постоянном внимании и присмотре. Далеко не всегда удаётся обеспечить необходимый уход в домашних условиях.

    Когда пожилого человека берет под свое крыло опытный специалист, можно не беспокоиться за состояние физического и психического здоровья своего близкого. В частном пансионате для престарелых для постояльцев организован постоянный присмотр с уходом, а также медицинское сопровождение, обеспечиваемое квалифицированным персоналом.

    <h2> Дома для ветеранов в г. <?= $arResult['SECTION']['NAME'] ?></h2>

    Наши дома обустроены таким образом, чтобы каждый человек преклонного возраста чувствовал себя максимально комфортно. Для гостей учреждений разрабатывается многоразовое здоровое питание, которое предусматривает выбор жильцами подходящих блюд. Обязательно предоставляется доступ к сети Интернет для общения с семьей, поиска необходимой информации и прочтения новостей.

    <h2>Пансионаты с уходом за пожилыми в г. <?= $arResult['SECTION']['NAME'] ?></h2>

    Выбирая в каталоге подходящее заведение для близкого человека, вы можете рассчитывать на:
    <ul>
        <li>качественный уход в течение 24 часа в сутки;</li>
        <li>домашнюю обстановку;</li>
        <li>комплексное питание, учитывающее потребности каждого постояльца (в том числе и диетическое);</li>
        <li>организацию досуга, празднование дней рождений и проведение совместных мероприятий;</li>
        <li>своевременный медицинский осмотр и контроль за приемом медикаментов;</li>
        <li>возможность ежедневных прогулок на свежем воздухе.</li>
    </ul>


<? else: ?>
    <?= $arResult['SECTION']['DESCRIPTION'] ?>
<? endif; ?>
    <? $this->EndViewTarget(); ?>

    <?
    if (!empty($arResult['SECTION']['UF_SEO_LINKS']) && !$hide) {
        $str = '<div class="cat_links_top">';
        foreach ($arResult['SECTION']['UF_SEO_LINKS'] as $link) {
            $ex = explode('#', $link);
            $str .= '<a href="' . $ex[1] . '">' . $ex[0] . '</a>';
        }
        $str .= '</div>';
    }
    $APPLICATION->SetPageProperty("catalog_seo_top_links", $str);

    ?>
<? endif; ?>

