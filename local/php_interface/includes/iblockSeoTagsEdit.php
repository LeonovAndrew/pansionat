<?php

use Bitrix\Main;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Catalog;
use Bitrix\Catalog\Access\AccessController;
use Bitrix\Catalog\Access\ActionDictionary;
use Bitrix\Iblock;

/** @global CUser $USER */
/** @global CMain $APPLICATION */
/** @global CDatabase $DB */

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/iblock/prolog.php');

    //////////////////////////
	//START of the custom form
	//////////////////////////

	//We have to explicitly call calendar and editor functions because
	//first output may be discarded by form settings

	$nameFormat = CSite::GetNameFormat();

	$tabControl->BeginPrologContent();
	CJSCore::Init(array('date'));

	//TODO: this code only for old html editor. Need remove after final cut old editor
	if (
		$bFileman
		&& Main\Config\Option::get('iblock', 'use_htmledit') === 'Y'
		&& Main\Config\Option::get('fileman', 'use_editor_3', 'Y') !== 'Y'
	)
	{
		echo '<div style="display:none">';
		CFileMan::AddHTMLEditorFrame("SOME_TEXT", "", "SOME_TEXT_TYPE", "text",
			array('height' => 450, 'width' => '100%'),
			"N", 0, "", "", $arIBlock["LID"]
		);
		echo '</div>';
	}

	if($arTranslit["TRANSLITERATION"] == "Y")
	{
		CJSCore::Init(array('translit'));
		?>
		<script>
		var linked=<?if($bLinked) echo 'true'; else echo 'false';?>;
		function set_linked()
		{
			linked=!linked;

			var name_link = document.getElementById('name_link');
			if(name_link)
			{
				if(linked)
					name_link.src='/bitrix/themes/.default/icons/iblock/link.gif';
				else
					name_link.src='/bitrix/themes/.default/icons/iblock/unlink.gif';
			}
			var code_link = document.getElementById('code_link');
			if(code_link)
			{
				if(linked)
					code_link.src='/bitrix/themes/.default/icons/iblock/link.gif';
				else
					code_link.src='/bitrix/themes/.default/icons/iblock/unlink.gif';
			}
			var linked_state = document.getElementById('linked_state');
			if(linked_state)
			{
				if(linked)
					linked_state.value='Y';
				else
					linked_state.value='N';
			}
		}
		var oldValue = '';
		function transliterate()
		{
			if(linked)
			{
				var from = document.getElementById('NAME');
				var to = document.getElementById('CODE');
				if(from && to && oldValue != from.value)
				{
					BX.translit(from.value, {
						'max_len' : <?echo intval($arTranslit['TRANS_LEN'])?>,
						'change_case' : '<?echo $arTranslit['TRANS_CASE']?>',
						'replace_space' : '<?echo $arTranslit['TRANS_SPACE']?>',
						'replace_other' : '<?echo $arTranslit['TRANS_OTHER']?>',
						'delete_repeat_replace' : <?echo $arTranslit['TRANS_EAT'] == 'Y'? 'true': 'false'?>,
						'use_google' : <?echo $arTranslit['USE_GOOGLE'] == 'Y'? 'true': 'false'?>,
						'callback' : function(result){to.value = result; setTimeout('transliterate()', 250); }
					});
					oldValue = from.value;
				}
				else
				{
					setTimeout('transliterate()', 250);
				}
			}
			else
			{
				setTimeout('transliterate()', 250);
			}
		}
		transliterate();
		</script>
		<?
	}
	?>
	<script>
		var InheritedPropertiesTemplates = new JCInheritedPropertiesTemplates(
			'<?echo $tabControl->GetName()?>_form',
			'<?=$selfFolderUrl?>iblock_templates.ajax.php?ENTITY_TYPE=E&IBLOCK_ID=<?echo intval($IBLOCK_ID)?>&ENTITY_ID=<?echo intval($ID)?>&bxpublic=y'
		);
		BX.ready(function(){
			setTimeout(function(){
				InheritedPropertiesTemplates.updateInheritedPropertiesTemplates(true);
			}, 1000);
		});
	</script>
<?
	$tabControl->EndPrologContent();

	$tabControl->BeginEpilogContent();

echo bitrix_sessid_post();
echo GetFilterHiddens("find_");?>
<input type="hidden" name="linked_state" id="linked_state" value="<?if($bLinked) echo 'Y'; else echo 'N';?>">
<input type="hidden" name="Update" value="Y">
<input type="hidden" name="from" value="<?echo htmlspecialcharsbx($from)?>">
<input type="hidden" name="WF" value="<?echo htmlspecialcharsbx($WF)?>">
<input type="hidden" name="return_url" value="<?echo htmlspecialcharsbx($return_url)?>">

<?if($ID>0 && !$bCopy)
{
	?><input type="hidden" name="ID" value="<?echo $ID?>"><?
}
if ($bCopy)
{
	?><input type="hidden" name="copyID" value="<? echo $ID; ?>"><?
}
elseif ($copyID > 0)
{
	?><input type="hidden" name="copyID" value="<? echo $copyID; ?>"><?
}

if ($bCatalog)
{
	CCatalogAdminTools::showFormParams();
}
//TODO: $IBLOCK_SECTION_ID - it's crutch
?>
<input type="hidden" name="IBLOCK_SECTION_ID" value="<?echo intval($IBLOCK_SECTION_ID ?? 0)?>">
<input type="hidden" name="TMP_ID" value="<?echo intval($TMP_ID)?>">
<?
$tabControl->EndEpilogContent();

$customTabber->SetErrorState($bVarsFromForm);

$arEditLinkParams = array(
	"find_section_section" => $find_section_section
);
if ($bAutocomplete)
{
	$arEditLinkParams['lookup'] = $strLookup;
}
if ($adminSidePanelHelper->isPublicFrame())
{
	$arEditLinkParams["IFRAME"] = "Y";
	$arEditLinkParams["IFRAME_TYPE"] = "PUBLIC_FRAME";
}
$tabControl->Begin(array(
	"FORM_ACTION" => $urlBuilder->getElementSaveUrl(null, $arEditLinkParams)
));

$tabControl->BeginNextFormTab();
	if($ID > 0 && !$bCopy)
	{
		$p = CIblockElement::GetByID($ID);
		$pr = $p->ExtractFields("prn_");
	}
	else
	{
		$pr = array();
	}

if ($ID > 0 && !$bCopy)
{
	if (Loader::includeModule('crm'))
	{
		$importProduct = \Bitrix\Crm\Order\Import\Internals\ProductTable::getRow([
			'select' => ['SETTINGS'],
			'filter' => [
				'=PRODUCT_ID' => CIBlockElement::GetRealElement($ID),
			],
		]);

		if (!empty($importProduct))
		{
			$accountName = !empty($importProduct['SETTINGS']['account_name']) ? $importProduct['SETTINGS']['account_name'] : '';
			$linkToProduct = !empty($importProduct['SETTINGS']['permalink']) ? $importProduct['SETTINGS']['permalink'] : '';

			$tabControl->BeginCustomField('IMPORTED_FROM', GetMessage('IBLOCK_IMPORT_FROM').':');
			?>
			<tr>
				<td width="40%"><?=$tabControl->GetCustomLabelHTML()?></td>
				<td width="60%">
					<style>
						.adm-crm-order-instagram-icon {
							width: 20px;
							height: 20px;
							display: inline-block;
							vertical-align: middle;
							margin-right: 5px;
							background-image: url(data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22none%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%0A%20%20%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M10%2020c5.523%200%2010-4.477%2010-10S15.523%200%2010%200%200%204.477%200%2010s4.477%2010%2010%2010z%22%20fill%3D%22%23E85998%22/%3E%0A%20%20%3Cpath%20fill-rule%3D%22evenodd%22%20clip-rule%3D%22evenodd%22%20d%3D%22M12.027%206.628a.584.584%200%201%201%201.168%200%20.584.584%200%200%201-1.168%200zM7.355%204h4.672a3.219%203.219%200%200%201%203.213%203.213v1.392h-1.168V7.213a2.028%202.028%200%200%200-2.045-2.045H7.355a2.028%202.028%200%200%200-2.044%202.045v4.672c0%201.143.902%202.045%202.044%202.045h3.87v1.168h-3.87a3.22%203.22%200%200%201-3.212-3.213V7.213A3.219%203.219%200%200%201%207.355%204zm-.73%205.549a3.076%203.076%200%200%201%203.066-3.067c1.43%200%202.635.992%202.971%202.32-.45.195-.826.526-1.082.94a1.89%201.89%200%200%200-1.889-2.09%201.89%201.89%200%200%200-1.898%201.897%201.89%201.89%200%200%200%201.898%201.898c.653%200%201.221-.322%201.563-.816-.018.115-.03.232-.03.352v1.215a3.03%203.03%200%200%201-1.533.418%203.076%203.076%200%200%201-3.066-3.067zm6.104%202.696h.607v-.83c0-.152-.03-1.167%201.281-1.167h.924v1.056h-.68c-.134%200-.271.14-.271.243v.694h.951c-.039.532-.117%201.02-.117%201.02h-.838v3.015h-1.25V13.26h-.607v-1.015z%22%20fill%3D%22white%22/%3E%0A%3C/svg%3E%0A);
							margin-top: -3px;
							background-repeat: no-repeat;
						}
					</style>
					<span class="adm-crm-order-instagram-icon"></span>
					<?=$accountName?>
					<?=($linkToProduct ? "<a href=\"{$linkToProduct}\" target=\"_blank\">".GetMessage('IBLOCK_LINK_TO_MEDIA')."</a>" : '')?>
				</td>
			</tr>
			<?
			$tabControl->EndCustomField('IMPORTED_FROM', '');
		}
	}
}



$tabControl->BeginCustomField("ID", "ID:");
if ($ID > 0 && !$bCopy)
{
	?><tr>
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo $str_ID?></td>
	</tr><?
}
$tabControl->EndCustomField("ID", '');

$tabControl->BeginCustomField("DATE_CREATE", GetMessage("IBLOCK_FIELD_CREATED").":");
if ($ID > 0 && !$bCopy)
{
	if ($str_DATE_CREATE <> ''):?>
		<tr>
			<td width="40%"><? echo $tabControl->GetCustomLabelHTML() ?></td>
			<td width="60%"><? echo $str_DATE_CREATE ?><?
				if (intval($str_CREATED_BY) > 0):
					if (!$adminSidePanelHelper->isPublicSidePanel()):
					?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANGUAGE_ID; ?>&amp;ID=<?=$str_CREATED_BY; ?>"><? echo $str_CREATED_BY ?></a>]<?
					endif;
					$rsUser = CUser::GetByID($str_CREATED_BY);
					$arUser = $rsUser->Fetch();
					if ($arUser):
						echo '&nbsp;'.CUser::FormatName($nameFormat, $arUser, false, true);
					endif;
				endif;
				?></td>
		</tr>
	<?endif;
}
$tabControl->EndCustomField("DATE_CREATE", '');

