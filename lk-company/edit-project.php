<?
require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/header.php");

$APPLICATION->SetTitle("Редактирование проекта");
global $USER;
?>
    <script>
        function addInput() {
            const inputContainer = document.getElementById('123');
            // создаем новый элемент input
            var newInput = document.createElement("select");
            newInput.type = "text";
            newInput.className = "form-control";
            newInput.name = "<?=$propProj[1]?>[]"
            var names = ['Маркетинг', 'IT']
            for (var i = 1; i <= 2; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = names[i - 1];
                newInput.appendChild(option);
            }

            // создаем новый div
            var newDiv = document.createElement("div");
            newDiv.className = "input-group";

            // добавляем input в div
            newDiv.appendChild(newInput);

            // добавляем div
            inputContainer.appendChild(newDiv);
        }
    </script>
    <script>
        function addInput1() {
            const inputContainer = document.getElementById('321');
            // создаем новый элемент input
            var newInput = document.createElement("select");
            for (var i = 3; i <= 7; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = (i - 2) + ' Курс';
                newInput.appendChild(option);
            }
            newInput.className = "form-control";
            newInput.name = "<?=$propProj[3]?>[]"

            // создаем новый div
            var newDiv = document.createElement("div");
            newDiv.className = "input-group";

            // добавляем input в div
            newDiv.appendChild(newInput);

            // добавляем div
            inputContainer.appendChild(newDiv);
        }
    </script>

