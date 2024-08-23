<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "ID_HIGLOAD" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("COMPONENT_PASSWORD"),
            "TYPE" => "STRING",
            "DEFAULT" => "1",
        ],
        "OPTION_SELECTION" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("SELECT_OPTION"),
            "TYPE" => "LIST",
            "VALUES" => [
                "OPTION_1" => GetMessage("1"),
                "OPTION_2" => GetMessage("2"),
            ],
            "DEFAULT" => "OPTION_1",
            "MULTIPLE" => "N", //  "Y", если хотите, чтобы можно было выбрать несколько значений
        ],
        
    ],
];