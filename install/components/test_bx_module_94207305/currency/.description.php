<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    'NAME' => Loc::getMessage('CUSTOM_CURRENCY_COMPONENT_NAME'),
    'DESCRIPTION' => Loc::getMessage('CUSTOM_CURRENCY_COMPONENT_DESC'),
    'ICON' => '/images/icon.gif', // Путь к иконке компонента
    'CACHE_PATH' => 'Y', // Кэшировать результаты работы компонента
    'PATH' => array(
        'ID' => 'custom', // Идентификатор раздела в панели управления
        'NAME' => Loc::getMessage('CUSTOM_CURRENCY_SECTION_NAME'),
        'SORT' => 10, // Порядок отображения в панели управления
    ),
);
