<?php
define('B_PROLOG_INCLUDED', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
/**
 * AJAX-endpoint for getting currency rates for a specific date.
 *
 * This endpoint retrieves currency rates for the specified date from the "Currency" module.
 * The resulting array is returned in JSON format.
 *
 * @package test_bx_module_94207305
 * @global array $arResult
 * @global string $date The date for which to retrieve currency rates.
 *                     The date must be in the format "YYYY-MM-DD".
 * @return void
 */

use Bitrix\Main\Web\Json;
use Bitrix\Main\Loader;

if (!Loader::includeModule('custom.currency')) {
    echo Json::encode(['error' => 'Module "custom.currency" is not installed']);
    die();
}

$date = $_GET['date'];

// Check date format
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    echo Json::encode(['error' => 'Invalid date format']);
    die();
}

// Get currency rates for the specified date
$component = new CCurrencyComponent();
$currencyList = $component->getCurrencyRates($date);

// Return currency rates in JSON format
echo Json::encode($currencyList);

