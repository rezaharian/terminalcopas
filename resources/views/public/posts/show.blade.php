@extends('layouts.app_public')

@section('content')
    <div class="container py-4">
        {{-- Judul & Metadata --}}
        <div class="mb-1">
            <h4 class="fw-bold">{{ $post->title }}</h4>
            <div class="text-muted small">
                <i class="fas fa-user"></i> {{ $post->author->name ?? 'Anonim' }} |
                <i class="fas fa-calendar-alt"></i> {{ $post->created_at->translatedFormat('d M Y') }} |
                <i class="fas fa-folder-open"></i> {{ $post->category->name ?? '-' }}
            </div>
            <div class="mt-1">
                @foreach ($post->tags as $tag)
                    <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>

        {{-- Teknologi Digunakan --}}
        @if ($post->technologies->count())
            <div class="mb-2 ">
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($post->technologies as $tech)
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
                            $iconClass = $icons[$key] ?? null;
                        @endphp

                        <a href="{{ route('posts.teknologi', \Str::slug($tech->name)) }}"
                            class="badge d-inline-flex align-items-center gap-1 px-2 py-1 fw-normal text-decoration-none"
                            style="background: #f0f0f0; color: #222; font-size: 0.75rem;">
                            @if ($iconClass)
                                <i class="{{ $iconClass }}" style="font-size: 14px;"></i>
                            @else
                                <i class="fas fa-code text-secondary" style="font-size: 13px;"></i>
                            @endif
                            {{ $tech->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif




        {{-- Gambar Cover --}}
        @php
            $cover = $post->images->where('type', 'cover')->first();
        @endphp
        @if ($cover)
            <div class="mb-3">
                <img src="{{ $cover->url }}" class="img-fluid rounded shadow-sm w-100"
                    style="max-height: 300px; object-fit: cover;" alt="cover {{ $post->title }}">
            </div>
        @endif

        {{-- Deskripsi --}}
        <div class="mb-3 small text-secondary">
            <strong>Deskripsi:</strong>
            <p class="mb-0">{{ $post->description }}</p>
        </div>

        {{-- Konten --}}
        <div class="mb-4">
            <div class="border rounded p-3 bg-light small">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        {{-- Gambar Tambahan --}}
        @if ($post->images->where('type', 'internal')->count())
            <div class="mb-4">
                <strong class="small">Gambar Tambahan:</strong>
                <div class="row g-2 mt-1">
                    @foreach ($post->images->where('type', 'internal') as $img)
                        <div class="col-6 col-md-4">
                            <img src="{{ $img->url }}" class="img-fluid rounded shadow-sm border" alt="image">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Tombol Download & Kembali --}}
        <div class="d-flex gap-2 mb-4">
            @if ($post->url_download)
                <a href="{{ $post->url_download }}" class="btn btn-sm btn-success" target="_blank">
                    <i class="fas fa-download me-1"></i> Download
                </a>
            @endif
            <a href="{{ route('home') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        {{-- KOMENTAR --}}
        <hr>
        <h6 class="fw-semibold mb-3">Komentar</h6>

        {{-- Form Tambah Komentar --}}
        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4 comment-form">
                @csrf
                <textarea name="content" rows="2" class="form-control @error('content') is-invalid @enderror"
                    placeholder="Tulis komentar...">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button class="btn btn-sm btn-primary mt-2"><i class="fas fa-paper-plane me-1"></i> Kirim</button>
            </form>
        @else
            <p class="small text-muted">Silakan <a href="{{ route('login') }}">login</a> untuk memberi komentar.</p>
        @endauth

        {{-- List Komentar --}}
        <div id="comments-list">

            @forelse ($post->comments as $comment)
                <div class="mb-3 p-3 rounded border bg-white small">
                    <div class="fw-semibold">{{ $comment->user->name ?? 'Anonim' }}
                        <span class="text-muted">• {{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-secondary mb-2">{{ $comment->content }}</div>

                    {{-- Balasan --}}
                    @if ($comment->replies->count())
                        <div class="ms-3 ps-3 border-start">
                            @foreach ($comment->replies as $reply)
                                <div class="mb-2">
                                    <strong>{{ $reply->user->name ?? 'Anonim' }}</strong>:
                                    {{ $reply->content }}
                                    <div class="text-muted small">{{ $reply->created_at->diffForHumans() }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Form Balas --}}
                    @auth
                        <form action="{{ route('comments.reply', $comment->id) }}" method="POST"
                            class="reply-form mt-2 small">
                            @csrf
                            <textarea name="content" rows="2" class="form-control form-control-sm mb-2 @error('content') is-invalid @enderror"
                                placeholder="Balas komentar..."></textarea>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-reply me-1"></i> Balas
                            </button>
                        </form>
                    @endauth
                </div>
            @empty
                <p class="text-muted small">Belum ada komentar.</p>
            @endforelse
        </div>
    </div>
    @push('scripts')
        <script>
            // Tambah komentar utama
            $(document).on('submit', 'form.comment-form', function(e) {
                e.preventDefault();

                let form = $(this);
                let content = form.find('textarea[name="content"]').val();

                $.post(form.attr('action'), {
                    _token: '{{ csrf_token() }}',
                    content: content
                }, function(res) {
                    if (res.success) {
                        $('#comments-list').prepend(res.comment);
                        form.find('textarea[name="content"]').val('');
                    }
                });
            });

            // Balas komentar
            $(document).on('submit', '.reply-form', function(e) {
                e.preventDefault();

                let form = $(this);
                let content = form.find('textarea[name="content"]').val();
                let action = form.attr('action');

                $.post(action, {
                    _token: '{{ csrf_token() }}',
                    content: content
                }, function(res) {
                    if (res.success) {
                        form.prev('.replies').append(res.reply);
                        form.find('textarea[name="content"]').val('');
                    }
                });
            });
        </script>
    @endpush


@endsection
