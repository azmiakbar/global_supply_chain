@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    💱 Currency Dashboard
</h2>

<div class="row mb-4">

    <div class="col-md-4">

        <div class="card border-primary shadow">

            <div class="card-body text-center">

                <h6>Total Currency</h6>

                <h2>{{ $totalCurrencies }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card border-success shadow">

            <div class="card-body text-center">

                <h6>Highest Exchange Rate</h6>

                @if($highest)
                    <h5>{{ $highest['country'] }}</h5>
                    <strong>{{ number_format($highest['rate'],2) }}</strong>
                @endif

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card border-danger shadow">

            <div class="card-body text-center">

                <h6>Lowest Exchange Rate</h6>

                @if($lowest)
                    <h5>{{ $lowest['country'] }}</h5>
                    <strong>{{ number_format($lowest['rate'],2) }}</strong>
                @endif

            </div>

        </div>

    </div>

</div>

{{-- CURRENCY TREND CHART --}}
<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white fw-bold">
        📈 Currency Trends (Last 7 Days against USD)
    </div>
    <div class="card-body">
        <div style="height: 320px; position: relative;">
            <canvas id="currencyTrendChart"></canvas>
        </div>
    </div>
</div>

<div class="card shadow">

    <div class="card-header bg-warning">

        Currency Monitoring

    </div>

    <div class="card-body">

        <table class="table table-hover table-bordered">

            <thead class="table-light">

                <tr>

                    <th>No</th>

                    <th>Country</th>

                    <th>Currency</th>

                    <th>Exchange Rate</th>

                    <th>Last Update</th>

                </tr>

            </thead>

            <tbody>

            @foreach($currencies as $currency)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $currency['country'] }}</td>

                    <td>{{ $currency['currency'] }}</td>

                    <td>

                        <strong>

                            1 USD = {{ number_format($currency['rate'],2) }}

                            {{ $currency['currency'] }}

                        </strong>

                    </td>

                    <td>{{ $currency['updated'] }}</td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const trendData = JSON.parse('@json($trendData)');
    
    new Chart(document.getElementById('currencyTrendChart'), {
        type: 'line',
        data: {
            labels: trendData.labels,
            datasets: [
                {
                    label: 'EUR (Euro)',
                    data: trendData.EUR,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    tension: 0.2,
                    yAxisID: 'y'
                },
                {
                    label: 'GBP (British Pound)',
                    data: trendData.GBP,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.2,
                    yAxisID: 'y'
                },
                {
                    label: 'JPY (Japanese Yen)',
                    data: trendData.JPY,
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    tension: 0.2,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Kurs EUR & GBP'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false
                    },
                    title: {
                        display: true,
                        text: 'Kurs JPY (Yen)'
                    }
                }
            }
        }
    });
});
</script>
@endpush

@endsection