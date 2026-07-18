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
        $countries = Country::where('name', '!=', 'Unknown')
        ->orderBy('name')
        ->paginate(20);

        return view('countries.index', compact('countries'));
    }

    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    public function apiIndex()
    {
        $countries = Country::where('name', '!=', 'Unknown')
            ->orderBy('name')
            ->get();
        return response()->json($countries);
    }

    public function apiRisk(\Illuminate\Http\Request $request)
    {
        $countryId = $request->query('country_id');
        $country = Country::find($countryId);
        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        $weather = null;
        if ($country->latitude && $country->longitude) {
            $weather = $this->weatherService->current(
                (float) $country->latitude,
                (float) $country->longitude
            );
        }

        $currency = null;
        if (!empty($country->currency)) {
            $currency = $this->currencyService->latest($country->currency);
        }

        $economy = null;
        if (!empty($country->code)) {
            $economy = $this->worldBankService->economy($country->code);
        }

        $news = $this->newsService->latest($country->name);

        $risk = $this->riskService->calculate(
            $weather,
            $currency,
            $economy,
            $news
        );

        return response()->json([
            'country' => $country->name,
            'risk_score' => $risk,
        ]);
    }
}