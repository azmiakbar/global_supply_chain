@extends('layouts.app')

@section('content')

<h2 class="mb-4">

Edit Artikel

</h2>

<form
action="{{ route('admin.articles.update',$article) }}"
method="POST">

@csrf
@method('PUT')

<div class="card shadow">

<div class="card-body">

<div class="mb-3">

<label>Judul</label>

<input
type="text"
name="title"
class="form-control"
value="{{ $article->title }}"
required>

</div>

<div class="mb-3">

<label>Kategori</label>

<input
type="text"
name="category"
class="form-control"
value="{{ $article->category }}"
required>

</div>

<div class="mb-3">

<label>Isi Artikel</label>

<textarea
name="content"
rows="8"
class="form-control"
required>{{ $article->content }}</textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-control">

<option
value="Draft"
{{ $article->status=='Draft'?'selected':'' }}>

Draft

</option>

<option
value="Published"
{{ $article->status=='Published'?'selected':'' }}>

Published

</option>

</select>

</div>

<button class="btn btn-primary">

Update

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