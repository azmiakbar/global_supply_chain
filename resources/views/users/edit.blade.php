@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">✏️ Edit User</h2>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('users.update',$user->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Nama</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$user->name) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$user->email) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Password Baru (Kosongkan jika tidak diubah)</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control">

                </div>

                <button class="btn btn-primary">

                    Update

                </button>

                <a href="{{ route('users.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection