<?
require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/header.php");
$APPLICATION->SetTitle("Отклики");
?>

<?
CModule::IncludeModule('iblock');
$pid = intval($_GET["pid"]);
$arItem1 = CIBlockElement::GetByID($pid)->GetNext();
//print_r( $arItem1);
$arFilter4 = array(
    "IBLOCK_ID" => $iblockStudReq,
    "ACTIVE" => "Y",
    "PROPERTY_practID" => $pid,
);
$arSelect4 = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_studentID", "PROPERTY_STATUS", "PROPERTY_practID", "PROPERTY_feedback", "PROPERTY_studStatus");
$rsApplications = CIBlockElement::GetList(array(), $arFilter4, false, array("nPageSize" => 50), $arSelect4);
if ($rsApplications) { ?>
    <? if ($_POST): ?>
        <? if (isset($_POST['hired'])) {
            $ELEMENT_ID = $_POST['id'];  // код элемента
            $PROPERTY_CODE1 = "STATUS";  // код свойства
            $PROPERTY_CODE2 = "feedback";  // код свойства
            $PROPERTY_VALUE1 = 1;  // значение свойства
            $PROPERTY_VALUE2 = $_POST['feedback'];  // значение свойства


            // Установим новое значение для данного свойства данного элемента
            CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE1 => $PROPERTY_VALUE1,
                $PROPERTY_CODE2 => $PROPERTY_VALUE2));

        } elseif (isset($_POST['fired'])) {
            $ELEMENT_ID = $_POST['id'];  // код элемента
            $PROPERTY_CODE1 = "STATUS";  // код свойства
            $PROPERTY_CODE2 = "feedback";  // код свойства
            $PROPERTY_VALUE1 = 2;  // значение свойства
            $PROPERTY_VALUE2 = $_POST['feedback'];  // значение свойства

            // Установим новое значение для данного свойства данного элемента
            CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE1 => $PROPERTY_VALUE1,
                $PROPERTY_CODE2 => $PROPERTY_VALUE2));

        }
        ?>
    <? endif; ?>
    <h5 class="mb-7"><span style="color: #309255;"> <? if($arItem1['IBLOCK_ID'] == $iblockProj): ?>Проект: <? else: ?> Практика: <? endif; ?></span> <a
                href="<?= $arItem1["DETAIL_PAGE_URL"] ?>"><?= $arItem1["NAME"] ?></a></h5>
    <table class="table table-hover w-100">
        <thead>
        <tr>
            <th>
                Данные кандидата
            </th>
            <th>
                Ваш комментарий
            </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        <? while ($arItem = $rsApplications->GetNextElement()) {
            $arFields = $arItem->GetFields();
            $arProps = $arItem->GetProperties();
            ?>
            <tr>
                <? $userData = CUser::GetByID($arProps["studentID"]["VALUE"])->Fetch(); // получаем данные пользователя
                $firstName = $userData['NAME']; // имя пользователя
                $lastName = $userData['LAST_NAME']; // фамилия пользователя
                $secondName = $userData['SECOND_NAME']; // фамилия пользователя?>
                <?
                $arFilterr = array(
                    "IBLOCK_ID" => $iblockResume,
                    "ACTIVE" => "Y",
                    "PROPERTY_studID" => $arProps["studentID"]["VALUE"],
                );
                $arSelectt = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_studID", "PROPERTY_resume",
                    "PROPERTY_phone", "PROPERTY_email", "PROPERTY_city", "PROPERTY_faculty", "PROPERTY_year");
                $rsStudInfo = CIBlockElement::GetList(array(), $arFilterr, false, array("nPageSize" => 50), $arSelectt); ?>

                <? while ($arInfo = $rsStudInfo->GetNextElement()) {
                    $arProps1 = $arInfo->GetProperties();
                    //print_r($arProps);
                    $phone = $arProps1["phone"]["VALUE"];
                    $email = $arProps1["email"]["VALUE"];
                    $city = $arProps1["city"]["VALUE"];
                    $faculty = $arProps1["faculty"]["VALUE"];
                    $year = $arProps1["year"]["VALUE"];
                    $resume = $arProps1["resume"]["VALUE"];
                    $filePath = CFile::GetPath($resume);
                }
                ?>
                <?php
                // установка цвета кнопки в зависимости от статуса заявки
                $status = (int)$arProps['STATUS']['VALUE'];
                switch ($status) {
                    case 1:
                        $class1 = 'btn btn-success w-auto py-1 disabled my-2';
                        $buttonText1 = 'Принят';
                        $class2 = 'btn btn-danger w-auto py-1 active my-2';
                        $buttonText2 = 'Отклонить';
                        break;
                    case 2:
                        $class1 = 'btn btn-success w-auto py-1 active my-2';
                        $buttonText1 = 'Принять';
                        $class2 = 'btn btn-danger w-auto py-1 disabled my-2';
                        $buttonText2 = 'Отклонён';
                        break;
                    case 3:
                        $class1 = 'btn btn-success w-auto py-1 active my-2';
                        $buttonText1 = 'Принять';
                        $class2 = 'btn btn-danger w-auto py-1 active my-2';
                        $buttonText2 = 'Отклонить';
                        break;
                }
                $style = "line-height: 30px; padding: 5px 10px;";

                $status1 = $arProps['studStatus']["VALUE"];
                switch ($status1) {
                    case 1:
                        $class3 = 'btn btn-success w-100 disabled my-2';
                        $buttonText3 = 'Студент согласен';
                        break;
                    case 2:
                        $class3 = 'btn btn-danger w-100 disabled my-2';
                        $buttonText3 = 'Студент отказался';
                        break;
                    case 3:
                        $class3 = 'btn btn-secondary w-100 disabled my-2';
                        $buttonText3 = 'Ожидание ответа студента';
                        break;
                }

                ?>
                <td class="w-50">
                    <div class="single-student bg-white">
                        <div class="student-content">
                            <h5 class="name"><?= "{$lastName} {$firstName} {$secondName}" ?></h5>
                            <span class="country"> <?= $city ?> </span>
                            <p><?= $phone ?></p>
                            <p><?= $email ?></p>
                            <p><?= $faculty ?></p>
                            <p><?= $year ?></p>
                            <? if ($filePath) { ?><a href="<?= $filePath ?>" target="_blank">Скачать файл</a> <? } ?>
                        </div>
                    </div>
                </td>
                <form action="<?= POST_FORM_ACTION_URI ?>" method="post">
                    <td class="w-25">
                        <div class="input-group">
                            <textarea style="height: 187px" name="feedback" class="form-control"
                                      aria-label="With textarea">
                                <?= $arProps['feedback']['VALUE'] ?></textarea>
                        </div>
                    </td>
                    <td class="w-25">
                        <div class="mx-auto">
                            <input type="submit" name="hired" value="<?= $buttonText1 ?>" aria-pressed="true"
                                   class="<?= $class1 ?>" style="<?= $style ?>"/>
                            <input type="submit" name="fired" value="<?= $buttonText2 ?>" aria-pressed="true"
                                   class="<?= $class2 ?>" style="<?= $style ?>">
                        </div>
                        <input type='hidden' name='id' value="<?= $arFields['ID'] ?>"/>
                        <input value="<?= $buttonText3 ?> " aria-pressed="true"
                               class="<?= $class3 ?>" style="<?= $style ?>">
                    </td>
                </form>

            </tr>
        <? } ?>

        </tbody>
    </table> <? } ?>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/footer.php"); ?>