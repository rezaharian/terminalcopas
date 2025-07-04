@php
    use App\Models\Category;
    use App\Models\Technology;
    use App\Models\Tag;
    use App\Models\Post;

    // Ambil semua kategori + jumlah posting published
    $categories = Category::withCount([
        'posts as posts_count' => function ($query) {
            $query->where('status', 'published');
        },
    ])->get();

    // Ambil teknologi random
    $technologies = Technology::inRandomOrder()->limit(8)->get();

    // Ambil tag random
    $tags = Tag::inRandomOrder()->limit(10)->get();

    // Ambil 10 postingan terbaru
    $latestPosts = Post::latest()->take(10)->get();
@endphp

{{-- Teknologi --}}
<div class="card mb-4 mt-3 shadow-sm border-0" style="background: var(--color-dark);">
    <div class="card-header text-white fs-6 fw-semibold" style="background: var(--color-dark);">
        <i class="fas fa-code me-2"></i> Teknologi Digunakan
    </div>
    <div class="card-body d-flex flex-wrap gap-2">
        @foreach ($technologies as $tech)
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
        @foreach ($tags as $tag)
            <a href=" " class="badge rounded-pill px-3 py-2 fw-medium"
                style="background: var(--color-hover); color: var(--color-dark); text-decoration: none;">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>

{{-- Kategori Dinamis --}}
<div class="card mb-4 shadow-sm border-0" style="background: var(--color-soft);">
    <div class="card-header text-white fs-6 fw-semibold" style="background: var(--color-dark);">
        <i class="fas fa-folder-open me-2"></i> Kategori
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($categories as $category)
            <li class="list-group-item px-3 py-2" style="background: var(--color-light);">
                <a href="{{ route('posts.kategori', $category->slug) }}"
                    class="text-decoration-none fw-medium d-flex align-items-center justify-content-between"
                    style="color: var(--color-text);">
                    <span>
                        <i class="fas fa-angle-right me-2 text-muted"></i>
                        {{ $category->name }} ({{ $category->posts_count }})
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
        @foreach ($latestPosts as $latest)
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
