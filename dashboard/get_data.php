<?

require($_SERVER["DOCUMENT_ROOT"] . "/params.php");

global $allVac;
global $allVacPrev;
global $allComp;
global $allStud;
global $allReq;

?>

<?php
// ИЩЕМ КОЛИЧЕСТВО ОПУБЛИКОВАННЫХ ВАКАНСИЙ

CModule::IncludeModule('iblock');

// ID инфоблока
$iblockId = [$iblockProj, $iblockPract];

// Создаем объект CIBlockElement
$element = new CIBlockElement();

// Получаем общее количество элементов в инфоблоке
$count = $element->GetList([], ['IBLOCK_ID' => $iblockId], [], false, []);

$allVac = $count;
?>

<?
// ИЩЕМ КОЛИЧЕСТВО ОПУБЛИКОВАННЫХ ВАКАНСИЙ ЗА ПОСЛЕДНИЙ МЕСЯЦ

// Получаем текущую дату
$currentDate = date('d.m.Y');
// Вычисляем дату, которая была год назад от текущей
$oneMonthAgo = date('d.m.Y', strtotime('-1 month', strtotime($currentDate)));

CModule::IncludeModule('iblock');

// ID инфоблока
$iblockId = [$iblockProj, $iblockPract];

// Создаем объект CIBlockElement
$element = new CIBlockElement();

// Получаем общее количество элементов в инфоблоке
$count = $element->GetList([], ['IBLOCK_ID' => $iblockId, '>=DATE_CREATE' => $oneMonthAgo], [], false, []);

$allVacPrev = $count;

?>

<?php
// ИЩЕМ КОЛИЧЕСТВО КОМПАНИЙ, КОТОРЫЕ КОГДА ЛИБО УЧАСТВОВАЛИ

// ID инфоблока
$iblockId = $iblockComp;

// Создаем объект CIBlockElement
$element = new CIBlockElement();

// Получаем общее количество элементов в инфоблоке
$count = $element->GetList([], ['IBLOCK_ID' => $iblockId], [], false, []);

$allComp = $count;
?>

<?php
// ИЩЕМ КОЛИЧЕСТВО СТУДЕНТОВ
$arFilter = array(
    "GROUPS_ID" => array($groupStudents), // ID пользовательской группы
    "ACTIVE" => "Y", // только активные пользователи
);
$rsUsers = CUser::GetList(($by = "id"), ($order = "asc"), $arFilter);
$registeredUsersCount = $rsUsers->SelectedRowsCount();

$allStud = $registeredUsersCount;
?>
<?php
// ИЩЕМ КОЛИЧЕСТВО ПОДАНЫХ ЗАЯВОК

CModule::IncludeModule('iblock');

// ID инфоблока
$iblockId = $iblockStudReq;

// Создаем объект CIBlockElement
$element = new CIBlockElement();

// Получаем общее количество элементов в инфоблоке
$countHired = $element->GetList([], ['IBLOCK_ID' => $iblockId, 'PROPERTY_STATUS' => 1], [], false, []);
$countFired = $element->GetList([], ['IBLOCK_ID' => $iblockId, 'PROPERTY_STATUS' => 2], [], false, []);
$countNone = $element->GetList([], ['IBLOCK_ID' => $iblockId, 'PROPERTY_STATUS' => 3], [], false, []);
$allReq = $countHired + $countFired + $countNone;

// ИЩЕМ КОЛИЧЕСТВО ПРИНЯТЫХ/НЕПРИНЯТЫХ ЗАЯВОК
$category_amount = array(
    array("category" => "Отклонено", "cost" => $countFired),
    array("category" => "Принято", "cost" => $countHired,),
    array("category" => "Без ответа", "cost" => $countNone,),
);
?>

<?
// ПОЛУЧАЕМ КОЛИЧЕСТВО ПРАКТИК И ПРОЕКТОВ ЗА ГОД

// Получаем текущую дату
$currentDate = date('d.m.Y');

// Вычисляем дату, которая была год назад от текущей
$oneYearAgo = date('d.m.Y', strtotime('-1 year', strtotime($currentDate)));

// Формируем фильтр для выборки элементов инфоблоков
$arFilter = array(
    "IBLOCK_ID" => [$iblockProj, $iblockPract], // ID инфоблоков "Практики" и "Проекты"
    ">DATE_CREATE" => $oneYearAgo, // только элементы, созданные за последний год
);

// Определяем необходимые поля для выборки элементов инфоблоков
$arSelect = array(
    "ID", "IBLOCK_ID", "NAME", "DATE_CREATE",
);

// Выбираем элементы инфоблоков согласно заданным условиям
$rsElements = CIBlockElement::GetList(array("DATE_CREATE" => "ASC"), $arFilter, false, false, $arSelect);

// Создаем массив для хранения данных по количеству практик и проектов за каждый месяц
$proj_per_month = array();

// Проходим по каждому элементу инфоблока
while ($arElement = $rsElements->GetNextElement()) {
    $arFields = $arElement->GetFields();

    // Получаем дату создания элемента
    $elementDate = strtotime($arFields["DATE_CREATE"]);

    // Если в массиве $proj_per_month нет элемента с данным ключом, то добавляем его
    if (!isset($proj_per_month[date('F', $elementDate)])) {
        $proj_per_month[date('F', $elementDate)] = array(
            "year" => date('F', $elementDate), // название месяца и года
            "projects" => 0, // количество проектов за этот месяц
            "practices" => 0, // количество практик за этот месяц
        );
    }

    // Увеличиваем счетчик количества проектов или практик (в зависимости от инфоблока)
    $proj_per_month[date('F', $elementDate)][$arFields["IBLOCK_ID"] == $iblockProj ? "projects" : "practices"]++;
}

?>

<?
// ПОЛУЧАЕМ КОЛИЧЕСТВО ПРАКТИК И ПРОЕКТОВ ЗА МЕСЯЦ

$start_date = date("01.05.Y"); // первый день текущего месяца
$end_date = date("d.m.Y"); // текущая дата

$arFilter1 = array(
    "IBLOCK_ID" => [$iblockProj, $iblockPract],
    ">=DATE_CREATE" => $start_date,
    "<=DATE_CREATE" => $end_date . ' 23:59:59',
);
// Определяем необходимые поля для выборки элементов инфоблоков
$arSelect1 = array(
    "ID", "IBLOCK_ID", "NAME", "DATE_CREATE",
);
$rsElements = CIBlockElement::GetList(array("DATE_CREATE" => "ASC"), $arFilter1, false, false, $arSelect1);

$w = 0;
$proj_per_week = array();
while ($ob = $rsElements->GetNextElement()) {

    $arFields = $ob->GetFields();
    $week_num = date("W", strtotime($arFields["DATE_CREATE"]));
    if ($w == 0) $w = $week_num;
    $key = $week_num - $w + 1;

    $date = new DateTime();
    $date->setISODate(date('Y'), $week_num, 1); // установка номера недели и дня 1 (понедельник)
    $weekStart = $date->format('d.m.Y'); // Начало недели (формат: ГГГГ-ММ-ДД)
    $weekEnd = date('d.m.Y', strtotime($weekStart . ' +6 days')); // Добавляем 6 дней (до воскресенья)
    $week_num = 'с ' . $weekStart . " по " . $weekEnd;
    if (!isset($proj_per_week[$week_num])) {
        $proj_per_week[$week_num] = array(
            "year" => $week_num,
            "projects" => 0,
            "practices" => 0,
        );
    }

    $proj_per_week[$week_num][$arFields["IBLOCK_ID"] == $iblockProj ? "projects" : "practices"]++;
}
?>
