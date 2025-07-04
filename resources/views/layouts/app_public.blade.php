<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Terminal-COPAS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    {{-- <style>
        body {
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' viewBox='0 0 800 800' opacity='0.62'><defs><filter id='bbblurry-filter' x='-100%' y='-100%' width='400%' height='400%' filterUnits='objectBoundingBox' primitiveUnits='userSpaceOnUse' color-interpolation-filters='sRGB'><feGaussianBlur stdDeviation='79' x='0%' y='0%' width='100%' height='100%' in='SourceGraphic' edgeMode='none' result='blur'></feGaussianBlur></filter></defs><g filter='url(%23bbblurry-filter)'><ellipse rx='117' ry='115.5' cx='747.1675699443717' cy='393.90979387373204' fill='%2300509e'></ellipse><ellipse rx='117' ry='115.5' cx='223.7992186221776' cy='182.22924940498712' fill='%2300509e'></ellipse><ellipse rx='117' ry='115.5' cx='266.99145012501026' cy='590.7811378359171' fill='%2300509e'></ellipse></g></svg>");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }
    </style> --}}


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZV3RJGJ6CH"></script>

</head>

<body>
    @include('layouts.navbar')

    <div class="container py-4">

        {{-- Tampilkan Hero hanya jika di halaman '/' --}}
        @if (request()->is('/'))
            <div class="row mb-4">
                <div class="col-12">
                    @include('public.hero')
                </div>
            </div>
        @endif

        <div class="row">
            {{-- Konten Utama --}}
            <div class="col-md-8">
                @yield('content')
            </div>

            {{-- Sidebar --}}
            <div class="col-md-4 mt-5">
                @include('layouts.sidebar')
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    @stack('scripts')

    @include('layouts.tombolgoup')

</body>


</html>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-3XXHY9YG97');
</script>
