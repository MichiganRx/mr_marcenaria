document.addEventListener('DOMContentLoaded', function () {
    const produtosPorPagina = 15;
    const totalPaginas = <?= $totalPaginas ?>;
    let currentPage = 1;

    function changePage(page) {
        if (page < 1 || page > totalPaginas) return;
        
        currentPage = page;
        const start = (currentPage - 1) * produtosPorPagina;
        const end = start + produtosPorPagina;

        const linhasTabela = document.querySelectorAll('.line-table');
        const containersResponsivos = document.querySelectorAll('.container-content');
        
        linhasTabela.forEach((linha, index) => {
            linha.style.display = (index >= start && index < end) ? '' : 'none';
        });

        containersResponsivos.forEach((container, index) => {
            container.style.display = (index >= start && index < end) ? '' : 'none';
        });

        document.getElementById('pageIndicator').textContent = `Página ${currentPage} de ${totalPaginas}`;
        document.getElementById('prevPage').disabled = currentPage === 1;
        document.getElementById('nextPage').disabled = currentPage === totalPaginas;
    }

    document.getElementById('prevPage').addEventListener('click', function () {
        changePage(currentPage - 1);
    });

    document.getElementById('nextPage').addEventListener('click', function () {
        changePage(currentPage + 1);
    });

    changePage(1);
});
