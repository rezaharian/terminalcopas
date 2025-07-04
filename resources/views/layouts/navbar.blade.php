<style>
    /* Dropdown Toggle Styling */
    .custom-dropdown-toggle::after {
        display: none;
        /* Hilangkan icon panah bawaan */
    }

    .custom-dropdown-toggle {
        font-weight: 500;
        color: #f8f9fa;
        transition: color 0.3s ease;
    }

    .custom-dropdown-toggle:hover {
        color: #00BFFF;
    }

    /* Dropdown Container */
    .custom-dropdown {
        background-color: var(--color-dark);
        ;
        border: 1px solid #0000006f;
        border-radius: 8px;
        padding: 0.5rem 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        min-width: 200px;
    }

    /* Dropdown Items */
    .custom-dropdown .dropdown-item {
        color: #f8f9fa;
        padding: 0.5rem 1rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .custom-dropdown .dropdown-item:hover {
        background-color: #00BFFF;
        color: #fff;
    }

    /* Optional: spacing antar item */
    .custom-dropdown .dropdown-item+.dropdown-item {
        margin-top: 2px;
    }

    /* Efek muncul dan hilang untuk pesan login */
    /* Container user di-set relative supaya anaknya absolute */
    .nav-user-wrapper {
        position: relative;
        display: inline-block;
    }

    /* Pesan login */
    .login-message {
        position: absolute;
        top: 100%;
        /* Posisi di bawah user name */
        left: 50%;
        transform: translateX(-50%);
        margin-top: 5px;
        background-color: #212529;
        color: #ffea00;
        border: 1px solid #92e4ff;
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 1rem;
        white-space: nowrap;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        opacity: 0;
        animation: fadeSlide 3s ease forwards;
        z-index: 1000;
    }

    /* Animasi muncul lalu hilang */
    @keyframes fadeSlide {
        0% {
            opacity: 0;
            transform: translate(-50%, -5px);
        }

        20%,
        80% {
            opacity: 1;
            transform: translate(-50%, 0);
        }

        100% {
            opacity: 0;
            transform: translate(-50%, -5px);
        }
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 sticky-top" id="mainNavbar"
    style="background-image: linear-gradient(to right, #ffea00 100%, transparent 0%);
           background-repeat: no-repeat;
           background-position: bottom;
           background-size: 0% 2px;">


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
                    <a class="nav-link dropdown-toggle custom-dropdown-toggle d-flex align-items-center" href="#"
                        id="kategoriDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                        <span class="ms-1">&#9662;</span> {{-- Unicode panah bawah ▼ --}}
                    </a>


                    <ul class="dropdown-menu custom-dropdown" aria-labelledby="kategoriDropdown">
                        @php
                            use App\Models\Category;
                            $categories = Category::all();
                        @endphp

                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('posts.kategori', $category->slug) }}">
                                    {{ $category->name }}
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
                        <a class="nav-link dropdown-toggle custom-dropdown-toggle d-flex align-items-center
    @if (Request::is('/') && Auth::check()) nav-glow @endif"
                            href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown">

                            <div class="nav-user-wrapper">
                                {{ Auth::user()->name }}

                                @if (Request::is('/') && Auth::check())
                                    <div class="login-message">Anda sudah login {{ Auth::user()->name }}</div>
                                @endif
                            </div>

                            <span class="ms-1">&#9662;</span>
                        </a>


                        <ul class="dropdown-menu custom-dropdown dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                            <li hidden>
                                <a class="dropdown-item" href="/user/profile">Profil</a>
                            </li>
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
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        const scrollTop = window.scrollY;
        const maxScroll = document.body.scrollHeight - window.innerHeight;

        // Hitung persentase scroll
        const scrollPercent = Math.min(scrollTop / maxScroll, 1) * 100;

        // Update ukuran gradient secara horizontal
        navbar.style.backgroundSize = `${scrollPercent}% 4px`;
    });
</script>
