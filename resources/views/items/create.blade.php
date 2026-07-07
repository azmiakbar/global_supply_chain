<!DOCTYPE html>
<html>
<head>
    <title>Tambah Item</title>
</head>
<body>

<h1>Tambah Item</h1>

<form action="{{ route('items.store') }}" method="POST">
    @csrf

    <p>
        <label>Nama Barang</label><br>
        <input type="text" name="name">
    </p>

    <p>
        <label>Kategori</label><br>
        <input type="text" name="category">
    </p>

    <p>
        <label>Berat (kg)</label><br>
        <input type="number" step="0.01" name="weight">
    </p>

    <p>
        <label>Harga</label><br>
        <input type="number" name="price">
    </p>

    <p>
        <label>Supplier</label><br>
        <input type="text" name="supplier">
    </p>

    <button type="submit">Simpan</button>

</form>

<br>

<a href="{{ route('items.index') }}">← Kembali ke Data Item</a>

</body>
</html>