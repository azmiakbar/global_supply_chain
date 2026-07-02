<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API Global Supply Chain berjalan'
    ]);
});

Route::get('/countries', [CountryController::class, 'apiIndex']);

Route::get('/import-countries', [CountryController::class, 'importCountries']);