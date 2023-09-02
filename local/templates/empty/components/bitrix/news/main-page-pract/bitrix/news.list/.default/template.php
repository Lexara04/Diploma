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
$userId = $USER->GetID();
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
$style="line-height: 30px; padding: 5px 10px;";

?>

<?php if ($arResult["ITEMS"]): ?>
<?
// ОБРАБОТКА ЗАЯВКИ ОТ ПОЛЬЗОВАТЕЛЯ
if ($_POST['submit']) {
    // формируем массив со свойствами элемента
    $properties = array(
        "studentID" => $userId,
        "practID" => $_POST['id'],
        "STATUS" => 3,
        "companyID" => $_POST['comp'],
    );

// создаем элемент в инфоблоке Студент-Заявка
    $arFields = array(
        "IBLOCK_ID" => $iblockStudReq,
        "NAME" => "Заявка {$userId}.{$_POST['id']}",
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $properties,
    );
    $arFilter1 = array(
            "IBLOCK_ID" => $iblockStudReq, "NAME" => $arFields["NAME"]);
    $res = CIBlockElement::GetList(array(), $arFilter1, false, false, array("ID"));
    if($ob = $res->GetNext()){
    $existingElementId = $ob["ID"];
    }
    else {
        $el = new CIBlockElement;
        $newElementId = $el->Add($arFields);
        $class = 'btn btn-secondary w-auto py-1 disabled';
        $buttonText = 'Заявка на рассмотрении';
    }
}
?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>

<div class="col-lg-4 col-md-6">
    <!-- Single Courses Start -->
    <div class="single-courses">
        <!-- Превью проекта -->
        <div class="courses-images">
            <a href="courses-details.html">
                <img
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                    <? else: ?>
                        src="<?= SITE_TEMPLATE_PATH ?>/img/team-amico1.png"
                    <? endif; ?>
                        alt="Courses">
            </a>
        </div>
        <div class="courses-content">
            <? if ($arItem["DISPLAY_PROPERTIES"]["COMP_ID"]):?>
                <div class="courses-author">
                    <div class="author w-100">
                        <!-- Логотип компании-->
                        <?
                        $element = CIBlockElement::GetByID($arItem["DISPLAY_PROPERTIES"]["COMP_ID"]['VALUE'])->GetNextElement();
                        $elementFields = $element->GetFields();

                        ?>
                        <div class="author-thumb">
                            <a href="#"><img
                                        src="<?= CFile::GetPath($elementFields['PREVIEW_PICTURE']) ?>"
                                        alt="Author"></a>
                        </div>

                        <div class="author-name">
                            <?= $arItem['DISPLAY_PROPERTIES']["COMP_ID"]['DISPLAY_VALUE']; ?>
                        </div>
                    </div>
                    <? if ($arItem["DISPLAY_PROPERTIES"]["TYPE"]): ?>

                    <div class="tag">
                        <a href="#" class="w-auto"
                           style="cursor: auto"><?= $arItem['DISPLAY_PROPERTIES']["TYPE"]['DISPLAY_VALUE']; ?></a>
                    </div>
                    <?endif;?>
                </div>
            <? endif ?>

            <h4 class="title">
                <a href="/all-practices<?= $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a>
            </h4>
            <div class="courses-meta">
                        <span> <i class="icofont-clock-time"></i>
                            <?= $arItem['DISPLAY_PROPERTIES']["DURATION"]['DISPLAY_VALUE'] ?>
                        </span>
                <span> <i class="icofont-google-map"></i>
                            <?= $arItem['DISPLAY_PROPERTIES']["LOCATION"]['DISPLAY_VALUE']; ?>
                        </span>
            </div>
            <?php

            $elementId = $arItem['ID'];
            $class="btn btn-primary btn-hover-danger";
            $buttonText = 'ПОДАТЬ ЗАЯВКУ';
            // ПОЛУЧЕНИЕ ИНФОРМАЦИИ О ТОМ, ПОДАВАЛ ЛИ СТУДЕНТ ЗАЯВКУ
            CModule::IncludeModule('iblock');

            $rsElements = CIBlockElement::GetList(
                array(),
                array(
                    'IBLOCK_ID' => $iblockStudReq,
                    'NAME' => "Заявка {$userId}.{$elementId}"
                ),
                false,
                false,
                array('ID')
            );

            if ($element = $rsElements->Fetch()) {
                $newElementId = $element['ID'];
            } else {
                $newElementId = 0;
            }
            ?>

            <?
            // установка цвета кнопки в зависимости от статуса заявки
            $status = (int)CIBlockElement::GetProperty(4, $newElementId, [], ['CODE' => 'STATUS'])->Fetch()['VALUE'];
            switch ($status) {
                case 1:
                    $class = 'btn btn-success w-auto py-1 disabled';
                    $buttonText = 'Заявка принята';
                    break;
                case 2:
                    $class = 'btn btn-danger w-auto py-1 disabled';
                    $buttonText = 'Заявка отклонена';
                    break;
                case 3:
                    $class = 'btn btn-secondary w-auto py-1 disabled';
                    $buttonText = 'Заявка на рассмотрении';
                    break;
            }
            ?>
            <div class="courses-price-review">
                <div class="courses-price">
                    <a href="/all-practices<?= $arItem["DETAIL_PAGE_URL"] ?>" class="btn btn-secondary btn-hover-primary" style="<?=$style?>"> Подробнее...</a>
                </div>
                <? if (in_array(6, CUser::GetUserGroup($USER->GetID())) || in_array(1, CUser::GetUserGroup($USER->GetID()))): ?>
                <div class="courses-review">
                    <form action="" method="post">
                        <input type='hidden' name='comp' value='<? echo $arItem['DISPLAY_PROPERTIES']['COMP_ID']['VALUE']?>'/>
                        <input type='hidden' name='id' value='<?=$arItem['ID']?>'/>
                        <input type="submit" name="submit" value="<?=$buttonText?>" aria-pressed="true"
                               class="<?=$class?>" style="<?=$style?>">
                    </form>
                </div>
                <?endif;?>
            </div>
        </div>
    </div>
    <!-- Single Courses End -->
</div>

<? endforeach; ?>


<? endif; ?>

