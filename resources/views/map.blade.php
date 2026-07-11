@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    🗺 Global Risk Map
</h2>

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        Global Supply Chain Monitoring
    </div>

    <div class="card-body">

        <div id="map" style="height:700px;"></div>

    </div>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener("DOMContentLoaded", function () {

    //-------------------------------------------------
    // Membuat Map
    //-------------------------------------------------

    const map = L.map('map', {
        worldCopyJump: true,
        maxBounds: [
            [-85, -180],
            [85, 180]
        ],
        maxBoundsViscosity: 1.0,
        minZoom: 2
    });

    //-------------------------------------------------
    // OpenStreetMap
    //-------------------------------------------------

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    //-------------------------------------------------
    // Data Shipment
    //-------------------------------------------------

    const shipments = JSON.parse('@json($shipments)');

    const bounds = [];

    shipments.forEach(function(shipment){

        if(
            shipment.origin_country &&
            shipment.destination_country
        ){

            const origin = [
                parseFloat(shipment.origin_country.latitude),
                parseFloat(shipment.origin_country.longitude)
            ];

            const destination = [
                parseFloat(shipment.destination_country.latitude),
                parseFloat(shipment.destination_country.longitude)
            ];

            bounds.push(origin);
            bounds.push(destination);

            //---------------------------------------------
            // Marker Origin
            //---------------------------------------------

            L.circleMarker(origin,{
                radius:8,
                color:"green",
                fillColor:"green",
                fillOpacity:1
            })
            .addTo(map)
            .bindTooltip(
                shipment.origin_country.name,
                {
                    permanent:true,
                    direction:"top"
                }
            );

            //---------------------------------------------
            // Marker Destination
            //---------------------------------------------

            L.circleMarker(destination,{
                radius:8,
                color:"red",
                fillColor:"red",
                fillOpacity:1
            })
            .addTo(map)
            .bindTooltip(
                shipment.destination_country.name,
                {
                    permanent:true,
                    direction:"top"
                }
            );

            //---------------------------------------------
            // Warna Risk
            //---------------------------------------------

            let color = "green";

            if(shipment.risk_level === "Medium"){
                color = "orange";
            }

            if(shipment.risk_level === "High"){
                color = "red";
            }

            //---------------------------------------------
            // Garis Shipment
            //---------------------------------------------

            L.polyline(
                [origin, destination],
                {
                    color: color,
                    weight: 6,
                    opacity: 0.8
                }
            )
            .addTo(map)
            .bindPopup(`
                <div style="min-width:250px">

                    <h4>📦 Shipment #${shipment.id}</h4>

                    <hr>

                    <p>
                        <b>🚢 Transport</b><br>
                        ${shipment.transport_type}
                    </p>

                    <p>
                        <b>📍 Origin</b><br>
                        ${shipment.origin_country.name}
                    </p>

                    <p>
                        <b>🏁 Destination</b><br>
                        ${shipment.destination_country.name}
                    </p>

                    <p>
                        <b>📅 ETA</b><br>
                        ${shipment.estimated_arrival}
                    </p>

                    <p>
                        <b>📦 Status</b><br>
                        ${shipment.status}
                    </p>

                    <p>
                        <b>⚠ Risk</b><br>
                        ${shipment.risk_level} (${shipment.risk_score})
                    </p>

                </div>
            `);

        }

    });

    //-------------------------------------------------
    // Zoom Otomatis
    //-------------------------------------------------

    if(bounds.length > 0){

        map.fitBounds(bounds,{
            padding:[100,100],
            maxZoom:5
        });

    }else{

        map.setView([-2,118],4);

    }

    //-------------------------------------------------
    // Batas Dunia
    //-------------------------------------------------

    map.setMaxBounds([
        [-85,-180],
        [85,180]
    ]);

    //-------------------------------------------------
    // Refresh Map
    //-------------------------------------------------

    setTimeout(function(){

        map.invalidateSize();

    },300);

});

</script>

@endpush