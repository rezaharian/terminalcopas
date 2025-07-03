@extends('layouts.appmaster')

@section('content')
    <div class="container">
        <h4 class="fw-semibold">{{ $post->title }}</h4>

        <div class="mb-2 text-muted small">
            Oleh <strong>{{ $post->author->name ?? 'Tidak diketahui' }}</strong> |
            Kategori: <strong>{{ $post->category->name ?? '-' }}</strong> |
            Status: <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'secondary' }}">
                {{ $post->status }}
            </span>
        </div>

        <div class="mb-3">
            <strong>Deskripsi:</strong><br>
            <div class="text-secondary">{{ $post->description }}</div>
        </div>

        @php
            $cover = $post->images->where('type', 'cover')->first();
            $internalImages = $post->images->where('type', 'internal');
        @endphp

        @if ($cover)
            <div class="mb-3">
                <img src="{{ $cover->url }}" alt="Cover Image" class="img-fluid rounded shadow-sm"
                    style="max-height: 300px; object-fit: cover;">
            </div>
        @endif

        <div class="mb-3">
            <strong>Konten:</strong>
            <div class="border rounded p-2 bg-light small">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        @if ($internalImages->count())
            <div class="mb-3">
                <strong>Gambar Tambahan:</strong>
                <div class="row g-2">
                    @foreach ($internalImages as $img)
                        <div class="col-6 col-md-4">
                            <img src="{{ $img->url }}" alt="Image" class="img-fluid rounded border shadow-sm"
                                style="max-height: 150px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-3">
            <strong>Tag:</strong>
            @foreach ($post->tags as $tag)
                <span class="badge bg-info text-dark">{{ $tag->name }}</span>
            @endforeach
        </div>

        <div class="mb-3">
            <strong>Teknologi:</strong>
            @foreach ($post->technologies as $tech)
                <span class="badge bg-warning text-dark">{{ $tech->name }}</span>
            @endforeach
        </div>
        @if ($post->url_download)
            <a href="{{ $post->url_download }}" class="btn btn-sm btn-success" target="_blank">Download</a>
        @endif


        <div class="mt-3 d-flex gap-2">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>

        <hr>
        <h5 class="mt-4">Komentar</h5>

        @forelse ($post->comments as $comment)
            <div class="mb-3 p-2 border rounded bg-white small">
                <div><strong>{{ $comment->user->name ?? 'Anonim' }}</strong>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div class="text-secondary">{{ $comment->content }}</div>

                @if ($comment->replies->count())
                    <div class="mt-2 ms-3 ps-2 border-start">
                        @foreach ($comment->replies as $reply)
                            <div class="mb-1">
                                <strong>{{ $reply->user->name ?? 'Anonim' }}</strong>: {{ $reply->content }}<br>
                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <p class="text-muted">Belum ada komentar.</p>
        @endforelse
    </div>
@endsection
