@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    🌍 Global Supply Chain Risk Intelligence Platform
</h2>

<div class="row g-4">

    <div class="col-md-3">

        <div class="card border-0 shadow-lg bg-primary text-white">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small>Total Countries</small>

                        <h2 class="fw-bold">

                            {{ $totalCountries }}

                        </h2>

                    </div>

                    <div style="font-size:55px">

                        🌍

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-lg bg-success text-white">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small>Total Sea Ports</small>

                        <h2 class="fw-bold">

                            {{ number_format($totalPorts) }}

                        </h2>

                    </div>

                    <div style="font-size:55px">

                        🚢

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-lg bg-warning text-dark">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small>Total Shipments</small>

                        <h2 class="fw-bold">

                            {{ $totalShipments }}

                        </h2>

                    </div>

                    <div style="font-size:55px">

                        📦

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-lg bg-danger text-white">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small>High Risk</small>

                        <h2 class="fw-bold">

                            {{ $highRisk }}

                        </h2>

                    </div>

                    <div style="font-size:55px">

                        ⚠️

                    </div>

                </div>

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