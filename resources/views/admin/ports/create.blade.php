@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">⚓ Tambah Pelabuhan</h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('admin.ports.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Negara</label>

                    <select name="country_id" class="form-control">

                        @foreach($countries as $country)

                            <option value="{{ $country->id }}">

                                {{ $country->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Kode Pelabuhan</label>

                    <input type="text"
                           name="code"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label>Nama Pelabuhan</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           required>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label>Latitude</label>

                        <input type="text"
                               name="latitude"
                               class="form-control"
                               required>

                    </div>

                    <div class="col-md-6">

                        <label>Longitude</label>

                        <input type="text"
                               name="longitude"
                               class="form-control"
                               required>

                    </div>

                </div>

                <br>

                <div class="mb-3">

                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Transport</label>

                    <select name="transport_type" class="form-control">

                        <option value="Sea">Sea</option>

                    </select>

                </div>

                <button class="btn btn-success">

                    Simpan

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