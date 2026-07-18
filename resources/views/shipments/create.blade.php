@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        🚢 Tambah Shipment
    </h2>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            Informasi Shipment
        </div>

        <div class="card-body">

            <form action="{{ route('shipments.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Item
                        </label>

                        <select
                            name="item_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Pilih Item --
                            </option>

                            @foreach($items as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Quantity
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            name="quantity"
                            min="1"
                            required>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Origin Country
                        </label>

                        <select
                            id="origin_country"
                            name="origin_country_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Pilih Negara Asal --
                            </option>

                            @foreach($countries as $country)

                                <option value="{{ $country->id }}">
                                    {{ $country->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Origin Port
                        </label>

                        <select
                            id="origin_port"
                            name="origin_port_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Pilih Negara Asal --
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Destination Country
                        </label>

                        <select
                            id="destination_country"
                            name="destination_country_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Pilih Negara Tujuan --
                            </option>

                            @foreach($countries as $country)

                                <option value="{{ $country->id }}">
                                    {{ $country->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Destination Port
                        </label>

                        <select
                            id="destination_port"
                            name="destination_port_id"
                            class="form-select"
                            required>

                            <option value="">
                                -- Pilih Negara Tujuan --
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Departure Date
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="departure_date"
                            required>

                    </div>

                </div>

                <hr>

                <button
                    type="submit"
                    class="btn btn-success">

                    💾 Simpan Shipment

                </button>

                <a
                    href="{{ route('shipments.index') }}"
                    class="btn btn-secondary">

                    ← Kembali

                </a>

            </form>

        </div>

    </div>

</div>


<script>

async function loadPorts(countryId, targetId)
{
    if(countryId=="")
    {
        document.getElementById(targetId).innerHTML =
        '<option value="">-- Pilih Negara Terlebih Dahulu --</option>';

        return;
    }

    const response = await fetch('/ports/'+countryId);

    const ports = await response.json();

    let html='<option value="">-- Pilih Pelabuhan --</option>';

    ports.forEach(function(port){

        html += `
            <option value="${port.id}">
                ${port.name}
            </option>
        `;

    });

    document.getElementById(targetId).innerHTML=html;
}

document.getElementById('origin_country')
.addEventListener('change',function(){

    loadPorts(this.value,'origin_port');

});

document.getElementById('destination_country')
.addEventListener('change',function(){

    loadPorts(this.value,'destination_port');

});

</script>

@endsection