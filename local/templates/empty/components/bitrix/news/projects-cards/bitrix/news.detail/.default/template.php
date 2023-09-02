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
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");

?>
<?php
$shortInfo = array("COMP_ID", "DURATION", "YEAR_NUM", "LOCATION", "TYPE", "TYPE2");
$detailInfo = array("REQUIREMENTS", "CONDITIONS");
$symbols["COMP_ID"] = '<i class="icofont-man-in-glasses"></i>';
$symbols["DURATION"] = '<i class="icofont-clock-time"></i>';
$symbols["YEAR_NUM"] = '<i class="icofont-hat-alt"></i>';
$symbols["LOCATION"] = '<i class="icofont-map"></i>';
$symbols["ADDRESS"] = '<i class="icofont-google-map"></i>';
$symbols["TYPE"] = '<i class="icofont-instrument"></i>';
$symbols["TYPE2"] = '<i class="icofont-test-tube-alt"></i>';

?>
<?php
global $elementId;
$elementId = $arParams["ELEMENT_ID"];
global $userId;
$userId = $USER->GetID();
$class = 'btn btn-primary btn-hover-danger';
$style = "line-height: 30px; padding: 5px 10px;";
$buttonText = 'Подать Заявку';
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
// установка цвета кнопки в зависимости от статуса заявки
$status = (int)CIBlockElement::GetProperty($iblockStudReq, $newElementId, [], ['CODE' => 'STATUS'])->Fetch()['VALUE'];
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
    );

