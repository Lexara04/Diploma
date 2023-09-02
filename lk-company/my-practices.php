<?
require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
$APPLICATION->SetTitle("Мои практики");
?>
<?
global $USER;
$arFilter1 = array(
    "IBLOCK_ID" => $iblockPract,
    "PROPERTY_COMP_ID" => $arCompanies,
);
$arSelect1 = array("ID", "NAME");
$rsApplications = CIBlockElement::GetList(array(), $arFilter1, false, array("nPageSize" => 50), $arSelect1);
if ($rsApplications) { ?>
    <div class="d-flex justify-content-between mb-5" >
        <div>
            <h5>
                Список практик
            </h5>
            <p>Просматривайте отклики, редактируйте и добавляйте практики</p>
        </div>

        <a href="add-practice.php" class="btn btn-primary mb-5">Добавить<i class="icofont-ui-add"></i></a>
    </div>

    <div class="table-responsive-md">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="w-50" scope="col">Название Практики</th>
            <th class="w-25" scope="col">Отклики</th>
            <th class="w-25" scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <? while ($arItem = $rsApplications->GetNextElement()) {
            $arFields = $arItem->GetFields();
            $arProps = $arItem->GetProperties();

            ?>
            <? $arElem = CIBlockElement::GetByID($arFields["ID"])->GetNext(); ?>
            <tr>
                <? //$userData = CUser::GetByID($arProps["studentID"]["VALUE"])->Fetch(); // получаем данные пользователя
                //$firstName = $userData['NAME']; // имя пользователя
                //$lastName = $userData['LAST_NAME']; // фамилия пользователя?>
                <td><a href="<?= $arElem['DETAIL_PAGE_URL'] ?>"><?= $arFields["NAME"] ?></a></td>
                <?
                $resCounter = 0;
                $arFilter3 = array("IBLOCK_ID" => $iblockStudReq, "PROPERTY_practID" => $arFields["ID"]);
                $amount = CIBlockElement::GetList(array(), $arFilter3, false, array("nPageSize" => 50));
                while ($ob = $amount->GetNextElement()) {
                    $resCounter += 1;
                }
                ?>
                <td>
                    <? if ($resCounter): ?>
                        <a href="responses.php?pid=<?= $arFields["ID"] ?>" aria-pressed="true"
                           class="btn btn-primary w-auto">Просмотр (<?= $resCounter ?>)</a>
                    <? else: ?>
                        <a href="responses.php?pid=<?= $arFields["ID"] ?>" aria-pressed="true"
                           class="btn btn-secondary h-auto w-auto disabled">Просмотр</a>
                    <? endif; ?>
                </td>
                <td>
                    <a href="edit-practice.php?pid=<?= $arFields["ID"] ?>" aria-pressed="true"
                       class="btn btn-primary w-auto">Редактировать</a>
                </td>
            </tr>

        <? } ?>
        </tbody>
    </table>
    </div>

<? } ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/footer.php"); ?>