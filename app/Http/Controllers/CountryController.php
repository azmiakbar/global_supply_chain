<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\WorldBankService;
use App\Services\NewsService;
use App\Services\RiskService;

class CountryController extends Controller
{
    protected WeatherService $weatherService;
    protected CurrencyService $currencyService;
    protected WorldBankService $worldBankService;
    protected NewsService $newsService;
    protected RiskService $riskService;

    public function __construct(
        WeatherService $weatherService,
        CurrencyService $currencyService,
        WorldBankService $worldBankService,
        NewsService $newsService,
        RiskService $riskService
    ) {
        $this->weatherService = $weatherService;
        $this->currencyService = $currencyService;
        $this->worldBankService = $worldBankService;
        $this->newsService = $newsService;
        $this->riskService = $riskService;
    }

    public function index()
    {
        $countries = Country::orderBy('name')->paginate(20);

        return view('countries.index', compact('countries'));
    }

    public function show(Country $country)
    {
        return view(
            'countries.show',
            compact('country')
        );
    }
}