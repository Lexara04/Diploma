<?php
$STATUS = 0;
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    CModule::IncludeModule('iblock');
    // формируем массив со свойствами элемента
    $properties = array(
        "FIO" => $_POST["name"],
        "EMAIL" => $_POST["email"],
        "TEL" => $_POST["userPhone"],
        "COMPANY" => $_POST["subject"],
        "MESSAGE" => $_POST["message"],
    );

// создаем элемент в инфоблоке Студент-Заявка
    $arFields = array(
        "IBLOCK_ID" => $iblockCompReq,
        "NAME" => "Заявка от {$_POST["name"]} из {$_POST["subject"]}",
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $properties,
    );

    $el = new CIBlockElement;
    $newElementId = $el->Add($arFields);
    if ($newElementId) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Спасибо! Ваше сообщение получено.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Упс! Что-то пошло не так";
    }
}
else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "Мы не можем обработать запрос. Пожалуйста, попробуйте позже.";
}


?>