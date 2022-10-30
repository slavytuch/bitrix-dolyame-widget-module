<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => Loc::getMessage('V_LUCHKO_DOLYAME_WIDGET_ORDER_NAME'),
	"DESCRIPTION" => Loc::getMessage('V_LUCHKO_DOLYAME_WIDGET_ORDER_DESCRIPTION'),
	"CACHE_PATH" => "Y",
	"SORT" => 120,
	"PATH" => array(
        "ID" => "dolayme.widget",
        "NAME" => Loc::getMessage('V_LUCHKO_DOLYAME_WIDGET_PATH'),
        "SORT" => 300,
    ),
);

?>