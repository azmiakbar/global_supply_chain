<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Port;
use App\Models\Shipment;
use App\Models\Item;
use App\Models\Watchlist;
use App\Models\User;
use App\Models\NewsAnalysis;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCountries = Country::where('name', '!=', 'Unknown')->count();
        $totalPorts = Port::count();
        $totalItems = Item::count();
        $totalShipments = Shipment::count();

        $lowRisk = Shipment::where('risk_level', 'LOW')->count();
        $mediumRisk = Shipment::where('risk_level', 'MEDIUM')->count();
        $highRisk = Shipment::where('risk_level', 'HIGH')->count();

        $pending = 0;
        $inTransit = 0;
        $delivered = 0;

        foreach (Shipment::all() as $shipment) {

            if ($shipment->current_status == 'Pending') {

                $pending++;

            } elseif ($shipment->current_status == 'In Transit') {

                $inTransit++;

            } else {

                $delivered++;

            }

        }

        $shipmentCountry = Shipment::selectRaw('origin_country_id, COUNT(*) as total')
            ->groupBy('origin_country_id')
            ->with('originCountry')
            ->get();

        return view('dashboard', compact(
            'totalCountries',
            'totalPorts',
            'totalItems',
            'totalShipments',
            'lowRisk',
            'mediumRisk',
            'highRisk',
            'pending',
            'inTransit',
            'delivered',
            'shipmentCountry'
        ));
    }

    public function map()
    {
        $shipments = Shipment::with([
            'originCountry',
            'destinationCountry'
        ])->get();

        return view('map', compact('shipments'));
    }

    public function admin()
    {
        return view('admin.index', [

            'users' => User::count(),

            'ports' => Port::count(),

            'news' => NewsAnalysis::count(),

            'countries' => Country::count(),

            'shipments' => Shipment::count(),

        ]);
    }
}