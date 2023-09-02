<?php
CModule::IncludeModule('iblock');
global $USER;
$status = '';
?>

<?
// ОБРАБОТКА ЗАЯВКИ ОТ ПОЛЬЗОВАТЕЛЯ
if ($_POST['submit']) {
    if ($_FILES["resume"]['name']) $resume = $_FILES["resume"];
    else $resume = $_POST['resume_old'];
    // формируем массив со свойствами элемента
    $properties = array(
        "studID" => $USER->GetID(),
        "resume" => $resume,
        "phone" => $_POST['phone'],
        "email" => $_POST['email'],
        "city" => $_POST['city'],
        "faculty" => $_POST['faculty'],
        "year" => $_POST['year']
    );

// создаем элемент в инфоблоке Студент-Резюме
    $arFields = array(
        "IBLOCK_ID" => $iblockResume,
        "NAME" => "Информация о {$USER->GetID()}",
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $properties,
    );

    $el = new CIBlockElement;
    $newElementId = $el->Add($arFields);
    if ($newElementId)
        $status = "Резюме успешно загружено";
    else
        $status = "Ошибка загрузки резюме";
}
?>
<?
$arFilter = array(
    "IBLOCK_ID" => $iblockResume,
    "ACTIVE" => "Y",
    "PROPERTY_studID" => $USER->GetID(),
);
$arSelect = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_studID", "PROPERTY_resume",
    "PROPERTY_phone", "PROPERTY_email", "PROPERTY_city", "PROPERTY_faculty", "PROPERTY_year");
$rsApplications = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect); ?>

<? while ($arItem = $rsApplications->GetNextElement()) {
    $arFields = $arItem->GetFields();
    $arProps = $arItem->GetProperties();
    //print_r($arProps);
    $phone = $arProps["phone"]["VALUE"];
    $email = $arProps["email"]["VALUE"];
    $city = $arProps["city"]["VALUE"];
    $faculty = $arProps["faculty"]["VALUE"];
    $year = $arProps["year"]["VALUE"];
    $resume = $arProps["resume"]["VALUE"];
    $filePath = CFile::GetPath($resume);
}
?>

<h2> Информация, которая будет видна компаниям </h2>
<p> Здесь вы можете указать Ваши контакты для обратной связи и прикрепить резюме!</p>
<?
if ($status)
    ShowNote($status);
?>
<form enctype="multipart/form-data" action="<?= POST_FORM_ACTION_URI ?>" method="post">
    <div class="table-responsive-md">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <td>
                    Телефон:
                </td>
                <td>
                    <input class="form-control" type="text" name="phone"
                           value="<?= $phone ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Почта:
                </td>
                <td>
                    <input value="<?= $email ?>" class="form-control" type="text" name="email" required>
                </td>
            </tr>
            <tr>
                <td>
                    Город:
                </td>
                <td>
                    <input value="<?= $city ?>" class="form-control" type="text" name="city" required>
                </td>
            </tr>
            <tr>
                <td>
                    Факультет:
                </td>
                <td>
                    <input value="<?= $faculty ?>" class="form-control" type="text" name="faculty" required>
                </td>
            </tr>
            <tr>
                <td>
                    Курс:
                </td>
                <td>
                    <input value="<?= $year ?>" class="form-control" type="text" name="year" required>
                </td>
            </tr>
            <tr>
                <td>
                    Резюме:
                </td>
                <td>
                    <input class="form-control" type="hidden" name="resume_old" value="<?= $resume ?>">
                    <input class="form-control" type="file" name="resume"
                           accept="image/*, application/msword, .pdf, application/zip, .rar">
                    <? if ($filePath) { ?><a href="<?= $filePath ?>" target="_blank">Скачать файл</a> <? } ?>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
    <div class="input-group">
        <input class="form-control" type="submit" name="submit">
        <input class="form-control" type="reset" name="reset">
    </div>
</form>
