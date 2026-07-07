<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
</head>
<body>

<h1>Edit Item</h1>

<form action="{{ route('items.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        <label>Nama Barang</label><br>
        <input type="text" name="name" value="{{ $item->name }}">
    </p>

    <p>
        <label>Kategori</label><br>
        <input type="text" name="category" value="{{ $item->category }}">
    </p>

    <p>
        <label>Berat (kg)</label><br>
        <input type="number" step="0.01" name="weight" value="{{ $item->weight }}">
    </p>

    <p>
        <label>Harga</label><br>
        <input type="number" name="price" value="{{ $item->price }}">
    </p>

    <p>
        <label>Supplier</label><br>
        <input type="text" name="supplier" value="{{ $item->supplier }}">
    </p>

    <button type="submit">Update</button>

</form>

<br>

<a href="{{ route('items.index') }}">← Kembali</a>

</body>
</html>