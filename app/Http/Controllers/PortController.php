<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index()
    {
        return Port::with('country')
            ->where('transport_type', 'Sea')
            ->orderBy('name')
            ->paginate(100);
    }

    public function getByCountry(int $countryId)
    {
        $ports = Port::where('country_id', $countryId)
            ->where('transport_type', 'Sea')
            ->orderBy('name')
            ->get([
                'id',
                'name'
            ]);

        return response()->json($ports);
    }

    public function dashboard()
    {
        $countries = \App\Models\Country::where('name', '!=', 'Unknown')->orderBy('name')->get();
        return view('ports.dashboard', compact('countries'));
    }

    public function search(Request $request)
    {
        $query = Port::with('country')->where('transport_type', 'Sea');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        $ports = $query->orderBy('name')->limit(250)->get();

        return response()->json($ports);
    }
}