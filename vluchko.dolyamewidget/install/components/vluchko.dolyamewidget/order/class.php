<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class DolyameOrderWidget extends CBitrixComponent
{
    const PAYMENT_COUNT = 4;

    public function onPrepareComponentParams($params)
    {
        if (!Loader::includeModule('sale')) {
            $GLOBALS['APPLICATION']->ShowError('Модуль "sale" не установлен');
            return false;
        }

        $moduleId = 'vluchko.dolyamewidget';
        $disableComponent = Option::get($moduleId, 'DISABLE_ORDER', 'N');
        if ($disableComponent == 'Y') {
            return false;
        }

        $allowedGroups = Option::get($moduleId, 'DISPLAY_ORDER_FOR_GROUPS', [2]);

        if (!\CSite::InGroup($allowedGroups)) {
            return false;
        }

        return $params;
    }

    public function executeComponent()
    {
        if (!$this->arParams) {
            return;
        }
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        $total = $basket->getPrice();
        $partTotal = $total / self::PAYMENT_COUNT;
        for ($i = 0; $i < self::PAYMENT_COUNT; ++$i) {
            $this->arResult['PRICE_PARTS'][] = round($partTotal, 2);
        }

        $this->IncludeComponentTemplate();
    }
}