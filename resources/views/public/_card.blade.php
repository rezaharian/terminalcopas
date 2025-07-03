


<div class="col-6 col-md-4 mb-3 post-card category-{{ $post->category->id ?? 'unknown' }}">
    <div class="card h-100 border-0 rounded-3  overflow-hidden"
        style="background: var(--color-soft); font-size: 0.82rem;">

        @php
            $cover = $post->images->where('type', 'cover')->first();
        @endphp

        {{-- Gambar Cover --}}
        @if ($cover)
            <div class="position-relative">
                <img src="{{ $cover->url }}" class="card-img-top" alt="cover {{ $post->title }}"
                    style="height: 130px; object-fit: cover;">

                {{-- Kategori Badge --}}
                <span class="position-absolute top-0 start-0 m-2 badge rounded-pill"
                    style="background: var(--color-dark); font-size: 0.7rem;">
                    <i class="fas fa-folder-open me-1"></i> {{ $post->category->name ?? '-' }}
                </span>
            </div>
        @endif

        {{-- Konten Card --}}
        <div class="card-body p-3 d-flex flex-column">
            {{-- Judul Post --}}
            <h6 class="fw-semibold mb-2"
                style="line-height: 1.3rem; min-height: 2.6rem; font-size: 0.84rem; color: var(--color-text);">
                <a href="{{ route('posts.selengkapnya', ['id' => $post->id, 'slug' => Str::slug($post->title)]) }}"
                    class="text-decoration-none text-dark">
                    {{ Str::limit($post->title, 60) }}
                </a>
            </h6>

            {{-- Info Penulis & Tanggal --}}
            <div class="text-muted small mb-3" style="line-height: 1.3;">
                <div><i class="fas fa-user me-1"></i> {{ $post->author->name ?? '-' }}</div>
                <div><i class="fas fa-calendar-alt me-1"></i> {{ $post->created_at->translatedFormat('d M Y') }}</div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-auto">
                <a href="{{ route('posts.selengkapnya', ['id' => $post->id, 'slug' => Str::slug($post->title)]) }}"
                    class="btn btn-sm w-100 rounded"
                    style="background: var(--color-dark); color: white; font-size: 0.78rem;"
                    onmouseover="this.style.backgroundColor='#ffc107'; this.style.color='#000';"
                    onmouseout="this.style.backgroundColor='var(--color-dark)'; this.style.color='white';">
                    Selengkapnya <i class="fas fa-chevron-right ms-1" style="font-size: 0.65rem;"></i>
                </a>
            </div>

        </div>
    </div>
</div>
<script>
    function adjustCardDisplayPerCategory() {
        // Jalankan filter hanya jika di route /
        if (window.location.pathname !== '/') return;

        const categories = new Set();
        document.querySelectorAll('.post-card').forEach(card => {
            const match = [...card.classList].find(cls => cls.startsWith('category-'));
            if (match) categories.add(match);
        });

        const maxCards = window.innerWidth >= 768 ? 3 : 4;

        categories.forEach(category => {
            const cards = document.querySelectorAll(`.post-card.${category}`);
            cards.forEach((card, index) => {
                card.style.display = (index < maxCards) ? '' : 'none';
            });
        });
    }

    window.addEventListener('DOMContentLoaded', adjustCardDisplayPerCategory);
    window.addEventListener('resize', adjustCardDisplayPerCategory);
</script>
