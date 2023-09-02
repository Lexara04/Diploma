<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
$bIsMainPage = $APPLICATION->GetCurPage(false) == SITE_DIR;
?>

<!-- Footer Start  -->
<div class="section footer-section">

    <div class="footer-widget-section">

        <img class="shape-1 animation-down" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-21.png" alt="Shape">

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 order-md-1 order-lg-1">
                    <div class="footer-widget">
                        <div class="widget-logo">
                            <a href="#"><img src="<?= SITE_TEMPLATE_PATH ?>/img/logo-final.png" alt="Logo" height="60px"></a>
                        </div>

                        <div class="widget-address">
                            <h4 class="footer-widget-title">НГТУ НЭТИ, 1994–2023</h4>
                        </div>

                        <ul class="widget-info">
                            <li>
                                <p><a href="https://nstu.ru/university/struct/uip_dept" class="ms-0">Отдел маркетинга</a></p>
                                <p><i class="flaticon-email"></i> <?
                                    // включаемая область для раздела
                                    $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/email.php",
                                        array(),
                                        array(
                                            "MODE" => "html",
                                        ));
                                    ?>
                                </p>
                            </li>
                            <li>
                                <p> <i class="flaticon-phone-call"></i>
                                    <?
                                    // включаемая область для раздела
                                    $APPLICATION->IncludeFile(SITE_DIR . "include/for-companies/phone.php",
                                        array(),
                                        array(
                                            "MODE" => "html",
                                        ));
                                    ?>
                                </p>
                            </li>
                        </ul>

                        <ul class="widget-social">
                            <?
                            // включаемая область для раздела
                            $APPLICATION->IncludeFile(SITE_DIR . "include/social-links.php",
                                array(),
                                array(
                                    "MODE" => "html",
                                ));
                            ?>
                            </ul>
                    </div>
                </div>

                <div class="col-lg-6 order-md-3 order-lg-2">
                    <div class="footer-widget-link">

                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Меню</h4>

                            <ul class="widget-link">
                                <? $APPLICATION->IncludeComponent("bitrix:menu", "menu", array(
                                    "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                                    "CHILD_MENU_TYPE" => "left",    // Тип меню для остальных уровней
                                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                                    "MAX_LEVEL" => "1",    // Уровень вложенности меню
                                    "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                                        0 => "",
                                    ),
                                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                                    "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                                    "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
                                    "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                                ),
                                    false
                                ); ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <img class="shape-2 animation-left" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-22.png" alt="Shape">

    </div>
</div>
<!-- Footer End -->

<!--Back To Start-->
<a href="#" class="back-to-top">
    <i class="icofont-simple-up"></i>
</a>
<!--Back To End-->

</div>
<!-- Modernizer & jQuery JS -->
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/vendor/modernizr-3.11.2.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/vendor/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/popper.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/bootstrap.min.js"></script>

<!-- Plugins JS -->
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/swiper-bundle.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/jquery.magnific-popup.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/video-playlist.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/jquery.nice-select.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/ajax-contact.js"></script>

<!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
<!-- <script src="assets/js/plugins.min.js"></script> -->


<!-- Main JS -->
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/main.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/plugins/apexcharts.min.js"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/assets/js/engagement.js"></script>
</body>
</html>