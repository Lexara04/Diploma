<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/user/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0)
    LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>
    <p>Вы зарегистрированы и успешно авторизовались.</p>

    <p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/user/footer.php");?>