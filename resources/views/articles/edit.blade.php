@extends('layouts.app')

@section('content')

<h2>Edit Article</h2>

<form
action="{{ route('articles.update',$article) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="mb-3">

<label>Title</label>

<input
type="text"
name="title"
value="{{ $article->title }}"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Author</label>

<input
type="text"
name="author"
value="{{ $article->author }}"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Image</label>

<input
type="file"
name="image"
class="form-control">

@if($article->image)

<img
src="{{ asset('articles/'.$article->image) }}"
width="200"
class="mt-2">

@endif

</div>

<div class="mb-3">

<label>Content</label>

<textarea
name="content"
rows="8"
class="form-control"
required>{{ $article->content }}</textarea>

</div>

<div class="form-check mb-3">

<input
class="form-check-input"
type="checkbox"
name="published"
{{ $article->published ? 'checked' : '' }}>

<label>

Published

</label>

</div>

<button class="btn btn-success">

Update

</button>

<a
href="{{ route('articles.index') }}"
class="btn btn-secondary">

Back

</a>

</form>

@endsection