$tabControl->BeginCustomField("TIMESTAMP_X", GetMessage("IBLOCK_FIELD_LAST_UPDATED").":");
if ($ID > 0 && !$bCopy)
{
	?><tr>
	<td width="40%"><? echo $tabControl->GetCustomLabelHTML() ?></td>
	<td width="60%"><? echo $str_TIMESTAMP_X; ?><?
		if (intval($str_MODIFIED_BY) > 0):
			if (!$adminSidePanelHelper->isPublicSidePanel()):
			?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANGUAGE_ID; ?>&amp;ID=<?=$str_MODIFIED_BY; ?>"><? echo $str_MODIFIED_BY ?></a>]<?
			endif;
			if (intval($str_CREATED_BY) != intval($str_MODIFIED_BY))
			{
				$rsUser = CUser::GetByID($str_MODIFIED_BY);
				$arUser = $rsUser->Fetch();
			}
			if ($arUser)
			{
				echo '&nbsp;' . CUser::FormatName($nameFormat, $arUser, false, true);
			}
		endif ?></td>
	</tr><?
}
$tabControl->EndCustomField("TIMESTAMP_X", '');

$tabControl->AddCheckBoxField("ACTIVE", GetMessage("IBLOCK_FIELD_ACTIVE").":", false, array("Y","N"), $str_ACTIVE=="Y");
$tabControl->BeginCustomField("ACTIVE_FROM", GetMessage("IBLOCK_FIELD_ACTIVE_PERIOD_FROM"), $arIBlock["FIELDS"]["ACTIVE_FROM"]["IS_REQUIRED"] === "Y");
?>
	<tr id="tr_ACTIVE_FROM">
		<td><?echo $tabControl->GetCustomLabelHTML()?>:</td>
		<td><?echo CAdminCalendar::CalendarDate("ACTIVE_FROM", $str_ACTIVE_FROM, 19, true)?></td>
	</tr>
<?
$tabControl->EndCustomField("ACTIVE_FROM", '<input type="hidden" id="ACTIVE_FROM" name="ACTIVE_FROM" value="'.$str_ACTIVE_FROM.'">');
$tabControl->BeginCustomField("ACTIVE_TO", GetMessage("IBLOCK_FIELD_ACTIVE_PERIOD_TO"), $arIBlock["FIELDS"]["ACTIVE_TO"]["IS_REQUIRED"] === "Y");
?>
	<tr id="tr_ACTIVE_TO">
		<td><?echo $tabControl->GetCustomLabelHTML()?>:</td>
		<td><?echo CAdminCalendar::CalendarDate("ACTIVE_TO", $str_ACTIVE_TO, 19, true)?></td>
	</tr>

<?
$tabControl->EndCustomField("ACTIVE_TO", '<input type="hidden" id="ACTIVE_TO" name="ACTIVE_TO" value="'.$str_ACTIVE_TO.'">');

if($arTranslit["TRANSLITERATION"] == "Y")
{
	$tabControl->BeginCustomField("NAME", GetMessage("IBLOCK_FIELD_NAME").":", true);
	?>
		<tr id="tr_NAME">
			<td><?echo $tabControl->GetCustomLabelHTML()?></td>
			<td style="white-space: nowrap;">
				<input type="text" size="70" name="NAME" id="NAME" maxlength="255" value="<?echo $str_NAME?>"><img id="name_link" title="<?echo GetMessage("IBEL_E_LINK_TIP")?>" class="linked" src="/bitrix/themes/.default/icons/iblock/<?if($bLinked) echo 'link.gif'; else echo 'unlink.gif';?>" onclick="set_linked()" />
			</td>
		</tr>
	<?
	$tabControl->EndCustomField("NAME",
		'<input type="hidden" name="NAME" id="NAME" value="'.$str_NAME.'">'
	);

	$tabControl->BeginCustomField("CODE", GetMessage("IBLOCK_FIELD_CODE").":", $arIBlock["FIELDS"]["CODE"]["IS_REQUIRED"] === "Y");
	?>
		<tr id="tr_CODE">
			<td><?echo $tabControl->GetCustomLabelHTML()?></td>
			<td style="white-space: nowrap;">
				<input type="text" size="70" name="CODE" id="CODE" maxlength="255" value="<?echo $str_CODE?>"><img id="code_link" title="<?echo GetMessage("IBEL_E_LINK_TIP")?>" class="linked" src="/bitrix/themes/.default/icons/iblock/<?if($bLinked) echo 'link.gif'; else echo 'unlink.gif';?>" onclick="set_linked()" />
			</td>
		</tr>
	<?
	$tabControl->EndCustomField("CODE",
		'<input type="hidden" name="CODE" id="CODE" value="'.$str_CODE.'">'
	);
}
else
{
	$tabControl->AddEditField("NAME", GetMessage("IBLOCK_FIELD_NAME").":", true, array("size" => 70, "maxlength" => 255), $str_NAME);
	$tabControl->AddEditField("CODE", GetMessage("IBLOCK_FIELD_CODE").":", $arIBlock["FIELDS"]["CODE"]["IS_REQUIRED"] === "Y", array("size" => 70, "maxlength" => 255), $str_CODE);
}

if (
	$arShowTabs['sections']
	&& $arIBlock["FIELDS"]["IBLOCK_SECTION"]["DEFAULT_VALUE"]["KEEP_IBLOCK_SECTION_ID"] === "Y"
)
{
	$arDropdown = array();
	if ($str_IBLOCK_ELEMENT_SECTION)
	{
		$sectionList = CIBlockSection::GetList(
			array("left_margin"=>"asc"),
			array("=ID"=>$str_IBLOCK_ELEMENT_SECTION),
			false,
			array("ID", "NAME")
		);
		while ($section = $sectionList->Fetch())
			$arDropdown[$section["ID"]] = htmlspecialcharsEx($section["NAME"]);
	}
	$tabControl->BeginCustomField("IBLOCK_ELEMENT_SECTION_ID", GetMessage("IBEL_E_MAIN_IBLOCK_SECTION_ID").":", false);
	?>
		<tr id="tr_IBLOCK_ELEMENT_SECTION_ID">
			<td class="adm-detail-valign-top"><?echo $tabControl->GetCustomLabelHTML()?></td>
			<td>
				<div id="RESULT_IBLOCK_ELEMENT_SECTION_ID">
				<select name="IBLOCK_ELEMENT_SECTION_ID" id="IBLOCK_ELEMENT_SECTION_ID" onchange="InheritedPropertiesTemplates.updateInheritedPropertiesValues(false, true)">
				<?foreach($arDropdown as $key => $val):?>
					<option value="<?echo $key?>" <?if ($str_IBLOCK_SECTION_ID == $key) echo 'selected'?>><?echo $val?></option>
				<?endforeach?>
				</select>
				</div>
				<script>
					window.ipropTemplates[window.ipropTemplates.length] = {
						"ID": "IBLOCK_ELEMENT_SECTION_ID",
						"INPUT_ID": "IBLOCK_ELEMENT_SECTION_ID",
						"RESULT_ID": "RESULT_IBLOCK_ELEMENT_SECTION_ID",
						"TEMPLATE": ""
					};
					window.ipropTemplates[window.ipropTemplates.length] = {
						"ID": "CODE",
						"INPUT_ID": "CODE",
						"RESULT_ID": "",
						"TEMPLATE": ""
					};
					<?
					if (COption::GetOptionString('iblock', 'show_xml_id') == 'Y')
					{
					?>
					window.ipropTemplates[window.ipropTemplates.length] = {
						"ID": "XML_ID",
						"INPUT_ID": "XML_ID",
						"RESULT_ID": "",
						"TEMPLATE": ""
					};
					<?
					}
					?>
				</script>
			</td>
		</tr>
	<?
	$tabControl->EndCustomField("IBLOCK_ELEMENT_SECTION_ID",
		'<input type="hidden" name="IBLOCK_ELEMENT_SECTION_ID" id="IBLOCK_ELEMENT_SECTION_ID" value="'.$str_IBLOCK_SECTION_ID.'">'
	);
}

if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y")
{
	if ($bCopy || $ID == 0)
	{
		$tabControl->BeginCustomField("XML_ID", GetMessage("IBLOCK_FIELD_XML_ID") . ":", $arIBlock["FIELDS"]["XML_ID"]["IS_REQUIRED"] === "Y");
		?><tr id="tr_XML_ID">
		<td><span id="hint_XML_ID"></span>
			<script>
			BX.hint_replace(BX('hint_XML_ID'), '<?=CUtil::JSEscape(htmlspecialcharsbx(GetMessage('IBLOCK_FIELD_HINT_XML_ID')))?>');
			</script> <?=$tabControl->GetCustomLabelHTML(); ?></td>
		<td>
			<input type="text" name="XML_ID" id="XML_ID" size="70" maxlength="255" value="<?=$str_XML_ID; ?>">
		</td>
		</tr><?
		$tabControl->EndCustomField("XML_ID", '<input type="hidden" name="XML_ID" id="XML_ID" value="'.$str_XML_ID.'">');
	}
	else
	{
		$tabControl->AddEditField("XML_ID", GetMessage("IBLOCK_FIELD_XML_ID") . ":", $arIBlock["FIELDS"]["XML_ID"]["IS_REQUIRED"] === "Y", array("size" => 70, "maxlength" => 255, "id" => "XML_ID"), $str_XML_ID);
	}
}

$tabControl->AddEditField("SORT", GetMessage("IBLOCK_FIELD_SORT").":", $arIBlock["FIELDS"]["SORT"]["IS_REQUIRED"] === "Y", array("size" => 7, "maxlength" => 10), $str_SORT);

