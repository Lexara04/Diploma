<?php


$STATUS = 0;


// Only process POST reqeusts.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require($_SERVER["DOCUMENT_ROOT"]."/params.php");

    // Get the form fields and remove whitespace.

    $name = strip_tags(trim($_POST["name"]));

    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

    $phone = trim($_POST["userPhone"]);

    $subject = trim($_POST["subject"]);

    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer.

    if (empty($name) or empty($subject) or (empty($message) or empty($phone)) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Пожалуйста, заполните форму и повторите отправку. ";
        exit;

    }else {

        // формируем массив со свойствами элемента
        $properties = array(
            "FIO" => $_POST["name"],
            "EMAIL" => $_POST["email"],
            "TEL" => $_POST["userPhone"],
            "SUBJECT" => $_POST["subject"],
            "MESSAGE" => $_POST["message"],
        );

// создаем элемент в инфоблоке Студент-Заявка
        $arFields = array(
            "IBLOCK_ID" => $iblockPeopleReq,
            "NAME" => "Вопрос от {$_POST["name"]}",
            "ACTIVE" => "Y",
            "PROPERTY_VALUES" => $properties,
        );

        $el = new CIBlockElement;
        $newElementId = $el->Add($arFields);
        if ($newElementId) {
            echo "Спасибо! Ваше сообщение получено.";
            exit;
        } else {
            echo "Упс! Что-то пошло не так";
            exit;
        }

    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "Мы не можем обработать запрос. Пожалуйста, попробуйте позже.";
}


?>

