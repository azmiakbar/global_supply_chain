@extends('layouts.app')

@section('content')

<h2>Create Article</h2>

<form
    action="{{ route('articles.store') }}"
    method="POST"
    enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Title</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Author</label>

<input
type="text"
name="author"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Image</label>

<input
type="file"
name="image"
class="form-control">

</div>

<div class="mb-3">

<label>Content</label>

<textarea
name="content"
rows="8"
class="form-control"
required></textarea>

</div>

<div class="form-check mb-3">

<input
class="form-check-input"
type="checkbox"
name="published"
checked>

<label class="form-check-label">

Published

</label>

</div>

<button class="btn btn-primary">

Save Article

</button>

<a
href="{{ route('articles.index') }}"
class="btn btn-secondary">

Back

</a>

</form>

@endsection