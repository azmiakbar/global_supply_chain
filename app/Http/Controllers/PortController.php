<?php

namespace App\Http\Controllers;

use App\Models\Port;

class PortController extends Controller
{
    public function index()
    {
        return Port::with('country')
            ->paginate(100);
    }
}