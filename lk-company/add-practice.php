<?
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/header.php");

$APPLICATION->SetTitle("Редактирование практики");
global $USER;
?>
    <script>
        function addInput() {
            const inputContainer = document.getElementById('123');
            // создаем новый элемент input
            var newInput = document.createElement("select");
            newInput.className = "nice-select";
            newInput.name = "<?=$propPract[1]?>[]"
            var names = ['Маркетинг', 'IT']
            for (var i = <?=$listCategoryPract[0]?>; i <= <?=$listCategoryPract[1]?>; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = names[i - <?=$listCategoryPract[0]?>];
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
            for (var i = <?=$listYearPract[0]?>; i <= <?=$listYearPract[4]?>; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = (i - <?=$listYearPract[0]?> + 1) + ' Курс';
                newInput.appendChild(option);
            }
            newInput.className = "nice-select";
            newInput.name = "<?=$propPract[3]?>[]"

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

    <? if (isset($_POST['submit'])) {
        $prevImg = $_FILES['preview_picture'];
        $detImg = $_FILES['detail_picture'];
        $el = new CIBlockElement;
        $PROP = array();
        $PROP[$propPract[0]] = $_POST[$propPract[0]]; // адрес
        $PROP[$propPract[1]] = $_POST[$propPract[1]]; // категория
        $PROP[$propPract[2]] = $arCompanies; // компания
        $PROP[$propPract[3]] = $_POST[$propPract[3]]; // курс
        $PROP[$propPract[4]] = $_POST[$propPract[4]]; // местоположение
        $PROP[$propPract[5]] = $_POST[$propPract[5]]; // продолжительность
        $PROP[$propPract[6]] = 1; // статус набора
        $PROP[$propPract[7]] = array("VALUE" => array("TYPE" => "HTML", "TEXT" => $_POST[$propPract[7]])); // требования
        $PROP[$propPract[8]] = array("VALUE" => array("TYPE" => "HTML", "TEXT" => $_POST[$propPract[8]])); // условия
        $PROP[$propPract[9]] = $_POST[$propPract[9]]; // вид практики 1
        $PROP[$propPract[10]] = $_POST[$propPract[10]]; // вид практики 2

        $arLoadProductArray = array(
            "IBLOCK_ID" => $iblockPract,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $_POST['name'],
            "ACTIVE" => "Y",            // активен
            "PREVIEW_TEXT" => $_POST['preview_text_new'],
            "DETAIL_TEXT" => $_POST['detail_text_new'],
            "PREVIEW_PICTURE" => $prevImg,
            "DETAIL_PICTURE" => $detImg
        );

        $res = $el->Add($arLoadProductArray);
        if ($res) {
            $status = 'Данные сохранены!';
        } else {
            $status = 'Ошибка при сохранении!';
        }

    } ?>
<? endif; ?>


<? if ($status <> '') { ShowNote($status); ?> <br> <br><? } ?>
    <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data"
          name="my_form"
          id="my_form">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">Название</span>
            <textarea name="name" class="form-control" required
                      aria-label="With textarea"></textarea>
        </div>
        <br>
        <div class="row align-items-start">
            <div class="col-6">
                <span class="input-group-text" id="basic-addon3">Изображение анонса</span>
                <input class="form-control" type="file" name="preview_picture" accept="image/*">
            </div>
            <div class="col-6">
                <span class="input-group-text" id="basic-addon3">Изображение анонса</span>
                <input class="form-control" type="file" name="detail_picture" accept="image/*">
            </div>
        </div>
        <br>
        <span class="input-group-text" id="basic-addon3">Короткий текст</span>
        <? $APPLICATION->IncludeComponent(
            "bitrix:fileman.light_editor",
            "",
            array(
                "AUTO_RESIZE" => "Y",
                "CONTENT" => "",
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
                "CONTENT" => "",
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
        <span class="input-group-text"
              id="basic-addon3">Требования</span>
        <? $APPLICATION->IncludeComponent(
            "bitrix:fileman.light_editor",
            "",
            array(
                "AUTO_RESIZE" => "Y",
                "CONTENT" => "",
                "HEIGHT" => "200px",
                "ID" => "",
                "INPUT_ID" => "",
                "INPUT_NAME" => $propPract[7],
                "JS_OBJ_NAME" => "",
                "RESIZABLE" => "Y",
                "USE_FILE_DIALOGS" => "Y",
                "WIDTH" => "100%"
            )
        ); ?>
        <br>
        <span class="input-group-text"
              id="basic-addon3">Условия</span>
        <? $APPLICATION->IncludeComponent(
            "bitrix:fileman.light_editor",
            "",
            array(
                "AUTO_RESIZE" => "Y",
                "CONTENT" => "",
                "HEIGHT" => "200px",
                "ID" => "",
                "INPUT_ID" => "",
                "INPUT_NAME" => $propPract[8],
                "JS_OBJ_NAME" => "",
                "RESIZABLE" => "Y",
                "USE_FILE_DIALOGS" => "Y",
                "WIDTH" => "100%"
            )
        ); ?>
        <br>
        <div class="input-group">
                                        <span class="input-group-text"
                                              id="basic-addon3">Местоположение</span>
            <textarea name="<?= $propPract[4] ?>" class="form-control" required
                      aria-label="With textarea"></textarea>
        </div>
        <div class="input-group">
                                        <span class="input-group-text"
                                              id="basic-addon3">Адрес</span>
            <textarea name="<?= $propPract[0] ?>" class="form-control"
                      aria-label="With textarea"></textarea>
        </div>
        <br>

        <br>
        <div class="input-group">
                                        <span class="input-group-text"
                                              id="basic-addon3">Продолжительность</span>
            <textarea name="<?= $propPract[5] ?>" class="form-control"
                      aria-label="With textarea"></textarea>
        </div>
        <br>
        <div class="input-group">
                                        <span class="input-group-text"
                                              id="basic-addon3">Тип практики 1</span>
            <select class="nice-select" name="<?= $propPract[9] ?>" required>
                <option value="<?= $listTypePract[0] ?>">
                    <?= $typePract[0] ?>
                </option>
                <option value="<?= $listTypePract[1] ?>">
                    <?= $typePract[1] ?>
                </option>
                <option value="<?= $listTypePract[2] ?>">
                    <?= $typePract[2] ?>
                </option>
                <option value="<?= $listTypePract[3] ?>">
                    <?= $typePract[3] ?>
                </option>
            </select>
        </div>
        <div class="input-group">
                                        <span class="input-group-text"
                                              id="basic-addon3">Тип практики 2</span>
            <select class="nice-select" name="<?= $propPract[10] ?>" required>
                <option value="<?= $listType2Pract[0] ?>">
                    <?= $type2Pract[0] ?>
                </option>
                <option value="<?= $listType2Pract[1] ?>">
                    <?= $type2Pract[1] ?>
                </option>
                <option value="<?= $listType2Pract[2] ?>">
                    <?= $type2Pract[2] ?>
                </option>
            </select>
        </div>
        <br>
        <span class="input-group-text"
              id="basic-addon3">Категория</span>
        <div id="123">
            <select class="form-select" name="<?= $propPract[1] ?>[]" required>
                <option value="<?= $listCategoryPract[0] ?>">Маркетинг</option>
                <option value="<?= $listCategoryPract[1] ?>">IT</option>
            </select>
        </div>
        <button class="btn btn-outline-secondary" onclick="addInput()" type="button"
                id="button-addon1">
            + Добавить категорию
        </button>
        <br><br>
        <div id="321">
                                        <span class="input-group-text"
                                              id="basic-addon3">Курс</span>
            <select class="form-select" name="<?= $propPract[3] ?>[]" required
                    tabindex="0">
                <option value="<?= $listYearPract[0] ?>">1 Курс</option>
                <option value="<?= $listYearPract[1] ?>">2 Курс</option>
                <option value="<?= $listYearPract[2] ?>">3 Курс</option>
                <option value="<?= $listYearPract[3] ?>">4 Курс</option>
                <option value="<?= $listYearPract[4] ?>">5 курс</option>
            </select>
        </div>
        <button class="btn btn-outline-secondary" onclick="addInput1()" type="button"
                id="button-addon2">
            + Добавить курс
        </button>
        <br><br>
        <input type="submit" class="btn btn-primary" name="submit" value="Сохранить">

    </form>


<? require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/footer.php"); ?>