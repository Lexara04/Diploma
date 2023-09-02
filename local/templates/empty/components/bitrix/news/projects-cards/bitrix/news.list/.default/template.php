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
$style = "line-height: 30px; padding: 5px 10px;";
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");

?>

<?php if ($arResult["ITEMS"]): ?>
<?
CModule::IncludeModule('iblock');
// ОБРАБОТКА ЗАЯВКИ ОТ ПОЛЬЗОВАТЕЛЯ
if ($_POST['submit']) {
    // формируем массив со свойствами элемента
    $properties = array(
        "studentID" => $userId,
        "practID" => $_POST['id'],
        "STATUS" => 3,
        "studStatus" => 3
    );

// создаем элемент в инфоблоке Студент-Заявка
    $arFields = array(
        "IBLOCK_ID" => $iblockStudReq,
        "NAME" => "Заявка {$userId}.{$_POST['id']}",
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $properties,
    );
    $el = new CIBlockElement;
    $newElementId = $el->Add($arFields);
    $class = 'btn btn-secondary w-auto py-1 disabled';
    $buttonText = 'Заявка на рассмотрении';
}
?>
<div class="col-lg-9">
    <div class="blog-wrapper">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php

            $elementId = $arItem['ID'];
            $class = 'btn btn-primary btn-hover-danger w-auto py-1 my-2 text-decoration-none text-white';
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
            <div class="anons-card">
                <div class="row">

                    <div class="col-sm-12 align-items-center flex-md-column-reverse">
                        <div class="anons-info">
                            <div class="anons-title">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a>
                            </div>
                            <div class="text-sm-start anons-short-info ">
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

                            <? if (in_array(6, CUser::GetUserGroup($USER->GetID())) || in_array(1, CUser::GetUserGroup($USER->GetID()))): ?>
                                <div class="anons-short-info">
                                    <div class="row-cols-2">
                                        <form action="" method="post">
                                            <input type='hidden' name='id' value='<?= $arItem['ID'] ?>'/>
                                            <input type="submit" name="submit" value="<?= $buttonText ?>"
                                                   aria-pressed="true"
                                                   class="<?= $class ?>" style="<?= $style ?>">
                                        </form>
                                    </div>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-end">
                        <img class="anons-img"
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
                </div>
            </div>
        <? endforeach; ?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?>
        <? endif; ?>

        <? endif; ?>
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
            <h4 class="widget-title">Вид проекта</h4>
            <div class="widget-category">
                <ul class="category-list">

                    <? if ($arResult['ID'] == $iblockProj): ?>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE=$listTypeProj[0]", array("TYPE")) ?>">Технический</a>
                        </li>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE=$listTypeProj[1]", array("TYPE")) ?>">Творческий</a>
                        </li>
                    <? else: ?>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE1=$listTypePract[0]", array("TYPE1")) ?>">Летняя</a>
                        </li>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE1=$listTypePract[2]", array("TYPE1")) ?>">Весенняя</a>
                        </li>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE1=$listTypePract[1]", array("TYPE1")) ?>">Осенняя</a>
                        </li>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE2=$listType2Pract[0]", array("TYPE2")) ?>">Преддипломная</a>
                        </li>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE2=$listType2Pract[1]", array("TYPE2")) ?>">Учебная</a>
                        </li>
                        <li><a href="<?= $APPLICATION->GetCurPageParam("TYPE2=$listType2Pract[2]", array("TYPE2")) ?>">Производственная</a>
                        </li>
                    <? endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
