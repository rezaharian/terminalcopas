<style>
    .hero-illustration {
        animation: floatUpDown 3s ease-in-out infinite;
    }

    @keyframes floatUpDown {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .tech-icons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border-radius: 12px;
        background: transparent;
    }

    .tech-icons img {
        width: 48px;
        height: 48px;
        padding: 8px;
        background-color: rgba(255, 255, 255, 0.509);
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        filter: grayscale(60%) brightness(90%);
    }

    .tech-icons img:hover {
        transform: scale(1.15);
        filter: none;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
    }
</style>


<section class="text-white py-5 position-relative overflow-hidden" style="background-color: var(--color-dark);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1 class="display-5 fw-bold mb-3">
                    Selamat Datang di <span class="text-warning">Terminal COPAS</span>
                </h1>
                <p class="lead mb-4">
                    Temukan berbagai tutorial, source code, dan artikel pemrograman untuk membantumu belajar dan
                    berkembang lebih cepat.
                </p>
                {{-- <a href="{{ route('posts.index') }}" class="btn btn-warning btn-lg rounded-pill shadow-sm mb-3">
                    Jelajahi Post
                </a> --}}

                {{-- Tech Icons --}}
                <div class="tech-icons d-flex flex-wrap justify-content-center align-items-center mt-4 p-1 text-dark">



                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" alt="Laravel">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg"
                        alt="Bootstrap">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg"
                        alt="HTML5">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS3">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg"
                        alt="JavaScript">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg"
                        alt="MySQL">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg"
                        alt="Python">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg"
                        alt="Vue.js">

                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg"
                        alt="React">



                </div>
            </div>
            <div class="col-md-5 text-center d-none d-md-block">

                <img src="https://cdn-icons-gif.flaticon.com/17122/17122565.gif" alt="Coding Illustration"
                    class="img-fluid hero-illustration" style="max-height: 280px;">
            </div>
        </div>
    </div>
</section>
