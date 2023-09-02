<?
use \koolreport\widgets\koolphp\Card;
use \koolreport\widgets\google\DonutChart;
use \koolreport\widgets\google\BarChart;
global $allVac;
global $allVacPrev;
global $allComp;
global $allStud;
global $allReq;

?>
<?php
if ($_GET['mode'] === 'all_years') {
    $allVac=800;
    echo $allVac;
} elseif ($_GET['mode'] === 'current_year') {
    echo 'Текст для текущего года';
} elseif ($_GET['mode'] === 'current_month') {
    echo 'Текст для текущего месяца';
}
?>