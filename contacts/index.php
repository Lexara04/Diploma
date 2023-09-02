<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
$APPLICATION->SetTitle("Контакты");
?>
<?php
$STATUS = array(0, 0);
if ($_POST['submit']) {

    if (empty($_POST["name"]) or empty($_POST["subject"]) or
        (empty($_POST["userPhone"]) or !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        or empty($_POST["message"])) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        $STATUS = array("Пожалуйста, заполните форму и повторите отправку.", 3);
    } else {

        CModule::IncludeModule('iblock');
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
            "NAME" => "Заявка от {$_POST["name"]}",
            "ACTIVE" => "Y",
            "PROPERTY_VALUES" => $properties,
        );

        $el = new CIBlockElement;
        $newElementId = $el->Add($arFields);
        if ($newElementId) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            $STATUS = array("Спасибо! Ваше сообщение получено.", 1);
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            $STATUS = array("Упс! Что-то пошло не так", 2);
        }
    }
}

?>
    <div class="section section-padding-02">
        <div class="container">

            <div class="contact-map-wrapper">
                <iframe id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2289.164400149265!2d82.90541340158991!3d54.9877515137452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x42dfe6e664a72223%3A0xe0547dd76b9c218d!2z0J3QvtCy0L7RgdC40LHQuNGA0YHQutC40Lkg0LPQvtGB0YPQtNCw0YDRgdGC0LLQtdC90L3Ri9C5INGC0LXRhdC90LjRh9C10YHQutC40Lkg0YPQvdC40LLQtdGA0YHQuNGC0LXRgg!5e0!3m2!1sru!2sru!4v1683618570115!5m2!1sru!2sru" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>

    <div class="section section-padding">
        <div class="container">

            <div class="contact-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6">

                        <div class="contact-info">

                            <img class="shape animation-round"
                                 src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png" alt="Shape">

                            <div class="single-contact-info">
                                <div class="info-icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">Телефон</h6>
                                    <p><?
                                        // включаемая область для раздела
                                        $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/phone.php",
                                            array(),
                                            array(
                                                "MODE" => "html",
                                            ));
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="info-icon">
                                    <i class="flaticon-email"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">Почта</h6>
                                    <p>
                                        <?
                                        // включаемая область для раздела
                                        $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/email.php",
                                            array(),
                                            array(
                                                "MODE" => "html",
                                            ));
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="info-icon">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">Адрес</h6>
                                    <p>
                                        <?
                                        // включаемая область для раздела
                                        $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/address.php",
                                            array(),
                                            array(
                                                "MODE" => "text",
                                            ));
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <!-- Contact Form Start -->
                        <div class="contact-form">
                            <h3 class="title">Остались вопросы?</h3>

                            <div class="form-wrapper">
                                <form action="" method="POST">
                                    <div class="single-form">
                                        <input type="text" name="name" placeholder="ФИО" required>
                                    </div>
                                    <div class="single-form">
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="single-form">
                                        <input type="tel" name="userPhone" placeholder="Телефон: +7-777-777-7777"
                                               pattern="(\+7|8)-[0-9]{3}-[0-9]{3}-[0-9]{4}" required
                                        >
                                    </div>
                                    <div class="single-form">
                                        <input type="text" name="subject" placeholder="Тема" required>
                                    </div>
                                    <div class="single-form">
                                        <textarea name="message" placeholder="Сообщение" required></textarea>
                                    </div>
                                    <? if ($STATUS <> '') { ShowNote($STATUS[0]); ?> <? } ?>
                                    <div class="single-form">
                                        <input type="submit" name="submit" class="btn btn-primary btn-hover-dark w-100">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Contact End -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>