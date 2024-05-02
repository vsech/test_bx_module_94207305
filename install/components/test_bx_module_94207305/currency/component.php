<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Web\HttpClient;

class CCurrencyComponent extends CBitrixComponent
{
    /**
     * Get currency rates for a specific date.
     *
     * This method retrieves currency rates for the specified date from the Central Bank of Russia.
     * The rates are returned as an associative array, where the keys are currency codes
     * and the values are currency rates.
     *
     * @param string $date The date for which to retrieve currency rates.
     *                     The date must be in the format "YYYY-MM-DD".
     * @return array An associative array of currency rates.
     */
    public function getCurrencyRates($date)
    {
        // Check that "Currency" module is installed
        if (!Loader::includeModule('currency')) {
            return [];
        }

        // Build URL for the request to the CBR
        $url = 'https://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $date;

        // Send AJAX-request to the CBR
        $httpClient = new HttpClient();
        $response = $httpClient->get($url);

        // Parse XML-response
        $xml = simplexml_load_string($response);
        $currencyList = [];

        // Iterate over the currency list in the XML-response
        foreach ($xml->Valute as $valute) {

            // Get currency code and rate
            $currencyCode = (string)$valute->CharCode;
            $currencyRate = (float)str_replace(',', '.', (string)$valute->Value);

            // Add currency code and rate to the result array
            $currencyList[$currencyCode] = $currencyRate;
        }

        return $currencyList;
    }


    /**
     * Executes the component.
     *
     * Gets currency rates for a specific date from the Central Bank of Russia
     * and sets the resulting array to the component result.
     *
     * @return void
     */
    public function executeComponent()
    {
        // Get date from AJAX-request
        $date = $_GET['date'];

        // Check date format
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            // Show error message if date format is invalid
            ShowError('Invalid date format');

            // Stop script execution
            return;
        }

        // Get currency rates for the specified date
        $currencyList = $this->getCurrencyRates($date);

        // Set resulting array to the component result
        $this->arResult['CURRENCY_LIST'] = $currencyList;

        // Include component template
        $this->includeComponentTemplate();
    }


}
