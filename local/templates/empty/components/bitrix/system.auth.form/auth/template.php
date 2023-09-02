<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init();
require($_SERVER["DOCUMENT_ROOT"] . "/params.php");
global $USER;
?>


<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
    ShowMessage($arResult['ERROR_MESSAGE']);
?>

<? if ($arResult["FORM_TYPE"] == "login"): ?>
    <div class="dropdown">
        <li class="dropHover" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <a class="sign-up">
                Авторизация
            </a>
        </li>
        <div class="dropdown-menu text-small shadow w-auto">

            <div class="auth-form">
                <form name="form-auth-form<?= $arResult["RND"] ?>" method="post" target="_top"
                      action="<?= $arResult["AUTH_URL"] ?>" style="width: 180px">
                    <? if ($arResult["BACKURL"] <> ''): ?>
                        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                    <? endif ?>
                    <? foreach ($arResult["POST"] as $key => $value): ?>
                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                    <? endforeach ?>
                    <input type="hidden" name="AUTH_FORM" value="Y"/>
                    <input type="hidden" name="TYPE" value="AUTH"/>
                    <table>
                        <tr>
                            <td colspan="2">
                                <?= GetMessage("AUTH_LOGIN") ?>:<br/>
                                <div class="single-form">
                                    <input type="text" name="USER_LOGIN" maxlength="50" value="" size="17"/>
                                </div>
                                <script>
                                    BX.ready(function () {
                                        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                                        if (loginCookie) {
                                            var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                                            var loginInput = form.elements["USER_LOGIN"];
                                            loginInput.value = loginCookie;
                                        }
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?= GetMessage("AUTH_PASSWORD") ?>:<br/>
                                <div class="single-form">
                                    <input type="password" name="USER_PASSWORD" maxlength="255" size="17"
                                           autocomplete="off"/>
                                </div>
                                <? if ($arResult["SECURE_AUTH"]): ?>
                                    <span class="bx-auth-secure" id="bx_auth_secure<?= $arResult["RND"] ?>"
                                          title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                                    <noscript>
				<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                                    </noscript>
                                    <script type="text/javascript">
                                        document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
                                    </script>
                                <? endif ?>
                            </td>
                        </tr>
                        <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                            <tr>
                                <td valign="top"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER"
                                                        value="Y"/>
                                </td>
                                <td width="100%"><label for="USER_REMEMBER_frm"
                                                        title="<?= GetMessage("AUTH_REMEMBER_ME") ?>"><? echo GetMessage("AUTH_REMEMBER_SHORT") ?></label>
                                </td>
                            </tr>
                        <? endif ?>
                        <? if ($arResult["CAPTCHA_CODE"]): ?>
                            <tr>
                                <td colspan="2">
                                    <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                                    <input type="hidden" name="captcha_sid"
                                           value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                                    <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                                         width="180" height="40" alt="CAPTCHA"/><br/><br/>
                                    <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                            </tr>
                        <? endif ?>
                        <tr>
                            <td colspan="2"><input type="submit" name="Login"
                                                   class="btn btn-primary btn-hover-danger w-100"
                                                   style="line-height: 30px; padding: 5px 10px; "
                                                   value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>
                            </td>
                        </tr>
                        <? if ($arResult["NEW_USER_REGISTRATION"] == "Y"): ?>
                            <tr>
                                <td colspan="2">
                                    <a href="<?= $arResult["AUTH_REGISTER_URL"] ?>"
                                       rel="nofollow"><?= GetMessage("AUTH_REGISTER") ?></a>
                                    <br/></td>
                            </tr>
                        <? endif ?>

                        <tr>
                            <td colspan="2">
                                <noindex><a href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>"
                                            rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a></noindex>
                            </td>
                        </tr>
                        <? if ($arResult["AUTH_SERVICES"]): ?>
                            <tr>
                                <td colspan="2">
                                    <div class="bx-auth-lbl"><?= GetMessage("socserv_as_user_form") ?></div>
                                    <?
                                    $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
                                        array(
                                            "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                                            "SUFFIX" => "form",
                                        ),
                                        $component,
                                        array("HIDE_ICONS" => "Y")
                                    );
                                    ?>
                                </td>
                            </tr>
                        <? endif ?>
                    </table>
                </form>
            </div>
            <? if ($arResult["AUTH_SERVICES"]): ?>
                <?
                $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                    array(
                        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                        "AUTH_URL" => $arResult["AUTH_URL"],
                        "POST" => $arResult["POST"],
                        "POPUP" => "Y",
                        "SUFFIX" => "form",
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
            <? endif ?>

        </div>
    </div>
<?
elseif ($arResult["FORM_TYPE"] == "otp"):
    ?>

    <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" target="_top"
          action="<?= $arResult["AUTH_URL"] ?>">
        <? if ($arResult["BACKURL"] <> ''): ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
        <? endif ?>
        <input type="hidden" name="AUTH_FORM" value="Y"/>
        <input type="hidden" name="TYPE" value="OTP"/>
        <table width="95%">
            <tr>
                <td colspan="2">
                    <? echo GetMessage("auth_form_comp_otp") ?><br/>
                    <input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off"/></td>
            </tr>
            <? if ($arResult["CAPTCHA_CODE"]): ?>
                <tr>
                    <td colspan="2">
                        <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                        <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>"
                             width="180" height="40" alt="CAPTCHA"/><br/><br/>
                        <input type="text" name="captcha_word" maxlength="50" value=""/></td>
                </tr>
            <? endif ?>
            <? if ($arResult["REMEMBER_OTP"] == "Y"): ?>
                <tr>
                    <td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y"/>
                    </td>
                    <td width="100%"><label for="OTP_REMEMBER_frm"
                                            title="<? echo GetMessage("auth_form_comp_otp_remember_title") ?>"><? echo GetMessage("auth_form_comp_otp_remember") ?></label>
                    </td>
                </tr>
            <? endif ?>
            <tr>
                <td colspan="2"><input type="submit" name="Login"
                                       class="btn btn-primary btn-hover-danger w-100"
                                       style="line-height: 30px; padding: 5px 10px; "
                                       value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <noindex><a href="<?= $arResult["AUTH_LOGIN_URL"] ?>"
                                rel="nofollow"><? echo GetMessage("auth_form_comp_auth") ?></a></noindex>
                    <br/></td>
            </tr>
        </table>
    </form>

<?
else:
    ?>
    <div class="dropdown">
        <li class="dropHover" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle">
                <?
                $user = CUser::GetByID($USER->GetID())->Fetch();
                $gender = $user['PERSONAL_GENDER'];
                if ($gender == "F") { ?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/woman.png" alt="mdo" height="50">
                <? } else { ?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/man.png" alt="mdo" height="50">
                <? } ?>
            </a>
        </li>
        <div class="dropdown-menu text-small shadow">

            <li>
                <?= $arResult["USER_NAME"] ?><br/>
            </li>
            <? if (in_array($groupStudents, CUser::GetUserGroup($USER->GetID())) || in_array(1, CUser::GetUserGroup($USER->GetID()))): ?>
                <li><a class="dropdown-item" href="<?= $arResult["PROFILE_URL"] ?>"
                       title="<?= GetMessage("AUTH_PROFILE") ?>"><?= GetMessage("AUTH_PROFILE") ?></a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
            <? endif; ?>
            <li>
                <a class="dropdown-item"
                   href="<?= $APPLICATION->GetCurPageParam("logout=yes&" . bitrix_sessid_get(), array(
                       "login",
                       "logout",
                       "register",
                       "forgot_password",
                       "change_password")); ?>"><?= GetMessage("AUTH_LOGOUT_BUTTON") ?></a></li>

        </div>
    </div>
<? endif ?>
