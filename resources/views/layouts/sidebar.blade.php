@php
    use App\Models\Category;

    // Ambil semua kategori beserta jumlah postingannya
    $categories = Category::withCount([
        'posts as posts_count' => function ($query) {
            $query->where('status', 'published');
        },
    ])->get();

    // Daftar label untuk kategori yang ingin ditampilkan
    $sections = [
        'tutorial' => 'Tutorial ',
        'source-code' => 'Source Code ',
        'artikel' => 'Artikel',
        'tips-tricks' => 'Tips & Tricks',
        'berita' => 'Berita',
    ];

    // Siapkan kategori berdasarkan slug (hasil slug dari nama category di DB)
    $categoryMap = $categories->keyBy(fn($cat) => \Str::slug($cat->name));
@endphp

{{-- Teknologi --}}
<div class="card mb-4 mt-3 shadow-sm border-0" style="background: var(--color-dark);">
    <div class="card-header text-white fs-6 fw-semibold" style="background: var(--color-dark);">
        <i class="fas fa-code me-2"></i> Teknologi Digunakan
    </div>
    <div class="card-body d-flex flex-wrap gap-2">
        @foreach (\App\Models\Technology::inRandomOrder()->limit(8)->get() as $tech)
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
            @php
                $slug = \Str::slug($tech->name);
            @endphp
            <a href="{{ route('posts.teknologi', $slug) }}"
                class="badge d-flex align-items-center gap-2 px-3 py-2 fw-medium rounded-pill text-decoration-none"
                style="background: white; border: 1px solid var(--color-accent); color: var(--color-dark);">
                @if ($iconClass)
                    <i class="{{ $iconClass }}" style="font-size: 18px;"></i>
                @else
                    <i class="fas fa-code"></i>
                @endif
                {{ $tech->name }}
            </a>
        @endforeach
    </div>
</div>

{{-- Tag Populer --}}
<div class="card mb-4 shadow-sm border-0" style="background: var(--color-dark);">
    <div class="card-header text-white fs-6 fw-semibold" style="background: var(--color-dark);">
        <i class="fas fa-tags me-2"></i> Tag Populer
    </div>
    <div class="card-body d-flex flex-wrap gap-2">
        @foreach (\App\Models\Tag::inRandomOrder()->limit(10)->get() as $tag)
            <a href="#" class="badge rounded-pill px-3 py-2 fw-medium"
                style="background: var(--color-hover); color: var(--color-dark); text-decoration: none;">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>

{{-- Kategori --}}
<div class="card mb-4 shadow-sm border-0" style="background: var(--color-soft);">
    <div class="card-header text-white fs-6 fw-semibold" style="background: var(--color-dark);">
        <i class="fas fa-folder-open me-2"></i> Kategori
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($sections as $slug => $title)
            @php
                $count = $categoryMap[$slug]->posts_count ?? 0;
            @endphp
            <li class="list-group-item px-3 py-2" style="background: var(--color-light);">
                <a href="{{ route('posts.kategori', $slug) }}"
                    class="text-decoration-none fw-medium d-flex align-items-center justify-content-between"
                    style="color: var(--color-text);">
                    <span>
                        <i class="fas fa-angle-right me-2 text-muted"></i>
                        {{ $title }} ({{ $count }})
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

{{-- Postingan Terbaru --}}
<div class="card mb-4 shadow-sm border-0" style="background: var(--color-soft);">
    <div class="card-header text-white fs-6 fw-semibold" style="background: var(--color-dark);">
        <i class="fas fa-clock me-2"></i> Postingan Terbaru
    </div>
    <ul class="list-group list-group-flush">
        @foreach (\App\Models\Post::latest()->take(10)->get() as $latest)
            <li class="list-group-item small px-3 py-2" style="background: var(--color-light);">
                <a href="{{ route('posts.selengkapnya', [$latest->id, \Str::slug($latest->title)]) }}"
                    class="text-decoration-none" style="color: var(--color-text);">
                    <i class="fas fa-circle me-2" style="font-size: 6px; color: var(--color-accent);"></i>
                    {{ \Illuminate\Support\Str::limit($latest->title, 50) }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