if(!empty($PROP)):
	if ($arIBlock["SECTION_PROPERTY"] === "Y" || defined("CATALOG_PRODUCT"))
	{
		$arPropLinks = array("IBLOCK_ELEMENT_PROP_VALUE");
		if(is_array($str_IBLOCK_ELEMENT_SECTION) && !empty($str_IBLOCK_ELEMENT_SECTION))
		{
			foreach($str_IBLOCK_ELEMENT_SECTION as $section_id)
			{
				foreach(CIBlockSectionPropertyLink::GetArray($IBLOCK_ID, $section_id) as $PID => $arLink)
					$arPropLinks[$PID] = "PROPERTY_".$PID;
			}
		}
		else
		{
			foreach(CIBlockSectionPropertyLink::GetArray($IBLOCK_ID, 0) as $PID => $arLink)
				$arPropLinks[$PID] = "PROPERTY_".$PID;
		}
		$tabControl->AddFieldGroup("IBLOCK_ELEMENT_PROPERTY", GetMessage("IBLOCK_ELEMENT_PROP_VALUE"), $arPropLinks, $bPropertyAjax);
	}

	$tabControl->AddSection("IBLOCK_ELEMENT_PROP_VALUE", GetMessage("IBLOCK_ELEMENT_PROP_VALUE"));

	foreach($PROP as $prop_code=>$prop_fields):
		$prop_values = $prop_fields["VALUE"];
		$tabControl->BeginCustomField("PROPERTY_".$prop_fields["ID"], $prop_fields["NAME"], $prop_fields["IS_REQUIRED"]==="Y");
		?>
		<tr id="tr_PROPERTY_<?echo $prop_fields["ID"];?>"<?if ($prop_fields["PROPERTY_TYPE"]=="F"):?> class="adm-detail-file-row"<?endif?>>
			<td class="adm-detail-valign-top" width="40%"><?if($prop_fields["HINT"]!=""):
				?><span id="hint_<?echo $prop_fields["ID"];?>"></span><script>BX.hint_replace(BX('hint_<?echo $prop_fields["ID"];?>'), '<?echo CUtil::JSEscape(htmlspecialcharsbx($prop_fields["HINT"]))?>');</script>&nbsp;<?
			endif;?><?echo $tabControl->GetCustomLabelHTML();?>:</td>
			<td width="60%"><?_ShowPropertyField('PROP['.$prop_fields["ID"].']', $prop_fields, $prop_fields["VALUE"], (($historyId <= 0) && (!$bVarsFromForm) && ($ID<=0) && (!$bPropertyAjax)), $bVarsFromForm||$bPropertyAjax, 50000, $tabControl->GetFormName(), $bCopy);?></td>
		</tr>
		<?
			$hidden = "";
			if(!is_array($prop_fields["~VALUE"]))
				$values = Array();
			else
				$values = $prop_fields["~VALUE"];
			$start = 1;
			foreach($values as $key=>$val)
			{
				if($bCopy)
				{
					$key = "n".$start;
					$start++;
				}

				if(is_array($val) && array_key_exists("VALUE",$val))
				{
					$hidden .= _ShowHiddenValue('PROP['.$prop_fields["ID"].']['.$key.'][VALUE]', $val["VALUE"]);
					$hidden .= _ShowHiddenValue('PROP['.$prop_fields["ID"].']['.$key.'][DESCRIPTION]', $val["DESCRIPTION"] ?? '');
				}
				else
				{
					$hidden .= _ShowHiddenValue('PROP['.$prop_fields["ID"].']['.$key.'][VALUE]', $val);
					$hidden .= _ShowHiddenValue('PROP['.$prop_fields["ID"].']['.$key.'][DESCRIPTION]', "");
				}
			}
		$tabControl->EndCustomField("PROPERTY_".$prop_fields["ID"], $hidden);
	endforeach;?>
<?endif;


/********************************************************/
$tabControl->BeginCustomField("FILTER", "Фильтр :");
if ($ID > 0 && !$bCopy)
{

    $obProperties = CIBlockProperty::GetList(['name' => 'asc'], ['ACTIVE' => 'Y', 'IBLOCK_ID' => $IBLOCK_ID]);
    $propIdSection=0;
    $sectionId=0;
    $filterPror=0;
    $filterSmart=0;
    $filterProrVal=0;
    while ($arProperty = $obProperties->GetNext()) {
        if($arProperty['CODE'] == "SECTION"){
            $propIdSection=$arProperty['ID'];
        }
        if($arProperty['CODE'] == "FILTER_URL_PAGE"){
            $filterPror=$arProperty['ID'];
        }
        if($arProperty['CODE'] == "FILTER_SMART"){
            $filterSmart=$arProperty['ID'];

        }

    }

    if(!empty($PROP[$propIdSection])){
        $sectionId=array_shift($PROP[$propIdSection]["VALUE"]);
    }
    if(!empty($PROP[$filterPror])){
        $filterProrVal=array_shift($PROP[$filterPror]["VALUE"]);
    }


    ?>
        <div id="filterSmart" data-id="<?=$filterSmart?>"></div>
    <tr class="heading" id="filter-smart"><td colspan="2">Фильтр:</td></tr>
    <tr>
    <td colspan="2">
        <div class="filter_tag_admin" data-id="<?=$filterPror?>">
            <?php if(!empty($sectionId)):?>

                <?php
                $sectionUrl = "";
                $res = CIBlockSection::GetByID($sectionId);
                if($ar_res = $res->GetNext()){
                    $sectionUrl = $ar_res["SECTION_PAGE_URL"];
                }

                ?>
            <div id="sectionUrl"><?=$sectionUrl?></div>
                <?php
                $APPLICATION->IncludeComponent(
                    "des:filter.tag.admin",
                    "catalog-smart",
                    array(
                        "IBLOCK_ID" => 1,
                        "SECTION_ID" => $sectionId,
                        "FILTER_NAME" => "seoTagFilter",
                        "FILTER" => $filterProrVal,
                        "SECTION" => $sectionUrl,
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );

                ?>
            <?php else:?>
                <div style="align-items: center; color: #f00; text-align: center;">Выберите ИД раздела и нажмите применить, для выбора фильтра.</div>
            <?php endif;?>
        </div>
    </td>
    </tr><?
}
$tabControl->EndCustomField("FILTER", '');

// Кнопка "Настроить"
$aMenu = array();
if (false == ((true == defined('BT_UT_AUTOCOMPLETE')) && (1 == BT_UT_AUTOCOMPLETE))) {
    $link = DeleteParam(array("mode"));
    $link = $GLOBALS["APPLICATION"]->GetCurPage() . "?mode=settings" . ($link <> "" ? "&" . $link : "");
    $aMenu[] = array(
        "TEXT" => GetMessage("IBEL_E_SETTINGS"),
        "TITLE" => GetMessage("IBEL_E_SETTINGS_TITLE"),
        "LINK" => "javascript:" . $tabControl->GetName() . ".ShowSettings('" . urlencode($link) . "')",
        "ICON" => "btn_settings",
    );

    $context = new CAdminContextMenu($aMenu);
    $context->Show();
}

/***************************************************************/
?>

    <!--<style>
        #tr_PROPERTY_128, #tr_PROPERTY_129{
            display: none;
        }
    </style>-->
<?php
	if (!$bAutocomplete && ($ID > 0 && !$bCopy))
	{
		$rsLinkedProps = CIBlockProperty::GetList(array(), array(
			"PROPERTY_TYPE" => "E",
			"LINK_IBLOCK_ID" => $IBLOCK_ID,
			"ACTIVE" => "Y",
			"FILTRABLE" => "Y",
		));
		$arLinkedProp = $rsLinkedProps->GetNext();
		if ($arLinkedProp && !$adminSidePanelHelper->isPublicSidePanel())
		{
			$linkedTitle = '';
			$tabControl->BeginCustomField("LINKED_PROP", GetMessage("IBLOCK_ELEMENT_EDIT_LINKED"));
			?>
			<tr class="heading" id="tr_LINKED_PROP">
				<td colspan="2"><?echo $tabControl->GetCustomLabelHTML();?></td>
			</tr>
			<?
			if (defined('BX_PUBLIC_MODE') && BX_PUBLIC_MODE == 1)
				$linkedTitle = htmlspecialcharsbx(GetMessage('IBLOCK_LINKED_ELEMENT_TITLE'));
			do
			{
				$elements_name = (string)CIBlock::GetArrayByID($arLinkedProp["IBLOCK_ID"], "ELEMENTS_NAME");
				if ($elements_name == '')
					$elements_name = GetMessage("IBLOCK_ELEMENT_EDIT_ELEMENTS");
			?><tr id="tr_LINKED_PROP<?echo $arLinkedProp["ID"]?>">
				<?
				$href = $selfFolderUrl.htmlspecialcharsbx(CIBlock::GetAdminElementListLink($arLinkedProp["IBLOCK_ID"],
					array('apply_filter'=>'Y', 'PROPERTY_'.$arLinkedProp["ID"]=>$ID, 'find_section_section' => -1)));
				?>
				<td colspan="2">
					<a title="<?=$linkedTitle; ?>" href="<?=$href?>">
						<?=htmlspecialcharsbx(CIBlock::GetArrayByID($arLinkedProp["IBLOCK_ID"], "NAME").": ".$elements_name);?>
					</a>
				</td>
			</tr><?
			}
			while ($arLinkedProp = $rsLinkedProps->GetNext());
			unset($linkedTitle);
			$tabControl->EndCustomField("LINKED_PROP", "");
		}
	}

$tabControl->BeginNextFormTab();
$tabControl->BeginCustomField("PREVIEW_PICTURE", GetMessage("IBLOCK_FIELD_PREVIEW_PICTURE"), $arIBlock["FIELDS"]["PREVIEW_PICTURE"]["IS_REQUIRED"] === "Y");
if($bVarsFromForm && !array_key_exists("PREVIEW_PICTURE", $_REQUEST) && $arElement)
	$str_PREVIEW_PICTURE = intval($arElement["PREVIEW_PICTURE"]);
?>
	<tr id="tr_PREVIEW_PICTURE" class="adm-detail-file-row">
		<td width="40%" class="adm-detail-valign-top"><?echo $tabControl->GetCustomLabelHTML()?>:</td>
		<td width="60%">
			<?if($historyId > 0):
				echo CFileInput::Show(
					"PREVIEW_PICTURE",
					$str_PREVIEW_PICTURE,
					array(
						"IMAGE" => "Y",
						"PATH" => "Y",
						"FILE_SIZE" => "Y",
						"DIMENSIONS" => "Y",
						"IMAGE_POPUP" => "Y",
						"MAX_SIZE" => array(
							"W" => COption::GetOptionString("iblock", "detail_image_size"),
							"H" => COption::GetOptionString("iblock", "detail_image_size"),
						)
					)
				);
			else:
				echo \Bitrix\Main\UI\FileInput::createInstance(array(
					"name" => "PREVIEW_PICTURE",
					"description" => true,
					"upload" => true,
					"allowUpload" => "I",
					"medialib" => true,
					"fileDialog" => true,
					"cloud" => true,
					"delete" => true,
					"maxCount" => 1
				))->show(
					($bVarsFromForm ? ($_REQUEST["PREVIEW_PICTURE"] ?? null) : ($ID > 0 && !$bCopy ? $str_PREVIEW_PICTURE: 0)),
					$bVarsFromForm
				);
			endif;?>
		</td>
	</tr>
