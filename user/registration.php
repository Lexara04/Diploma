<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"registration",
	Array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array("EMAIL","NAME","LAST_NAME","PERSONAL_GENDER","PERSONAL_BIRTHDAY"),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array("EMAIL","NAME","SECOND_NAME","LAST_NAME","PERSONAL_GENDER","PERSONAL_BIRTHDAY"),
		"SUCCESS_PAGE" => "/",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "Y"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>