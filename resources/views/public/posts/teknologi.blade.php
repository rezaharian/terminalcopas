@extends('layouts.app_public')

@section('content')
    @php
        $key = strtolower(str_replace(['.', ' '], '', $tech->name));
        $icons = [
            'codeigniter' => 'devicon-codeigniter-plain colored',
            'php' => 'devicon-php-plain colored',
            'html' => 'devicon-html5-plain colored',
            'css' => 'devicon-css3-plain colored',
            'vue' => 'devicon-vuejs-plain colored',
            'vuejs' => 'devicon-vuejs-plain colored',
            'vue.js' => 'devicon-vuejs-plain colored',
            'react' => 'devicon-react-original colored',
            'javascript' => 'devicon-javascript-plain colored',
            'laravel' => 'devicon-laravel-plain colored',
        ];
        $iconClass = $icons[$key] ?? 'fas fa-microchip text-secondary';
    @endphp

    <div class="py-3 mt-2">
        <h5 class="fw-bold text-uppercase text-dark mb-0 d-flex align-items-center gap-2">
            <i class="{{ $iconClass }}" style="font-size: 20px;"></i>
            Teknologi: {{ $tech->name }}
        </h5>
        <p class="text-muted small mb-0">Menampilkan postingan yang menggunakan teknologi ini</p>
    </div>


    @php
        $sections = [
            'posts_sc' => 'Source Code',
            'posts_tutor' => 'Tutorial',
            'posts_artikel' => 'Artikel',
            'posts_tipstriks' => 'Tips & Tricks',
            'posts_berita' => 'Berita',
        ];
    @endphp

    @foreach ($sections as $key => $title)
        @if (isset($posts[$key]) && $posts[$key]->count())
            <div class="py-2 mt-2">
                <h5 class="fw-bold text-uppercase text-dark">{{ $title }}</h5>
            </div>

            <div class="row g-3">
                @foreach ($posts[$key] as $post)
                    @include('public._card', ['post' => $post])
                @endforeach
            </div>
        @endif
    @endforeach
@endsection
