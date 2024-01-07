<?php

namespace App\Http\Controllers;

use App\Services\ExchangeRateService;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    protected $exchangeRateService;

    public function __construct(ExchangeRateService $exchangeRateService)
    {
        $this->exchangeRateService = $exchangeRateService;
    }

    public function showExchangeRates()
    {
        $exchangeRates = $this->exchangeRateService->getExchangeRates();
        // dd($exchangeRates);
        return view('admin.exchange-rates', compact('exchangeRates'));
    }
}
