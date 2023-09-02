<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
$bIsMainPage = $APPLICATION->GetCurPage(false) == SITE_DIR;
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");

global $USER;
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <link rel="icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/main_styles.css">-->
    <? define('SCRIPTPATH', SITE_TEMPLATE_PATH . '/phpchart/'); ?>
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/icofont.min.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/flaticon.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/font-awesome.min.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/plugins/jqvmap.min.css">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/assets/css/style.css">

    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/css/project_card.css">
    <script>
        const windowInnerHeight = window.innerHeight
        console.log(windowInnerHeight);
    </script>
</head>

<body>
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>
<div class="main-wrapper">
    <div class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrapper">
                </div>
            </div>
        </div>
        <!-- Header Top End -->
        <div class="header-main">
            <div class="container">
                <div class="header-main-wrapper">
                    <div class="header-logo">
                        <a href="/"><img src="<?= SITE_TEMPLATE_PATH ?>/img/logo-final.png" alt="Logo"
                                         style="height: 70px"></a>
                    </div>
                    <div class="header-menu d-none d-lg-block">
                        <ul class="nav-menu">
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

                    <!-- Header Mobile Toggle Start -->
                    <div class="header-toggle d-lg-none">
                        <a class="menu-toggle" href="javascript:void(0)">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                    <!-- Header Mobile Toggle End -->
                    <div class="header-sign-in-up d-none d-lg-block">
                        <ul>
                            <li>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:system.auth.form",
                                    "auth",
                                    array(
                                        "FORGOT_PASSWORD_URL" => "/user/",
                                        "PROFILE_URL" => "/user/profile.php",
                                        "REGISTER_URL" => "/user/registration.php",
                                        "SHOW_ERRORS" => "Y",
                                        "COMPONENT_TEMPLATE" => "auth"
                                    )
                                ); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Start -->
    <div class="mobile-menu">

        <!-- Menu Close Start -->
        <a class="menu-close" href="javascript:void(0)">
            <i class="icofont-close-line"></i>
        </a>
        <!-- Menu Close End -->

        <!-- Mobile Sing In & Up Start -->
        <? if ($USER->IsAuthorized()) { ?>
            <? if (in_array($groupStudents, CUser::GetUserGroup($USER->GetID())) || in_array(1, CUser::GetUserGroup($USER->GetID()))) { ?>
                <div class="mobile-sign-in-up">
                    <ul>
                        <li><a class="sign-in w-auto" href="/user/profile.php">Профиль</a></li>
                        <li><a class="sign-up"
                               href="<?= $APPLICATION->GetCurPageParam("logout=yes&" . bitrix_sessid_get(), array(
                                   "login",
                                   "logout",
                                   "register",
                                   "forgot_password",
                                   "change_password")); ?>">Выход</a></li>
                    </ul>
                </div>
            <? } else { ?>
                <div class="mobile-sign-in-up">
                    <ul>
                        <li> <?
                            $user = CUser::GetByID($USER->GetID())->Fetch();
                            $gender = $user['PERSONAL_GENDER'];
                            if ($gender == "F") { ?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/woman.png" alt="mdo" height="50">
                            <? } else { ?>
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/man.png" alt="mdo" height="50">
                            <? } ?>
                        </li>
                        <li><a class="sign-in"
                               href="<?= $APPLICATION->GetCurPageParam("logout=yes&" . bitrix_sessid_get(), array(
                                   "login",
                                   "logout",
                                   "register",
                                   "forgot_password",
                                   "change_password")); ?>">Выход</a></li>
                    </ul>
                </div>
            <? }
        } else { ?>
            <div class="mobile-sign-in-up">
                <ul>
                    <li><a class="sign-in" href="/user/?login=yes&backurl=%2F">Вход</a></li>
                    <li><a class="sign-up" href="/user/registration.php">Регистрация</a></li>
                </ul>
            </div>
        <? } ?>

        <!-- Mobile Sing In & Up End -->

        <!-- Mobile Menu Start -->
        <div class="mobile-menu-items">
            <ul class="nav-menu">
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
        <!-- Mobile Menu End -->
    </div>
    <!-- Mobile Menu End -->
    <!-- Overlay Start -->
    <div class="overlay"></div>
    <!-- Overlay End -->
    <? if ($bIsMainPage): ?>
        <!-- Slider Start -->
        <div class="section slider-section">
            <div class="container">
                <div class="row row-cols-1 gy-7 row-cols-lg-12">
                    <div class="col d-flex align-items-center col-lg-4 ">
                        <!-- Slider Content Start -->
                        <div class="slider-content">
                            <?
                            // включаемая область для раздела
                            $APPLICATION->IncludeFile(SITE_DIR . "include/main_slogan.php",
                                array(),
                                array(
                                    "MODE" => "html",
                                ));
                            ?>
                        </div>
                    </div>
                    <div class="col col-lg-8">
                        <div class="row row-cols-1 row-cols-lg-12 gy-7">
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <?
                                    // включаемая область для раздела
                                    $APPLICATION->IncludeFile(SITE_DIR . "include/card.php",
                                        array(),
                                        array(
                                            "MODE" => "html",
                                        ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <?
                                    // включаемая область для раздела
                                    $APPLICATION->IncludeFile(SITE_DIR . "include/card12.php",
                                        array(),
                                        array(
                                            "MODE" => "html",
                                        ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <?
                                    // включаемая область для раздела
                                    $APPLICATION->IncludeFile(SITE_DIR . "include/card21.php",
                                        array(),
                                        array(
                                            "MODE" => "html",
                                        ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <?
                                    // включаемая область для раздела
                                    $APPLICATION->IncludeFile(SITE_DIR . "include/card22.php",
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
            </div>
            <!-- Slider Content End -->
        </div>
        <!-- Slider End -->
    <? else: ?>
        <!-- Page Banner Start -->
        <div class="section page-banner">

            <img class="shape-1 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-8.png"
                 alt="Shape">

            <img class="shape-2" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-23.png" alt="Shape">

            <div class="container">
                <!-- Page Banner Start -->
                <div class="page-banner-content">
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    ); ?>
                </div>
                <!-- Page Banner End -->
            </div>

            <!-- Shape Icon Box Start -->
            <div class="shape-icon-box">
                <div class="box-content">
                    <div class="box-wrapper">
                        <i class="flaticon-badge"></i>
                    </div>
                </div>
                <img class="icon-shape-2" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-6.png" alt="Shape">
            </div>
            <!-- Shape Icon Box End -->

        </div>
        <!-- Page Banner End -->
    <? endif; ?>

	
						