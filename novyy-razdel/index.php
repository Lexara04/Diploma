<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новый раздел");
?>

<?
require_once $_SERVER["DOCUMENT_ROOT"] .SITE_TEMPLATE_PATH."/koolreport/core/autoload.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/novyy-razdel/MyReport.php";


$report1 = new MyReport;
$report1->run()->render();


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>