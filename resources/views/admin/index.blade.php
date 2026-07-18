@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    👨‍💼 Admin Dashboard
</h2>

<div class="row">

    <div class="col-md-4 mb-4">

        <div class="card shadow border-primary">

            <div class="card-body text-center">

                <h2>{{ $users }}</h2>

                <h5>👤 Kelola User</h5>

                <p class="text-muted">
                    Manajemen akun pengguna sistem.
                </p>

                <a href="{{ route('users.index') }}"class="btn btn-primary">

                    Kelola User

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-4">

        <div class="card shadow border-success">

            <div class="card-body text-center">

                <h2>{{ $ports }}</h2>

                <h5>⚓ Dataset Pelabuhan</h5>

                <p class="text-muted">
                    Kelola data pelabuhan dunia.
                </p>

                <a href="{{ route('admin.ports.index') }}" class="btn btn-success">
                    Kelola Pelabuhan
                </a>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-4">

        <div class="card shadow border-warning">

            <div class="card-body text-center">

                <h2>{{ $news }}</h2>

                <h5>📝 Artikel Analisis</h5>

                <p class="text-muted">
                    Analisis berita supply chain.
                </p>

                <a href="{{ route('admin.news-analysis.index') }}"
                    class="btn btn-warning">

                    Monitoring Berita

                </a>

            </div>

        </div>

    </div>

</div>

<hr>

<div class="row">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-body">

                <h5>📊 Informasi Sistem</h5>

                <table class="table">

                    <tr>
                        <td>Total Negara</td>
                        <td>{{ $countries }}</td>
                    </tr>

                    <tr>
                        <td>Total Shipment</td>
                        <td>{{ $shipments }}</td>
                    </tr>

                    <tr>
                        <td>Framework</td>
                        <td>Laravel 12</td>
                    </tr>

                    <tr>
                        <td>Database</td>
                        <td>MySQL</td>
                    </tr>

                    <tr>
                        <td>News API</td>
                        <td>GNews API</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection