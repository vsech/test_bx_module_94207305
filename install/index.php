<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class custom_currency extends CModule
{
    /**
     * Class constructor
     *
     * Sets module id, name, description and partner name.
     *
     * @see \CModule::__construct()
     */
    public function __construct()
    {
        $this->MODULE_ID = 'custom.currency';
        /**
         * Module name.
         *
         * @var string
         */
        $this->MODULE_NAME = Loc::getMessage('CUSTOM_CURRENCY_MODULE_NAME');
        /**
         * Module description.
         *
         * @var string
         */
        $this->MODULE_DESCRIPTION = Loc::getMessage('CUSTOM_CURRENCY_MODULE_DESC');
        /**
         * Module partner name.
         *
         * @var string
         */
        $this->PARTNER_NAME = Loc::getMessage('CUSTOM_CURRENCY_PARTNER_NAME');
        /**
         * Module partner URI.
         *
         * @var string
         */
        $this->PARTNER_URI = '';
    }


    /**
     * Install module
     *
     * Registers the module in the Bitrix framework.
     *
     * @see \CModule::DoInstall()
     */
    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    /**
     * Uninstall module
     *
     * Unregisters the module from the Bitrix framework.
     *
     * @see \CModule::DoUninstall()
     */
    public function DoUninstall()
    {
        /**
         * Unregister the module from the Bitrix framework.
         *
         * @global string $this->MODULE_ID The module ID.
         */
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

}
