@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    🌍 Countries
</h2>

<div class="card">

    <div class="card-body">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Flag</th>

                    <th>Country</th>

                    <th>Capital</th>

                    <th>Currency</th>

                    <th>Region</th>

                    <th></th>

                </tr>

            </thead>

            <tbody>

            @foreach($countries as $country)

                <tr>

                    <td>{{ $countries->firstItem() + $loop->index }}</td>

                    <td>
                        <img
                        src="https://flagcdn.com/48x36/{{ strtolower($country->code) }}.png"
                        alt="{{ $country->name }}"
                        width="40"
                        class="border rounded shadow-sm">
                    </td>

                    <td>{{ $country->name }}</td>

                    <td>{{ $country->capital }}</td>

                    <td>{{ $country->currency }}</td>

                    <td>{{ $country->region }}</td>

                    <td>

                        <a href="{{ route('countries.show',$country) }}"
                           class="btn btn-primary btn-sm">

                            Monitoring

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