<?php
session_start();
require_once './banco.php';
require_once './class.php';

$produto = new produto;
$result = $produto->estoque();
$produtos = $result->fetch_all(MYSQLI_ASSOC); // Certificando que a variável $produtos é preenchida corretamente
$totalProdutos = $result->num_rows;
$produtosPorPagina = 12;
$totalPaginas = max(1, ceil($totalProdutos / $produtosPorPagina));

if (isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./side-bar/style.scss" rel="stylesheet">
    <link href="./style/global.scss" rel="stylesheet">
    <link href="./style/table-style.scss" rel="stylesheet">
    <link href="./style/table-responsive.scss" rel="stylesheet">
    <link href="./style/select-personalizado.scss" rel="stylesheet">
    <link href="./style/modal-cad-style.scss" rel="stylesheet">
    <link href="./side-bar/style-responsive.scss" rel="stylesheet">
    <title>Estoque</title>
</head>
<body>
    <main class="container">
        <?php require_once './side-bar/menu.php'; ?>
        <header>
            <div class="navbar">
                <?php require_once './side-bar/menu-responsive.php'; ?>
            </div>
        </header>
        <div class="table">
            <div class="content-table">
                <div class="title-table">
                    <div class="title-page">
                        <h2>Lista de Compras</h2>
                    </div>
                </div>
                <div class="container-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Saldo</th>
                                <th>Mínimo</th>
                                <th>Situação</th>
                                <th>Fornecedor</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($produtos)) { ?>
                                <?php foreach ($produtos as $linha) { ?>
                                    <tr class="line-table">
                                        <td><?= htmlspecialchars($linha['nomeproduto']) ?></td>
                                        <td><?= htmlspecialchars($linha['saldo']) ?></td>
                                        <td><?= htmlspecialchars($linha['quantidade_minima']) ?></td>
                                        <td>
                                            <?php
                                                if ($linha['saldo'] == 0) {
                                                    echo '<img src="./assets/img/fora-estoque.png" alt="Fora do Estoque">';
                                                } elseif ($linha['saldo'] < $linha['quantidade_minima']) {
                                                    echo '<img src="./assets/img/alerta.png" alt="Em Alerta">';
                                                } else {
                                                    echo '<img src="./assets/img/em-estoque.png" alt="Em Estoque">';
                                                }
                                            ?>
                                        </td>
                                        <td><?= htmlspecialchars($linha['idfornecedor']) ?></td>  
                                        <td>
                                            <a href="#" onclick="return confirmarExclusao('<?= htmlspecialchars($linha['nomeproduto']) ?>', './apagar_produto.php?idproduto=<?= htmlspecialchars($linha['idproduto']) ?>&nome=<?= htmlspecialchars($linha['nomeproduto']) ?>&redirect=lista_de_compra')">
                                                <i class="bi bi-trash3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6">Nenhum produto encontrado.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="container-table-responsive">
                    <?php 
                    if (!empty($produtos)) {
                        $isBg = true;
                        foreach ($produtos as $linha) { 
                            $rowClass = $isBg ? 'true-background' : '';
                            $isBg = !$isBg;
                    ?>
                            <div class="container-content <?= $rowClass ?>">
                                <div class="line-title">
                                    <div>
                                        <h1>Produto:</h1>
                                        <span><?= htmlspecialchars($linha['nomeproduto']) ?></span>
                                    </div>
                                    <div>
                                        <a href="#" onclick="return confirmarExclusao('<?= htmlspecialchars($linha['nomeproduto']) ?>', './apagar_produto.php?idproduto=<?= htmlspecialchars($linha['idproduto']) ?>&nome=<?= htmlspecialchars($linha['nomeproduto']) ?>&redirect=home')">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="content">
                                    <div>
                                        <h3>Saldo:</h3>
                                        <span><?= htmlspecialchars($linha['saldo']) ?></span>
                                    </div>
                                    <div>
                                        <?php
                                            if ($linha['saldo'] == 0) {
                                                echo '<img src="./assets/img/fora-estoque.png" alt="Fora do Estoque">';
                                            } elseif ($linha['saldo'] < $linha['quantidade_minima']) {
                                                echo '<img src="./assets/img/alerta.png" alt="Em Alerta">';
                                            } else {
                                                echo '<img src="./assets/img/ok.png" alt="Em Estoque">';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php 
                        }
                    } else { 
                        echo '<div class="no-products">Nenhum produto encontrado.</div>';
                    }
                    ?>
                </div>
                <div class="pagination">
                    <span id="pageIndicator">Página 1 de <?= $totalPaginas ?></span>
                    <button id="prevPage" onclick="changePage(currentPage - 1)" disabled><i class="bi bi-caret-left-fill"></i></button>
                    <button id="nextPage" onclick="changePage(currentPage + 1)"><i class="bi bi-caret-right-fill"></i></button>
                </div>
            </div>
        </div>
        <div id="appDelet"></div>
    <?php require_once './rodape.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const produtosPorPagina = <?= $produtosPorPagina ?>;
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
    </script>
    <script src="./script/script-home.js"></script>
    <script src="./script/alert.js"></script>
    <script src="./script/alert-delet.js"></script>
</body>
</html>
<?php
} else {
    header("Location: ./index.php");
}
?>
