@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>📰 Kelola Artikel</h2>

    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
        + Tambah Artikel
    </a>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th width="60">ID</th>

                    <th>Judul</th>

                    <th>Kategori</th>

                    <th>Status</th>

                    <th>Penulis</th>

                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($articles as $article)

                <tr>

                    <td>{{ $article->id }}</td>

                    <td>{{ $article->title }}</td>

                    <td>{{ $article->category }}</td>

                    <td>

                        @if($article->status=="Published")

                            <span class="badge bg-success">

                                Published

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                Draft

                            </span>

                        @endif

                    </td>

                    <td>

                        {{ $article->user->name ?? '-' }}

                    </td>

                    <td>

                        <a href="{{ route('admin.articles.edit',$article) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('admin.articles.destroy',$article) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus artikel ini?')">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        Belum ada artikel.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection