<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\WorldBankService;
use App\Services\NewsService;
use App\Services\RiskService;
use Illuminate\Http\Request;

class ComparisonController extends Controller
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
    ){
        $this->weatherService=$weatherService;
        $this->currencyService=$currencyService;
        $this->worldBankService=$worldBankService;
        $this->newsService=$newsService;
        $this->riskService=$riskService;
    }

    public function index(Request $request)
    {
        $countries=Country::orderBy('name')->get();

        $country1=null;
        $country2=null;

        if($request->country1 && $request->country2){

            $country1=Country::find($request->country1);
            $country2=Country::find($request->country2);

            foreach([$country1,$country2] as $country){

                $country->weather=$this->weatherService->current(
                    (float)$country->latitude,
                    (float)$country->longitude
                );

                $country->currencyData=$this->currencyService->latest(
                    $country->currency
                );

                $country->economy=$this->worldBankService->economy(
                    $country->code
                );

                $country->news=$this->newsService->latest(
                    $country->name
                );

                $country->risk=$this->riskService->calculate(
                    $country->weather,
                    $country->currencyData,
                    $country->economy,
                    $country->news
                );

            }

        }

        return view(
            'comparison.index',
            compact(
                'countries',
                'country1',
                'country2'
            )
        );

    }

}