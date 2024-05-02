<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = array(
    'PARAMETERS' => array(
        'CACHE_TIME' => array('DEFAULT' => 3600),
        'DATE_FORMAT' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage('CUSTOM_CURRENCY_DATE_FORMAT'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'Y-m-d',
        ),
    ),
);
