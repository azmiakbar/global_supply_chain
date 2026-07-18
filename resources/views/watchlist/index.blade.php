@extends('layouts.app')

@section('content')

<h2 class="mb-4">

    ⭐ My Watchlist

</h2>

<div class="card shadow">

    <div class="card-header bg-warning">

        Saved Countries

    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Country</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

            @forelse($watchlists as $watch)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $watch->country->name }}</td>

                    <td>

                        <form action="{{ route('watchlist.destroy',$watch->country) }}"
                              method="POST">

                            @csrf

                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">

                                Remove

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3"
                        class="text-center">

                        Belum ada Watchlist.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection