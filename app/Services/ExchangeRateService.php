<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('EXCHANGE_RATE_API_KEY');
    }

    public function getExchangeRates()
    {
        $response = Http::get($this->buildApiUrl());

        // dd($response->json());

        if ($response->successful()) {
            return $response->json()['rates'];
        }

        return null;
    }

    protected function buildApiUrl()
    {
        $endpoint = 'latest';

        return "http://api.exchangeratesapi.io/v1/$endpoint?access_key=$this->apiKey";
    }
}
