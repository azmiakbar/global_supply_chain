<!DOCTYPE html>
<html>
<head>
    <title>Tambah Shipment</title>
</head>
<body>

<h1>Tambah Shipment</h1>

<form action="{{ route('shipments.store') }}" method="POST">

    @csrf

    <p>
        <label>Item</label><br>

        <select name="item_id" required>

            <option value="">-- Pilih Item --</option>

            @foreach($items as $item)
                <option value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
            @endforeach

        </select>
    </p>


    <p>
        <label>Origin Country</label><br>

        <select id="origin_country" name="origin_country_id" required>

            <option value="">-- Pilih Negara Asal --</option>

            @foreach($countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
            @endforeach

        </select>
    </p>


    <p>
        <label>Origin Port</label><br>

        <select id="origin_port" name="origin_port_id" required>

            <option value="">
                -- Pilih Negara Asal Terlebih Dahulu --
            </option>

        </select>
    </p>


    <p>
        <label>Destination Country</label><br>

        <select id="destination_country" name="destination_country_id" required>

            <option value="">-- Pilih Negara Tujuan --</option>

            @foreach($countries as $country)
                <option value="{{ $country->id }}">
                    {{ $country->name }}
                </option>
            @endforeach

        </select>
    </p>


    <p>
        <label>Destination Port</label><br>

        <select id="destination_port" name="destination_port_id" required>

            <option value="">
                -- Pilih Negara Tujuan Terlebih Dahulu --
            </option>

        </select>
    </p>


    <p>
        <label>Quantity</label><br>
        <input type="number" name="quantity" min="1" required>
    </p>


    <p>
        <label>Transport Type</label><br>

        <select name="transport_type" required>
            <option value="Sea">Sea</option>
            <option value="Air">Air</option>
            <option value="Land">Land</option>
        </select>
    </p>


    <p>
        <label>Departure Date</label><br>
        <input type="date" name="departure_date" required>
    </p>


    <p>
        <label>Estimated Arrival</label><br>
        <input type="date" name="estimated_arrival" required>
    </p>


    <p>
        <label>Status</label><br>

        <select name="status" required>
            <option value="Pending">Pending</option>
            <option value="In Transit">In Transit</option>
            <option value="Delivered">Delivered</option>
        </select>
    </p>


    <button type="submit">
        Simpan Shipment
    </button>

</form>


<br>

<a href="{{ route('shipments.index') }}">
    ← Kembali
</a>


<script>

async function loadPorts(countryId, targetId)
{
    if(countryId == "")
    {
        document.getElementById(targetId).innerHTML =
        '<option value="">-- Pilih Negara Terlebih Dahulu --</option>';

        return;
    }

    const response = await fetch('/ports/' + countryId);

    const ports = await response.json();

    let html = '<option value="">-- Pilih Port --</option>';

    ports.forEach(function(port){

        html += `<option value="${port.id}">
                    ${port.name}
                 </option>`;

    });

    document.getElementById(targetId).innerHTML = html;
}


document.getElementById('origin_country')
.addEventListener('change', function(){

    loadPorts(this.value,'origin_port');

});


document.getElementById('destination_country')
.addEventListener('change', function(){

    loadPorts(this.value,'destination_port');

});

</script>

</body>
</html>