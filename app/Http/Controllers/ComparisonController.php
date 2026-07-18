<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\WorldBankService;
use App\Services\NewsService;
use App\Services\RiskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    ) {
        $this->weatherService = $weatherService;
        $this->currencyService = $currencyService;
        $this->worldBankService = $worldBankService;
        $this->newsService = $newsService;
        $this->riskService = $riskService;
    }

    public function index(Request $request)
    {
        $countries = Country::orderBy('name')->get();

        $country1 = null;
        $country2 = null;

        if ($request->country1 && $request->country2) {

            $country1 = Country::find($request->country1);
            $country2 = Country::find($request->country2);

            foreach ([$country1, $country2] as $country) {

                $country->weather = $this->weatherService->current(
                    (float) $country->latitude,
                    (float) $country->longitude
                );

                $country->currencyData = $this->currencyService->latest($country->currency);

                if ($country->currencyData) {

                    $country->currencyData = [
                        'base' => 'USD',
                        'currency' => $country->currency,
                        'rate' => $country->currencyData['rate'] ?? 0,
                        'updated' => now()->format('d M Y H:i'),
                    ];

                }

                $country->economy = $this->worldBankService->economy(
                    $country->code
                );

                $country->news = Cache::remember("country_news_{$country->id}", 15 * 60, function () use ($country) {
                    $query = '"' . $country->name . '" AND ("supply chain" OR logistics OR shipping OR port OR trade OR oil OR economy OR industry)';
                    return $this->newsService->latest($query);
                });

                $country->risk = $this->riskService->calculate(
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

    public function currencyDashboard()
    {
        $countries = Country::orderBy('name')->get();

        $exchange = $this->currencyService->latest();

        $currencies = [];

        if ($exchange && isset($exchange['rates'])) {

            foreach ($countries as $country) {

                if (!$country->currency) {
                    continue;
                }

                $rate = $exchange['rates'][$country->currency] ?? null;

                if ($rate) {

                    $currencies[] = [

                        'country' => $country->name,

                        'currency' => $country->currency,

                        'rate' => $rate,

                        'updated' => $exchange['time_last_update_utc'] ?? '-',

                    ];

                }

            }

        }

        usort($currencies, function ($a, $b) {
            return $b['rate'] <=> $a['rate'];
        });

        $totalCurrencies = count($currencies);

        $highest = $currencies[0] ?? null;

        $lowest = !empty($currencies) ? end($currencies) : null;

        // Mock historical trend data for major currencies (last 7 days against USD)
        $trendData = [
            'labels' => ['7 Days Ago', '6 Days Ago', '5 Days Ago', '4 Days Ago', '3 Days Ago', '2 Days Ago', 'Today'],
            'EUR' => [0.92, 0.91, 0.93, 0.92, 0.91, 0.92, 0.91],
            'GBP' => [0.79, 0.78, 0.79, 0.78, 0.77, 0.78, 0.78],
            'JPY' => [157.2, 156.5, 157.8, 155.9, 156.2, 155.8, 155.5],
            'IDR' => [16300, 16220, 16350, 16180, 16250, 16200, 16150]
        ];

        return view(
            'comparison.currency',
            compact(
                'currencies',
                'totalCurrencies',
                'highest',
                'lowest',
                'trendData'
            )
        );
    }

    public function apiCurrency()
    {
        $exchange = $this->currencyService->latest();
        return response()->json($exchange);
    }
}