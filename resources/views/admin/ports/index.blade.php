@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>⚓ Dataset Pelabuhan</h2>

    <a href="{{ route('admin.ports.create') }}" class="btn btn-success">
        + Tambah Pelabuhan
    </a>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        Daftar Pelabuhan

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Negara</th>
                    <th>Kode</th>
                    <th>Nama Pelabuhan</th>
                    <th>Status</th>
                    <th>Transport</th>
                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($ports as $port)

                <tr>

                    <td>{{ $port->id }}</td>

                    <td>{{ $port->country->name ?? '-' }}</td>

                    <td>{{ $port->code }}</td>

                    <td>{{ $port->name }}</td>

                    <td>{{ $port->status }}</td>

                    <td>{{ $port->transport_type }}</td>

                    <td>

                        <a href="{{ route('admin.ports.edit',$port->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form action="{{ route('admin.ports.destroy',$port->id) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin ingin menghapus pelabuhan ini?')"
                                class="btn btn-danger btn-sm">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada data pelabuhan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $ports->links() }}

    </div>

</div>

@endsection