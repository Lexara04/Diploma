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
$style = "line-height: 30px; padding: 5px 10px;";
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");

?>
<?php if ($arResult["ITEMS"]): ?>
<div class="col-lg-9">
    <div class="blog-wrapper">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $projectCounter = 0;
        $arFilter = array("IBLOCK_ID" => 2, "PROPERTY_COMP_ID" => $arItem['ID']);
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50));
        while ($ob = $res->GetNextElement()) {
            $projectCounter += 1;
        }
        ?>
        <?
        $practiceCounter = 0;
        $arFilter = array("IBLOCK_ID" => 3, "PROPERTY_COMP_ID" => $arItem['ID']);
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50));
        while ($ob = $res->GetNextElement()) {
            $practiceCounter += 1;
        }
        ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="anons-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="row ">
                <div class="col-md-3 align-items-center d-flex justify-content-center d-md-inline ">
                    <img class="anons-img-comp"
                        <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                            src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                            width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                            height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                            alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                            title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                        <? else: ?>
                            src="<?= SITE_TEMPLATE_PATH ?>/img/team-amico1.png"
                        <? endif; ?>
                    >
                </div>
                <div class="col-12 col-md-9 align-items-center">
                    <div class="anons-info">
                        <div class="anons-title">
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a>
                        </div>
                        <div class="anons-short-info">
                            <b>Описание: </b>
                            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                <? echo $arItem["PREVIEW_TEXT"]; ?>
                            <? endif; ?>
                        </div>
                        <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                            <div class="anons-short-info">
                                <b><?= $arProperty["NAME"] ?></b>:&nbsp;
                                <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                                    <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
                                <? else: ?>
                                    <?= $arProperty["DISPLAY_VALUE"]; ?>
                                <? endif ?>
                            </div>
                        <? endforeach; ?>
                        <div class="anons-short-info">
                            <div class="row-cols-2 ">
                                <? if ($projectCounter): ?>
                                    <a href="/all-projects/?COMP_ID=<?= $arItem['ID'] ?>"
                                       class="btn btn-primary btn-hover-danger w-auto py-1 my-2 text-decoration-none text-white"
                                       role="button" aria-pressed="true" style="<?= $style ?>">
                                        Предложения проектов &#40;<?= $projectCounter ?>&#41;
                                    </a>
                                <? endif; ?>
                                <? if ($practiceCounter): ?>
                                    <a href="/all-practices/?COMP_ID=<?= $arItem['ID'] ?>"
                                       class="btn btn-primary btn-hover-danger w-auto py-1 my-2 text-decoration-none text-white"
                                       role="button" aria-pressed="true" style="<?= $style ?>">
                                        Предложения практик &#40;<?= $practiceCounter ?>&#41;
                                    </a>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>

<? endif; ?>

        <br>
    </div>
</div>
<div class="col-lg-3">
    <div class="sidebar">
        <div class="sidebar-widget widget-search">
            <form action="#">
                <input type="text" placeholder="Поиск...">
                <button><i class="icofont-search-1"></i></button>
            </form>
        </div>
        <div class="sidebar-widget">
            <h4 class="widget-title">Факультеты</h4>
            <div class="widget-category">
                <ul class="category-list">
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[0]", array("fid")) ?>">АВТФ</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[1]", array("fid")) ?>">ФЛА</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[2]", array("fid")) ?>">МТФ</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[3]", array("fid")) ?>">ФМА</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[4]", array("fid")) ?>">ФПМИ</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[5]", array("fid")) ?>">РЭФ</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[6]", array("fid")) ?>">ФТФ</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[7]", array("fid")) ?>">ФЭН</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[8]", array("fid")) ?>">ФБ</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[9]", array("fid")) ?>">ФГО</a></li>
                    <li><a href="<?= $APPLICATION->GetCurPageParam("fid=$faculties[10]", array("fid")) ?>">ИСТ</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>