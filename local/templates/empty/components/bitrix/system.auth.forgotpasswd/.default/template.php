<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?><?

ShowMessage($arParams["~AUTH_RESULT"]);

?>
<div class="section section-padding">
    <div class="container">
        <!-- Register & Login Wrapper Start -->
        <div class="register-login-wrapper">
            <div class="row">
                <div class="col-lg-5 ">
                    <div class="register-login-images ">
                        <div class="images">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/Forgot password-bro.png" alt="Register Login">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">

                    <!-- Register & Login Form Start -->
                    <div class="register-login-form">
                        <h3 class="title">Восстановление пароля</h3>
                        <div class="form-wrapper">
                            <form name="bform" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
                                <?
                                if ($arResult["BACKURL"] <> '') {
                                    ?>
                                    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                                    <?
                                }
                                ?>
                                <input type="hidden" name="AUTH_FORM" value="Y">
                                <input type="hidden" name="TYPE" value="SEND_PWD">

                                <p><? echo GetMessage("sys_forgot_pass_label") ?></p>

                                <div style="margin-top: 16px">
                                    <div><b><?= GetMessage("sys_forgot_pass_login1") ?></b></div>
                                    <div class="single-form w-50">
                                        <input type="text" name="USER_LOGIN" value="<?= $arResult["USER_LOGIN"] ?>"/>
                                        <input type="hidden" name="USER_EMAIL"/>
                                    </div>
                                    <div><? echo GetMessage("sys_forgot_pass_note_email") ?></div>
                                </div>

                                <? if ($arResult["PHONE_REGISTRATION"]): ?>

                                    <div style="margin-top: 16px">
                                        <div><b><?= GetMessage("sys_forgot_pass_phone") ?></b></div>
                                        <div class="single-form"><input type="text" name="USER_PHONE_NUMBER"
                                                                        value="<?= $arResult["USER_PHONE_NUMBER"] ?>"/>
                                        </div>
                                        <div><? echo GetMessage("sys_forgot_pass_note_phone") ?></div>
                                    </div>
                                <? endif; ?>

                                <? if ($arResult["USE_CAPTCHA"]): ?>
                                    <div style="margin-top: 16px">
                                        <div>
                                            <input type="hidden" name="captcha_sid"
                                                   value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                                 width="180" height="40" alt="CAPTCHA"/>
                                        </div>
                                        <div><? echo GetMessage("system_auth_captcha") ?></div>
                                        <div class="single-form w-50"><input type="text" name="captcha_word"
                                                                             maxlength="50" value=""/></div>
                                    </div>
                                <? endif ?>
                                <div style="margin-top: 20px">
                                    <input class="btn btn-primary w-auto" type="submit" name="send_account_info"
                                           value="<?= GetMessage("AUTH_SEND") ?>"/>
                                </div>
                            </form>
                            <div style="margin-top: 16px">
                                <p><a class="btn btn-outline-primary w-auto"
                                      href="<?= $arResult["AUTH_AUTH_URL"] ?>"><b><?= GetMessage("AUTH_AUTH") ?></b></a>
                                </p>
                            </div>
                            <script type="text/javascript">
                                document.bform.onsubmit = function () {
                                    document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;
                                };
                                document.bform.USER_LOGIN.focus();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="call-to-action-wrapper mt-10">

            <img class="cat-shape-01 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
                 alt="Shape">
            <img class="cat-shape-02" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-13.svg" alt="Shape">
            <img class="cat-shape-03 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png"
                 alt="Shape">

            <div class="row align-items-center">
                <div class="col-md-6">

                    <!-- Section Title Start -->
                    <div class="section-title shape-02">
                        <h5 class="sub-title">Познакомься с будущими специалистами уже сегодня</h5>
                        <h2 class="main-title">Есть <span>предложения</span> для наших студентов в Вашей
                            <span>компании?</span></h2>
                    </div>
                    <!-- Section Title End -->

                </div>
                <div class="col-md-6">
                    <div class="call-to-action-btn">
                        <a class="btn btn-primary btn-hover-dark" href="/for-companies">Хочу принять участие!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
