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
?>
<?
$filter1 = array(
    "IBLOCK_ID" => 1,
    "ACTIVE" => "Y",
    "PROPERTY_REPRESENT" => $USER->GetID(),
);
$arCompanies = [];
while ($arCompany = CIBlockElement::GetList(array(), $filter1, false, array("nPageSize" => 50))->Fetch()) {
    $arCompanies[] = $arCompany["ID"];
}
$arFilter = array(
    "IBLOCK_ID" => 4,
    "ACTIVE" => "Y",
    "PROPERTY_companyID" => $arCompanies,
);
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");

$rsApplications = CIBlockElement::GetList(array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
?>
<? if ($arResult["ITEMS"]): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название проекта/практики</th>
            <th scope="col">Статус</th>
            <th scope="col">Комментарий</th>
        </tr>
        </thead>
        <tbody>
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
            <td>
                <button aria-pressed="true" class="<?= $class ?>"><?= $buttonText ?></button>
            </td>

            <td><?= $arItem["DISPLAY_PROPERTIES"]['feedback']["DISPLAY_VALUE"]; ?></td>
            <? endforeach; ?>
        </tr>
        </tbody>
    </table>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>

<? endif; ?>