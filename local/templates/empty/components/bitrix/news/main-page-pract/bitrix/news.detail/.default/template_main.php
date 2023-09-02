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
$count = 0;
?>
<?php
$shortInfo = array("COMP_ID", "DURATION", "YEAR_NUM", "LOCATION", "ADDRESS");
$detailInfo = array("REQUIREMENTS", "CONDITIONS");
?>
<div class="about-project">
    <div class="about-project-text">
        <div class="about-project-text-head">
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
            <img
                    class="about-project-img"
                    border="0"
                    src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                    width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                    height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                    alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                    title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
            />
        <div class="about-project-text1">
            <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
                <h1><?=$arResult["NAME"]?></h1>
            <?endif;?>
        <? else:?>
        <div class="about-project-text-non-img">
            <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
                <h1><?=$arResult["NAME"]?></h1>
            <?endif;?>
        <?endif?>
            <? // вывод каждого свойства по отдельности: ?>
            <? foreach($shortInfo as $attribute):?>

                <? if ($arResult["DISPLAY_PROPERTIES"][$attribute]):?>
                    <b><?=$arResult['DISPLAY_PROPERTIES'][$attribute]['NAME']?>:&nbsp;</b>
                    <?if(is_array($arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE'])):?>

                        <?=implode("&nbsp;/&nbsp;", $arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE']);?>

                    <?else:?>

                        <?=$arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE'];?>

                    <?endif?>
                    <br>

                <?/*else:?>
                    <b><?=$arResult['DISPLAY_PROPERTIES'][$attribute]['NAME']?>:&nbsp;</b>&mdash;
                <?*/endif?>
            <?endforeach;?>
        </div>
        </div>

            <?if($arResult["DETAIL_TEXT"] <> ''):?>
                <?echo $arResult["DETAIL_TEXT"];?>
            <?else:?>
                <?echo $arResult["PREVIEW_TEXT"];?>
            <?endif?>
            <br>
            <? foreach($detailInfo as $attribut):?>
                <? if ($arResult["DISPLAY_PROPERTIES"][$attribut]):?>
                    <b><?=$arResult['DISPLAY_PROPERTIES'][$attribut]['NAME']?>:&nbsp;</b><br>
                    <?if(is_array($arResult['DISPLAY_PROPERTIES'][$attribut]['DISPLAY_VALUE'])):?>

                        <?=implode("&nbsp;/&nbsp;", $arResult['DISPLAY_PROPERTIES'][$attribut]['DISPLAY_VALUE']);?>

                    <?else:?>
                        <?=$arResult['DISPLAY_PROPERTIES'][$attribut]['DISPLAY_VALUE'];?>

                    <?endif?>
                    <br><br>
                <?endif?>
            <?endforeach;?>

    </div>



</div>