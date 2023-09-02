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
// генерируем новый массив данных
$new_data = array(
    array("year" => "2019", "projects" => 50, "practices" => 20),
    array("year" => "2020", "projects" => 70, "practices" => 30),
    array("year" => "2021", "projects" => 90, "practices" => 40),
);

// возвращаем новый массив данных в формате JSON
echo json_encode($new_data);
?>