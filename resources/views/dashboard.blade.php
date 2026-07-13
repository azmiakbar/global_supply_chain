@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    🌍 Global Supply Chain Risk Intelligence Platform
</h2>

<div class="row">

    <div class="col-md-3 mb-3">

        <div class="card shadow">

            <div class="card-body">

                <h5>Total Countries</h5>

                <h2>{{ $totalCountries }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card shadow">

            <div class="card-body">

                <h5>Total Ports</h5>

                <h2>{{ number_format($totalPorts) }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card shadow">

            <div class="card-body">

                <h5>Total Items</h5>

                <h2>{{ $totalItems }}</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card shadow">

            <div class="card-body">

                <h5>Total Shipments</h5>

                <h2>{{ $totalShipments }}</h2>

            </div>

        </div>

    </div>

</div>

<hr>

<h4>Risk Summary</h4>

<div class="row">

    <div class="col-md-4">

        <div class="alert alert-success">

            Low Risk : <strong>{{ $lowRisk }}</strong>

        </div>

    </div>

    <div class="col-md-4">

        <div class="alert alert-warning">

            Medium Risk : <strong>{{ $mediumRisk }}</strong>

        </div>

    </div>

    <div class="col-md-4">

        <div class="alert alert-danger">

            High Risk : <strong>{{ $highRisk }}</strong>

        </div>

    </div>

</div>

<hr>

<div class="row">

    <div class="col-md-6 mb-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">

                📊 Risk Distribution

            </div>

            <div class="card-body">

                <canvas id="riskChart"></canvas>

            </div>

        </div>

    </div>

    <div class="col-md-6 mb-4">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                🚢 Shipment Status

            </div>

            <div class="card-body">

                <canvas id="statusChart"></canvas>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script id="dashboard-data"
    type="application/json">
{
    "lowRisk": {{ $lowRisk }},
    "mediumRisk": {{ $mediumRisk }},
    "highRisk": {{ $highRisk }},
    "pending": {{ $pending }},
    "inTransit": {{ $inTransit }},
    "delivered": {{ $delivered }}
}
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const data = JSON.parse(
        document.getElementById('dashboard-data').textContent
    );

    new Chart(document.getElementById('riskChart'), {
        type: 'pie',
        data: {
            labels: ['Low', 'Medium', 'High'],
            datasets: [{
                data: [
                    data.lowRisk,
                    data.mediumRisk,
                    data.highRisk
                ]
            }]
        }
    });

    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: [
                'Pending',
                'In Transit',
                'Delivered'
            ],
            datasets: [{
                data: [
                    data.pending,
                    data.inTransit,
                    data.delivered
                ]
            }]
        }
    });

});

</script>

@endpush