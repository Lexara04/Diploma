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
CModule::IncludeModule('iblock');
$class2 = 'btn btn-danger w-auto active';
$buttonText2 = 'Отказаться';
$class1 = 'btn btn-success w-auto active';
$buttonText1 = 'Подтвердить';
?>
<?php if ($arResult["ITEMS"]): ?>
    <div class="table-responsive-md">
        <table class="table table-hover ">
            <thead>
            <tr>
                <th class="w-auto" scope="col">#</th>
                <th class="w-50" scope="col">Название проекта/практики</th>
                <th class="w-25" scope="col">Статус</th>
                <th class="w-25" scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <? if ($_POST): ?>
                <? if (isset($_POST['hired'])) {
                    $ELEMENT_ID1 = $_POST['id'];  // код элемента
                    $PROPERTY_CODE1 = "studStatus";  // код свойства
                    $PROPERTY_VALUE1 = 1;  // значение свойства


                    // Установим новое значение для данного свойства данного элемента
                    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID1, false, array($PROPERTY_CODE1 => $PROPERTY_VALUE1));

                } elseif (isset($_POST['fired'])) {
                    $ELEMENT_ID1 = $_POST['id'];  // код элемента
                    $PROPERTY_CODE1 = "studStatus";  // код свойства
                    $PROPERTY_VALUE1 = 2;  // значение свойства

                    // Установим новое значение для данного свойства данного элемента
                    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID1, false, array($PROPERTY_CODE1 => $PROPERTY_VALUE1));

                }
                ?>
            <? endif; ?>
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <tr id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <th scope="row"><?= $arItem['NAME'] ?></th>
                    <td><?= $arItem["DISPLAY_PROPERTIES"]['practID']["DISPLAY_VALUE"]; ?></td>

                    <?php
                    // установка цвета кнопки в зависимости от статуса заявки
                    $status = (int)$arItem["DISPLAY_PROPERTIES"]['STATUS']["DISPLAY_VALUE"];
                    switch ($status) {
                        case 1:
                            $class = 'btn btn-success w-100 py-1 disabled';
                            $buttonText = 'Заявка принята';
                            break;
                        case 2:
                            $class = 'btn btn-danger w-100 py-1 disabled';
                            $buttonText = 'Заявка отклонена';
                            break;
                        case 3:
                            $class = 'btn btn-secondary w-100 py-1 disabled';
                            $buttonText = 'Заявка на рассмотрении';
                            break;
                    }
                    $style = "line-height: 30px; padding: 5px 10px;";

                    $status1 = (int)CIBlockElement::GetProperty(4, $arItem['ID'], [], ['CODE' => 'studStatus'])->Fetch()['VALUE'];
                    switch ($status1) {
                        case 1:
                            $class2 = 'btn btn-danger w-auto active';
                            $buttonText2 = 'Отказаться';
                            $class1 = 'btn btn-success w-auto disabled';
                            $buttonText1 = 'Вы согласились!';
                            break;
                        case 2:
                            $class2 = 'btn btn-danger w-auto disabled';
                            $buttonText2 = 'Вы отказались!';
                            $class1 = 'btn btn-success w-auto active';
                            $buttonText1 = 'Принять';
                            break;
                        case 3:
                            $class2 = 'btn btn-danger w-auto active';
                            $buttonText2 = 'Отказаться';
                            $class1 = 'btn btn-success w-auto active';
                            $buttonText1 = 'Подтвердить';
                            break;
                    }
                    ?>
                    <td>
                        <button aria-pressed="true" class="h-auto <?= $class ?>"><?= $buttonText ?></button>
                        <div class="input-group">
                            <?= $arItem["DISPLAY_PROPERTIES"]['feedback']["DISPLAY_VALUE"] ?>
                        </div>
                    </td>
                    <td>
                        <? if ($status != 2) { ?>
                            <form action="" method="post">
                                <input type='hidden' name='id' value='<?= $arItem['ID'] ?>'/>
                                <input type="submit" name="hired" value="<?= $buttonText1 ?>" aria-pressed="true"
                                       class="<?= $class1 ?>" style="<?= $style ?>"/>
                                <input type="submit" name="fired" value="<?= $buttonText2 ?>" aria-pressed="true"
                                       class="<?= $class2 ?>" style="<?= $style ?>">
                            </form>
                        <? } ?>
                    </td>

                </tr>
            <? endforeach; ?>

            </tbody>
        </table>
    </div>

<? else: ?>

    <!-- Call to Action Wrapper Start -->
    <div class="call-to-action-wrapper w-sm-75 mx-auto">

        <img class="cat-shape-01 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
             alt="Shape">
        <img class="cat-shape-04" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-13.svg" alt="Shape">
        <img class="cat-shape-03 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
             alt="Shape">

        <div class="row align-items-center">
            <div class="col-md-6 col-lg-5">
                <div class="section-title shape-02">
                    <h4>Вы еще не подали ни одной заявки на участие! Начните прямо сейчас</h4>
                </div>
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="d-xl-flex align-content-between">
                    <a class="btn btn-primary btn-hover-danger me-lg-5 mb-2" href="/all-practices">Все практики</a>
                    <a class="btn btn-primary btn-hover-danger mb-2" href="/all-projects">Все проекты</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action Wrapper End -->


<? endif; ?>

