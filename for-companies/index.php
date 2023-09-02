<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
$APPLICATION->SetTitle("Для компаний");
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
            $STATUS = array("Спасибо! Ваше сообщение получено.", 1);
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            $STATUS = array("Упс! Что-то пошло не так", 2);
        }
    }
}

?>
    <!-- About Start -->
    <div class="section">

        <div class="section-padding-02 mt-n10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-images">
                            <?
                            // включаемая область для раздела
                            $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/heading.php",
                                array(),
                                array(
                                    "MODE" => "html",
                                ));
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <?
                            // включаемая область для раздела
                            $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/heading-text.php",
                                array(),
                                array(
                                    "MODE" => "html",
                                ));
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="section-padding-02 mt-n6">
            <div class="container">

                <!-- About Items Wrapper Start -->
                <div class="about-items-wrapper">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- About Item Start -->
                            <div class="about-item">
                                <?
                                // включаемая область для раздела
                                $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/card1.php",
                                    array(),
                                    array(
                                        "MODE" => "html",
                                    ));
                                ?>
                            </div>
                            <!-- About Item End -->
                        </div>
                        <div class="col-lg-4">
                            <!-- About Item Start -->
                            <div class="about-item">
                                <?
                                // включаемая область для раздела
                                $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/card2.php",
                                    array(),
                                    array(
                                        "MODE" => "html",
                                    ));
                                ?>
                            </div>
                            <!-- About Item End -->
                        </div>
                        <div class="col-lg-4">
                            <!-- About Item Start -->
                            <div class="about-item">
                                <?
                                // включаемая область для раздела
                                $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/card3.php",
                                    array(),
                                    array(
                                        "MODE" => "html",
                                    ));
                                ?>
                            </div>
                            <!-- About Item End -->
                        </div>
                    </div>
                </div>
                <!-- About Items Wrapper End -->

            </div>
        </div>

    </div>
    <!-- Download App Start -->
    <div class="section section-padding download-section">

        <div class="app-shape-1"></div>
        <div class="app-shape-2"></div>
        <div class="app-shape-3"></div>
        <div class="app-shape-4"></div>

        <div class="container">

            <div class="section-title section-title-white">
                <?
                // включаемая область для раздела
                $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/green-text.php",
                    array(),
                    array(
                        "MODE" => "text",
                    ));
                ?>
            </div>
        </div>
    </div>
    <!-- Download App End -->

    <!-- About End -->
    <!-- Contact Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- Contact Wrapper Start -->
            <div class="contact-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6">

                        <!-- Contact Info Start -->
                        <div class="contact-info">

                            <img class="shape animation-round"
                                 src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png" alt="Shape">

                            <!-- Single Contact Info Start -->
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
                            <!-- Single Contact Info End -->
                            <!-- Single Contact Info Start -->
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
                            <!-- Single Contact Info End -->
                            <!-- Single Contact Info Start -->
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
                            <!-- Single Contact Info End -->
                        </div>
                        <!-- Contact Info End -->

                    </div>
                    <div class="col-lg-6">

                        <!-- Contact Form Start -->
                        <div class="contact-form">
                            <h3 class="title">Оставьте заявку на участие или свяжитесь с нами!</h3>

                            <div class="form-wrapper">
                                <form action="" method="post">
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="text" name="name" placeholder="ФИО">
                                    </div>
                                    <!-- Single Form End -->
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="email" name="email" placeholder="Email">
                                    </div>
                                    <!-- Single Form End -->

                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="tel" name="userPhone" placeholder="Телефон: +7-777-777-7777"
                                               pattern="(\+7|8)-[0-9]{3}-[0-9]{3}-[0-9]{4}" required
                                        >
                                    </div>
                                    <!-- Single Form End -->
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="text" name="subject" placeholder="Название фирмы">
                                    </div>
                                    <!-- Single Form End -->
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <textarea name="message" placeholder="Сообщение"></textarea>
                                    </div>
                                    <!-- Single Form End -->
                                    <? if ($STATUS <> '') { ShowNote($STATUS[0]); ?> <? } ?>
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="submit" name="submit" class="btn btn-primary btn-hover-dark w-100">
                                    </div>
                                    <!-- Single Form End -->

                                </form>
                            </div>
                        </div>
                        <!-- Contact Form End -->

                    </div>
                </div>
            </div>
            <!-- Contact Wrapper End -->

        </div>
    </div>
    <!-- Contact End -->
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>