<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


class DolyameProductCardWidget extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $moduleId = 'vluchko.dolyamewidget';
        $disableComponent = \Bitrix\Main\Config\Option::get($moduleId, 'DISABLE_PRODUCT_CARD', 'N');
        if($disableComponent == 'Y') {
            return false;
        }

        $allowedGroups = \Bitrix\Main\Config\Option::get($moduleId, 'DISABLE_ORDER', [2]);

        if(!\CSite::InGroup($allowedGroups)) {
            return false;
        }

        return $params;
    }

    public function executeComponent()
    {
        if (!$this->arParams) {
            return;
        }

        $this->arResult['PRICE'] = ceil($this->arParams['PRICE']/4);

        $this->IncludeComponentTemplate();
    }
}