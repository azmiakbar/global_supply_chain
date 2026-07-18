@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    🚢 Data Shipment
</h2>

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <span>Daftar Shipment</span>

        <a href="{{ route('shipments.create') }}"
           class="btn btn-light btn-sm">

            + Tambah Shipment

        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle text-center">

                <thead class="table-dark align-middle">

                <tr>

                    <th>ID</th>

                    <th>Item</th>

                    <th>Origin</th>

                    <th>Destination</th>

                    <th>Transport</th>

                    <th>Qty</th>

                    <th>Departure</th>

                    <th>Base ETA</th>

                    <th>Delay</th>

                    <th>Final ETA</th>

                    <th>Status</th>

                    <th>Risk</th>

                    <th style="min-width:260px;">
                        Recommendation
                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($shipments as $shipment)

                <tr>

                    <td class="align-middle">
                        {{ $shipment->id }}
                    </td>

                    <td class="align-middle">
                        {{ $shipment->item->name }}
                    </td>

                    <td class="align-middle">

                        <strong>
                            {{ $shipment->originCountry->name }}
                        </strong>

                        <br>

                        <small class="text-muted">
                            {{ $shipment->originPort->name }}
                        </small>

                    </td>

                    <td class="align-middle">

                        <strong>
                            {{ $shipment->destinationCountry->name }}
                        </strong>

                        <br>

                        <small class="text-muted">
                            {{ $shipment->destinationPort->name }}
                        </small>

                    </td>

                    <td class="align-middle">

                        🚢 Sea

                    </td>

                    <td class="align-middle">

                        {{ $shipment->quantity }}

                    </td>

                    <td class="align-middle">

                        {{ $shipment->departure_date }}

                    </td>

                    <td class="align-middle">

                        {{ $shipment->estimated_days }} Days

                    </td>

                    <td class="align-middle">

                        @if($shipment->delay_days > 0)

                            <span class="badge bg-danger">

                                +{{ $shipment->delay_days }} Days

                            </span>

                        @else

                            <span class="badge bg-success">

                                No Delay

                            </span>

                        @endif

                    </td>

                    <td class="align-middle">

                        {{ $shipment->estimated_arrival }}

                    </td>

                    <td class="align-middle">

                        @if($shipment->current_status == "Pending")

                            <span class="badge bg-warning text-dark">

                                Pending

                            </span>

                        @elseif($shipment->current_status == "In Transit")

                            <span class="badge bg-info">

                                In Transit

                            </span>

                        @else

                            <span class="badge bg-success">

                                Delivered

                            </span>

                        @endif

                    </td>

                    <td class="align-middle">

                        @if($shipment->risk_level=="LOW")

                            <span class="badge bg-success">

                                Low ({{ $shipment->risk_score }})

                            </span>

                        @elseif($shipment->risk_level=="MEDIUM")

                            <span class="badge bg-warning text-dark">

                                Medium ({{ $shipment->risk_score }})

                            </span>

                        @else

                            <span class="badge bg-danger">

                                High ({{ $shipment->risk_score }})

                            </span>

                        @endif

                    </td>

                    <td class="align-middle">

                        <small>

                            {{ $shipment->latest_information }}

                        </small>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="13" class="text-center">

                        Belum ada data shipment.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection