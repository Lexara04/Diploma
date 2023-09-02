<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?><?require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
?>
<?require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
?>
    <div class="section section-padding-02">
        <div class="container">
            <div class="courses-top">

                <div class="section-title shape-01">
                    <h2 class="main-title">Выбери свою <span>идеальную практику</span></h2>
                </div>

            </div>

            <div class="courses-tabs-menu courses-active justify-content-center text-center">
                <div class="swiper-container">
                    <ul class="swiper-wrapper nav ">
                        <li class="swiper-slide w-auto">
                            <button class="active" data-bs-toggle="tab" data-bs-target="#tabs1">Преддипломная</button>
                        </li>
                        <li class="swiper-slide w-auto">
                            <button data-bs-toggle="tab" data-bs-target="#tabs2">Учебная</button>
                        </li>
                        <li class="swiper-slide w-auto">
                            <button data-bs-toggle="tab" data-bs-target="#tabs3">Производственная</button>
                        </li>
                    </ul>
                </div>
                <div class="swiper-button-next"><i class="icofont-rounded-right"></i></div>
                <div class="swiper-button-prev"><i class="icofont-rounded-left"></i></div>
            </div>

            <div class="tab-content courses-tab-content">
                <?
                global $arFilter;
                $ind = $listType2Pract[0];
                foreach ($listType2Pract as $typenum):
                    $arFilter = array("PROPERTY" => array("TYPE2" => "$typenum"));
                    ?>
                    <div class="tab-pane fade <? if ($typenum == $ind) { ?>show active <? } ?>"
                         id="tabs<?= ($typenum - $ind) + 1 ?>">
                        <!-- All Courses Wrapper Start -->
                        <div class="courses-wrapper">
                            <div class="row">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:news",
                                    "main-page-pract",
                                    array(
                                        "ADD_ELEMENT_CHAIN" => "N",
                                        "ADD_SECTIONS_CHAIN" => "Y",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "BROWSER_TITLE" => "-",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "CHECK_DATES" => "Y",
                                        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DETAIL_DISPLAY_TOP_PAGER" => "N",
                                        "DETAIL_FIELD_CODE" => array("", ""),
                                        "DETAIL_PAGER_SHOW_ALL" => "Y",
                                        "DETAIL_PAGER_TEMPLATE" => "",
                                        "DETAIL_PAGER_TITLE" => "Страница",
                                        "DETAIL_PROPERTY_CODE" => array("", ""),
                                        "DETAIL_SET_CANONICAL_URL" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DISPLAY_DATE" => "Y",
                                        "DISPLAY_NAME" => "Y",
                                        "DISPLAY_PICTURE" => "Y",
                                        "DISPLAY_PREVIEW_TEXT" => "Y",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "FILTER_FIELD_CODE" => array("", ""),
                                        "FILTER_NAME" => "arFilter",
                                        "FILTER_PROPERTY_CODE" => array("", ""),
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "IBLOCK_ID" => "3",
                                        "IBLOCK_TYPE" => "SharedStorage",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                                        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "LIST_FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
                                        "LIST_PROPERTY_CODE" => array("COMP_ID", "YEAR_NUM", "LOCATION", "DURATION", "TYPE"),
                                        "MESSAGE_404" => "",
                                        "META_DESCRIPTION" => "-",
                                        "META_KEYWORDS" => "-",
                                        "NEWS_COUNT" => "3",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "PAGER_TITLE" => "Новости",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "SEF_MODE" => "N",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "Y",
                                        "SHOW_404" => "N",
                                        "SORT_BY1" => "ACTIVE_FROM",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "STRICT_SECTION_CHECK" => "N",
                                        "USE_CATEGORIES" => "N",
                                        "USE_FILTER" => "Y",
                                        "USE_PERMISSIONS" => "N",
                                        "USE_RATING" => "N",
                                        "USE_REVIEW" => "N",
                                        "USE_RSS" => "N",
                                        "USE_SEARCH" => "N",
                                        "USE_SHARE" => "N",
                                        "VARIABLE_ALIASES" => array("ELEMENT_ID" => "ELEMENT_ID", "SECTION_ID" => "SECTION_ID")
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>

            </div>
        </div>
    </div>
    <div class="section section-padding-02">
        <div class="container">

            <div class="call-to-action-wrapper">

                <img class="cat-shape-01 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png" alt="Shape">
                <img class="cat-shape-02" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-13.svg" alt="Shape">
                <img class="cat-shape-03 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png" alt="Shape">

                <div class="row align-items-center">
                    <div class="col-md-6">

                        <div class="section-title shape-02">
                            <h5 class="sub-title">Познакомься с будущими специалистами уже сегодня</h5>
                            <h2 class="main-title">Есть <span>предложения</span> для наших студентов в Вашей <span>компании?</span></h2>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="call-to-action-btn">
                            <a class="btn btn-primary btn-hover-danger" href="/for-companies">Хочу принять участие!</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section section-padding mt-n1">
        <div class="container">

            <div class="section-title shape-003 text-center">
                <h5 class="sub-title">Множество интересных предложений ждут тебя</h5>
                <h2 class="main-title">Как Выбрать <span> Своё?</span></h2>
            </div>

            <div class="how-it-work-wrapper">

                <div class="single-work">
                    <img class="shape-1" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-15.png" alt="Shape">

                    <div class="work-icon">
                        <i class="flaticon-transparency"></i>
                    </div>
                    <div class="work-content">
                        <?
                        // включаемая область для раздела
                        $APPLICATION->IncludeFile(SITE_DIR . "include/scard1.php",
                            array(),
                            array(
                                "MODE" => "html",
                            ));
                        ?>
                    </div>
                </div>

                <div class="work-arrow">
                    <img class="arrow" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-17.png" alt="Shape">
                </div>

                <div class="single-work">
                    <img class="shape-2" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-15.png" alt="Shape">

                    <div class="work-icon">
                        <i class="flaticon-forms"></i>
                    </div>
                    <div class="work-content">
                        <?
                        // включаемая область для раздела
                        $APPLICATION->IncludeFile(SITE_DIR . "include/scard2.php",
                            array(),
                            array(
                                "MODE" => "html",
                            ));
                        ?>
                    </div>
                </div>

                <div class="work-arrow">
                    <img class="arrow" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-17.png" alt="Shape">
                </div>

                <div class="single-work">
                    <img class="shape-3" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-16.png" alt="Shape">

                    <div class="work-icon">
                        <i class="flaticon-badge"></i>
                    </div>
                    <div class="work-content">
                        <?
                        // включаемая область для раздела
                        $APPLICATION->IncludeFile(SITE_DIR . "include/scard3.php",
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

    <div class="section section-padding-02 mb-10">
        <div class="container">

            <div class="brand-logo-wrapper">

                <img class="shape-1" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-19.png" alt="Shape">

                <img class="shape-2 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-20.png" alt="Shape">

                <div class="section-title shape-03">
                    <h2 class="main-title">Твой <span>Факультет</span> Уже с Нами!</h2>
                </div>

                <div class="brand-logo brand-active">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            <?
                            // включаемая область для раздела
                            $APPLICATION->IncludeFile(SITE_DIR . "include/faculties.php",
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

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>