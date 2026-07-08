@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    🌍 {{ $country->name }}
</h2>

<div class="row">

    <div class="col-md-4">

        <div class="card shadow mb-4">

            <div class="card-header bg-primary text-white">
                Country Information
            </div>

            <div class="card-body text-center">

                <img
                    src="https://flagcdn.com/w160/{{ strtolower($country->code) }}.png"
                    width="120"
                    class="mb-3 border rounded shadow">

                <table class="table table-bordered">

                    <tr>
                        <th>Name</th>
                        <td>{{ $country->name }}</td>
                    </tr>

                    <tr>
                        <th>Capital</th>
                        <td>{{ $country->capital }}</td>
                    </tr>

                    <tr>
                        <th>Currency</th>
                        <td>{{ $country->currency }}</td>
                    </tr>

                    <tr>
                        <th>Language</th>
                        <td>{{ $country->language }}</td>
                    </tr>

                    <tr>
                        <th>Region</th>
                        <td>{{ $country->region }}</td>
                    </tr>

                    <tr>
                        <th>Population</th>
                        <td>{{ number_format($country->population) }}</td>
                    </tr>

                    <tr>
                        <th>Latitude</th>
                        <td>{{ $country->latitude }}</td>
                    </tr>

                    <tr>
                        <th>Longitude</th>
                        <td>{{ $country->longitude }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-8">

        {{-- WEATHER --}}
        <div class="card shadow mb-4">

            <div class="card-header bg-success text-white">
                🌦 Live Weather
            </div>

            <div class="card-body">

                @if($weather)

                    <div class="row text-center">

                        <div class="col-md-3">

                            <h5>🌡 Temperature</h5>

                            <h3>
                                {{ $weather['temperature_2m'] }} °C
                            </h3>

                        </div>

                        <div class="col-md-3">

                            <h5>💧 Humidity</h5>

                            <h3>
                                {{ $weather['relative_humidity_2m'] }} %
                            </h3>

                        </div>

                        <div class="col-md-3">

                            <h5>🌧 Rain</h5>

                            <h3>
                                {{ $weather['rain'] }} mm
                            </h3>

                        </div>

                        <div class="col-md-3">

                            <h5>💨 Wind</h5>

                            <h3>
                                {{ $weather['wind_speed_10m'] }} km/h
                            </h3>

                        </div>

                    </div>

                @else

                    <div class="alert alert-danger mb-0">

                        Weather data unavailable.

                    </div>

                @endif

            </div>

        </div>

        {{-- CURRENCY --}}
        <div class="card shadow mb-4">

            <div class="card-header bg-warning">
                💱 Currency Monitoring
            </div>

            <div class="card-body">

                @if($currency)

                    <table class="table table-bordered mb-0">

                        <tr>
                            <th width="40%">Base Currency</th>
                            <td>{{ $currency['base'] }}</td>
                        </tr>

                        <tr>
                            <th>Country Currency</th>
                            <td>{{ $currency['currency'] }}</td>
                        </tr>

                        <tr>
                            <th>Exchange Rate</th>
                            <td>

                                <strong>

                                    1 {{ $currency['base'] }}

                                    =

                                    {{ number_format($currency['rate'], 2) }}

                                    {{ $currency['currency'] }}

                                </strong>

                            </td>
                        </tr>

                        <tr>
                            <th>Last Update</th>
                            <td>{{ $currency['updated'] }}</td>
                        </tr>

                    </table>

                @else

                    <div class="alert alert-warning mb-0">

                        Currency data unavailable.

                    </div>

                @endif

            </div>

        </div>

        {{-- ECONOMY --}}
        @if($economy)
        <div class="row text-center">
            <div class="col-md-6 mb-3">
                <div class="border rounded p-3">
                    <h6>GDP</h6>
                    <h5 class="text-primary">
                        {{ $economy['gdp'] ? number_format($economy['gdp'],0) : '-' }}
                    </h5>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="border rounded p-3">
                    <h6>Inflation</h6>
                    <h5 class="text-danger">
                        {{ $economy['inflation'] ? number_format($economy['inflation'],2).' %' : '-' }}
                    </h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <h6>Exports</h6>
                    <h5 class="text-success">
                        {{ $economy['exports'] ? number_format($economy['exports'],0) : '-' }}
                    </h5>
                </div>
            </div>
            <div class="col-md-6">

        <div class="border rounded p-3">
            <h6>Imports</h6>
            <h5 class="text-warning">
                {{ $economy['imports'] ? number_format($economy['imports'],0) : '-' }}
            </h5>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning mb-0">
    Economy data unavailable.
</div>
@endif

        {{-- NEWS --}}
        <div class="card shadow mb-4">

            <div class="card-header bg-dark text-white">
                📰 Latest News
            </div>

            <div class="card-body">

                <div class="alert alert-secondary mb-0">

                    News API akan ditampilkan di sini.

                </div>

            </div>

        </div>

        {{-- RISK SCORE --}}
        <div class="card shadow">

            <div class="card-header bg-danger text-white">
                ⚠ Risk Score
            </div>

            <div class="card-body">

                <div class="alert alert-danger mb-0">

                    Risk Score akan dihitung setelah seluruh API selesai diintegrasikan.

                </div>

            </div>

        </div>

    </div>

</div>

@endsection