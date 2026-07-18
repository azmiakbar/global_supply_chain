@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        📰 Global Supply Chain News Intelligence
    </h2>

    <div class="alert alert-info shadow-sm">
        Latest international news related to logistics, shipping, ports,
        trade, oil, and global supply chain.
    </div>

    <div class="row">

        @forelse($allNews as $article)

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card shadow h-100 border-0">

                {{-- GAMBAR BERITA --}}

                @if(!empty($article['image']))

                    <img
                        src="{{ $article['image'] }}"
                        class="card-img-top"
                        style="height:220px; object-fit:cover;">

                @else

                    <img
                        src="https://placehold.co/600x350?text=Global+Supply+Chain"
                        class="card-img-top"
                        style="height:220px; object-fit:cover;">

                @endif


                <div class="card-body d-flex flex-column">

                    {{-- KATEGORI --}}

                    @if($article['category']=='Shipping')

                        <span class="badge bg-primary mb-2">
                            🚢 Shipping
                        </span>

                    @elseif($article['category']=='Trade')

                        <span class="badge bg-success mb-2">
                            🌍 Trade
                        </span>

                    @elseif($article['category']=='Oil')

                        <span class="badge bg-warning text-dark mb-2">
                            🛢 Oil
                        </span>

                    @elseif($article['category']=='Port')

                        <span class="badge bg-info text-dark mb-2">
                            ⚓ Port
                        </span>

                    @elseif($article['category']=='Logistics')

                        <span class="badge bg-secondary mb-2">
                            📦 Logistics
                        </span>

                    @else

                        <span class="badge bg-dark mb-2">
                            🌐 Supply Chain
                        </span>

                    @endif

                    {{-- JUDUL --}}

                    <h5 class="fw-bold">

                        {{ $article['title'] }}

                    </h5>

                    {{-- DESKRIPSI --}}

                    <p class="text-muted">

                        {{ $article['description'] }}

                    </p>

                    <hr>

                    {{-- SOURCE --}}

                    <small class="text-muted">

                        📰
                        <strong>

                            {{ $article['source'] }}

                        </strong>

                    </small>

                    {{-- TANGGAL --}}

                    <small class="text-muted mb-3">

                        📅

                        {{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y H:i') }}

                    </small>

                    <div class="mt-auto text-end">

                        <a
                            href="{{ $article['url'] }}"
                            target="_blank"
                            class="btn btn-primary">

                            Read More →

                        </a>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-warning text-center">

                No Global News Available.

            </div>

        </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $allNews->links() }}
    </div>

</div>

@endsection