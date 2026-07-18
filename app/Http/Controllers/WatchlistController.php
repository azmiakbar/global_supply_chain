<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function index()
    {
        $watchlists = Watchlist::with('country')
            ->where('user_id', Auth::id())
            ->get();

        return view(
            'watchlist.index',
            compact('watchlists')
        );
    }

    public function store(Country $country)
    {
        Watchlist::firstOrCreate([
            'user_id' => Auth::id(),
            'country_id' => $country->id,
        ]);

        return back()->with(
            'success',
            'Country added to Watchlist.'
        );
    }

    public function destroy(Country $country)
    {
        Watchlist::where(
            'user_id',
            Auth::id()
        )
        ->where(
            'country_id',
            $country->id
        )
        ->delete();

        return back()->with(
            'success',
            'Country removed from Watchlist.'
        );
    }
}