@extends('layouts.app_public')

@section('content')
    @include('public.posts.search')
    @php
        $sections = [
            'posts_sc' => 'Source Code ',
            'posts_tutor' => 'Tutorial ',
            'posts_artikel' => 'Artikel',
            'posts_tipstriks' => 'Tips & Tricks',
            'posts_berita' => 'Berita',
        ];
    @endphp

    @foreach ($sections as $key => $title)
        @if (isset($$key) && $$key->count())
            <div class="py-2 mt-2">
                <h5 class="fw-bold text-uppercase text-dark">{{ $title }}</h5>
            </div>

            <div class="row g-3">
                @foreach ($$key as $post)
                    @include('public._card', ['post' => $post])
                @endforeach
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('posts.kategori', \Str::slug(str_replace('Populer', '', $title))) }}"
                    class="btn btn-sm btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-right me-1"></i> Lihat Semua {{ $title }}
                </a>
            </div>
        @endif
    @endforeach
@endsection
