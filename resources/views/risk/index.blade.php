@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>⚠ Risk Monitoring</h2>

</div>

<div class="card shadow">

    <div class="card-header bg-danger text-white">

        Monitoring Seluruh Negara

    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>Negara</th>
                    <th>Currency</th>
                    <th>Region</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @foreach($countries as $country)

                <tr>

                    <td>{{ $country->name }}</td>

                    <td>{{ $country->currency }}</td>

                    <td>{{ $country->region }}</td>

                    <td>

                        <a href="{{ route('risk.show',$country) }}"
                            class="btn btn-danger btn-sm">
                        
                            Monitor Risk
                        </a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        {{ $countries->links() }}

    </div>

</div>

@endsection