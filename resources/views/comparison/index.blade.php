@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    📊 Country Comparison
</h2>

<div class="card shadow mb-4">

    <div class="card-body">

        <form method="GET" action="{{ route('comparison.index') }}">

            <div class="row">

                <div class="col-md-5">

                    <label class="form-label">
                        Country 1
                    </label>

                    <select
                        name="country1"
                        class="form-select"
                        required>

                        <option value="">
                            -- Select Country --
                        </option>

                        @foreach($countries as $country)

                            <option
                                value="{{ $country->id }}"
                                {{ request('country1')==$country->id?'selected':'' }}>

                                {{ $country->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-5">

                    <label class="form-label">
                        Country 2
                    </label>

                    <select
                        name="country2"
                        class="form-select"
                        required>

                        <option value="">
                            -- Select Country --
                        </option>

                        @foreach($countries as $country)

                            <option
                                value="{{ $country->id }}"
                                {{ request('country2')==$country->id?'selected':'' }}>

                                {{ $country->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button class="btn btn-primary w-100">

                        Compare

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@if($country1 && $country2)

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        Comparison Result

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th>Data</th>

                <th>{{ $country1->name }}</th>

                <th>{{ $country2->name }}</th>

            </tr>

            <tr>

                <th>Currency</th>

                <td>{{ $country1->currency }}</td>

                <td>{{ $country2->currency }}</td>

            </tr>

            <tr>

                <th>Population</th>

                <td>{{ number_format($country1->population) }}</td>

                <td>{{ number_format($country2->population) }}</td>

            </tr>

            <tr>

                <th>GDP</th>

                <td>

                    {{ number_format($country1->economy['gdp'] ?? 0) }}

                </td>

                <td>

                    {{ number_format($country2->economy['gdp'] ?? 0) }}

                </td>

            </tr>

            <tr>

                <th>Inflation</th>

                <td>

                    {{ $country1->economy['inflation'] ?? '-' }}

                </td>

                <td>

                    {{ $country2->economy['inflation'] ?? '-' }}

                </td>

            </tr>

            <tr>

                <th>Risk Score</th>

                <td>

                    {{ $country1->risk['total'] }}

                    ({{ $country1->risk['level'] }})

                </td>

                <td>

                    {{ $country2->risk['total'] }}

                    ({{ $country2->risk['level'] }})

                </td>

            </tr>

        </table>

    </div>

</div>

@endif

@endsection