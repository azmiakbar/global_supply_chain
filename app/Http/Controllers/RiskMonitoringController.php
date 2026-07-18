<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Watchlist;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\WorldBankService;
use App\Services\NewsService;
use App\Services\RiskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

        // ==========================
        // WEATHER
        // ==========================
        if ($country->latitude && $country->longitude) {
            $weather = $this->weatherService->current(
                (float) $country->latitude,
                (float) $country->longitude
            );
        }

        // ==========================
        // CURRENCY
        // ==========================
        if (!empty($country->currency)) {

            $data = $this->currencyService->latest($country->currency);

            if ($data) {
                $currency = [
                    'base' => 'USD',
                    'currency' => $data['code'],
                    'rate' => $data['rate'],
                    'updated' => now()->format('d M Y H:i'),
                ];
            }
        }

        // ==========================
        // WORLD BANK
        // ==========================
        if (!empty($country->code)) {
            $economy = $this->worldBankService->economy($country->code);
        }

        // ==========================
        // NEWS
        // ==========================
        $news = Cache::remember("country_news_{$country->id}", 15 * 60, function () use ($country) {
            $query = '"' . $country->name . '" AND ("supply chain" OR logistics OR shipping OR port OR trade OR oil OR economy OR industry)';
            return $this->newsService->latest($query);
        });

        // ==========================
        // RISK SCORE
        // ==========================
        $risk = $this->riskService->calculate(
            $weather,
            $currency,
            $economy,
            $news
        );

        // ==========================
        // WATCHLIST
        // ==========================
        $isWatchlist = false;

        if (Auth::check()) {
            $isWatchlist = Watchlist::where('user_id', Auth::id())
                ->where('country_id', $country->id)
                ->exists();
        }

        return view('risk.show', compact(
            'country',
            'weather',
            'currency',
            'economy',
            'news',
            'risk',
            'isWatchlist'
        ));
    }
}