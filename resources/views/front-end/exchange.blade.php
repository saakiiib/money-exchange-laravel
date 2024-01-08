@extends('layouts.app')

@section('content')
<h1>Exchange Rates</h1>

<form id="exchangeForm">
    <label for="from_currency">From Currency:</label>
    <select name="from_currency" id="fromCurrencySelect">
        @if ($exchangeRates)
        @foreach ($exchangeRates as $currency => $rate)
        <option value="{{ $currency }}">{{ $currency }}</option>
        @endforeach
        @else
        <option value="" disabled>No exchange rates available.</option>
        @endif
    </select>

    <label for="to_currency">To Currency:</label>
    <select name="to_currency" id="toCurrencySelect">
        @if ($exchangeRates)
        @foreach ($exchangeRates as $currency => $rate)
        <option value="{{ $currency }}">{{ $currency }}</option>
        @endforeach
        @else
        <option value="" disabled>No exchange rates available.</option>
        @endif
    </select>

    <label for="amount">Amount:</label>
    <input type="number" name="amount" id="amountInput" placeholder="Enter amount">

    <button type="button" onclick="calculateExchange()">Calculate Exchange</button>
</form>

<div id="result">
</div>

<script>
    var exchangeRates = @json($exchangeRates);

function calculateExchange() {
    var fromCurrency = document.getElementById('fromCurrencySelect').value;
    var toCurrency = document.getElementById('toCurrencySelect').value;
    var amount = parseFloat(document.getElementById('amountInput').value);

    if (exchangeRates && exchangeRates[fromCurrency] && exchangeRates[toCurrency]) {
        var fromRate = exchangeRates[fromCurrency];
        var toRate = exchangeRates[toCurrency];
        var exchangedAmount = (amount / fromRate) * toRate;

        document.getElementById('result').innerText = `Exchanged Amount: ${exchangedAmount.toFixed(2)} ${toCurrency}`;
    } else {
        document.getElementById('result').innerText = 'Exchange rates are not available.';
    }
}
</script>
@endsection