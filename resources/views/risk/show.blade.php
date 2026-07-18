@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>
        ⚠ Risk Monitoring - {{ $country->name }}
    </h2>

    <div>

        @if($isWatchlist)

            <form action="{{ route('watchlist.destroy',$country) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger">
                    🗑 Remove Watchlist
                </button>

            </form>

        @else

            <form action="{{ route('watchlist.store',$country) }}" method="POST" class="d-inline">
                @csrf

                <button class="btn btn-warning">
                    ⭐ Add Watchlist
                </button>

            </form>

        @endif

        <a href="{{ route('risk.index') }}"
            class="btn btn-secondary">

            ← Kembali

        </a>

    </div>

</div>

<div class="row">

    {{-- Risk Score --}}
    <div class="col-md-4">

        <div class="card shadow mb-4">

            <div class="card-header bg-danger text-white">

                Risk Score

            </div>

            <div class="card-body text-center">

                <h1>{{ $risk['total'] }}</h1>

                @if($risk['level']=='LOW')

                    <span class="badge bg-success fs-5">
                        LOW RISK
                    </span>

                @elseif($risk['level']=='MEDIUM')

                    <span class="badge bg-warning text-dark fs-5">
                        MEDIUM RISK
                    </span>

                @else

                    <span class="badge bg-danger fs-5">
                        HIGH RISK
                    </span>

                @endif

            </div>

        </div>

    </div>

    {{-- Weather --}}
    <div class="col-md-8">

        <div class="card shadow mb-4">

            <div class="card-header bg-success text-white">

                🌦 Live Weather

            </div>

            <div class="card-body">

                @if($weather)

                <div class="row text-center">

                    <div class="col">
                        <h6>Temperature</h6>
                        <h4>{{ $weather['temperature_2m'] }}°C</h4>
                    </div>

                    <div class="col">
                        <h6>Humidity</h6>
                        <h4>{{ $weather['relative_humidity_2m'] }}%</h4>
                    </div>

                    <div class="col">
                        <h6>Rain</h6>
                        <h4>{{ $weather['rain'] }} mm</h4>
                    </div>

                    <div class="col">
                        <h6>Wind</h6>
                        <h4>{{ $weather['wind_speed_10m'] }} km/h</h4>
                    </div>

                </div>

                @else

                <div class="alert alert-warning">

                    Weather tidak tersedia.

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

<div class="row">

    {{-- Currency --}}
    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header bg-warning">

                💱 Currency

            </div>

            <div class="card-body">

                @if($currency)

                <table class="table table-bordered">

                    <tr>

                        <th>Base</th>

                        <td>{{ $currency['base'] }}</td>

                    </tr>

                    <tr>

                        <th>Currency</th>

                        <td>{{ $currency['currency'] }}</td>

                    </tr>

                    <tr>

                        <th>Rate</th>

                        <td>{{ number_format($currency['rate'],2) }}</td>

                    </tr>

                    <tr>

                        <th>Updated</th>

                        <td>{{ $currency['updated'] }}</td>

                    </tr>

                </table>

                @else

                <div class="alert alert-warning">

                    Currency tidak tersedia.

                </div>

                @endif

            </div>

        </div>

    </div>

    {{-- Economy --}}
    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header bg-info text-white">

                📈 Economy

            </div>

            <div class="card-body">

                @if($economy)

                <table class="table table-bordered">

                    <tr>

                        <th>GDP</th>

                        <td>{{ number_format($economy['gdp'] ?? 0) }}</td>

                    </tr>

                    <tr>

                        <th>Population</th>

                        <td>{{ number_format($country->population) }}</td>

                    </tr>

                    <tr>

                        <th>Inflation</th>

                        <td>{{ number_format($economy['inflation'] ?? 0,2) }}%</td>

                    </tr>

                    <tr>

                        <th>Export</th>

                        <td>{{ number_format($economy['exports'] ?? 0) }}</td>

                    </tr>

                    <tr>

                        <th>Import</th>

                        <td>{{ number_format($economy['imports'] ?? 0) }}</td>

                    </tr>

                </table>

                @else

                <div class="alert alert-warning">

                    Economy tidak tersedia.

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- NEWS --}}

<div class="card shadow">

    <div class="card-header bg-dark text-white">

        📰 Latest News

    </div>

    <div class="card-body">

        <div class="row">

            @forelse($news as $article)

            <div class="col-md-4 mb-4">

                <div class="card shadow h-100">

                    @if(!empty($article['image']))

                        <img
                            src="{{ $article['image'] }}"
                            class="card-img-top"
                            style="height:220px;object-fit:cover;">

                    @endif

                    <div class="card-body d-flex flex-column">

                        {{-- KATEGORI --}}
                        @if(($article['category'] ?? '') == 'Shipping')
                            <div>
                                <span class="badge bg-primary mb-2">
                                    🚢 Shipping
                                </span>
                            </div>
                        @elseif(($article['category'] ?? '') == 'Trade')
                            <div>
                                <span class="badge bg-success mb-2">
                                    🌍 Trade
                                </span>
                            </div>
                        @elseif(($article['category'] ?? '') == 'Oil')
                            <div>
                                <span class="badge bg-warning text-dark mb-2">
                                    🛢 Oil
                                </span>
                            </div>
                        @elseif(($article['category'] ?? '') == 'Port')
                            <div>
                                <span class="badge bg-info text-dark mb-2">
                                    ⚓ Port
                                </span>
                            </div>
                        @elseif(($article['category'] ?? '') == 'Logistics')
                            <div>
                                <span class="badge bg-secondary mb-2">
                                    📦 Logistics
                                </span>
                            </div>
                        @else
                            <div>
                                <span class="badge bg-dark mb-2">
                                    🌐 Supply Chain
                                </span>
                            </div>
                        @endif

                        <h5>

                            {{ $article['title'] }}

                        </h5>

                        <p class="text-muted">

                            {{ $article['description'] }}

                        </p>

                        <hr>

                        <small class="text-muted">

                            📰 {{ $article['source'] }}

                        </small>

                        <small class="text-muted mb-3">

                            📅 {{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y') }}

                        </small>

                        <div class="mt-auto">

                            <a
                                href="{{ $article['url'] }}"
                                target="_blank"
                                class="btn btn-primary w-100">

                                Read More →

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="col">

                <div class="alert alert-secondary">

                    Tidak ada berita.

                </div>

            </div>

            @endforelse

        </div>

    </div>

</div>

@endsection