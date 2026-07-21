<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RiskMonitoringController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminPortController;
use App\Http\Controllers\Admin\NewsAnalysisController;
use Illuminate\Support\Facades\Route;


Route::get('/login-user', function () {
    $user = \App\Models\User::where('email', 'azmi@gmail.com')->first();
    if ($user) {
        auth()->login($user);
        return redirect()->route('dashboard');
    }
    return 'Akun User azmi@gmail.com tidak ditemukan!';
});

Route::get('/login-admin', function () {
    $admin = \App\Models\User::where('email', 'admin@gmail.com')->first();
    if ($admin) {
        auth()->login($admin);
        return redirect()->route('admin.index');
    }
    return 'Akun Admin admin@gmail.com tidak ditemukan!';
});

Route::get('/', function () {
    if (auth()->check()) {
        if (str_contains(strtolower(auth()->user()->email), 'admin')) {
            return redirect()->route('admin.index');
        }
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/map', [DashboardController::class, 'map'])
    ->middleware(['auth'])
    ->name('map');

Route::resource('countries', CountryController::class)
    ->only(['index','show']);

Route::resource('items', ItemController::class);
Route::resource('shipments', ShipmentController::class);
Route::get('/ports-dashboard', [PortController::class, 'dashboard'])->name('ports.dashboard');
Route::get('/ports/{country}', [PortController::class, 'getByCountry']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/risk-monitoring',[RiskMonitoringController::class,'index'])
    ->name('risk.index');

Route::get('/risk-monitoring/{country}', [RiskMonitoringController::class, 'show'])
    ->name('risk.show');

Route::get('/comparison', [ComparisonController::class,'index'])
    ->name('comparison.index');

Route::get('/currency-dashboard', [ComparisonController::class, 'currencyDashboard'])
    ->name('currency.dashboard');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/news/{country}', [NewsController::class, 'show'])
    ->name('news.show');

Route::middleware('auth')->group(function () {

    Route::get('/watchlist', [WatchlistController::class, 'index'])
        ->name('watchlist.index');

    Route::post('/watchlist/{country}', [WatchlistController::class, 'store'])
        ->name('watchlist.store');

    Route::delete('/watchlist/{country}', [WatchlistController::class, 'destroy'])
        ->name('watchlist.destroy');

});

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])
        ->name('admin.index');

    Route::resource('/admin/articles', ArticleController::class)
        ->names('admin.articles');

    Route::resource('users', UserController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('ports', AdminPortController::class);

        Route::get('/news-analysis', [NewsAnalysisController::class, 'index'])
            ->name('news-analysis.index');

        Route::delete('/news-analysis/{newsAnalysis}', [NewsAnalysisController::class, 'destroy'])
            ->name('news-analysis.destroy');
    });
});

require __DIR__.'/auth.php';
