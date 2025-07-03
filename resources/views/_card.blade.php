<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100 shadow-none border-0 small position-relative overflow-hidden">
        @php
            $cover = $post->images->where('type', 'cover')->first();
        @endphp

        <div class="position-relative">
            @if ($cover)
                <img src="{{ $cover->url }}" class="card-img-top" alt="cover {{ $post->title }}"
                    style="height: 130px; object-fit: cover;">
            @endif

            <span class="position-absolute top-0 start-0 m-2 badge bg-primary small text-white">
                <i class="fas fa-folder-open me-1"></i> {{ $post->category->name ?? '-' }}
            </span>

            @if ($post->tags->count())
                <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark small">
                    <i class="fas fa-tags me-1"></i> {{ $post->tags->first()->name }}
                </span>
            @endif
        </div>

        <div class="card-body p-2 d-flex flex-column">
            <h6 class="card-title fw-semibold mb-1" style="font-size: 0.85rem;">
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                    {{ Str::limit($post->title, 50) }}
                </a>
            </h6>

            <p class="text-muted small mb-1" style="font-size: 0.7rem;">
                <i class="fas fa-user me-1"></i> {{ $post->author->name ?? '-' }} |
                <i class="fas fa-calendar-alt me-1"></i>
                {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}
            </p>

            <p class="card-text text-secondary small mb-2" style="font-size: 0.75rem;">
                {{ Str::limit(strip_tags($post->description), 60) }}
            </p>

            <div class="mt-auto">
                <a href="{{ route('posts.selengkapnya', ['id' => $post->id, 'slug' => Str::slug($post->title)]) }}"
                    class="btn btn-sm btn-outline-primary w-100">
                    <i class="fas fa-book-open me-1"></i> Selengkapnya
                </a>
            </div>
        </div>
    </div>
</div>
