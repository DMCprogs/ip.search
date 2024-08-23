<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

$hlbl = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
if ($hlbl === false) {
    echo json_encode([
        'status' => "error",
        'data' => "id не int",
    ]);
    exit;
}

$ip = filter_input(INPUT_POST, 'IP', FILTER_VALIDATE_IP);
if ($ip === false) {
    echo json_encode([
        'status' => "error",
        'data' => "не валидный ip",
    ]);
    exit;
}

$servic = filter_input(INPUT_POST, 'SERVIC', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, 'TYPE', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($type === "search" && $hlbl !== false && $ip !== false) {
    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();

    if ($hlblock) {
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array("UF_IP" => $ip)  // Задаем параметры фильтра выборки
        ));

        $info = null;
        while ($arData = $rsData->Fetch()) {
            $info = $arData["UF_IP_INFO"];
        }

        if ($info === null) {
            switch ($servic) {
                case 'OPTION_1':
                    echo json_encode("OPTION_1");
                    break;
                case 'OPTION_2':
                    echo json_encode("OPTION_2");
                    break;
                default:
                    // неправильный сервис
                    echo json_encode([
                        'status' => "error",
                        'data' => "неправильный сервис для опеределения ip",
                    ]);
                    break;
            }
        } else {
            echo json_encode([
                'status' => "success",
                'data' => $info,
            ]);
        }
    } else {
        echo json_encode([
            'status' => "error",
            'data' => "неизвестный higload block",
        ]);
    }
} elseif ($type === "add" && $hlbl !== false && $ip !== false) {
    $ipInfo = $_POST['IP_INFO'];

    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
    if ($hlblock) {
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        // Массив полей для добавления
        $data = array(
            "UF_IP" => $ip,
            "UF_IP_INFO" => $ipInfo,
        );

        $result = $entity_data_class::add($data);
        echo json_encode([
            'status' => "success",
            'data' => $result,
        ]);
    } else {
        echo json_encode([
            'status' => "error",
            'data' => "неизвестный higload block",
        ]);
    }
} else {
    echo json_encode([
        'status' => "error",
        'data' => "Неизвестная операция",
    ]);
}
