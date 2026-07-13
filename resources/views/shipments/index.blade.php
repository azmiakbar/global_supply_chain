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

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Item</th>

                    <th>Origin</th>

                    <th>Destination</th>

                    <th>Transport</th>

                    <th>Qty</th>

                    <th>Departure</th>

                    <th>ETA</th>

                    <th>Status</th>

                    <th>Risk</th>

                </tr>

                </thead>

                <tbody>

                @forelse($shipments as $shipment)

                <tr>

                    <td>{{ $shipment->id }}</td>

                    <td>{{ $shipment->item->name }}</td>

                    <td>
                        {{ $shipment->originCountry->name }}
                        <br>
                        <small class="text-muted">
                            {{ $shipment->originPort->name }}
                        </small>
                    </td>

                    <td>
                        {{ $shipment->destinationCountry->name }}
                        <br>
                        <small class="text-muted">
                            {{ $shipment->destinationPort->name }}
                        </small>
                    </td>

                    <td>

                        @if($shipment->transport_type=="Sea")

                            🚢 Sea

                        @elseif($shipment->transport_type=="Air")

                            ✈ Air

                        @else

                            🚛 Land

                        @endif

                    </td>

                    <td>{{ $shipment->quantity }}</td>

                    <td>{{ $shipment->departure_date }}</td>

                    <td>{{ $shipment->estimated_arrival }}</td>

                    <td>

                        @if($shipment->status=="Pending")

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @elseif($shipment->status=="In Transit")

                            <span class="badge bg-info">
                                In Transit
                            </span>

                        @else

                            <span class="badge bg-success">
                                Delivered
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($shipment->risk_level=="Low")

                            <span class="badge bg-success">
                                Low ({{ $shipment->risk_score }})
                            </span>

                        @elseif($shipment->risk_level=="Medium")

                            <span class="badge bg-warning text-dark">
                                Medium ({{ $shipment->risk_score }})
                            </span>

                        @else

                            <span class="badge bg-danger">
                                High ({{ $shipment->risk_score }})
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="10" class="text-center">

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