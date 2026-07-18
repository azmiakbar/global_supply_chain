@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-4">

    <h2>📰 Article Management</h2>

    <a href="{{ route('articles.create') }}" class="btn btn-primary">
        + Create Article
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

            <thead>

            <tr>

                <th>No</th>

                <th>Title</th>

                <th>Author</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($articles as $article)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $article->title }}</td>

                <td>{{ $article->author }}</td>

                <td>

                    @if($article->published)

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

                    <a href="{{ route('articles.show',$article) }}"
                       class="btn btn-info btn-sm">

                        View

                    </a>

                    <a href="{{ route('articles.edit',$article) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form
                        action="{{ route('articles.destroy',$article) }}"
                        method="POST"
                        style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Delete article?')"
                            class="btn btn-danger btn-sm">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5" class="text-center">

                    No Articles

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        {{ $articles->links() }}

    </div>

</div>

@endsection