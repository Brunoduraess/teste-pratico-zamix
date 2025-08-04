document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('pesquisar');
    const tableRows = document.querySelectorAll('.table tbody tr');

    searchInput.addEventListener('keyup', function () {
        const searchValue = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchValue) ? '' : 'none';
        });
    });
});
