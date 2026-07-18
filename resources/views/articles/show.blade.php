@extends('layouts.app')

@section('content')

<div class="card shadow">

<div class="card-body">

<h2>

{{ $article->title }}

</h2>

<p>

<b>Author :</b>

{{ $article->author }}

</p>

@if($article->image)

<img
src="{{ asset('articles/'.$article->image) }}"
class="img-fluid mb-4">

@endif

<div>

{!! nl2br(e($article->content)) !!}

</div>

<a
href="{{ route('articles.index') }}"
class="btn btn-primary mt-4">

Back

</a>

</div>

</div>

@endsection