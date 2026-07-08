<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\WorldBankService;

class CountryController extends Controller
{
    protected WeatherService $weatherService;
    protected CurrencyService $currencyService;
    protected WorldBankService $worldBankService;

    public function __construct(
        WeatherService $weatherService,
        CurrencyService $currencyService,
        WorldBankService $worldBankService
    ) {
        $this->weatherService = $weatherService;
        $this->currencyService = $currencyService;
        $this->worldBankService = $worldBankService;
    }

    public function index()
    {
        $countries = Country::orderBy('name')->paginate(20);

        return view('countries.index', compact('countries'));
    }

    public function show(Country $country)
    {
        $weather = null;
        $currency = null;
        $economy = null;

        if ($country->latitude && $country->longitude) {
            $weather = $this->weatherService->current(
                (float) $country->latitude,
                (float) $country->longitude
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

        return view(
            'countries.show',
            compact(
                'country',
                'weather',
                'currency',
                'economy'
            )
        );
    }
}