<?
$tabControl->EndCustomField("PREVIEW_PICTURE", "");
$tabControl->BeginCustomField("PREVIEW_TEXT", GetMessage("IBLOCK_FIELD_PREVIEW_TEXT"), $arIBlock["FIELDS"]["PREVIEW_TEXT"]["IS_REQUIRED"] === "Y");
?>
	<tr class="heading" id="tr_PREVIEW_TEXT_LABEL">
		<td colspan="2"><?= $tabControl->GetCustomLabelHTML()?></td>
	</tr>
	<?if($ID && $PREV_ID && $bWorkflow):?>
	<tr id="tr_PREVIEW_TEXT_DIFF">
		<td colspan="2">
			<div style="width:95%;background-color:white;border:1px solid black;padding:5px">
				<?echo getDiff($prev_arElement["PREVIEW_TEXT"], $arElement["PREVIEW_TEXT"])?>
			</div>
		</td>
	</tr>
	<?elseif(COption::GetOptionString("iblock", "use_htmledit", "Y")=="Y" && $bFileman):?>
	<tr id="tr_PREVIEW_TEXT_EDITOR">
		<td colspan="2" align="center">
			<?CFileMan::AddHTMLEditorFrame(
			"PREVIEW_TEXT",
			$str_PREVIEW_TEXT,
			"PREVIEW_TEXT_TYPE",
			$str_PREVIEW_TEXT_TYPE,
			array(
				'height' => 450,
				'width' => '100%'
			),
			"N",
			0,
			"",
			"",
			$arIBlock["LID"],
			true,
			false,
			array(
				'toolbarConfig' => CFileMan::GetEditorToolbarConfig("iblock_".(defined('BX_PUBLIC_MODE') && BX_PUBLIC_MODE == 1 ? 'public' : 'admin')),
				'saveEditorKey' => $IBLOCK_ID,
				'hideTypeSelector' => $arIBlock["FIELDS"]["PREVIEW_TEXT_TYPE_ALLOW_CHANGE"]["DEFAULT_VALUE"] === "N",
			)
			);?>
		</td>
	</tr>
	<?else:?>
	<tr id="tr_PREVIEW_TEXT_TYPE">
		<td><?echo GetMessage("IBLOCK_DESC_TYPE")?></td>
		<td>
			<?if($arIBlock["FIELDS"]["PREVIEW_TEXT_TYPE_ALLOW_CHANGE"]["DEFAULT_VALUE"] === "N"):?>
				<input type="hidden" name="PREVIEW_TEXT_TYPE" value="<?echo $str_PREVIEW_TEXT_TYPE?>"><?echo $str_PREVIEW_TEXT_TYPE!="html"? GetMessage("IBLOCK_DESC_TYPE_TEXT"): GetMessage("IBLOCK_DESC_TYPE_HTML")?>
			<?else:?>
				<input type="radio" name="PREVIEW_TEXT_TYPE" id="PREVIEW_TEXT_TYPE_text" value="text"<?if($str_PREVIEW_TEXT_TYPE!="html")echo " checked"?>> <label for="PREVIEW_TEXT_TYPE_text"><?echo GetMessage("IBLOCK_DESC_TYPE_TEXT")?></label> / <input type="radio" name="PREVIEW_TEXT_TYPE" id="PREVIEW_TEXT_TYPE_html" value="html"<?if($str_PREVIEW_TEXT_TYPE=="html")echo " checked"?>> <label for="PREVIEW_TEXT_TYPE_html"><?echo GetMessage("IBLOCK_DESC_TYPE_HTML")?></label>
			<?endif?>
		</td>
	</tr>
	<tr id="tr_PREVIEW_TEXT">
		<td colspan="2" align="center">
			<textarea cols="60" rows="10" name="PREVIEW_TEXT" style="width:100%"><?echo $str_PREVIEW_TEXT?></textarea>
		</td>
	</tr>
	<?endif;
$tabControl->EndCustomField("PREVIEW_TEXT",
	'<input type="hidden" name="PREVIEW_TEXT" value="'.$str_PREVIEW_TEXT.'">'.
	'<input type="hidden" name="PREVIEW_TEXT_TYPE" value="'.$str_PREVIEW_TEXT_TYPE.'">'
);
$tabControl->BeginNextFormTab();
$tabControl->BeginCustomField("DETAIL_PICTURE", GetMessage("IBLOCK_FIELD_DETAIL_PICTURE"), $arIBlock["FIELDS"]["DETAIL_PICTURE"]["IS_REQUIRED"] === "Y");
if($bVarsFromForm && !array_key_exists("DETAIL_PICTURE", $_REQUEST) && $arElement)
	$str_DETAIL_PICTURE = intval($arElement["DETAIL_PICTURE"]);
?>
	<tr id="tr_DETAIL_PICTURE" class="adm-detail-file-row">
		<td width="40%" class="adm-detail-valign-top"><?echo $tabControl->GetCustomLabelHTML()?>:</td>
		<td width="60%">
			<?if($historyId > 0):
				echo CFileInput::Show(
					"DETAIL_PICTURE",
					$str_DETAIL_PICTURE,
					array(
						"IMAGE" => "Y",
						"PATH" => "Y",
						"FILE_SIZE" => "Y",
						"DIMENSIONS" => "Y",
						"IMAGE_POPUP" => "Y",
						"MAX_SIZE" => array(
							"W" => COption::GetOptionString("iblock", "detail_image_size"),
							"H" => COption::GetOptionString("iblock", "detail_image_size"),
						)
					)
				);
			else:
				echo \Bitrix\Main\UI\FileInput::createInstance(array(
					"name" => "DETAIL_PICTURE",
					"description" => true,
					"upload" => true,
					"allowUpload" => "I",
					"medialib" => true,
					"fileDialog" => true,
					"cloud" => true,
					"delete" => true,
					"maxCount" => 1
				))->show(
					$bVarsFromForm ? ($_REQUEST["DETAIL_PICTURE"] ?? null) : ($ID > 0 && !$bCopy? $str_DETAIL_PICTURE: 0),
					$bVarsFromForm
				);
			endif;?>
		</td>
	</tr>
<?
$tabControl->EndCustomField("DETAIL_PICTURE", "");
$tabControl->BeginCustomField("DETAIL_TEXT", GetMessage("IBLOCK_FIELD_DETAIL_TEXT"), $arIBlock["FIELDS"]["DETAIL_TEXT"]["IS_REQUIRED"] === "Y");
?>
	<tr class="heading" id="tr_DETAIL_TEXT_LABEL">
		<td colspan="2"><?echo $tabControl->GetCustomLabelHTML()?></td>
	</tr>
	<?if($ID && $PREV_ID && $bWorkflow):?>
	<tr id="tr_DETAIL_TEXT_DIFF">
		<td colspan="2">
			<div style="width:95%;background-color:white;border:1px solid black;padding:5px">
				<?echo getDiff($prev_arElement["DETAIL_TEXT"], $arElement["DETAIL_TEXT"])?>
			</div>
		</td>
	</tr>
	<?elseif(COption::GetOptionString("iblock", "use_htmledit", "Y")=="Y" && $bFileman):?>
	<tr id="tr_DETAIL_TEXT_EDITOR">
		<td colspan="2" align="center">
			<?CFileMan::AddHTMLEditorFrame(
				"DETAIL_TEXT",
				$str_DETAIL_TEXT,
				"DETAIL_TEXT_TYPE",
				$str_DETAIL_TEXT_TYPE,
				array(
					'height' => 450,
					'width' => '100%'
				),
				"N",
				0,
				"",
				"",
				$arIBlock["LID"],
				true,
				false,
				array(
					'toolbarConfig' => CFileMan::GetEditorToolbarConfig("iblock_".(defined('BX_PUBLIC_MODE') && BX_PUBLIC_MODE == 1 ? 'public' : 'admin')),
					'saveEditorKey' => $IBLOCK_ID,
					'hideTypeSelector' => $arIBlock["FIELDS"]["DETAIL_TEXT_TYPE_ALLOW_CHANGE"]["DEFAULT_VALUE"] === "N",
				)
			);
		?></td>
	</tr>
	<?else:?>
	<tr id="tr_DETAIL_TEXT_TYPE">
		<td><?echo GetMessage("IBLOCK_DESC_TYPE")?></td>
		<td>
			<?if($arIBlock["FIELDS"]["DETAIL_TEXT_TYPE_ALLOW_CHANGE"]["DEFAULT_VALUE"] === "N"):?>
				<input type="hidden" name="DETAIL_TEXT_TYPE" value="<?echo $str_DETAIL_TEXT_TYPE?>"><?echo $str_DETAIL_TEXT_TYPE!="html"? GetMessage("IBLOCK_DESC_TYPE_TEXT"): GetMessage("IBLOCK_DESC_TYPE_HTML")?>
			<?else:?>
				<input type="radio" name="DETAIL_TEXT_TYPE" id="DETAIL_TEXT_TYPE_text" value="text"<?if($str_DETAIL_TEXT_TYPE!="html")echo " checked"?>> <label for="DETAIL_TEXT_TYPE_text"><?echo GetMessage("IBLOCK_DESC_TYPE_TEXT")?></label> / <input type="radio" name="DETAIL_TEXT_TYPE" id="DETAIL_TEXT_TYPE_html" value="html"<?if($str_DETAIL_TEXT_TYPE=="html")echo " checked"?>> <label for="DETAIL_TEXT_TYPE_html"><?echo GetMessage("IBLOCK_DESC_TYPE_HTML")?></label>
			<?endif?>
		</td>
	</tr>
	<tr id="tr_DETAIL_TEXT">
		<td colspan="2" align="center">
			<textarea cols="60" rows="20" name="DETAIL_TEXT" style="width:100%"><?echo $str_DETAIL_TEXT?></textarea>
		</td>
	</tr>
	<?endif?>
