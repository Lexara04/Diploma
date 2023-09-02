<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/header.php");

?>

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
            $detImg = $_FILES['preview_picture'];
        }
        $el = new CIBlockElement;

        $arLoadProductArray = array(
            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
            "IBLOCK_SECTION" => false,          // элемент лежит в корне раздела
            "NAME" => $_POST['name'],
            "ACTIVE" => "Y",            // активен
            "PREVIEW_TEXT" => $_POST['preview_text_new'],
            "DETAIL_TEXT" => $_POST['detail_text_new'],
            "PREVIEW_PICTURE" => $prevImg,
            "DETAIL_PICTURE" => $detImg
        );

        $PRODUCT_ID = $arCompanies;
        $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
        if ($res) {
            $status = 'Данные сохранены!';
        } else {
            $status = 'Ошибка при сохранении!';
        }

    } ?>
<? endif; ?>

<? $res = CIBlockElement::GetByID($arCompanies);
if ($ar_res = $res->GetNext()) { ?>
    <? if ($status <> '') { ?> <h6> <?= $status; ?> </h6><br> <br><? } ?>

        <h3>Добро пожаловать в личный кабинет</h3>
        <p>Отредактируйте информацию о вашей компании</p>
    <br>
    <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data"
          name="my_form"
          id="my_form">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">Название</span>
            <textarea name="name" class="form-control" required
                      aria-label="With textarea"><?= $ar_res["NAME"] ?></textarea>
        </div>
        <br>
        <div class="row row-cols-sm-12 align-items-start">
            <div class="col-xs-12 gy-5 col-sm-6">
                <span class="input-group-text" id="basic-addon3">Изображение анонса</span>
                <input class="form-control" type="file" name="preview_picture" accept="image/*">
                <? if ($ar_res['PREVIEW_PICTURE']) { ?>
                    <img style="width: 50%"
                         src="<?= CFile::GetPath($ar_res['PREVIEW_PICTURE']) ?>">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="preview_delete"
                               value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Удалить
                            изображение</label>
                    </div>
                <? } ?>
            </div>
            <div class="col-xs-12 gy-5 col-sm-6">
                <span class="input-group-text" id="basic-addon3">Изображение анонса</span>
                <input class="form-control" type="file" name="detail_picture" accept="image/*">
                <? if ($ar_res['DETAIL_PICTURE']) { ?>
                    <img style="width: 100%"
                         src="<?= CFile::GetPath($ar_res['DETAIL_PICTURE']) ?>">
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="detail_delete"
                               value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Удалить
                            изображение</label>
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
        <input type="submit" class="btn btn-primary" name="submit" value="Сохранить">
    </form>
<? } ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/lk-company/footer.php"); ?>