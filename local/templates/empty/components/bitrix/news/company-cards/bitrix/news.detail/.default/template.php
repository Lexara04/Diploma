<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$style = "line-height: 30px; padding: 5px 10px;";

?>
<? global $arFilter;

$arFilter = array("ACTIVE_DATE" => "Y", "ACTIVE" => "Y",
    "PROPERTY_COMP_ID" => $_GET['ELEMENT_ID']);
?>
<div class="row gx-10">
    <div class="col-lg-7">
        <div class="courses-details">

            <div class="courses-details-images">
                <div class="info-img-div">
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                        <img border="0"
                             src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                             width="500px"
                             alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                             title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                        />
                    <? else: ?>
                        <img border="0"
                             src="<?= SITE_TEMPLATE_PATH ?>/img/detail-proj.png"
                             width="500px"
                             alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                             title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                        />
                    <? endif; ?>
                </div>
            </div>
            <div class="courses-details-admin">
                <div class="admin-author">
                    <div class="author-thumb">
                        <img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt="Author">
                    </div>
                    <div class="author-content ">
                        <h2 class="title my-auto">
                            <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
                                <?= $arResult["NAME"] ?>
                            <? endif; ?>
                        </h2>
                    </div>
                </div>
            </div>


            <div class="courses-details-tab">

                <div class="details-tab-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <button class="active" data-bs-toggle="tab" data-bs-target="#description">Описание
                            </button>
                        </li>
                        <li>
                            <button data-bs-toggle="tab"
                                    data-bs-target="#instructors">Все практики
                            </button>
                        </li>
                        <li>
                            <button data-bs-toggle="tab"
                                    data-bs-target="#reviews">Все проекты
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="details-tab-content">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="description">

                            <div class="tab-description">
                                <div class="description-wrapper">
                                    <? if ($arResult["DETAIL_TEXT"] <> ''): ?>
                                        <? echo $arResult["DETAIL_TEXT"]; ?>
                                    <? else: ?>
                                        <? echo $arResult["PREVIEW_TEXT"]; ?>
                                    <? endif ?>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="instructors">
                            <div class="tab-description">
                                <div class="description-wrapper">
                                    <h3 class="tab-title">Ознакомьтесь с нашими практиками.</h3>
                                    <p>
                                        <? $APPLICATION->IncludeComponent(
                                            "bitrix:news.list",
                                            "companies-practices",
                                            array(
                                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                                "ADD_SECTIONS_CHAIN" => "Y",
                                                "AJAX_MODE" => "N",
                                                "AJAX_OPTION_ADDITIONAL" => "",
                                                "AJAX_OPTION_HISTORY" => "N",
                                                "AJAX_OPTION_JUMP" => "N",
                                                "AJAX_OPTION_STYLE" => "Y",
                                                "CACHE_FILTER" => "N",
                                                "CACHE_GROUPS" => "Y",
                                                "CACHE_TIME" => "36000000",
                                                "CACHE_TYPE" => "A",
                                                "CHECK_DATES" => "Y",
                                                "DETAIL_URL" => "",
                                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                                "DISPLAY_DATE" => "Y",
                                                "DISPLAY_NAME" => "Y",
                                                "DISPLAY_PICTURE" => "Y",
                                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                                "DISPLAY_TOP_PAGER" => "N",
                                                "FIELD_CODE" => array("PREVIEW_TEXT", ""),
                                                "FILTER_NAME" => "arFilter",
                                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                                "IBLOCK_ID" => "3",
                                                "IBLOCK_TYPE" => "-",
                                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                                "INCLUDE_SUBSECTIONS" => "Y",
                                                "MESSAGE_404" => "",
                                                "NEWS_COUNT" => "20",
                                                "PAGER_BASE_LINK_ENABLE" => "N",
                                                "PAGER_DESC_NUMBERING" => "N",
                                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                                "PAGER_SHOW_ALL" => "N",
                                                "PAGER_SHOW_ALWAYS" => "N",
                                                "PAGER_TEMPLATE" => ".default",
                                                "PAGER_TITLE" => "Новости",
                                                "PARENT_SECTION" => "",
                                                "PARENT_SECTION_CODE" => "",
                                                "PREVIEW_TRUNCATE_LEN" => "",
                                                "PROPERTY_CODE" => array("", ""),
                                                "SET_BROWSER_TITLE" => "Y",
                                                "SET_LAST_MODIFIED" => "N",
                                                "SET_META_DESCRIPTION" => "Y",
                                                "SET_META_KEYWORDS" => "Y",
                                                "SET_STATUS_404" => "N",
                                                "SET_TITLE" => "Y",
                                                "SHOW_404" => "N",
                                                "SORT_BY1" => "ACTIVE_FROM",
                                                "SORT_BY2" => "SORT",
                                                "SORT_ORDER1" => "DESC",
                                                "SORT_ORDER2" => "ASC",
                                                "STRICT_SECTION_CHECK" => "N"
                                            )
                                        ); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reviews">

                            <div class="tab-description">
                                <div class="description-wrapper">
                                    <h3 class="tab-title">Ознакомьтесь с нашими проектами.</h3>
                                    <p>
                                        <? $APPLICATION->IncludeComponent(
                                            "bitrix:news.list",
                                            "companies-projects",
                                            array(
                                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                                "ADD_SECTIONS_CHAIN" => "Y",
                                                "AJAX_MODE" => "N",
                                                "AJAX_OPTION_ADDITIONAL" => "",
                                                "AJAX_OPTION_HISTORY" => "N",
                                                "AJAX_OPTION_JUMP" => "N",
                                                "AJAX_OPTION_STYLE" => "Y",
                                                "CACHE_FILTER" => "N",
                                                "CACHE_GROUPS" => "Y",
                                                "CACHE_TIME" => "36000000",
                                                "CACHE_TYPE" => "A",
                                                "CHECK_DATES" => "Y",
                                                "DETAIL_URL" => "",
                                                "DISPLAY_BOTTOM_PAGER" => "Y",
                                                "DISPLAY_DATE" => "Y",
                                                "DISPLAY_NAME" => "Y",
                                                "DISPLAY_PICTURE" => "Y",
                                                "DISPLAY_PREVIEW_TEXT" => "Y",
                                                "DISPLAY_TOP_PAGER" => "N",
                                                "FIELD_CODE" => array("", ""),
                                                "FILTER_NAME" => "arFilter",
                                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                                "IBLOCK_ID" => "2",
                                                "IBLOCK_TYPE" => "-",
                                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                                "INCLUDE_SUBSECTIONS" => "Y",
                                                "MESSAGE_404" => "",
                                                "NEWS_COUNT" => "20",
                                                "PAGER_BASE_LINK_ENABLE" => "N",
                                                "PAGER_DESC_NUMBERING" => "N",
                                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                                "PAGER_SHOW_ALL" => "N",
                                                "PAGER_SHOW_ALWAYS" => "N",
                                                "PAGER_TEMPLATE" => ".default",
                                                "PAGER_TITLE" => "Новости",
                                                "PARENT_SECTION" => "",
                                                "PARENT_SECTION_CODE" => "",
                                                "PREVIEW_TRUNCATE_LEN" => "",
                                                "PROPERTY_CODE" => array("", ""),
                                                "SET_BROWSER_TITLE" => "Y",
                                                "SET_LAST_MODIFIED" => "N",
                                                "SET_META_DESCRIPTION" => "Y",
                                                "SET_META_KEYWORDS" => "Y",
                                                "SET_STATUS_404" => "N",
                                                "SET_TITLE" => "Y",
                                                "SHOW_404" => "N",
                                                "SORT_BY1" => "ACTIVE_FROM",
                                                "SORT_BY2" => "SORT",
                                                "SORT_ORDER1" => "DESC",
                                                "SORT_ORDER2" => "ASC",
                                                "STRICT_SECTION_CHECK" => "N"
                                            )
                                        ); ?>

                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="sidebar">
            <div class="sidebar-widget widget-information">
                <div class="info-list">
                    <div class="info-price">
                        <span class="price">Факультеты</span>
                    </div>
                    <ul>
                        <? foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>

                            <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                                <? foreach ($arProperty["DISPLAY_VALUE"] as $prop): ?>
                                    <li class="h-auto">
                                        <strong><?= $prop ?></strong>
                                    </li>
                                <? endforeach; ?>

                            <? else: ?>
                                <li class="h-auto">
                                    <strong><?= $arProperty["DISPLAY_VALUE"]; ?></strong>
                                </li>
                            <? endif ?>

                        <? endforeach; ?>

                    </ul>
                </div>
            </div>
            <div class="sidebar-widget">
                <h4 class="widget-title">Поделиться</h4>

                <ul class="social">
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
    </div>
</div>
<div class="section section-padding-02">
    <div class="container">

        <div class="call-to-action-wrapper">

            <img class="cat-shape-01 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
                 alt="Shape">
            <img class="cat-shape-02" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-13.svg" alt="Shape">
            <img class="cat-shape-03 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
                 alt="Shape">

            <div class="row align-items-center">
                <div class="col-md-6">

                    <div class="section-title shape-02">
                        <h5 class="sub-title">Познакомься с будущими специалистами уже сегодня</h5>
                        <h2 class="main-title">Есть <span>предложения</span> для наших студентов в Вашей
                            <span>компании?</span></h2>
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
