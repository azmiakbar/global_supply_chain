@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">✏️ Edit Pelabuhan</h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('admin.ports.update',$port->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Negara</label>

                    <select name="country_id" class="form-control">

                        @foreach($countries as $country)

                            <option value="{{ $country->id }}"
                                {{ $country->id==$port->country_id ? 'selected' : '' }}>

                                {{ $country->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Kode</label>

                    <input type="text"
                           name="code"
                           value="{{ $port->code }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Nama Pelabuhan</label>

                    <input type="text"
                           name="name"
                           value="{{ $port->name }}"
                           class="form-control">

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label>Latitude</label>

                        <input type="text"
                               name="latitude"
                               value="{{ $port->latitude }}"
                               class="form-control">

                    </div>

                    <div class="col-md-6">

                        <label>Longitude</label>

                        <input type="text"
                               name="longitude"
                               value="{{ $port->longitude }}"
                               class="form-control">

                    </div>

                </div>

                <br>

                <div class="mb-3">

                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="Active"
                            {{ $port->status=='Active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="Inactive"
                            {{ $port->status=='Inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Transport</label>

                    <select name="transport_type" class="form-control">

                        <option value="Sea"
                            {{ $port->transport_type=='Sea' ? 'selected' : '' }}>
                            Sea
                        </option>

                    </select>

                </div>

                <button class="btn btn-primary">

                    Update

                </button>

                <a href="{{ route('admin.ports.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection