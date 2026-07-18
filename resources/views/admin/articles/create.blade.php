@extends('layouts.app')

@section('content')

<h2 class="mb-4">

    Tambah Artikel

</h2>

@if($errors->any())

<div class="alert alert-danger">

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('admin.articles.store') }}" method="POST">

@csrf

<div class="card shadow">

<div class="card-body">

<div class="mb-3">

<label>Judul</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kategori</label>

<input
type="text"
name="category"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Isi Artikel</label>

<textarea
name="content"
rows="8"
class="form-control"
required></textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-control">

<option value="Draft">

Draft

</option>

<option value="Published">

Published

</option>

</select>

</div>

<button class="btn btn-success">

Simpan

</button>

<a
href="{{ route('admin.articles.index') }}"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</form>

@endsection