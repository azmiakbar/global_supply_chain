<!DOCTYPE html>
<html>
<head>
    <title>Data Shipment</title>
</head>
<body>

<h1>Data Shipment</h1>

<a href="{{ route('shipments.create') }}">+ Tambah Shipment</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Origin Country</th>
        <th>Destination Country</th>
        <th>Status</th>
        <th>Risk Level</th>
    </tr>

    @forelse($shipments as $shipment)

    <tr>
        <td>{{ $shipment->id }}</td>

        <td>{{ $shipment->item->name }}</td>

        <td>{{ $shipment->originCountry->name }}</td>

        <td>{{ $shipment->destinationCountry->name }}</td>

        <td>{{ $shipment->status }}</td>

        <td>{{ $shipment->risk_level }}</td>
    </tr>

    @empty

    <tr>
        <td colspan="6">
            Belum ada data shipment.
        </td>
    </tr>

    @endforelse

</table>

</body>
</html>