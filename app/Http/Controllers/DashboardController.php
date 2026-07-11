<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Port;
use App\Models\Shipment;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCountries = Country::count();

        $totalPorts = Port::count();

        $totalItems = Item::count();

        $totalShipments = Shipment::count();

        $lowRisk = Shipment::where('risk_level', 'Low')->count();

        $mediumRisk = Shipment::where('risk_level', 'Medium')->count();

        $highRisk = Shipment::where('risk_level', 'High')->count();

        return view('dashboard', compact(
            'totalCountries',
            'totalPorts',
            'totalItems',
            'totalShipments',
            'lowRisk',
            'mediumRisk',
            'highRisk'
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
}