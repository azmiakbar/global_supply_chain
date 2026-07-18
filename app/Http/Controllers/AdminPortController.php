<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Port;
use Illuminate\Http\Request;

class AdminPortController extends Controller
{
    public function index()
    {
        $ports = Port::with('country')
            ->join('countries', 'ports.country_id', '=', 'countries.id')
            ->orderBy('countries.name')
            ->select('ports.*')
            ->paginate(10);

        return view('admin.ports.index', compact('ports'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('admin.ports.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
            'transport_type' => 'required',
        ]);

        Port::create($request->all());

        return redirect()
            ->route('admin.ports.index')
            ->with('success', 'Pelabuhan berhasil ditambahkan.');
    }

    public function edit(Port $port)
    {
        $countries = Country::orderBy('name')->get();

        return view('admin.ports.edit', compact('port', 'countries'));
    }

    public function update(Request $request, Port $port)
    {
        $request->validate([
            'country_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
            'transport_type' => 'required',
        ]);

        $port->update($request->all());

        return redirect()
            ->route('admin.ports.index')
            ->with('success', 'Pelabuhan berhasil diupdate.');
    }

    public function destroy(Port $port)
    {
        $port->delete();

        return redirect()
            ->route('admin.ports.index')
            ->with('success', 'Pelabuhan berhasil dihapus.');
    }
}