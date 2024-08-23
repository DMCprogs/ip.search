<?php

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var $APPLICATION CMain
 * @var $USER CUser
 */

Loc::loadMessages(__FILE__);




class SyncComponent extends CBitrixComponent
{
    protected $actions;

    public function onPrepareComponentParams($arParams)
    {
        // Здесь может быть обработка входящих параметров, если такие есть
        $arParams['ID_HIGLOAD'] = isset($arParams['ID_HIGLOAD']) ? trim($arParams['ID_HIGLOAD']) : "1";
        return $arParams;
    }

    public function executeComponent()
    {


        $this->includeComponentTemplate();
    }




}