// создаем элемент в инфоблоке Студент-Заявка
    $arFields = array(
        "IBLOCK_ID" => $iblockStudReq,
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
<div class="row gx-10">
    <div class="col-lg-7">
        <div class="courses-details">

            <div class="courses-details-images">
                <div class="info-img-div">
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                        <img border="0"
                             src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                             width="500px"
                             alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                             title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                        />
                    <? else: ?>
                        <img border="0"
                             src="<?= SITE_TEMPLATE_PATH ?>/img/detail-proj.png"
                             width="500px"
                             alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                             title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                        />
                    <? endif; ?>
                </div>
            </div>
            <h2 class="title">
                <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
                    <?= $arResult["NAME"] ?>
                <? endif; ?>
            </h2>
            <? $comp = $arResult['DISPLAY_PROPERTIES']['COMP_ID']['LINK_ELEMENT_VALUE'][$arResult['DISPLAY_PROPERTIES']['COMP_ID']['VALUE']] ?>
            <div class="courses-details-admin">
                <div class="admin-author">
                    <div class="author-thumb">
                        <img src="<?= CFile::GetPath($comp['PREVIEW_PICTURE']) ?>" alt="Author">
                    </div>
                    <div class="author-content">
                        <a class="name" href="<?= $comp['DETAIL_PAGE_URL'] ?>">
                            <?= $comp['NAME'] ?>
                        </a>
                    </div>
                </div>
                <? if ($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]): ?>
                    <div class="admin-rating w-50 text-end">
                        <span class="rating-text">
                        <?= $arResult['DISPLAY_PROPERTIES']["ADDRESS"]['DISPLAY_VALUE']; ?>
                    </span>
                        <span class="rating-text" style="font-size: 20px">
                    <?= $symbols["ADDRESS"] ?>
                    </span>
                    </div>
                <? endif; ?>
            </div>
            <div class="courses-details-tab">

                <div class="details-tab-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <button class="active" data-bs-toggle="tab" data-bs-target="#description">Описание
                            </button>
                        </li>
                        <li>
                            <button data-bs-toggle="tab"
                                    data-bs-target="#instructors"><?= $arResult['DISPLAY_PROPERTIES'][$detailInfo[0]]['NAME'] ?></button>
                        </li>
                        <li>
                            <button data-bs-toggle="tab"
                                    data-bs-target="#reviews"><?= $arResult['DISPLAY_PROPERTIES'][$detailInfo[1]]['NAME'] ?></button>
                        </li>
                    </ul>
                </div>
                <div class="details-tab-content">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="description">

                            <div class="tab-description">
                                <div class="description-wrapper">
                                    <? if ($arResult["DETAIL_TEXT"] <> ''): ?>
                                        <? echo $arResult["DETAIL_TEXT"]; ?>
                                    <? else: ?>
                                        <? echo $arResult["PREVIEW_TEXT"]; ?>
                                    <? endif ?>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="instructors">
                            <div class="tab-description">
                                <div class="description-wrapper">
                                    <h3 class="tab-title"><?= $arResult['DISPLAY_PROPERTIES'][$detailInfo[0]]['NAME'] ?>
                                        :</h3>
                                    <p> <?= $arResult['DISPLAY_PROPERTIES'][$detailInfo[0]]['DISPLAY_VALUE']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews">

                            <div class="tab-description">
                                <div class="description-wrapper">
                                    <h3 class="tab-title"><?= $arResult['DISPLAY_PROPERTIES'][$detailInfo[1]]['NAME'] ?>
                                        :</h3>
                                    <p><?= $arResult['DISPLAY_PROPERTIES'][$detailInfo[1]]['DISPLAY_VALUE']; ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="sidebar">
            <div class="sidebar-widget widget-information">
                <div class="info-list">
                    <div class="info-price">
                        <span class="price">Сведения</span>
                    </div>
                    <ul>
                        <? // вывод каждого свойства по отдельности: ?>
                        <? foreach ($shortInfo as $attribute): ?>

                            <? if ($arResult["DISPLAY_PROPERTIES"][$attribute]): ?>

                                <li>
                                    <?= $symbols[$attribute] ?>
                                    <strong><?= $arResult['DISPLAY_PROPERTIES'][$attribute]['NAME'] ?></strong>
                                    <span>
                                    <? if (is_array($arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE'])): ?>

                                        <?= implode("&nbsp;/&nbsp;", $arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE']); ?>

                                    <? else: ?>

                                        <?= $arResult['DISPLAY_PROPERTIES'][$attribute]['DISPLAY_VALUE']; ?>

                                    <? endif ?>
                                    </span>

                                </li>

                            <? endif ?>

                        <? endforeach; ?>
                    </ul>
                </div>
                <? if (in_array(6, CUser::GetUserGroup($USER->GetID())) || in_array(1, CUser::GetUserGroup($USER->GetID()))): ?>
                    <div class="info-btn">
                        <form action="" method="post">
                            <input type="submit" name="submit" value="<?= $buttonText ?>" aria-pressed="true"
                                   class="<?= $class ?>">
                        </form>
                    </div>
                <? elseif (!in_array(5, CUser::GetUserGroup($USER->GetID()))): ?>
                    <div class="info-btn">
                        <a aria-pressed="true" href="/user/?login=yes&backurl=%2F"
                           class="<?= $class ?>"> <?= $buttonText ?> </a>
                    </div>
                <? endif; ?>

            </div>
            <div class="sidebar-widget">
                <h4 class="widget-title">Поделиться</h4>

                <ul class="social">
                    <?
                    // включаемая область для раздела
                    $APPLICATION->IncludeFile(SITE_DIR . "include/social-links.php",
                        array(),
                        array(
                            "MODE" => "html",
                        ));
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="section section-padding-02">
    <div class="container">

        <div class="call-to-action-wrapper">

            <img class="cat-shape-01 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
                 alt="Shape">
            <img class="cat-shape-02" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-13.svg" alt="Shape">
            <img class="cat-shape-03 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
                 alt="Shape">

            <div class="row align-items-center">
                <div class="col-md-6">

                    <div class="section-title shape-02">
                        <h5 class="sub-title">Познакомься с будущими специалистами уже сегодня</h5>
                        <h2 class="main-title">Есть <span>предложения</span> для наших студентов в Вашей
                            <span>компании?</span></h2>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="call-to-action-btn">
                        <a class="btn btn-primary btn-hover-danger" href="/for-companies">Хочу принять участие!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
