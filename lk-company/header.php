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
<?
$bIsCompanyPage = $APPLICATION->GetCurPage(false) == '/lk-company/';
$bIsProjectPage = $APPLICATION->GetCurPage(false) == '/lk-company/my-projects.php';
$bIsPracticePage = $APPLICATION->GetCurPage(false) == '/lk-company/my-practices.php';
?>
    <!-- Courses Admin Start -->
    <div class="section overflow-hidden position-relative" id="wrapper">
        <div class="container">
            <div class="page-content-wrapper py-0">

                <!-- Admin Tab Menu Start -->
                <div class="nav flex-column nav-pills admin-tab-menu">
                    <a href="/lk-company"
                      <? if($bIsCompanyPage){ ?> class="active" <? }?>>Моя компания</a>
                    <a href="my-practices.php"
                        <? if($bIsPracticePage){ ?> class="active" <? }?>>Мои практики</a>
                    <a href="my-projects.php"
                        <? if($bIsProjectPage){ ?> class="active" <? }?>>Мои проекты</a>
                </div>
                <!-- Admin Tab Menu End -->

                <!-- Page Content Wrapper Start -->
                <div class="main-content-wrapper">
                    <div class="container">
