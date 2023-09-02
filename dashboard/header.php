<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<?
global $USER;
CModule::IncludeModule('iblock');
$arSelect = array("ID");
$arCompanies = [];
$arFilter = array("IBLOCK_ID" => $iblockComp, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_REPRESENT" => $USER->GetID());
$res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
while ($arCompany = $res->Fetch()) {
    $arCompanies = $arCompany["ID"];
}
?>

    <!-- Courses Admin Start -->
    <div class="section overflow-hidden position-relative" id="wrapper">
        <div class="container">
