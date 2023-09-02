<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 * @global CUser $USER
 * @global CMain $APPLICATION
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arResult["SHOW_SMS_FIELD"] == true) {
    CJSCore::Init('phone_auth');
}
?>
<div class="section section-padding">
    <div class="container">

        <!-- Register & Login Wrapper Start -->
        <div class="register-login-wrapper">
            <div class="row">
                <div class="col-lg-5 ">
                    <div class="register-login-images ">
                        <div class="images">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/Profiling-pana.png" alt="Register Login">
                        </div>
                    </div>
                    <div class="register-login-images ">
                        <div class="images">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/Business deal-amico.png" alt="Register Login">
                        </div>
                    </div>
                    <div class="register-login-images ">
                        <div class="images">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/Construction worker-bro.png" alt="Register Login">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">

                    <!-- Register & Login Form Start -->
                    <div class="register-login-form">
                        <h3 class="title"><span>Студент?</span> Зарегистрируйся сейчас</h3>

                        <div class="form-wrapper">
                            <? if ($USER->IsAuthorized()): ?>

                                <p><? echo GetMessage("MAIN_REGISTER_AUTH") ?></p>
                                <a href="/" class="btn btn-primary w-100">Начать поиски!</a>

                            <? else: ?>
                            <?
                            if (count($arResult["ERRORS"]) > 0):
                                foreach ($arResult["ERRORS"] as $key => $error)
                                    if (intval($key) == 0 && $key !== 0)
                                        $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);

                                ShowError(implode("<br />", $arResult["ERRORS"]));

                            elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
                            ?>
                                <p><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></p>
                            <? endif ?>

                            <? if ($arResult["SHOW_SMS_FIELD"] == true): ?>

                                <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform">
                                    <?
                                    if ($arResult["BACKURL"] <> ''):
                                        ?>
                                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                                    <?
                                    endif;
                                    ?>
                                    <input type="hidden" name="SIGNED_DATA"
                                           value="<?= htmlspecialcharsbx($arResult["SIGNED_DATA"]) ?>"/>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td><? echo GetMessage("main_register_sms") ?><span
                                                        class="starrequired">*</span></td>
                                            <td>
                                                <div class="single-form">
                                                    <input size="30" type="text" name="SMS_CODE"
                                                           value="<?= htmlspecialcharsbx($arResult["SMS_CODE"]) ?>"
                                                           autocomplete="off"/>
                                                    <div class="single-form">
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" name="code_submit_button"
                                                       value="<? echo GetMessage("main_register_sms_send") ?>"/></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </form>

                                <script>
                                    new BX.PhoneAuth({
                                        containerId: 'bx_register_resend',
                                        errorContainerId: 'bx_register_error',
                                        interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
                                        data:
                                            <?=CUtil::PhpToJSObject([
                                                'signedData' => $arResult["SIGNED_DATA"],
                                            ])?>,
                                        onError:
                                            function (response) {
                                                var errorDiv = BX('bx_register_error');
                                                var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
                                                errorNode.innerHTML = '';
                                                for (var i = 0; i < response.errors.length; i++) {
                                                    errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
                                                }
                                                errorDiv.style.display = '';
                                            }
                                    });
                                </script>

                                <div id="bx_register_error" style="display:none"><? ShowError("error") ?></div>

                                <div id="bx_register_resend"></div>

                            <? else: ?>

                                <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform"
                                      enctype="multipart/form-data">
                                    <?
                                    if ($arResult["BACKURL"] <> ''):
                                        ?>
                                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                                    <?
                                    endif;
                                    ?>

                                    <table>
                                        <tbody>
                                        <? foreach ($arResult["SHOW_FIELDS"] as $FIELD): ?>
                                            <? if ($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true): ?>
                                                <tr>
                                                    <td><? echo GetMessage("main_profile_time_zones_auto") ?><? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?>
                                                            <span class="starrequired">*</span><? endif ?></td>
                                                    <td>
                                                        <select name="REGISTER[AUTO_TIME_ZONE]"
                                                                onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
                                                            <option value=""><? echo GetMessage("main_profile_time_zones_auto_def") ?></option>
                                                            <option value="Y"<?= $arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : "" ?>><? echo GetMessage("main_profile_time_zones_auto_yes") ?></option>
                                                            <option value="N"<?= $arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : "" ?>><? echo GetMessage("main_profile_time_zones_auto_no") ?></option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><? echo GetMessage("main_profile_time_zones_zones") ?></td>
                                                    <td>
                                                        <select name="REGISTER[TIME_ZONE]"<? if (!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"' ?>>
                                                            <? foreach ($arResult["TIME_ZONE_LIST"] as $tz => $tz_name): ?>
                                                                <option value="<?= htmlspecialcharsbx($tz) ?>"<?= $arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : "" ?>><?= htmlspecialcharsbx($tz_name) ?></option>
                                                            <? endforeach ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <? else: ?>
                                                <tr>
                                                    <td><?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>
                                                        <? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"): ?><span class="starrequired">*</span><? endif ?></td>
                                                    <td><?
                                                        switch ($FIELD) {
                                                        case "PASSWORD":
                                                            ?>
                                                            <div class="single-form">
                                                                <input size="30" type="password"
                                                                       name="REGISTER[<?= $FIELD ?>]"
                                                                       value="<?= $arResult["VALUES"][$FIELD] ?>"
                                                                       autocomplete="off" class="bx-auth-input"/>
                                                            </div>
                                                        <? if ($arResult["SECURE_AUTH"]): ?>
                                                            <span class="bx-auth-secure" id="bx_auth_secure"
                                                                  title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>"
                                                                  style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                                                            <noscript>
				<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                                                            </noscript>
                                                            <script type="text/javascript">
                                                                document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                                            </script>
                                                        <? endif ?>
                                                        <?
                                                        break;
                                                        case "CONFIRM_PASSWORD":
                                                        ?>
                                                            <div class="single-form">
                                                                <input size="30" type="password"
                                                                       name="REGISTER[<?= $FIELD ?>]"
                                                                       value="<?= $arResult["VALUES"][$FIELD] ?>"
                                                                       autocomplete="off"/>
                                                            </div>
                                                        <?
                                                        break;

                                                        case "PERSONAL_GENDER":
                                                        ?>
                                                        <div class="single-form"><select class="w-100"
                                                                                         name="REGISTER[<?= $FIELD ?>]">
                                                                <option value=""><?= GetMessage("USER_DONT_KNOW") ?></option>
                                                                <option value="M"<?= $arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : "" ?>><?= GetMessage("USER_MALE") ?></option>
                                                                <option value="F"<?= $arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : "" ?>><?= GetMessage("USER_FEMALE") ?></option>
                                                            </select></div><?
                                                            break; ?>
                                                        <?
                                                        default:
                                                        if ($FIELD == "PERSONAL_BIRTHDAY"): ?>
                                                            <small><?= $arResult["DATE_FORMAT"] ?></small>
                                                        <br/><?endif;
                                                            ?>
                                                        <div class="single-form">
                                                            <input size="30" type="text"
                                                                   name="REGISTER[<?= $FIELD ?>]"
                                                                   value="<?= $arResult["VALUES"][$FIELD] ?>"/>

                                                        </div><?
                                                            if ($FIELD == "PERSONAL_BIRTHDAY")
                                                                $APPLICATION->IncludeComponent(
                                                                    'bitrix:main.calendar',
                                                                    '',
                                                                    array(
                                                                        'SHOW_INPUT' => 'N',
                                                                        'FORM_NAME' => 'regform',
                                                                        'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
                                                                        'SHOW_TIME' => 'N'
                                                                    ),
                                                                    null,
                                                                    array("HIDE_ICONS" => "Y")
                                                                );
                                                            ?>
                                                        <?
                                                        } ?></td>
                                                </tr>
                                            <? endif ?>
                                        <? endforeach ?>

                                        <?
                                        /* CAPTCHA */
                                        if ($arResult["USE_CAPTCHA"] == "Y") {
                                            ?>
                                            <tr>
                                                <td colspan="2"><b><?= GetMessage("REGISTER_CAPTCHA_TITLE") ?></b></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="single-form">
                                                        <input type="hidden" name="captcha_sid"
                                                               value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                                                    </div>
                                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                                         width="180" height="40" alt="CAPTCHA"/>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= GetMessage("REGISTER_CAPTCHA_PROMT") ?>:<span
                                                            class="starrequired">*</span></td>
                                                <td>
                                                    <div class="single-form"><input type="text" name="captcha_word"
                                                                                    maxlength="50" value=""
                                                                                    autocomplete="off"/></div>
                                                </td>
                                            </tr>
                                            <?
                                        }
                                        /* !CAPTCHA */
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td></td>
                                            <td><input class="btn btn-primary w-100 my-6" type="submit"
                                                       name="register_submit_button"
                                                       value="<?= GetMessage("AUTH_REGISTER") ?>"/></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </form>

                                <p>Пароль должен быть не менее<span class="starrequired"> 6</span> символов длиной</p>

                            <? endif //$arResult["SHOW_SMS_FIELD"] == true ?>

                                <p><span class="starrequired">*</span><?= GetMessage("AUTH_REQ") ?></p>

                            <? endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="call-to-action-wrapper mt-10">

            <img class="cat-shape-01 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png" alt="Shape">
            <img class="cat-shape-02" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-13.svg" alt="Shape">
            <img class="cat-shape-03 animation-round" src="<?= SITE_TEMPLATE_PATH ?>/assets/images/shape/shape-12.png" alt="Shape">

            <div class="row align-items-center">
                <div class="col-md-6">

                    <!-- Section Title Start -->
                    <div class="section-title shape-02">
                        <h5 class="sub-title">Познакомься с будущими специалистами уже сегодня</h5>
                        <h2 class="main-title">Есть <span>предложения</span> для наших студентов в Вашей <span>компании?</span></h2>
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