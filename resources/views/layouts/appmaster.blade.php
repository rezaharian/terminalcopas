<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - TernimalCoPas</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    <style>
        :root {
            --sidebar-width: 240px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--color-light);
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--color-dark);
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar .navbar-brand img {
            height: 32px;
            filter: brightness(0) invert(1);
        }

        .sidebar .nav-link {
            color: #ccc;
            padding: 0.6rem 0.9rem;
            border-radius: 0.4rem;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--color-accent);
            color: #fff;
        }

        .sidebar .navbar-user {
            margin-top: auto;
            color: #fff;
            font-size: 0.9rem;
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
                position: fixed;
                height: 100vh;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="d-flex justify-content-between align-items-center px-3 py-2 bg-dark text-white sticky-top">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-outline-light btn-sm d-md-none" onclick="toggleSidebar()">☰</button>
            <a class="navbar-brand mb-0" href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="Logo"
                    style="height: 28px; filter: brightness(0) invert(1);">
            </a>
        </div>

        <div class="d-flex align-items-center gap-3">
            @auth
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button class="btn btn-sm btn-outline-light" onclick="return confirm('Logout?')">Logout</button>
                </form>
            @endauth
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebarMenu">
        <a class="navbar-brand mb-4 d-flex align-items-center gap-2" href="{{ url('/') }}">
            <br>
        </a>

        <ul class="nav flex-column">
            <li class="nav-item mt-1">
                <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}" href="{{ route('posts.index') }}">
                    📄 Post
                </a>
            </li>
            <li class="nav-item mt-1">
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    👥 Users
                </a>
            </li>
        </ul>

        <div class="navbar-user mt-auto pt-4">
            <small>© {{ date('Y') }} TerminalCoPas</small>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebarMenu').classList.toggle('show');
        }

        // Optional: Hide sidebar when clicking outside (for mobile)
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebarMenu');
            if (!sidebar.contains(e.target) && !e.target.closest('.btn-outline-light')) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>

</html>
