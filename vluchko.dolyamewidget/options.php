<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

Loc::loadMessages(__FILE__);
Loc::loadMessages($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/options.php');

$moduleId = 'vluchko.dolyamewidget';
Loader::includeModule($moduleId);

global $APPLICATION;

$permission = $APPLICATION->GetGroupRight($moduleId);

if ($permission != "W") {
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
    die();
}

$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$res = \Bitrix\Main\GroupTable::getList(['select' => ['ID', 'NAME']]);

$groupList = [];
while ($group = $res->fetch()) {
    $groupList[$group['ID']] = $group['NAME'];
}


$optionList = [
    [
        'code' => 'DISABLE_PRODUCT_CARD',
        'name' => Loc::getMessage('DISABLE_PRODUCT_CARD'),
        'default' => 'N',
        'type' => 'checkbox'
    ],
    [
        'code' => 'DISABLE_ORDER',
        'name' => Loc::getMessage('DISABLE_ORDER'),
        'default' => 'N',
        'type' => 'checkbox'
    ],
    [
        'code' => 'DISPLAY_PRODUCT_CARD_FOR_GROUPS',
        'name' => Loc::getMessage('DISPLAY_PRODUCT_CARD_FOR_GROUPS'),
        'default' => '2',
        'type' => ['multiselectbox', $groupList]
    ],
    [
        'code' => 'DISPLAY_ORDER_FOR_GROUPS',
        'name' => Loc::getMessage('DISPLAY_ORDER_FOR_GROUPS'),
        'default' => '2',
        'type' => ['multiselectbox', $groupList]
    ]
];

function displayParams($paramList, $moduleId)
{
    $rowList = [];
    foreach ($paramList as $param) {
        $rowList[] = [
            $param['code'],
            $param['name'],
            $param['default'],
            is_array($param['type']) ? $param['type'] : [$param['type']]
        ];
    }

    __AdmSettingsDrawList($moduleId, $rowList);
}


if (($apply || $save) && check_bitrix_sessid() && $request->isPost()) {
    $availableOptions = array_column($optionList, 'code');

    foreach ($request->getPostList() as $key => $value) {
        if (!in_array($key, $availableOptions)) {
            continue;
        }

        if (is_array($value)) {
            $value = implode(',', $value);
        }

        Option::set($moduleId, $key, $value, false);
    }

    if (!in_array('DISABLE_PRODUCT_CARD', array_keys($request->getPostList()->toArray()))) {
        Option::set($moduleId, 'DISABLE_PRODUCT_CARD', 'N', false);
    }

    if (!in_array('DISABLE_ORDER', array_keys($request->getPostList()->toArray()))) {
        Option::set($moduleId, 'DISABLE_ORDER', 'N', false);
    }
}


$tabControl = new CAdminTabControl('tabControl', [
    [
        'DIV' => 'edit1',
        'TAB' => getMessage('MAIN_TAB_SET'),
        'TITLE' => getMessage('MAIN_TAB_TITLE_SET'),
    ]
]);

?>

<form name='v-luchko-dolyame-widget-settings'
      method='post'
      action='<?= $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($mid) ?>&amp;lang=<?= LANG ?>'
>
    <?= bitrix_sessid_post() ?>
    <?
    $tabControl->Begin();
    $tabControl->BeginNextTab();

    displayParams($optionList, $moduleId);
    $tabControl->Buttons(['btnSave' => true]);

    $tabControl->End(); ?>
</form>

