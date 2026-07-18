@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📦 Data Item (Commodities)</h2>
    <a href="{{ route('items.create') }}" class="btn btn-primary fw-bold">
        <i class="bi bi-plus-lg"></i> Tambah Item
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow border-0">
    <div class="card-header bg-primary text-white fw-bold">
        Daftar Item / Komoditas Kargo
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Berat (kg)</th>
                        <th>Harga (USD)</th>
                        <th>Supplier</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $item->id }}</td>
                        <td class="fw-bold">{{ $item->name }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $item->category }}</span>
                        </td>
                        <td>{{ number_format($item->weight, 2) }} kg</td>
                        <td class="fw-bold text-success">${{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->supplier }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus item ini?')">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection