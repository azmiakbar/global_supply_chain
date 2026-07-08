<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Global Supply Chain Risk Intelligence Platform</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">

            🌍 Global Supply Chain

        </a>

    </div>

</nav>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 bg-white border-end vh-100 p-3">

            <h4 class="fw-bold">
                Menu
            </h4>

            <hr>

            <a class="d-block mb-3 text-decoration-none" href="{{ route('dashboard') }}">
                📊 Dashboard
            </a>

            <a class="d-block mb-3 text-decoration-none" href="{{ route('countries.index') }}">
                🌍 Countries
            </a>

            <a class="d-block mb-3 text-decoration-none" href="{{ route('shipments.index') }}">
                🚢 Shipments
            </a>

            <a class="d-block mb-3 text-decoration-none" href="{{ route('items.index') }}">
                📦 Items
            </a>

            <hr>

            <a class="d-block mb-3 text-decoration-none" href="#">
                ⚠ Risk Monitoring
            </a>

            <a class="d-block mb-3 text-decoration-none" href="#">
                📰 News
            </a>

            <a class="d-block mb-3 text-decoration-none" href="#">
                ⭐ Watchlist
            </a>

            <hr>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button class="btn btn-danger w-100">

                    Logout

                </button>

            </form>

        </div>

        <div class="col-md-10 p-4">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>