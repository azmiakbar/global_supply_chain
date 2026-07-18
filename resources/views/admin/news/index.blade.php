@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">Monitoring Berita Otomatis</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">

        <thead>

        <tr>

            <th>Tanggal</th>
            <th>Negara / Keyword</th>
            <th>Sumber</th>
            <th>Judul</th>
            <th>Sentimen</th>
            <th>Aksi</th>

        </tr>

        </thead>

        <tbody>

        @foreach($news as $item)

            <tr>

                <td>{{ \Carbon\Carbon::parse($item->published_at)->format('d-m-Y') }}</td>

                <td>{{ $item->country }}</td>

                <td>{{ $item->source }}</td>

                <td>{{ $item->title }}</td>

                <td>

                    @if($item->sentiment=='Positif')

                        <span class="badge bg-success">Positif</span>

                    @elseif($item->sentiment=='Negatif')

                        <span class="badge bg-danger">Negatif</span>

                    @else

                        <span class="badge bg-warning text-dark">Netral</span>

                    @endif

                </td>

                <td>

                    <form action="{{ route('admin.news-analysis.destroy',$item) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    {{ $news->links() }}

</div>

@endsection