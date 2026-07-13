@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>
        ⚠ Risk Monitoring - {{ $country->name }}
    </h2>

    <a href="{{ route('risk.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>

</div>

<div class="row">

    {{-- RISK SCORE --}}
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

    {{-- WEATHER --}}
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

    {{-- CURRENCY --}}
    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header bg-warning">

                💱 Currency

            </div>

            <div class="card-body">

                @if($currency)

                <table class="table">

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

                </table>

                @else

                    <div class="alert alert-warning">

                        Currency tidak tersedia.

                    </div>

                @endif

            </div>

        </div>

    </div>

    {{-- ECONOMY --}}
    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header bg-info text-white">

                📈 Economy

            </div>

            <div class="card-body">

                @if($economy)

                <table class="table">

                    <tr>
                        <th>GDP</th>
                        <td>{{ number_format($economy['gdp']) }}</td>
                    </tr>

                    <tr>
                        <th>Inflation</th>
                        <td>{{ $economy['inflation'] }}%</td>
                    </tr>

                    <tr>
                        <th>Export</th>
                        <td>{{ number_format($economy['exports']) }}</td>
                    </tr>

                    <tr>
                        <th>Import</th>
                        <td>{{ number_format($economy['imports']) }}</td>
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

<div class="card shadow">

    <div class="card-header bg-dark text-white">

        📰 Latest News

    </div>

    <div class="card-body">

        @forelse($news as $article)

            <div class="border-bottom mb-3 pb-3">

                <h5>{{ $article['title'] }}</h5>

                <p>{{ $article['description'] }}</p>

                <a href="{{ $article['url'] }}" target="_blank" class="btn btn-primary btn-sm">

                    Read More

                </a>

            </div>

        @empty

            <div class="alert alert-secondary">

                Tidak ada berita.

            </div>

        @endforelse

    </div>

</div>

@endsection