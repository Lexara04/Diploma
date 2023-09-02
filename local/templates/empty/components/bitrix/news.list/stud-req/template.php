<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?php if ($arResult["ITEMS"]): ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $projectCounter = 0;
        //$arFilter = array("IBLOCK_ID" => 2, 'ID' => CIBlockElement::SubQuery('PROPERTY_practID', array(
        //"IBLOCK_ID" => 4,
       // "PROPERTY_studentID" => $USER->GetID(),
        //    'PROPERTY_practID' => $arItem['ID']),
        //)
        //);
        $arFilter = array("IBLOCK_ID" => $iblockStudReq, 'PROPERTY_practID' => $arItem['ID'], 'PROPERTY_studentID' =>$USER->GetID())
        ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="anons-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="info">
                    <h4><?= $arResult['DISPLAY_PROPERTIES']['practID']['NAME'] ?>:&nbsp;</h4>
                    <ul class="info-ul">
                        <li class="info-li">
                            <? if (is_array($arResult['DISPLAY_PROPERTIES']['practID']['DISPLAY_VALUE'])): ?>

                                <?= implode("&nbsp;/&nbsp;", $arResult['DISPLAY_PROPERTIES']['practID']['DISPLAY_VALUE']); ?>

                            <? else: ?>

                                <?= $arResult['DISPLAY_PROPERTIES']['practID']['DISPLAY_VALUE']; ?>

                            <? endif ?>
                            <br>
                        </li>
                    </ul>
                </div>
        </div>
    <? endforeach; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>

<? endif; ?>