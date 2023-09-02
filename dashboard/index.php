<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
$APPLICATION->SetTitle("Дашборд");
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
require_once $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/koolreport/core/autoload.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/dashboard/MyReport.php";
?>
    <div class="section overflow-hidden position-relative" id="wrapper">
        <div class="container">
            <div class="graph">
                <div class="graph-content">
                    <? $report1 = new MyReport;
                    $report1->run()->render(); ?>
                </div>
            </div>
        </div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>