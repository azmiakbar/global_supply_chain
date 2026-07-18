@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>
        🌍 {{ $country->name }}
    </h2>

    <a href="{{ route('countries.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>

</div>

<div class="row">

    <div class="col-md-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                Country Information
            </div>

            <div class="card-body text-center">

                <img
                    src="https://flagcdn.com/w160/{{ strtolower($country->code) }}.png"
                    width="140"
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
                        <td style="max-width:250px">
                            {{ \Illuminate\Support\Str::limit($country->language, 60) }}
                        </td>
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
                        <td>{{ number_format($country->latitude,2) }}</td>
                    </tr>

                    <tr>
                        <th>Longitude</th>
                        <td>{{ number_format($country->longitude,2) }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card shadow">

            <div class="card-header bg-success text-white">
                Description
            </div>

            <div class="card-body">

                <p>
                    Halaman <strong>Countries</strong> digunakan sebagai
                    master data negara yang digunakan oleh sistem Global
                    Supply Chain Risk Intelligence Platform.
                </p>

                <p>
                    Informasi pada halaman ini meliputi nama negara,
                    ibu kota, mata uang, bahasa, wilayah, populasi,
                    serta koordinat geografis.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection