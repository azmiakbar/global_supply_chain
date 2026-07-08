<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Item;
use App\Models\Country;
use App\Models\Port;
use Illuminate\Http\Request;

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
            'transport_type' => 'required',
            'departure_date' => 'required|date',
            'estimated_arrival' => 'required|date',
            'status' => 'required',
        ]);
        
        Shipment::create([
            'item_id' => $request->item_id,
            'origin_country_id' => $request->origin_country_id,
            'destination_country_id' => $request->destination_country_id,
            'origin_port_id' => $request->origin_port_id,
            'destination_port_id' => $request->destination_port_id,
            'quantity' => $request->quantity,
            'transport_type' => $request->transport_type,
            'departure_date' => $request->departure_date,
            'estimated_arrival' => $request->estimated_arrival,
            'status' => $request->status,
            
            // sementara otomatis
            'risk_level' => 'Low',
            'risk_score' => 10,
        ]);
        
        return redirect()->route('shipments.index')
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
