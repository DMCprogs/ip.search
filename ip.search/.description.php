<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SOK_FW_GETPRICE_NAME"),
	"DESCRIPTION" => GetMessage("SOK_FW_GETPRICE_DESCRIPTION"),
	"CACHE_PATH" => "Y",
	"SORT" => 120,
	"PATH" => array(
		"ID" => "sok",
		"NAME"=>GetMessage("SOK_DIR")
	),
);

?>