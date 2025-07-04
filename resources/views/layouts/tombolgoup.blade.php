<style>
    /* Tombol scroll ke atas */
    .scroll-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        background-color: var(--color-dark);
        color: #ffea00;
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .scroll-top.show {
        opacity: 1;
        visibility: visible;
    }

    .scroll-top:hover {
        background-color: #282502;
    }
</style>


<button class="scroll-top" id="scrollTopBtn">
    <i class="fas fa-arrow-up"></i>
</button>


<script>
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.add('show');
        } else {
            scrollTopBtn.classList.remove('show');
        }
    });

    scrollTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
