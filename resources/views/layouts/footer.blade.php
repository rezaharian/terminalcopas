<footer class="text-white pt-5 pb-4 mt-5" style="background: var(--color-dark, #1e1e2f);">
    <div class="container">
        <div class="row gy-4">

            {{-- Tentang --}}
            <div class="col-md-4">
                <a class="navbar-brand d-flex align-items-center mb-3" href="{{ url('/') }}">
                    <img src="{{ asset('logo.png') }}" alt="Logo" height="36" class="me-2"
                        style="filter: brightness(0) invert(1);">
                </a>
                <p class="text-light small mb-2">
                    Situs penyedia kebutuhan perkodingan, mulai dari source code, tutorial, pembuatan web, dan lainnya.
                </p>
                <p class="text-muted small">
                    Media berbagi source code, tutorial, dan artikel pemrograman. Membantu developer Indonesia
                    berkembang lebih baik dan efisien.
                </p>
            </div>

            {{-- Navigasi --}}
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Navigasi</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="/" class="text-white text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="{{ route('posts.kategori', 'source-code') }}"
                            class="text-white text-decoration-none">Source Code</a></li>
                    <li class="mb-2"><a href="{{ route('posts.kategori', 'tutorial') }}"
                            class="text-white text-decoration-none">Tutorial</a></li>
                    <li class="mb-2"><a href="{{ route('posts.kategori', 'artikel') }}"
                            class="text-white text-decoration-none">Artikel</a></li>
                    <li class="mb-2"><a href="{{ route('posts.kategori', 'berita') }}"
                            class="text-white text-decoration-none">Berita</a></li>
                </ul>
            </div>

            {{-- Sosial Media --}}
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Terhubung</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-github"></i></a>
                </div>
                <p class="small text-muted">
                    <a href="mailto:info@terminalcopas.com"
                        class="text-white text-decoration-none">info@terminalcopas.com</a><br>
                    <a href="https://www.terminalcopas.com" class="text-white text-decoration-none"
                        target="_blank">www.terminalcopas.com</a><br>
                    <a href="tel:0890123456789" class="text-white text-decoration-none">0890123456789</a>
                </p>

            </div>
        </div>

        <hr class="border-secondary mt-4">

        <div class="text-center small text-light">
            &copy; {{ now()->year }} <span class="fw-semibold">Terminal Copas</span>. All rights reserved.
        </div>
    </div>
</footer>
