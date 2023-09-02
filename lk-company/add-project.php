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
            newInput.name = "<?=$propProj[1]?>[]"
            var names = ['Маркетинг', 'IT']
            for (var i = <?=$listCategoryProj[0]?>; i <= <?=$listCategoryProj[1]?>; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = names[i - <?=$listCategoryProj[0]?>];
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
            for (var i = <?=$listYearProj[0]?>; i <= <?=$listYearProj[4]?>; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = (i - <?=$listYearProj[0]?> + 1) + ' Курс';
                newInput.appendChild(option);
            }
            newInput.className = "nice-select";
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

    <? if (isset($_POST['submit'])) {
        //echo '<pre>'; print_r($_POST); echo '<pre>';
        if ($_POST['preview_delete'] == 1 and !$_FILES['preview_picture']['name']) {
            $prevImg = array('del' => 'Y');
        } elseif ($_FILES['preview_picture']['name']) {
            $prevImg = $_FILES['preview_picture'];
        }
        if ($_POST['detail_delete'] == 1 and !$_FILES['detail_picture']['name']) {
            $detImg = array('del' => 'Y');
        } elseif ($_FILES['detail_picture']['name']) {
            $detImg = $_FILES['detail_picture'];
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
            "IBLOCK_ID" => $iblockProj,
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
                <span class="input-group-text">Изображение анонса</span>
                <input class="form-control" type="file" name="preview_picture" accept="image/*">
            </div>
            <div class="col-6">
                <span class="input-group-text">Детальная картинка</span>
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
                "INPUT_NAME" => $propProj[7],
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
                "INPUT_NAME" => $propProj[8],
                "JS_OBJ_NAME" => "",
                "RESIZABLE" => "Y",
                "USE_FILE_DIALOGS" => "Y",
                "WIDTH" => "100%"
            )
        ); ?>
        <br>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">Местоположение</span>
            <textarea name="<?= $propProj[4] ?>" class="form-control" required
                      aria-label="With textarea"></textarea>
        </div>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">Адрес</span>
            <textarea name="<?= $propProj[0] ?>" class="form-control"
                      aria-label="With textarea"></textarea>
        </div>
        <br>

        <br>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">Продолжительность</span>
            <textarea name="<?= $propProj[5] ?>" class="form-control"
                      aria-label="With textarea"></textarea>
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">Вид проекта</span>
            <select class="form-select" name="<?= $propProj[9] ?>">
            <option value="<?= $listTypeProj[0] ?>">
                Технический
            </option>
            <option value="<?= $listTypeProj[1] ?>">
                Творческий
            </option>
            </select>
        </div>

        <br>
        <span class="input-group-text"
              id="basic-addon3">Категория</span>
        <div id="123">
            <select class="form-select" name="<?= $propProj[1] ?>[]" required>
                <option value="<?= $listCategoryProj[0] ?>">Маркетинг</option>
                <option value="<?= $listCategoryProj[1] ?>">IT</option>
            </select>
        </div>
        <button class="btn btn-outline-secondary" onclick="addInput()" type="button"
                id="button-addon1">
            + Добавить категорию
        </button>
        <br><br>
        <div id="321">
            <span class="input-group-text" id="basic-addon3">Курс</span>
            <select class="form-select" name="<?= $propProj[3] ?>[]" required
                    tabindex="0">
                <option value="<?= $listYearProj[0] ?>">1 Курс</option>
                <option value="<?= $listYearProj[1] ?>">2 Курс</option>
                <option value="<?= $listYearProj[2] ?>">3 Курс</option>
                <option value="<?= $listYearProj[3] ?>">4 Курс</option>
                <option value="<?= $listYearProj[4] ?>">5 курс</option>
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