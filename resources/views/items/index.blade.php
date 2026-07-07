<!DOCTYPE html>
<html>
<head>
    <title>Data Item</title>
</head>
<body>

    <h1>Data Item</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Berat</th>
            <th>Harga</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>

        @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->weight }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->supplier }}</td>
            <td>
                <a href="{{ route('items.edit', $item->id) }}">Edit</a>
                
                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus item ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

</body>
</html>