<?
$tabControl->EndCustomField("DETAIL_TEXT",
	'<input type="hidden" name="DETAIL_TEXT" value="'.$str_DETAIL_TEXT.'">'.
	'<input type="hidden" name="DETAIL_TEXT_TYPE" value="'.$str_DETAIL_TEXT_TYPE.'">'
);
	$tabControl->BeginNextFormTab();
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_META_TITLE", GetMessage("IBEL_E_SEO_META_TITLE"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_META_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_META_TITLE",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_META_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS", GetMessage("IBEL_E_SEO_META_KEYWORDS"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_META_KEYWORDS", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_META_KEYWORDS", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION", GetMessage("IBEL_E_SEO_META_DESCRIPTION"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_META_DESCRIPTION", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_META_DESCRIPTION", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE", GetMessage("IBEL_E_SEO_ELEMENT_TITLE"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_PAGE_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_PAGE_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->AddSection("IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE", GetMessage("IBEL_E_SEO_FOR_ELEMENTS_PREVIEW_PICTURE"));
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT", GetMessage("IBEL_E_SEO_FILE_ALT"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_PREVIEW_PICTURE_FILE_ALT", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_PREVIEW_PICTURE_FILE_ALT", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE", GetMessage("IBEL_E_SEO_FILE_TITLE"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_PREVIEW_PICTURE_FILE_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_PREVIEW_PICTURE_FILE_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME", GetMessage("IBEL_E_SEO_FILE_NAME"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_PREVIEW_PICTURE_FILE_NAME", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_PREVIEW_PICTURE_FILE_NAME", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->AddSection("IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE", GetMessage("IBEL_E_SEO_FOR_ELEMENTS_DETAIL_PICTURE"));
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT", GetMessage("IBEL_E_SEO_FILE_ALT"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_DETAIL_PICTURE_FILE_ALT", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_DETAIL_PICTURE_FILE_ALT", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE", GetMessage("IBEL_E_SEO_FILE_TITLE"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_DETAIL_PICTURE_FILE_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_DETAIL_PICTURE_FILE_TITLE", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->BeginCustomField("IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME", GetMessage("IBEL_E_SEO_FILE_NAME"));
	?>
	<tr class="adm-detail-valign-top">
		<td width="40%"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%"><?echo IBlockInheritedPropertyInput($IBLOCK_ID, "ELEMENT_DETAIL_PICTURE_FILE_NAME", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME",
		IBlockInheritedPropertyHidden($IBLOCK_ID, "ELEMENT_DETAIL_PICTURE_FILE_NAME", $str_IPROPERTY_TEMPLATES, "E", GetMessage("IBEL_E_SEO_OVERWRITE"))
	);
	?>
	<?
	$tabControl->AddSection("SEO_ADDITIONAL", GetMessage("IBLOCK_EL_TAB_MO"));
	$tabControl->BeginCustomField("TAGS", GetMessage("IBLOCK_FIELD_TAGS").":", $arIBlock["FIELDS"]["TAGS"]["IS_REQUIRED"] === "Y");
	?>
		<tr id="tr_TAGS">
			<td><?echo $tabControl->GetCustomLabelHTML()?><br><?echo GetMessage("IBLOCK_ELEMENT_EDIT_TAGS_TIP")?></td>
			<td>
				<?if(Bitrix\Main\Loader::includeModule('search')):
					$arLID = array();
					$rsSites = CIBlock::GetSite($IBLOCK_ID);
					while($arSite = $rsSites->Fetch())
						$arLID[] = $arSite["LID"];
					echo InputTags("TAGS", htmlspecialcharsback($str_TAGS), $arLID, 'size="55"');
				else:?>
					<input type="text" size="20" name="TAGS" maxlength="255" value="<?echo $str_TAGS?>">
				<?endif?>
			</td>
		</tr>
	<?
	$tabControl->EndCustomField("TAGS",
		'<input type="hidden" name="TAGS" value="'.$str_TAGS.'">'
	);

	?>

<?if($arShowTabs['sections']):
	$tabControl->BeginNextFormTab();

	$tabControl->BeginCustomField("SECTIONS", GetMessage("IBLOCK_SECTION"), $arIBlock["FIELDS"]["IBLOCK_SECTION"]["IS_REQUIRED"] === "Y");
	?>
	<tr id="tr_SECTIONS">
	<?if($arIBlock["SECTION_CHOOSER"] != "D" && $arIBlock["SECTION_CHOOSER"] != "P"):?>

		<?$l = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>$IBLOCK_ID), array("ID", "NAME", "DEPTH_LEVEL"));?>
		<td width="40%" class="adm-detail-valign-top"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%">
		<select name="IBLOCK_SECTION[]" size="14" multiple onchange="onSectionChanged()">
			<option value="0"<?if(is_array($str_IBLOCK_ELEMENT_SECTION) && in_array(0, $str_IBLOCK_ELEMENT_SECTION))echo " selected"?>><?echo GetMessage("IBLOCK_UPPER_LEVEL")?></option>
		<?
			while($ar_l = $l->GetNext()):
				?><option value="<?echo $ar_l["ID"]?>"<?if(is_array($str_IBLOCK_ELEMENT_SECTION) && in_array($ar_l["ID"], $str_IBLOCK_ELEMENT_SECTION))echo " selected"?>><?echo str_repeat(" . ", $ar_l["DEPTH_LEVEL"])?><?echo $ar_l["NAME"]?></option><?
			endwhile;
		?>
		</select>
		</td>

	<?elseif($arIBlock["SECTION_CHOOSER"] == "D"):?>
		<td width="40%" class="adm-detail-valign-top"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%">
			<table class="internal" id="sections">
			<?php
			if(is_array($str_IBLOCK_ELEMENT_SECTION))
			{
				$i = 0;
				foreach($str_IBLOCK_ELEMENT_SECTION as $section_id)
				{
					$rsChain = CIBlockSection::GetNavChain(
						$IBLOCK_ID,
						$section_id,
						[
							'ID',
							'NAME',
						],
						true
					);
					$strPath = "";
					foreach ($rsChain as $arChain)
					{
						$strPath .= htmlspecialcharsbx($arChain["NAME"]) . "&nbsp;/&nbsp;";
					}
					if ($strPath !== '')
					{
						?><tr>
							<td nowrap><?= $strPath; ?></td>
							<td>
							<input type="button" value="<?= GetMessage("MAIN_DELETE")?>" OnClick="deleteRow(this)">
							<input type="hidden" name="IBLOCK_SECTION[]" value="<?= (int)$section_id; ?>">
							</td>
						</tr><?php
					}
					$i++;
				}
			}
			?>
			<tr>
				<td>
				<script>
				function deleteRow(button)
				{
					var my_row = button.parentNode.parentNode;
					var table = document.getElementById('sections');
					if(table)
					{
						for(var i=0; i<table.rows.length; i++)
						{
							if(table.rows[i] == my_row)
							{
								table.deleteRow(i);
								onSectionChanged();
							}
						}
					}
				}
				function addPathRow()
				{
					var table = document.getElementById('sections');
					if(table)
					{
						var section_id = 0;
						var html = '';
						var lev = 0;
						var oSelect;
						while(oSelect = document.getElementById('select_IBLOCK_SECTION_'+lev))
						{
							if(oSelect.value < 1)
								break;
							html += oSelect.options[oSelect.selectedIndex].text+'&nbsp;/&nbsp;';
							section_id = oSelect.value;
							lev++;
						}
						if(section_id > 0)
						{
							var cnt = table.rows.length;
							var oRow = table.insertRow(cnt-1);

							var i=0;
							var oCell = oRow.insertCell(i++);
							oCell.innerHTML = html;

							oCell = oRow.insertCell(i++);
							oCell.innerHTML =
								'<input type="button" value="<?echo GetMessage("MAIN_DELETE")?>" OnClick="deleteRow(this)">'+
								'<input type="hidden" name="IBLOCK_SECTION[]" value="'+section_id+'">';
							onSectionChanged();
						}
					}
				}
				function find_path(item, value)
				{
					if(item.id==value)
					{
						var a = Array(1);
						a[0] = item.id;
						return a;
					}
					else
					{
						for(var s in item.children)
						{
							if(ar = find_path(item.children[s], value))
							{
								var a = Array(1);
								a[0] = item.id;
								return a.concat(ar);
							}
						}
						return null;
					}
				}
				function find_children(level, value, item)
				{
					if(level==-1 && item.id==value)
						return item;
					else
					{
						for(var s in item.children)
						{
							if(ch = find_children(level-1,value,item.children[s]))
								return ch;
						}
						return null;
					}
				}
				function change_selection(name_prefix, prop_id,value,level,id)
				{
					var lev = level+1;
					var oSelect;

					while(oSelect = document.getElementById(name_prefix+lev))
					{
						jsSelectUtils.deleteAllOptions(oSelect);
						jsSelectUtils.addNewOption(oSelect, '0', '(<?echo GetMessage("MAIN_NO")?>)');
						lev++;
					}

					oSelect = document.getElementById(name_prefix+(level+1))
					if(oSelect && (value!=0||level==-1))
					{
						var item = find_children(level,value,window['sectionListsFor'+prop_id]);
						for(var s in item.children)
						{
							var obj = item.children[s];
							jsSelectUtils.addNewOption(oSelect, obj.id, obj.name, true);
						}
					}
					if(document.getElementById(id))
						document.getElementById(id).value = value;
				}
				function init_selection(name_prefix, prop_id, value, id)
				{
					var a = find_path(window['sectionListsFor'+prop_id], value);
					change_selection(name_prefix, prop_id, 0, -1, id);
					for(var i=1;i<a.length;i++)
					{
						if(oSelect = document.getElementById(name_prefix+(i-1)))
						{
							for(var j=0;j<oSelect.length;j++)
							{
								if(oSelect[j].value==a[i])
								{
									oSelect[j].selected=true;
									break;
								}
							}
						}
						change_selection(name_prefix, prop_id, a[i], i-1, id);
					}
				}
				var sectionListsFor0 = {id:0,name:'',children:Array()};

				<?
				$rsItems = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>$IBLOCK_ID), array("ID", "NAME", "DEPTH_LEVEL"));
				$depth = 0;
				$max_depth = 0;
				$arChain = array();
				while($arItem = $rsItems->GetNext())
				{
					if($max_depth < $arItem["DEPTH_LEVEL"])
					{
						$max_depth = $arItem["DEPTH_LEVEL"];
					}
					if($depth < $arItem["DEPTH_LEVEL"])
					{
						$arChain[]=$arItem["ID"];

					}
					while($depth > $arItem["DEPTH_LEVEL"])
					{
						array_pop($arChain);
						$depth--;
					}
					$arChain[count($arChain)-1] = $arItem["ID"];
					echo "sectionListsFor0";
					foreach($arChain as $i)
						echo ".children['".intval($i)."']";

					echo " = { id : ".$arItem["ID"].", name : '".CUtil::JSEscape($arItem["NAME"])."', children : Array() };\n";
					$depth = $arItem["DEPTH_LEVEL"];
				}
				?>
				</script>
				<?
				for($i = 0; $i < $max_depth; $i++)
					echo '<select id="select_IBLOCK_SECTION_'.$i.'" onchange="change_selection(\'select_IBLOCK_SECTION_\',  0, this.value, '.$i.', \'IBLOCK_SECTION[n'.$key.']\')"><option value="0">('.GetMessage("MAIN_NO").')</option></select>&nbsp;';
				?>
				<script>
					init_selection('select_IBLOCK_SECTION_', 0, '', 0);
				</script>
				</td>
				<td><input type="button" value="<?echo GetMessage("IBLOCK_ELEMENT_EDIT_PROP_ADD")?>" onClick="addPathRow()"></td>
			</tr>
			</table>
		</td>

	<?else:?>
		<td width="40%" class="adm-detail-valign-top"><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td width="60%">
			<table id="sections" class="internal">
			<?php
			if(is_array($str_IBLOCK_ELEMENT_SECTION))
			{
				$i = 0;
				foreach($str_IBLOCK_ELEMENT_SECTION as $section_id)
				{
					$rsChain = CIBlockSection::GetNavChain(
						$IBLOCK_ID,
						$section_id,
						[
							'ID',
							'NAME',
						],
						true
					);
					$strPath = "";
					foreach ($rsChain as $arChain)
					{
						$strPath .= htmlspecialcharsbx($arChain["NAME"]) . "&nbsp;/&nbsp;";
					}
					if ($strPath !== '')
					{
						?><tr>
							<td><?= $strPath; ?></td>
							<td>
							<input type="button" value="<?= GetMessage("MAIN_DELETE")?>" OnClick="deleteRow(this)">
							<input type="hidden" name="IBLOCK_SECTION[]" value="<?= (int)$section_id; ?>">
							</td>
						</tr><?php
					}
					$i++;
				}
			}
			?>
			</table>
				<script>
				function deleteRow(button)
				{
					var my_row = button.parentNode.parentNode;
					var table = document.getElementById('sections');
					if(table)
					{
						for(var i=0; i<table.rows.length; i++)
						{
							if(table.rows[i] == my_row)
							{
								table.deleteRow(i);
								onSectionChanged();
							}
						}
					}
				}
				function InS<?echo md5("input_IBLOCK_SECTION")?>(section_id, html)
				{
					var table = document.getElementById('sections');
					if(table)
					{
						if(section_id > 0 && html)
						{
							var cnt = table.rows.length;
							var oRow = table.insertRow(cnt-1);

							var i=0;
							var oCell = oRow.insertCell(i++);
							oCell.innerHTML = html;

							oCell = oRow.insertCell(i++);
							oCell.innerHTML =
								'<input type="button" value="<?echo GetMessage("MAIN_DELETE")?>" OnClick="deleteRow(this)">'+
								'<input type="hidden" name="IBLOCK_SECTION[]" value="'+section_id+'">';
							onSectionChanged();
						}
					}
				}
				</script>
				<input name="input_IBLOCK_SECTION" id="input_IBLOCK_SECTION" type="hidden">
				<input type="button" value="<?echo GetMessage("IBLOCK_ELEMENT_EDIT_PROP_ADD")?>..." onClick="jsUtils.OpenWindow('<?=$selfFolderUrl?>iblock_section_search.php?lang=<?echo LANGUAGE_ID?>&amp;IBLOCK_ID=<?echo $IBLOCK_ID?>&amp;n=input_IBLOCK_SECTION&amp;m=y&amp;iblockfix=y&amp;tableId=iblocksection-<?=$IBLOCK_ID; ?>', 900, 700);">
		</td>
	<?endif;?>
	</tr>
	<input type="hidden" name="IBLOCK_SECTION[]" value="">
	<script>
	function onSectionChanged()
	{
		<?
		$additionalParams = '';
		if ($bCatalog)
		{
			$catalogParams = array('TMP_ID' => $TMP_ID);
			CCatalogAdminTools::addTabParams($catalogParams);
			if (!empty($catalogParams))
			{
				foreach ($catalogParams as $name => $value)
				{
					if ($additionalParams != '')
						$additionalParams .= '&';
					$additionalParams .= urlencode($name) . "=" . urlencode($value);
				}
				unset($name, $value);
			}
			unset($catalogParams);
		}
		?>
		var form = BX('<?echo CUtil::JSEscape($tabControl->GetFormName())?>'),
			url = '<?echo CUtil::JSEscape($APPLICATION->GetCurPageParam($additionalParams))?>',
			selectedTab = BX('<?echo CUtil::JSEscape("form_element_".$IBLOCK_ID."_active_tab")?>'),
			groupField;

		if (selectedTab && selectedTab.value)
		{
			url += '&<?echo CUtil::JSEscape("form_element_".$IBLOCK_ID."_active_tab")?>=' + selectedTab.value;
		}
		<?if($arIBlock["SECTION_PROPERTY"] === "Y" || defined("CATALOG_PRODUCT")):?>
		groupField = new JCIBlockGroupField(form, 'tr_IBLOCK_ELEMENT_PROPERTY', url);
		groupField.reload();
		<?endif;
		if($arIBlock["FIELDS"]["IBLOCK_SECTION"]["DEFAULT_VALUE"]["KEEP_IBLOCK_SECTION_ID"] === "Y"):?>
		InheritedPropertiesTemplates.updateInheritedPropertiesValues(false, true);
		<?endif?>
	}
	</script>
	<?
	$hidden = "";
	if(is_array($str_IBLOCK_ELEMENT_SECTION))
		foreach($str_IBLOCK_ELEMENT_SECTION as $section_id)
			$hidden .= '<input type="hidden" name="IBLOCK_SECTION[]" value="'.intval($section_id).'">';
	$tabControl->EndCustomField("SECTIONS", $hidden);
