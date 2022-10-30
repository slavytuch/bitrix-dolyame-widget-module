<?php

use Bitrix\Main\Localization\Loc;

IncludeModuleLangFile(__FILE__);

class vluchko_dolyamewidget extends CModule
{
    const MODULE_ID = 'vluchko.dolyamewidget';
    public $MODULE_ID = 'vluchko.dolyamewidget';
    public $MODULE_DESCRIPTION = '';
    public $MODULE_DIR;

    public function __construct()
    {
        $arModuleVersion = [];

        include(__DIR__ . '/version.php');
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = Loc::getMessage('V_LUCHKO_DOLYAME_WIDGET_INSTALL_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('V_LUCHKO_DOLYAME_WIDGET_INSTALL_DESCRIPTION');
        $this->PARTNER_NAME = 'Вячеслав Лучко';
        $this->PARTNER_URI = 'https://github.com/slavytuch/';
        $this->MODULE_DIR = \Bitrix\Main\Loader::getLocal('modules/' . $this->MODULE_ID);
    }

    public function DoInstall()
    {
        RegisterModule(static::MODULE_ID);
        $this->InstallFiles();
    }

    public function DoUninstall()
    {
        UnRegisterModule(static::MODULE_ID);
        $this->UnInstallFiles();
    }

    public function InstallFiles()
    {
        CopyDirFiles(
            $this->MODULE_DIR . '/install/components/',
            $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/',
            true,
            true
        );
    }

    public function UnInstallFiles()
    {
        DeleteDirFilesEx('/bitrix/components/' . $this->MODULE_ID . '/');
    }
}