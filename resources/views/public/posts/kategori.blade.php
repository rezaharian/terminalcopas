@extends('layouts.app_public')

@section('content')
    <div class="container">
        {{-- Judul Kategori --}}

        <div class="text-center py-4">
            <h3 class="fw-bold text-uppercase text-dark">
                Kategori: {{ $category->name }}
            </h3>
            <p class="text-muted small">Menampilkan semua postingan di kategori ini.</p>
        </div>
        @include('public.posts.search')

        {{-- Daftar Post --}}
        @if ($posts->count())
            <div class="row g-3">
                @foreach ($posts as $post)
                    @include('public._card', ['post' => $post])
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center text-muted my-5">
                <p>Belum ada post dalam kategori ini.</p>
            </div>
        @endif
    </div>
@endsection
