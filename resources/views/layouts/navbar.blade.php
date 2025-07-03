<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" height="32" class="me-2"
                style="filter: brightness(0) invert(1);">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            {{-- Menu kiri --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="kategoriDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="kategoriDropdown">
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
                            @php
                                $kategori = \Illuminate\Support\Str::slug(str_replace('Populer', '', $title));
                            @endphp
                            <li>
                                <a class="dropdown-item" href="{{ route('posts.kategori', $kategori) }}">
                                    {{ $title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="/tentang">Tentang</a>
                </li>
            </ul>

            {{-- Menu kanan --}}
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" role="button"
                            data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                            <li><a class="dropdown-item" href="/user/profile">Profil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item" onclick="return confirm('Logout?')">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
