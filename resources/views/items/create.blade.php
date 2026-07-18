@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>➕ Tambah Item Baru</h2>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white fw-bold">
                Form Tambah Komoditas Kargo
            </div>
            <div class="card-body">
                <form action="{{ route('items.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Barang</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            placeholder="Contoh: Semiconductor Chips" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold">Kategori</label>
                        <input 
                            type="text" 
                            name="category" 
                            id="category" 
                            class="form-control" 
                            placeholder="Contoh: Elektronik" 
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label fw-bold">Berat (kg)</label>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="weight" 
                                id="weight" 
                                class="form-control" 
                                placeholder="Contoh: 0.05" 
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Harga (USD)</label>
                            <input 
                                type="number" 
                                name="price" 
                                id="price" 
                                class="form-control" 
                                placeholder="Contoh: 200" 
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="supplier" class="form-label fw-bold">Supplier</label>
                        <input 
                            type="text" 
                            name="supplier" 
                            id="supplier" 
                            class="form-control" 
                            placeholder="Contoh: TSMC" 
                            required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('items.index') }}" class="btn btn-light me-2">Batal</a>
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-save"></i> Simpan Item
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection