<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
$APPLICATION->SetTitle("test2"); ?>
    <div class="section section-padding-02">
        <div class="container">
            <!-- All Courses Top Start -->
            <div class="courses-top">

                <!-- Section Title Start -->
                <div class="section-title shape-01">
                    <h2 class="main-title">Все <span>Практики и Проекты</span> для студентов НГТУ</h2>
                </div>
                <!-- Section Title End -->

            </div>
            <!-- All Courses Top End -->

            <!-- All Courses Tabs Menu Start -->
            <div class="courses-tabs-menu courses-active justify-content-center text-center">
                <div class="swiper-container">
                    <ul class="swiper-wrapper nav ">
                        <li class="swiper-slide w-auto">
                            <button class="active" data-bs-toggle="tab" data-bs-target="#tabs1">Учебная</button>
                        </li>
                        <li class="swiper-slide w-auto">
                            <button data-bs-toggle="tab" data-bs-target="#tabs2">Преддипломная</button>
                        </li>
                        <li class="swiper-slide w-auto">
                            <button data-bs-toggle="tab" data-bs-target="#tabs3">Производственная</button>
                        </li>
                    </ul>
                </div>

                <!-- Add Pagination -->
                <div class="swiper-button-next"><i class="icofont-rounded-right"></i></div>
                <div class="swiper-button-prev"><i class="icofont-rounded-left"></i></div>
            </div>
            <!-- All Courses Tabs Menu End -->

            <!-- All Courses tab content Start -->
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

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>