endif;

if ($arShowTabs['product'])
{
	$tabControl->BeginNextFormTab();
	$tabControl->BeginCustomField(
		'PRODUCT',
		$catalogTabNames[CCatalogAdminTools::TAB_PRODUCT]['NAME'],
		false
	);

	$iblockEditProduct = $ID > 0 && !$bCopy
		? CIBlockElementRights::UserHasRightTo($IBLOCK_ID, $ID, 'element_edit_price')
		: CIBlockSectionRights::UserHasRightTo($IBLOCK_ID, $MENU_SECTION_ID, 'element_edit_price')
	;

	$allowEdit = false;
	if ($iblockEditProduct)
	{
		$allowEdit = $ID > 0 && !$bCopy
			? $allowProductEdit
			: $allowProductAdd
		;
	}

	$product = [
		'ID' => $ID,
		'IBLOCK_ID' => $IBLOCK_ID,
		'TYPE' => Catalog\ProductTable::TYPE_SKU,
	];
	$productConfig = [
		'FROM_FORM' => $bVarsFromForm,
		'ALLOW_EDIT' => $allowEdit,
	];

	echo CCatalogAdminTools::getSystemProductFieldsHtml($product, $productConfig);

	$tabControl->EndCustomField('PRODUCT', '');
}

if ($arShowTabs['catalog'])
{
	$tabControl->BeginNextFormTab();
	$tabControl->BeginCustomField(
		'CATALOG',
		$catalogTabNames[CCatalogAdminTools::TAB_CATALOG]['NAME'],
		true
	);
	include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/admin/templates/product_edit.php");
	$tabControl->EndCustomField("CATALOG", "");
}

