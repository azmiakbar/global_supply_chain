<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index()
    {
        return Port::with('country')
            ->paginate(100);
    }

    public function getByCountry($countryId)
    {
        $ports = Port::where('country_id', $countryId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($ports);
    }
}