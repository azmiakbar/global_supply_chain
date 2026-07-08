<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('countries', CountryController::class)
    ->only(['index','show']);

Route::resource('items', ItemController::class);
Route::resource('shipments', ShipmentController::class);
Route::get('/ports/{country}', [PortController::class, 'getByCountry']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