if ($arShowTabs['sku'])
{
	$tabControl->BeginNextFormTab();
	$tabControl->BeginCustomField('OFFERS', GetMessage("IBLOCK_EL_TAB_OFFERS"), false);
	?><tr id="tr_OFFERS"><td colspan="2"><?

	define('B_ADMIN_SUBELEMENTS',1);
	define('B_ADMIN_SUBELEMENTS_LIST',false);

	$intSubIBlockID = $arMainCatalog['IBLOCK_ID'];
	$arSubIBlock = CIBlock::GetArrayByID($intSubIBlockID);
	$arSubIBlock["SITE_ID"] = array();
	$rsSites = CIBlock::GetSite($intSubIBlockID);
	while($arSite = $rsSites->Fetch())
		$arSubIBlock["SITE_ID"][] = $arSite["LID"];
	$strSubIBlockType = $arSubIBlock['IBLOCK_TYPE_ID'];
	$arSubIBlockType = CIBlockType::GetByIDLang($strSubIBlockType, LANGUAGE_ID);

	$boolIncludeOffers = CIBlockRights::UserHasRightTo($intSubIBlockID, $intSubIBlockID, "iblock_admin_display");
	$arSubCatalog = CCatalogSku::GetInfoByOfferIBlock($arMainCatalog['IBLOCK_ID']);
	$boolSubCatalog = (!empty($arSubCatalog) && is_array($arSubCatalog));
	if (!$boolCatalogRead && !$boolCatalogPrice)
		$boolSubCatalog = false;

	$boolSubWorkFlow = Bitrix\Main\Loader::includeModule("workflow") && $arSubIBlock["WORKFLOW"] != "N";
	$boolSubBizproc = Bitrix\Main\Loader::includeModule("bizproc") && $arSubIBlock["BIZPROC"] != "N";

	$intSubPropValue = (0 == $ID || $bCopy ? '-'.$TMP_ID : $ID);
	$strSubTMP_ID = $TMP_ID;

	$additionalParams = (defined("SELF_FOLDER_URL") ? "&public=y" : "");
	$strSubElementAjaxPath = '/bitrix/tools/iblock/iblock_subelement_admin.php?WF=Y&IBLOCK_ID=' . $intSubIBlockID
		. '&type='.urlencode($strSubIBlockType) . '&lang=' . LANGUAGE_ID
		. '&find_section_section=0&find_el_property_' . $arSubCatalog['SKU_PROPERTY_ID']
		. '='.(0 == $ID || $bCopy ? '-' . $TMP_ID : $ID)
		. '&TMP_ID=' . urlencode($strSubTMP_ID)
		. '&urlBuilderId=' . urlencode($urlBuilderId)
		. $additionalParams
	;
	if ($boolIncludeOffers && file_exists($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/iblock/admin/templates/iblock_subelement_list.php'))
	{
		require($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/iblock/admin/templates/iblock_subelement_list.php');
	}
	else
	{
		ShowError(GetMessage('IBLOCK_EL_OFFERS_ACCESS_DENIED'));
	}
	?></td></tr><?
	$tabControl->EndCustomField('OFFERS','');
}

if ($arShowTabs['product_set'])
{
	$tabControl->BeginNextFormTab();
	$tabControl->BeginCustomField('PRODUCT_SET', GetMessage('IBLOCK_EL_PRODUCT_SET').':', false);
	?><tr id="tr_PRODUCT_SET"><td colspan="2"><?

	$intProductID = (0 < $ID ? CIBlockElement::GetRealElement($ID) : 0);

	$arSets = false;
	CCatalogAdminProductSetEdit::setProductFormParams(array('TYPE' => CCatalogProductSet::TYPE_SET));
	if (0 < $intProductID)
	{
		$arSets = CCatalogProductSet::getAllSetsByProduct($intProductID, CCatalogProductSet::TYPE_SET);
		if ($bCopy)
			CCatalogAdminProductSetEdit::clearOwnerSet($arSets);
	}
	if (empty($arSets))
		$arSets = CCatalogAdminProductSetEdit::getEmptySet($intProductID);

	if ($bVarsFromForm)
		CCatalogAdminProductSetEdit::getFormValues($arSets);
	CCatalogAdminProductSetEdit::addEmptyValues($arSets);

	CCatalogAdminProductSetEdit::showEditForm($arSets);
	?></td></tr><?
	$tabControl->EndCustomField('PRODUCT_SET', '');
}
if ($arShowTabs['product_group'])
{
	$tabControl->BeginNextFormTab();
	$tabControl->BeginCustomField('PRODUCT_GROUP', GetMessage('IBLOCK_EL_PRODUCT_GROUP').':', false);
	?><tr id="tr_PRODUCT_GROUP"><td colspan="2"><?

	$intProductID = (0 < $ID ? CIBlockElement::GetRealElement($ID) : 0);

	$arSets = false;
	CCatalogAdminProductSetEdit::setProductFormParams(array('TYPE' => CCatalogProductSet::TYPE_GROUP));
	if (0 < $intProductID)
	{
		$arSets = CCatalogProductSet::getAllSetsByProduct($intProductID, CCatalogProductSet::TYPE_GROUP);
		if ($bCopy)
			CCatalogAdminProductSetEdit::clearOwnerSet($arSets);
	}
	if (empty($arSets))
		$arSets = CCatalogAdminProductSetEdit::getEmptySet($intProductID);
	if ($bVarsFromForm)
		CCatalogAdminProductSetEdit::getFormValues($arSets);
	CCatalogAdminProductSetEdit::addEmptyValues($arSets);

	CCatalogAdminProductSetEdit::showEditForm($arSets);

	?></td></tr><?
	$tabControl->EndCustomField('PRODUCT_GROUP', '');
}
if($arShowTabs['workflow']):?>
<?
	$tabControl->BeginNextFormTab();
	$tabControl->BeginCustomField("WORKFLOW_PARAMS", GetMessage("IBLOCK_EL_TAB_WF_TITLE"));
	if ((string)($pr['DATE_CREATE'] ?? null) !== ''):
	?>
		<tr id="tr_WF_CREATED">
			<td width="40%"><?echo GetMessage("IBLOCK_CREATED")?></td>
			<td width="60%"><?echo $pr["DATE_CREATE"]?><?
			if ((int)($pr["CREATED_BY"] ?? null) > 0):
			?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANGUAGE_ID?>&amp;ID=<?=(int)$pr["CREATED_BY"];?>"><?echo $pr["CREATED_BY"]?></a>]&nbsp;<?=htmlspecialcharsex($pr["CREATED_USER_NAME"])?><?
			endif;
			?></td>
		</tr>
	<?php
	endif;
	if ((string)($str_TIMESTAMP_X ?? null) !== '' && !$bCopy):?>
	<tr id="tr_WF_MODIFIED">
		<td><?echo GetMessage("IBLOCK_LAST_UPDATE")?></td>
		<td><?echo $str_TIMESTAMP_X?><?
		if ((int)($str_MODIFIED_BY ?? null) > 0):
		?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANGUAGE_ID?>&amp;ID=<?=(int)$str_MODIFIED_BY?>"><?echo $str_MODIFIED_BY?></a>]&nbsp;<?=$str_USER_NAME?><?
		endif;
		?></td>
	</tr>
	<?php
	endif;
	if ($WF=="Y" && (string)($prn_WF_DATE_LOCK ?? null) !== ''):?>
	<tr id="tr_WF_LOCKED">
		<td><?echo GetMessage("IBLOCK_DATE_LOCK")?></td>
		<td><?echo $prn_WF_DATE_LOCK?><?
		if ((int)($prn_WF_LOCKED_BY ?? null) > 0):
		?>&nbsp;&nbsp;&nbsp;[<a href="user_edit.php?lang=<?=LANGUAGE_ID?>&amp;ID=<?=(int)$prn_WF_LOCKED_BY?>"><?echo $prn_WF_LOCKED_BY?></a>]&nbsp;<?=$prn_LOCKED_USER_NAME?><?
		endif;
		?></td>
	</tr>
	<?endif;
	$tabControl->EndCustomField("WORKFLOW_PARAMS", "");
	if ($WF=="Y" || $view=="Y"):
	$tabControl->BeginCustomField("WF_STATUS_ID", GetMessage("IBLOCK_FIELD_STATUS").":");
	?>
	<tr id="tr_WF_STATUS_ID">
		<td><?echo $tabControl->GetCustomLabelHTML()?></td>
		<td>
			<?if($ID > 0 && !$bCopy):?>
				<?echo SelectBox("WF_STATUS_ID", CWorkflowStatus::GetDropDownList("N", "desc"), "", $str_WF_STATUS_ID);?>
			<?else:?>
				<?echo SelectBox("WF_STATUS_ID", CWorkflowStatus::GetDropDownList("N", "desc"), "", "");?>
			<?endif?>
		</td>
	</tr>
	<?
	if($ID > 0 && !$bCopy)
		$hidden = '<input type="hidden" name="WF_STATUS_ID" value="'.$str_WF_STATUS_ID.'">';
	else
	{
		$rsStatus = CWorkflowStatus::GetDropDownList("N", "desc");
		$arDefaultStatus = $rsStatus->Fetch();
		if($arDefaultStatus)
			$def_WF_STATUS_ID = intval($arDefaultStatus["REFERENCE_ID"]);
		else
			$def_WF_STATUS_ID = "";
		$hidden = '<input type="hidden" name="WF_STATUS_ID" value="'.$def_WF_STATUS_ID.'">';
	}
	$tabControl->EndCustomField("WF_STATUS_ID", $hidden);
	endif;
	$tabControl->BeginCustomField("WF_COMMENTS", GetMessage("IBLOCK_COMMENTS"));
	$str_WF_COMMENTS ??= '';
	?>
	<tr class="heading" id="tr_WF_COMMENTS_LABEL">
		<td colspan="2"><b><?echo $tabControl->GetCustomLabelHTML()?></b></td>
	</tr>
	<tr id="tr_WF_COMMENTS">
		<td colspan="2">
			<?if($ID > 0 && !$bCopy):?>
				<textarea name="WF_COMMENTS" style="width:100%" rows="10"><?echo $str_WF_COMMENTS?></textarea>
			<?else:?>
				<textarea name="WF_COMMENTS" style="width:100%" rows="10"><?echo ""?></textarea>
			<?endif?>
		</td>
	</tr>
	<?
	$tabControl->EndCustomField("WF_COMMENTS", '<input type="hidden" name="WF_COMMENTS" value="'.$str_WF_COMMENTS.'">');
endif;

if ($arShowTabs['bizproc']):

	$tabControl->BeginNextFormTab();

	$tabControl->BeginCustomField("BIZPROC_WF_STATUS", GetMessage("IBEL_E_PUBLISHED"));
	?>
	<tr id="tr_BIZPROC_WF_STATUS">
		<td style="width:40%;"><?=GetMessage("IBEL_E_PUBLISHED")?>:</td>
		<td style="width:60%;"><?=($str_BP_PUBLISHED=="Y"?GetMessage("MAIN_YES"):GetMessage("MAIN_NO"))?></td>
	</tr>
	<?
	$tabControl->EndCustomField("BIZPROC_WF_STATUS", '');

	ob_start();
	$required = false;
	CBPDocument::AddShowParameterInit(MODULE_ID, "only_users", DOCUMENT_TYPE);

	$bizProcIndex = 0;
	if (!isset($arDocumentStates))
	{
		$arDocumentStates = CBPDocument::GetDocumentStates(
			array(MODULE_ID, ENTITY, DOCUMENT_TYPE),
			($ID > 0) ? array(MODULE_ID, ENTITY, $ID) : null
		);
	}
	foreach ($arDocumentStates as $arDocumentState)
	{
		$bizProcIndex++;
		if ($arDocumentState["ID"] <> '')
		{
			$canViewWorkflow = CBPDocument::CanUserOperateDocument(
				CBPCanUserOperateOperation::ViewWorkflow,
				$USER->GetID(),
				array(MODULE_ID, ENTITY, $ID),
				array("AllUserGroups" => $arCurrentUserGroups, "DocumentStates" => $arDocumentStates, "WorkflowId" => $arDocumentState["ID"] > 0 ? $arDocumentState["ID"] : $arDocumentState["TEMPLATE_ID"])
			);
		}
		else
		{
			$canViewWorkflow = CBPDocument::CanUserOperateDocumentType(
				CBPCanUserOperateOperation::ViewWorkflow,
				$USER->GetID(),
				array(MODULE_ID, ENTITY, DOCUMENT_TYPE),
				array("AllUserGroups" => $arCurrentUserGroups, "DocumentStates" => $arDocumentStates, "WorkflowId" => $arDocumentState["ID"] > 0 ? $arDocumentState["ID"] : $arDocumentState["TEMPLATE_ID"])
			);
		}
		if (!$canViewWorkflow)
			continue;
		?>
		<tr class="heading">
			<td colspan="2">
				<?= htmlspecialcharsbx($arDocumentState["TEMPLATE_NAME"]) ?>
				<?if ($arDocumentState["ID"] <> '' && $arDocumentState["WORKFLOW_STATUS"] <> ''):?>
					(<a href="<?echo htmlspecialcharsbx($selfFolderUrl.CIBlock::GetAdminElementEditLink($IBLOCK_ID, $ID, array(
						"WF"=>$WF,
						"find_section_section" => $find_section_section,
						"stop_bizproc" => $arDocumentState["ID"],
					),  "&".bitrix_sessid_get()))?>"><?echo GetMessage("IBEL_BIZPROC_STOP")?></a>)
				<?endif;?>
			</td>
		</tr>
		<tr>
			<td width="40%"><?echo GetMessage("IBEL_BIZPROC_NAME")?></td>
			<td width="60%"><?= htmlspecialcharsbx($arDocumentState["TEMPLATE_NAME"]) ?></td>
		</tr>
		<?if($arDocumentState["TEMPLATE_DESCRIPTION"]!=''):?>
		<tr>
			<td width="40%"><?echo GetMessage("IBEL_BIZPROC_DESC")?></td>
			<td width="60%"><?= htmlspecialcharsbx($arDocumentState["TEMPLATE_DESCRIPTION"]) ?></td>
		</tr>
		<?endif?>
		<?if ($arDocumentState["STATE_MODIFIED"] <> ''):?>
		<tr>
			<td width="40%"><?echo GetMessage("IBEL_BIZPROC_DATE")?></td>
			<td width="60%"><?= $arDocumentState["STATE_MODIFIED"] ?></td>
		</tr>
		<?endif;?>
		<?if ($arDocumentState["STATE_NAME"] <> ''):?>
		<tr>
			<td width="40%"><?echo GetMessage("IBEL_BIZPROC_STATE")?></td>
			<td width="60%"><?if ($arDocumentState["ID"] <> ''):?><a href="<?=$selfFolderUrl?>bizproc_log.php?ID=<?= $arDocumentState["ID"] ?>&back_url=<?= urlencode($APPLICATION->GetCurPageParam("", array())) ?>"><?endif;?><?= $arDocumentState["STATE_TITLE"] <> '' ? $arDocumentState["STATE_TITLE"] : $arDocumentState["STATE_NAME"] ?><?if ($arDocumentState["ID"] <> ''):?></a><?endif;?></td>
		</tr>
		<?endif;?>
		<?
		if ($arDocumentState["ID"] == '')
		{
			CBPDocument::StartWorkflowParametersShow(
				$arDocumentState["TEMPLATE_ID"],
				$arDocumentState["TEMPLATE_PARAMETERS"],
				($bCustomForm ? "tabControl" : "form_element_".$IBLOCK_ID)."_form",
				$bVarsFromForm
			);
			if (is_array($arDocumentState["TEMPLATE_PARAMETERS"]))
			{
				foreach ($arDocumentState["TEMPLATE_PARAMETERS"] as $arParameter)
				{
					if ($arParameter["Required"])
						$required = true;
				}
			}
		}

		$arEvents = CBPDocument::GetAllowableEvents($USER->GetID(), $arCurrentUserGroups, $arDocumentState, $arIBlock["RIGHTS_MODE"] === "E");
		if (!empty($arEvents))
		{
			?>
			<tr>
				<td width="40%"><?echo GetMessage("IBEL_BIZPROC_RUN_CMD")?></td>
				<td width="60%">
					<input type="hidden" name="bizproc_id_<?= $bizProcIndex ?>" value="<?= $arDocumentState["ID"] ?>">
					<input type="hidden" name="bizproc_template_id_<?= $bizProcIndex ?>" value="<?= $arDocumentState["TEMPLATE_ID"] ?>">
					<select name="bizproc_event_<?= $bizProcIndex ?>">
						<option value=""><?echo GetMessage("IBEL_BIZPROC_RUN_CMD_NO")?></option>
						<?
						foreach ($arEvents as $e)
						{
							?><option value="<?= htmlspecialcharsbx($e["NAME"]) ?>"<?= ($_REQUEST["bizproc_event_".$bizProcIndex] == $e["NAME"]) ? " selected" : ""?>><?= htmlspecialcharsbx($e["TITLE"]) ?></option><?
						}
						?>
					</select>
				</td>
			</tr>
			<?
		}

		if ($arDocumentState["ID"] <> '')
		{
			$arTasks = CBPDocument::GetUserTasksForWorkflow($USER->GetID(), $arDocumentState["ID"]);
			if (!empty($arTasks))
			{
				?>
				<tr>
					<td width="40%"><?echo GetMessage("IBEL_BIZPROC_TASKS")?></td>
					<td width="60%">
						<?
						foreach ($arTasks as $arTask)
						{
							?><a href="<?=$selfFolderUrl?>bizproc_task.php?id=<?= $arTask["ID"] ?>&back_url=<?= urlencode($APPLICATION->GetCurPageParam("", array())) ?>" title="<?= strip_tags($arTask["DESCRIPTION"]) ?>"><?= $arTask["NAME"] ?></a><br /><?
						}
						?>
					</td>
				</tr>
				<?
			}
		}
	}
	if ($bizProcIndex <= 0)
	{
		?>
		<tr>
			<td><br /></td>
			<td><?=GetMessage("IBEL_BIZPROC_NA")?></td>
		</tr>
		<?
	}
	?>
	<input type="hidden" name="bizproc_index" value="<?= $bizProcIndex ?>">
	<?
	if ($ID > 0):
		$bStartWorkflowPermission = CBPDocument::CanUserOperateDocument(
			CBPCanUserOperateOperation::StartWorkflow,
			$USER->GetID(),
			array(
				MODULE_ID,
				ENTITY,
				$ID,
			),
			array(
				'AllUserGroups' => $arCurrentUserGroups,
				'DocumentStates' => $arDocumentStates,
				'WorkflowId' => $arDocumentState['TEMPLATE_ID'] ?? '',
			)
		);
		if ($bStartWorkflowPermission):
			?>
			<tr class="heading">
				<td colspan="2"><?echo GetMessage("IBEL_BIZPROC_NEW")?></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<a href="<?=$selfFolderUrl.MODULE_ID?>_start_bizproc.php?document_id=<?= $ID ?>&document_type=<?= DOCUMENT_TYPE ?>&back_url=<?= urlencode($APPLICATION->GetCurPageParam("", array('bxpublic'))) ?>"><?echo GetMessage("IBEL_BIZPROC_START")?></a>
				</td>
			</tr>
			<?
		endif;
	endif;
	$html = ob_get_contents();
	ob_end_clean();
	$tabControl->BeginCustomField("BIZPROC", GetMessage("IBEL_E_TAB_BIZPROC"), $required);
	echo $html;
	$tabControl->EndCustomField("BIZPROC", "");
endif;

if($arShowTabs['edit_rights']):
	$tabControl->BeginNextFormTab();
	if($ID > 0)
	{
		$obRights = new CIBlockElementRights($IBLOCK_ID, $ID);
		$htmlHidden = '';
		foreach($obRights->GetRights() as $RIGHT_ID => $arRight)
			$htmlHidden .= '
				<input type="hidden" name="RIGHTS[][RIGHT_ID]" value="'.htmlspecialcharsbx($RIGHT_ID).'">
				<input type="hidden" name="RIGHTS[][GROUP_CODE]" value="'.htmlspecialcharsbx($arRight["GROUP_CODE"]).'">
				<input type="hidden" name="RIGHTS[][TASK_ID]" value="'.htmlspecialcharsbx($arRight["TASK_ID"]).'">
			';
	}
	else
	{
		$obRights = new CIBlockSectionRights($IBLOCK_ID, $MENU_SECTION_ID);
		$htmlHidden = '';
	}

	$tabControl->BeginCustomField("RIGHTS", GetMessage("IBEL_E_RIGHTS_FIELD"));
		IBlockShowRights(
			'element',
			$IBLOCK_ID,
			$ID,
			GetMessage("IBEL_E_RIGHTS_SECTION_TITLE"),
			"RIGHTS",
			$obRights->GetRightsList(),
			$obRights->GetRights(array("count_overwrited" => true, "parents" => $str_IBLOCK_ELEMENT_SECTION)),
			false, /*$bForceInherited=*/($ID <= 0) || $bCopy
		);
	$tabControl->EndCustomField("RIGHTS", $htmlHidden);
endif;

$newElement = ($ID <= 0) || $bCopy;
$currentElement = ($ID > 0) && !$bCopy;
$bDisabled =
	($view=="Y")
	|| ($bWorkflow && (string)($prn_LOCK_STATUS ?? null) === CIBlockElement::WORKFLOW_STATUS_LOCK)
	|| (
		$newElement
		&& !CIBlockSectionRights::UserHasRightTo($IBLOCK_ID, $MENU_SECTION_ID, "section_element_bind")
	)
	|| (
		$currentElement
		&& !CIBlockElementRights::UserHasRightTo($IBLOCK_ID, $ID, "element_edit")
	)
	|| (
		$bBizproc
		&& !$canWrite
	)
;

if (
	!$bDisabled
	&& $bCatalog
	&& !empty($arMainCatalog)
	&& $newElement
	&& !$allowProductAdd
)
{
	$bDisabled = true;
}

if ($adminSidePanelHelper->isSidePanelFrame()):
	$tabControl->Buttons(array(
		'disabled' => $bDisabled,
		'btnApply' => false,
	));
elseif(!defined('BX_PUBLIC_MODE') || BX_PUBLIC_MODE != 1):
	ob_start();
	$disableHtml = $bDisabled
		? ' disabled data-btn-disabled="Y"'
		: ''
	;
	?>
	<input<?= $disableHtml; ?> type="submit" class="adm-btn-save" name="save" id="save" value="<?echo GetMessage("IBLOCK_EL_SAVE")?>">
	<? if (!$bAutocomplete)
	{
		?><input<?= $disableHtml; ?> type="submit" class="button" name="apply" id="apply" value="<?echo GetMessage('IBLOCK_APPLY')?>"><?
	}
	?>
	<input<?= $disableHtml; ?> type="submit" class="button" name="dontsave" id="dontsave" value="<?echo GetMessage("IBLOCK_EL_CANC")?>">
	<? if (!$bAutocomplete)
	{
		?><input<?= $disableHtml; ?> type="submit" class="adm-btn-add" name="save_and_add" id="save_and_add" value="<?echo GetMessage("IBLOCK_EL_SAVE_AND_ADD")?>"><?
	}
	$buttons_add_html = ob_get_contents();
	ob_end_clean();
	$tabControl->Buttons(false, $buttons_add_html);
elseif(!$bPropertyAjax && (!isset($_REQUEST['nobuttons']) || $_REQUEST['nobuttons'] !== "Y")):

	$wfClose = "{
		title: '".CUtil::JSEscape(GetMessage("IBLOCK_EL_CANC"))."',
		name: 'dontsave',
		id: 'dontsave',
		action: function () {
			var FORM = this.parentWindow.GetForm();
			FORM.appendChild(BX.create('INPUT', {
				props: {
					type: 'hidden',
					name: this.name,
					value: 'Y'
				}
			}));
			this.disableUntilError();
			this.parentWindow.Submit();
		}
	}";
	$save_and_add = "{
		title: '".CUtil::JSEscape(GetMessage("IBLOCK_EL_SAVE_AND_ADD"))."',
		name: 'save_and_add',
		id: 'save_and_add',
		className: 'adm-btn-add',
		action: function () {
			var FORM = this.parentWindow.GetForm();
			FORM.appendChild(BX.create('INPUT', {
				props: {
					type: 'hidden',
					name: 'save_and_add',
					value: 'Y'
				}
			}));

			this.parentWindow.hideNotify();
			this.disableUntilError();
			this.parentWindow.Submit();
		}
	}";
	$cancel = "{
		title: '".CUtil::JSEscape(GetMessage("IBLOCK_EL_CANC"))."',
		name: 'cancel',
		id: 'cancel',
		action: function () {
			BX.WindowManager.Get().Close();
			if(window.reloadAfterClose)
				top.BX.reload(true);
		}
	}";
	$editInPanelParams = array(
		'WF' => ($WF == 'Y' ? 'Y': null),
		'find_section_section' => $find_section_section,
		'menu' => null
	);
	if (!empty($arMainCatalog))
		$editInPanelParams = CCatalogAdminTools::getFormParams($editInPanelParams);
	$edit_in_panel = "{
		title: '".CUtil::JSEscape(GetMessage('IBLOCK_EL_EDIT_IN_PANEL'))."',
		name: 'edit_in_panel',
		id: 'edit_in_panel',
		className: 'adm-btn-add',
		action: function () {
			location.href = '".$selfFolderUrl.CIBlock::GetAdminElementEditLink(
			$IBLOCK_ID,
			$ID,
			$editInPanelParams
		)."';
		}
	}";
	unset($editInPanelParams);
	$tabControl->ButtonsPublic(array(
		'.btnSave',
		($ID > 0 && $bWorkflow? $wfClose: $cancel),
		$edit_in_panel,
		$save_and_add
	));
