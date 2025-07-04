@extends('layouts.app_public')

@section('content')
    @include('public.posts.search')

    @foreach ($categories as $category)
        @php
            $key = 'posts_' . $category->slug;
        @endphp

        @if (!empty($posts[$key]) && $posts[$key]->count())
            <div class="py-2 mt-2">
                <h5 class="fw-bold text-uppercase text-dark">{{ $category->name }}</h5>
            </div>

            <div class="row g-3">
                @foreach ($posts[$key] as $post)
                    @include('public._card', ['post' => $post])
                @endforeach
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('posts.kategori', $category->slug) }}"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-right me-1"></i> Lihat Semua {{ $category->name }}
                </a>
            </div>
        @endif
    @endforeach
@endsection
