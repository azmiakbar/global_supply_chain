@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-4">

<h2>

📰 {{ $country->name }} News

</h2>

<a href="{{ route('news.index') }}"
class="btn btn-secondary">

← Back

</a>

</div>

@forelse($news as $article)

<div class="card shadow mb-4">

<div class="card-body">

<h4>

{{ $article['title'] }}

</h4>

<p>

{{ $article['description'] }}

</p>

<a href="{{ $article['url'] }}"
target="_blank"
class="btn btn-primary">

Read More

</a>

</div>

</div>

@empty

<div class="alert alert-warning">

No News Available

</div>

@endforelse

@endsection