<? if ($_POST): ?>
    <? if (isset($_POST['submit_project'])) {
        //echo '<pre>'; print_r($_POST); echo '<pre>';
        if ($_POST['preview_delete'] == 1 and !$_FILES['preview_picture']['name']) {
            $prevImg = array('del' => 'Y');
        } elseif ($_FILES['preview_picture']) {
            $prevImg = $_FILES['preview_picture'];
        }
        if ($_POST['detail_delete'] == 1 and !$_FILES['detail_picture']['name']) {
            $detImg = array('del' => 'Y');
        } elseif ($_FILES['preview_picture']) {
            $detImg = $_FILES['preview_picture'];
        }
        $el = new CIBlockElement;
        $PROP = array();
        $PROP[$propProj[0]] = $_POST[$propProj[0]]; // адрес
        $PROP[$propProj[1]] = $_POST[$propProj[1]]; // категория
        $PROP[$propProj[2]] = $arCompanies; // компания
        $PROP[$propProj[3]] = $_POST[$propProj[3]]; // курс
        $PROP[$propProj[4]] = $_POST[$propProj[4]]; // местоположение
        $PROP[$propProj[5]] = $_POST[$propProj[5]]; // продолжительность
        $PROP[$propProj[6]] = 1; // статус набора
        $PROP[$propProj[7]] = array("VALUE" => array("TYPE" => "HTML", "TEXT" => $_POST[$propProj[7]])); // требования
        $PROP[$propProj[8]] = array("VALUE" => array("TYPE" => "HTML", "TEXT" => $_POST[$propProj[8]])); // условия
        $PROP[$propProj[9]] = $_POST[$propProj[9]]; // тип проекта
        $arLoadProductArray = array(
            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
            "IBLOCK_SECTION" => false,          // элемент лежит в корне раздела
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $_POST['name'],
            "ACTIVE" => "Y",            // активен
            "PREVIEW_TEXT" => $_POST['preview_text_new'],
            "DETAIL_TEXT" => $_POST['detail_text_new'],
            "PREVIEW_PICTURE" => $prevImg,
            "DETAIL_PICTURE" => $detImg
        );

        $PRODUCT_ID = $_GET['pid'];  // изменяем элемент с кодом (ID) 2
        $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
        if ($res) {
            $status = 'Данные сохранены!';
        } else {
            $status = 'Ошибка при сохранении!';
        }
        // Перенаправление на ту же страницу
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
endif; ?>
<? $res = CIBlockElement::GetByID($_GET["pid"]);
if ($ar_res = $res->GetNext()) { ?>
    <? if ($status <> '') { ShowNote($status); ?> <br> <br><? } ?>
    <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data" name="my_form"
          id="my_form">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">Название</span>
            <textarea name="name" class="form-control"
                      aria-label="With textarea"><?= $ar_res["NAME"] ?></textarea>
        </div>
        <br>
        <div class="row align-items-start">
            <div class="col">
                <span class="input-group-text" id="basic-addon3">Изображение анонса</span>
                <input class="form-control" type="file" name="preview_picture" accept="image/*">
                <? if ($ar_res['PREVIEW_PICTURE']) { ?>
                    <img style="max-width: 150px" src="<?= CFile::GetPath($ar_res['PREVIEW_PICTURE']) ?>">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="preview_delete" value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Удалить изображение</label>
                    </div>
                <? } ?>
            </div>
            <div class="col">
                <span class="input-group-text" id="basic-addon3">Изображение анонса</span>
                <input class="form-control" type="file" name="detail_picture" accept="image/*">
                <? if ($ar_res['DETAIL_PICTURE']) { ?>
                    <img style="max-width: 500px" src="<?= CFile::GetPath($ar_res['DETAIL_PICTURE']) ?>"><br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="detail_delete" value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Удалить изображение</label>
                    </div>
                <? } ?>
            </div>
        </div>
        <br>
        <span class="input-group-text" id="basic-addon3">Короткий текст</span>
        <? $APPLICATION->IncludeComponent(
            "bitrix:fileman.light_editor",
            "",
            array(
                "AUTO_RESIZE" => "Y",
                "CONTENT" => $ar_res['PREVIEW_TEXT'],
                "HEIGHT" => "200px",
                "ID" => "",
                "INPUT_ID" => "",
                "INPUT_NAME" => "preview_text_new",
                "JS_OBJ_NAME" => "",
                "RESIZABLE" => "Y",
                "USE_FILE_DIALOGS" => "Y",
                "WIDTH" => "100%"
            )
        ); ?>
        <br>
        <br>
        <span class="input-group-text" id="basic-addon3">Детальный текст</span>
        <? $APPLICATION->IncludeComponent(
            "bitrix:fileman.light_editor",
            "",
            array(
                "AUTO_RESIZE" => "Y",
                "CONTENT" => $ar_res['DETAIL_TEXT'],
                "HEIGHT" => "200px",
                "ID" => "",
                "INPUT_ID" => "",
                "INPUT_NAME" => "detail_text_new",
                "JS_OBJ_NAME" => "",
                "RESIZABLE" => "Y",
                "USE_FILE_DIALOGS" => "Y",
                "WIDTH" => "100%"
            )
        ); ?>
        <br>
        <? $res = CIBlockElement::GetByID($_GET["pid"]);
        if ($prop = $res->GetNextElement()->GetProperties()) { ?>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3"><?= $prop["ADDRESS"]["NAME"] ?></span>
                <textarea name="<?= $propProj[0] ?>" class="form-control"
                          aria-label="With textarea"><?= $prop["ADDRESS"]["VALUE"] ?></textarea>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3"><?= $prop["LOCATION"]["NAME"] ?></span>
                <textarea name="<?= $propProj[4] ?>" class="form-control"
                          aria-label="With textarea"><?= $prop["LOCATION"]["VALUE"] ?></textarea>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3"><?= $prop["DURATION"]["NAME"] ?></span>
                <textarea name="<?= $propProj[5] ?>" class="form-control"
                          aria-label="With textarea"><?= $prop["DURATION"]["VALUE"] ?></textarea>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3"><?= $prop["TYPE"]["NAME"] ?></span>
                <select class="form-select" name="<?= $propProj[9] ?>">
                    <option value="<?= $listTypeProj[0] ?>" <? if ($prop["TYPE"]["VALUE_ENUM_ID"] == $listTypeProj[0]) { ?> selected <? } ?>>
                        Технический
                    </option>
                    <option value="<?= $listTypeProj[1] ?>" <? if ($prop["TYPE"]["VALUE_ENUM_ID"] == $listTypeProj[1]) { ?> selected <? } ?>>
                        Творческий
                    </option>
                </select>
            </div>
            <br>
            <span class="input-group-text" id="basic-addon3"><?= $prop["categories"]["NAME"] ?></span>
            <div id="123">
                <? if ($prop["categories"]["VALUE"]) {
                    for ($i = 0; $i < count($prop["categories"]["VALUE"]); $i++) { ?>
                        <select class="form-select" name="<?= $propProj[1] ?>[]">
                            <option value="<?= $listCategoryProj[0] ?>"
                                <? if ($prop["categories"]["VALUE_ENUM_ID"][$i] == $listCategoryProj[0]) { ?> selected <?
                                } ?>>Маркетинг
                            </option>
                            <option value="<?= $listCategoryProj[1] ?>"
                                <? if ($prop["categories"]["VALUE_ENUM_ID"][$i] == $listCategoryProj[1]) { ?> selected <?
                                } ?>>IT
                            </option>
                        </select>
                    <? }
                } else { ?>
                    <select class="form-select" name="<?= $propProj[1] ?>[]">
                        <option value="<?= $listCategoryProj[0] ?>">Маркетинг</option>
                        <option value="<?= $listCategoryProj[1] ?>">IT</option>
                    </select>
                <? } ?>
            </div>
            <button class="btn btn-outline-secondary" onclick="addInput()" type="button" id="button-addon1">
                + Добавить категорию
            </button>
            <br><br>
            <div id="321">
                <span class="input-group-text" id="basic-addon3"><?= $prop["YEAR_NUM"]["NAME"] ?></span>
                <? if ($prop["YEAR_NUM"]["VALUE"]) {
                    for ($i = 0; $i < count($prop["YEAR_NUM"]["VALUE"]); $i++) { ?>
                        <select class="form-select" name="<?= $propProj[3] ?>[]">
                            <option value="<?= $listYearProj[0] ?>" <? if ($prop["YEAR_NUM"]["VALUE_ENUM_ID"][$i] == $listYearProj[0]) { ?> selected <?
                            } ?>>1 Курс
                            </option>
                            <option value="<?= $listYearProj[1] ?>" <? if ($prop["YEAR_NUM"]["VALUE_ENUM_ID"][$i] == $listYearProj[1]) { ?> selected <?
                            } ?>>2 Курс
                            </option>
                            <option value="<?= $listYearProj[2] ?>" <? if ($prop["YEAR_NUM"]["VALUE_ENUM_ID"][$i] == $listYearProj[2]) { ?> selected <?
                            } ?>>3 Курс
                            </option>
                            <option value="<?= $listYearProj[3] ?>" <? if ($prop["YEAR_NUM"]["VALUE_ENUM_ID"][$i] == $listYearProj[3]) { ?> selected <?
                            } ?>>4 Курс
                            </option>
                            <option value="<?= $listYearProj[4] ?>" <? if ($prop["YEAR_NUM"]["VALUE_ENUM_ID"][$i] == $listYearProj[4]) { ?> selected <?
                            } ?>>5 курс
                            </option>
                        </select>
                    <? }
                } else { ?>
                    <select class="form-select" name="<?= $propProj[3] ?>[]">
                        <option value="<?= $listYearProj[0] ?>">1 Курс</option>
                        <option value="<?= $listYearProj[1] ?>">2 Курс</option>
                        <option value="<?= $listYearProj[2] ?>">3 Курс</option>
                        <option value="<?= $listYearProj[3] ?>">4 Курс</option>
                        <option value="<?= $listYearProj[4] ?>">5 курс</option>
                    </select>
                <? } ?>
            </div>
            <button class="btn btn-outline-secondary" onclick="addInput1()" type="button" id="button-addon2">
                + Добавить курс
            </button>
            <br><br>
            <span class="input-group-text" id="basic-addon3"><?= $prop["REQUIREMENTS"]["NAME"] ?></span>
            <? $APPLICATION->IncludeComponent(
                "bitrix:fileman.light_editor",
                "",
                array(
                    "AUTO_RESIZE" => "Y",
                    "CONTENT" => $prop["REQUIREMENTS"]["~VALUE"]["TEXT"],
                    "HEIGHT" => "200px",
                    "ID" => "",
                    "INPUT_ID" => "",
                    "INPUT_NAME" => $propProj[7],
                    "JS_OBJ_NAME" => "",
                    "RESIZABLE" => "Y",
                    "USE_FILE_DIALOGS" => "Y",
                    "WIDTH" => "100%"
                )
            ); ?>
            <br>
            <span class="input-group-text" id="basic-addon3"><?= $prop["CONDITIONS"]["NAME"] ?></span>
            <? $APPLICATION->IncludeComponent(
                "bitrix:fileman.light_editor",
                "",
                array(
                    "AUTO_RESIZE" => "Y",
                    "CONTENT" => $prop["CONDITIONS"]["~VALUE"]["TEXT"],
                    "HEIGHT" => "200px",
                    "ID" => "",
                    "INPUT_ID" => "",
                    "INPUT_NAME" => $propProj[8],
                    "JS_OBJ_NAME" => "",
                    "RESIZABLE" => "Y",
                    "USE_FILE_DIALOGS" => "Y",
                    "WIDTH" => "100%"
                )
            ); ?>
            <br>
            <? //echo '<pre>'; print_r($prop); echo '<pre>';?>

        <? } ?>

        <input type='hidden' name='id' value="<?= $ar_res['ID'] ?>"/>
        <input type="submit" name="submit_project" value="Сохранить">

    </form>

<? } ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/footer.php"); ?>