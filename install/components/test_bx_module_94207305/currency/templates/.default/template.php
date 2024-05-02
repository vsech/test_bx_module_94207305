<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<div id="currency_rates" class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <label for="date_input" class="form-label">Select Date:</label>
            <input type="date" id="date_input" class="form-control">
        </div>
        <div class="col-md-6">
            <button id="update_rates" class="btn btn-primary">Update Rates</button>
        </div>
    </div>
    <ul id="currency_list" class="mt-3">
        <?php foreach ($arResult['CURRENCY_LIST'] as $currencyCode => $currencyRate): ?>
            <li><?php echo $currencyCode . ': ' . $currencyRate; ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var updateButton = document.getElementById('update_rates');
        var dateInput = document.getElementById('date_input');

        updateButton.addEventListener('click', function() {
            var date = dateInput.value;
            if (date) {
                updateCurrencyRates(date);
            }
        });

        function updateCurrencyRates(date) {
            var xhr = new XMLHttpRequest();
            var url = '/bitrix/components/custom/currency/res.php?date=' + date;
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        var currencyList = document.getElementById('currency_list');
                        currencyList.innerHTML = '';

                        for (var currencyCode in response) {
                            var listItem = document.createElement('li');
                            listItem.textContent = currencyCode + ': ' + response[currencyCode];
                            currencyList.appendChild(listItem);
                        }
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            xhr.open('GET', url, true);
            xhr.send();
        }
    });
</script>
