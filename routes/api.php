<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PortController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API Global Supply Chain berjalan'
    ]);
});

Route::get('/countries', [CountryController::class, 'apiIndex']);

Route::get('/import-countries', [CountryController::class, 'importCountries']);

Route::get('/ports', [PortController::class, 'index']);