<style>
    #searchInput:focus {
        box-shadow: none;
    }

    .input-group:focus-within {
        border-color: var(--color-dark);
        /* Navy tetap saat fokus */
        box-shadow: 0 0 0 0.1rem rgba(0, 31, 63, 0.25);
    }
</style>

<!-- Search Bar Simple -->
<div class="mb-3">
    <div class="input-group shadow-sm " style="background-color: #f8f9fa; border: 1px solid; border-radius:2px;">
        <span class="input-group-text bg-transparent border-0" style="font-size: 1rem;">
            <i class="fas fa-search text-secondary"></i>
        </span>
        <input type="text" class="form-control border-0 bg-transparent" id="searchInput" placeholder="Cari Sesuatu..."
            style="font-size: 0.9rem;">
    </div>
</div>


<script>
    function filterCards() {
        const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
        const allCards = document.querySelectorAll('.post-card');

        if (keyword === '') {
            adjustCardDisplayPerCategory();
        } else {
            allCards.forEach(card => {
                const titleElement = card.querySelector('h6 a');
                const title = titleElement ? titleElement.textContent.toLowerCase() : '';
                card.style.display = title.includes(keyword) ? '' : 'none';
            });
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        adjustCardDisplayPerCategory();
        document.getElementById('searchInput').addEventListener('input', filterCards);
    });
</script>
