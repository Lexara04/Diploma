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
$count = 0;
?>
<?php
$shortInfo = array("COMP_ID", "DURATION", "YEAR_NUM", "LOCATION", "ADDRESS", "TYPE", "TYPE2");
$detailInfo = array("REQUIREMENTS", "CONDITIONS");
?>
<?php
global $elementId;
$elementId = $arParams["ELEMENT_ID"];
global $userId;
$userId = $USER->GetID();
$class = 'btn btn-primary w-auto py-1 active';
$buttonText = 'подать заявку';
 // ПОЛУЧЕНИЕ ИНФОРМАЦИИ О ТОМ, ПОДАВАЛ ЛИ СТУДЕНТ ЗАЯВКУ
CModule::IncludeModule('iblock');

$rsElements = CIBlockElement::GetList(
    array(),
    array(
        'IBLOCK_ID' => 4,
        'NAME' => "Заявка {$userId}.{$elementId}"
    ),
    false,
    false,
    array('ID')
);

if ($element = $rsElements->Fetch()) {
    $newElementId =  $element['ID'];
} else {
    $newElementId = 0;
}
// установка цвета кнопки в зависимости от статуса заявки
$status = (int) CIBlockElement::GetProperty(4, $newElementId, [], ['CODE' => 'STATUS'])->Fetch()['VALUE'];
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
<?php
// ОБРАБОТКА ЗАЯВКИ ОТ ПОЛЬЗОВАТЕЛЯ
if ($_POST['submit']) {
    // формируем массив со свойствами элемента
    $properties = array(
        "studentID" => $userId,
        "practID" => $elementId,
        "STATUS" => 3,
        "companyID" => $arResult['PROPERTIES']['COMP_ID']['VALUE'],
    );

// создаем элемент в инфоблоке Студент-Заявка
    $arFields = array(
        "IBLOCK_ID" => 4,
        "NAME" => "Заявка {$userId}.{$elementId}",
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $properties,
    );

    $el = new CIBlockElement;
    $newElementId = $el->Add($arFields);
    $class = 'btn btn-secondary w-auto py-1 disabled';
    $buttonText = 'Заявка на рассмотрении';
}
?>
<div class="about-project">
    <h3>
        <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
            <?= $arResult["NAME"] ?>
        <? endif; ?>
    </h3>
    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
        <div class="info-img-div">
            <img class="info-img"
                 class="about-project-img"
                 border="0"
                 src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                 width="500px"
                 alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                 title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
            />
        </div>
    <? endif; ?>
    <div class="info-box">
        <? // вывод каждого свойства по отдельности: ?>
        <? foreach ($shortInfo as $attribute): ?>

            <? if ($arResult["DISPLAY_PROPERTIES"][$attribute]): ?>
                <div class="info">
                    <h4><?= $arResult['DISPLAY_PROPERTIES'][$attribute]['NAME'] ?>:&nbsp;</h4>
                    <ul class="info-ul">
                        <li class="info-li">
                            <? if (is_array($arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE'])): ?>

                                <?= implode("&nbsp;/&nbsp;", $arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE']); ?>

                            <? else: ?>

                                <?= $arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE']; ?>

                            <? endif ?>
                            <br>
                        </li>
                    </ul>
                </div>
            <? endif ?>

        <? endforeach; ?>
    </div>
    <br>
    <? if(in_array(6, CUser::GetUserGroup($USER->GetID())) || in_array(1, CUser::GetUserGroup($USER->GetID()))): ?>
    <form action="" method="post">
        <input type="submit" name="submit" value="<?=$buttonText?>" aria-pressed="true"
               class="<?=$class?>">
    </form>
    <? endif;?>
    <hr id="my">
    <p>
        <? if ($arResult["DETAIL_TEXT"] <> ''): ?>
            <? echo $arResult["DETAIL_TEXT"]; ?>
        <? else: ?>
            <? echo $arResult["PREVIEW_TEXT"]; ?>
        <? endif ?>
    </p>
    <br>
    <? foreach ($detailInfo as $attribut): ?>
        <? if ($arResult["DISPLAY_PROPERTIES"][$attribut]): ?>
            <hr>
            <h4><?= $arResult['DISPLAY_PROPERTIES'][$attribut]['NAME'] ?>:&nbsp;</h4>
            <ul>
                <li>
                    <? if (is_array($arResult['DISPLAY_PROPERTIES'][$attribut]['DISPLAY_VALUE'])): ?>

                        <?= implode("&nbsp;/&nbsp;", $arResult['DISPLAY_PROPERTIES'][$attribut]['DISPLAY_VALUE']); ?>

                    <? else: ?>
                        <?= htmlspecialchars($arResult['DISPLAY_PROPERTIES'][$attribut]['DISPLAY_VALUE']); ?>

                    <? endif ?>
                    <br><br>
                </li>
            </ul>

        <? endif ?>
    <? endforeach; ?>

</div>