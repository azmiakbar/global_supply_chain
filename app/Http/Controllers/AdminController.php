<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Port;
use App\Models\Shipment;
use App\Models\NewsAnalysis;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();

        $ports = Port::count();

        $countries = Country::count();

        $shipments = Shipment::count();

        $news = NewsAnalysis::count();

        return view('admin.index', compact(
            'users',
            'ports',
            'countries',
            'shipments',
            'news'
        ));
    }
}