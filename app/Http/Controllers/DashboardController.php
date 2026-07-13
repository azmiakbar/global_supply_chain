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

        // Risk
        $lowRisk = Shipment::where('risk_level', 'Low')->count();

        $mediumRisk = Shipment::where('risk_level', 'Medium')->count();

        $highRisk = Shipment::where('risk_level', 'High')->count();

        // Status Shipment
        $pending = Shipment::where('status', 'Pending')->count();

        $inTransit = Shipment::where('status', 'In Transit')->count();

        $delivered = Shipment::where('status', 'Delivered')->count();

        // Shipment per Negara Asal
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
}