<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\ExchangeRateService;

class HomeController extends Controller
{
    protected $exchangeRateService;

    public function __construct()
    {
        $this->exchangeRateService = new ExchangeRateService();
    }

    public function home()
    {
        return view('front-end.home');
    }
}