endif;

$tabControl->Show();
if (
	(!defined('BX_PUBLIC_MODE') || BX_PUBLIC_MODE != 1)
	&& CIBlockRights::UserHasRightTo($IBLOCK_ID, $IBLOCK_ID, "iblock_edit")
	&& !$bAutocomplete && !$adminSidePanelHelper->isSidePanel()
)
{

	echo
		BeginNote(),
		GetMessage("IBEL_E_IBLOCK_MANAGE_HINT"),
		' <a href="'.$selfFolderUrl.'iblock_edit.php?type='.htmlspecialcharsbx($type).'&amp;lang='.LANGUAGE_ID.'&amp;ID='.$IBLOCK_ID.'&amp;admin=Y&amp;return_url='.urlencode($selfFolderUrl.CIBlock::GetAdminElementEditLink($IBLOCK_ID, $ID, array("WF" => ($WF=="Y"? "Y": null), "find_section_section" => $find_section_section, "IBLOCK_SECTION_ID" => $find_section_section, "return_url" => ($return_url <> ''? $return_url: null)))).'">',
		GetMessage("IBEL_E_IBLOCK_MANAGE_HINT_HREF"),
		'</a>',
		EndNote()
	;
}
	//////////////////////////
	//END of the custom form
	//////////////////////////