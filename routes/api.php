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
Route::get('/risk', [CountryController::class, 'apiRisk']);
Route::get('/news', [\App\Http\Controllers\NewsController::class, 'apiIndex']);
Route::get('/currency', [\App\Http\Controllers\ComparisonController::class, 'apiCurrency']);
Route::get('/ports', [PortController::class, 'index']);
Route::get('/ports/search', [PortController::class, 'search']);
Route::get('/import-countries', [CountryController::class, 'importCountries']);