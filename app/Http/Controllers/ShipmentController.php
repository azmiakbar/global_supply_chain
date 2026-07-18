<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Item;
use App\Models\Country;
use App\Models\Port;
use Illuminate\Http\Request;
use App\Services\DistanceService;
use App\Services\RiskService;
use App\Services\ShipmentMonitoringService;
use App\Services\WeatherService;
use App\Services\CurrencyService;
use App\Services\WorldBankService;
use App\Services\NewsService;

class ShipmentController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $shipments = Shipment::with([
            'item',
            'originCountry',
            'destinationCountry',
            'originPort',
            'destinationPort',
        ])->latest()->get();

        return view('shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        
        return view('shipments.create', compact(
            'items',
            'countries'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'origin_country_id' => 'required',
            'destination_country_id' => 'required',
            'origin_port_id' => 'required',
            'destination_port_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'departure_date' => 'required|date',
        ]);
        
        $originCountry = Country::findOrFail($request->origin_country_id);

        $destinationCountry = Country::findOrFail($request->destination_country_id);

        $originPort = Port::findOrFail($request->origin_port_id);

        $destinationPort = Port::findOrFail($request->destination_port_id);

        /*
        |--------------------------------------------------------------------------
        | Calculate Distance
        |--------------------------------------------------------------------------
        */

        $distanceService = new DistanceService();

        $distance = $distanceService->calculate(
            (float) $originPort->latitude,
            (float) $originPort->longitude,
            (float) $destinationPort->latitude,
            (float) $destinationPort->longitude
        );

        $etaDays = max(1, ceil($distance / 700));

        /*
        |--------------------------------------------------------------------------
        | External Monitoring
        |--------------------------------------------------------------------------
        */

        $weatherService = new WeatherService();
        $currencyService = new CurrencyService();
        $worldBankService = new WorldBankService();
        $newsService = new NewsService();

        $weather = $weatherService->current(
            (float) $originPort->latitude,
            (float) $originPort->longitude
        );

        $currency = $currencyService->latest(
            $destinationCountry->currency
        );

        $economy = $worldBankService->economy(
            $destinationCountry->code
        );

        $news = $newsService->latest(
            $destinationCountry->name
        );

        /*
        |--------------------------------------------------------------------------
        | Calculate Risk
        |--------------------------------------------------------------------------
        */

        $riskService = new RiskService();

        $risk = $riskService->calculate(
            $weather,
            $currency,
            $economy,
            $news
        );

        /*
        |--------------------------------------------------------------------------
        | Shipment Monitoring
        |--------------------------------------------------------------------------
        */

        $monitor = new ShipmentMonitoringService();

        $monitoring = $monitor->generate(
            $risk,
            $etaDays
        );

        Shipment::create([

            'item_id' => $request->item_id,

            'origin_country_id' => $request->origin_country_id,

            'destination_country_id' => $request->destination_country_id,

            'origin_port_id' => $request->origin_port_id,

            'destination_port_id' => $request->destination_port_id,

            'quantity' => $request->quantity,

            'transport_type' => 'Sea',

            'departure_date' => $request->departure_date,

            'estimated_arrival' => date(
                'Y-m-d',
                strtotime(
                    $request->departure_date .
                    " +{$monitoring['final_eta']} days"
                )
            ),

            'estimated_days' => $monitoring['base_eta'],

            'delay_days' => $monitoring['delay_days'],

            'actual_estimated_arrival' => date(
                'Y-m-d',
                strtotime(
                    $request->departure_date .
                    " +{$monitoring['final_eta']} days"
                )
            ),

            'last_monitoring' => now(),

            'latest_information' => $monitoring['recommendation'],

            'status' => 'Pending',

            'risk_level' => $risk['level'],

            'risk_score' => $risk['total'],

        ]);

        return redirect()
            ->route('shipments.index')
            ->with('success', 'Shipment berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
