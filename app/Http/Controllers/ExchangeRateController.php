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

        if (request()->is('admin/*')) {
            return view('admin.exchange-rates', compact('exchangeRates'));
        } else {
            return view('front-end.exchange', compact('exchangeRates'));
        }
    }
}
