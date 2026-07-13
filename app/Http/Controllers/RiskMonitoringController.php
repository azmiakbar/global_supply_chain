<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\WorldBankService;
use App\Services\NewsService;
use App\Services\RiskService;

class RiskMonitoringController extends Controller
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

        return view('risk.index', compact('countries'));
    }

    public function show(Country $country)
    {
        $weather = null;
        $currency = null;
        $economy = null;
        $news = [];
        $risk = null;

        if ($country->latitude && $country->longitude) {

            $weather = $this->weatherService->current(
                (float)$country->latitude,
                (float)$country->longitude
            );

        }

        if ($country->currency) {

            $currency = $this->currencyService->latest(
                $country->currency
            );

        }

        if ($country->code) {

            $economy = $this->worldBankService->economy(
                $country->code
            );

        }

        $news = $this->newsService->latest(
            $country->name
        );

        $risk = $this->riskService->calculate(
            $weather,
            $currency,
            $economy,
            $news
        );

        return view(
            'risk.show',
            compact(
                'country',
                'weather',
                'currency',
                'economy',
                'news',
                'risk'
            )
        );
    }
}