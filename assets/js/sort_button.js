const buttons = document.querySelectorAll('.sort-btn');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        const sortKey     = btn.dataset.sort;      // ex: "alpha" or "seasons"
        const currentOrder= btn.dataset.order;     // "asc" or "desc"

        btn.dataset.order = (currentOrder === 'asc') ? 'desc' : 'asc';

        window.location.href = '<?= site_url("home/sort/") ?>/' + sortKey + '/' + currentOrder;
    });
});