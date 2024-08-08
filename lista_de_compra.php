<?php
session_start();
require_once './banco.php';
require_once './class.php';

$produto = new produto;
$result = $produto->estoque();
$totalProdutos = $result->num_rows;
$produtosPorPagina = 15;
$totalPaginas = max(1, ceil($totalProdutos / $produtosPorPagina));

if (isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html lang="Pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/table-style.scss" rel="stylesheet">
    <link href="./style/select-personalizado.scss" rel="stylesheet">
    <link href="./side-bar/style.scss" rel="stylesheet">
    <link href="./style/global.scss" rel="stylesheet">    

    <title>Estoque</title>
</head>

<body>
    <main class="container">
        <?php require_once './side-bar/menu.php'; ?>
        <div class="table">
            <div class="content-table">
                <div class="title-table"><h2>Lista de Compras</h2></div>
                <div class="container-table">
                    <table >
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
                            <?php
                                while ($linha = $result->fetch_array()) {
                                    $foto = !empty($linha['foto']) ? $linha['foto'] : './assets/img/sem-foto.png';
                            ?>
                                <tr class="line-table">
                                    <td><?= $linha['nomeproduto'] ?></td>
                                    <td><?= $linha['saldo'] ?></td>
                                    <td><?= $linha['quantidade_minima'] ?></td>
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
                                    <td><?= $linha['idfornecedor'] ?></td>  
                                    <td>
                                        <a href="#" onclick="return confirmarExclusao('<?= htmlspecialchars($linha['nomeproduto']) ?>', './apagar_produto.php?idproduto=<?= htmlspecialchars($linha['idproduto']) ?>&nome=<?= htmlspecialchars($linha['nomeproduto']) ?>&redirect=lista_de_compra')">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <span id="pageIndicator">Página 1 de <?= $totalPaginas ?></span>
                    <button id="prevPage" onclick="changePage(currentPage - 1)" disabled><i class="bi bi-caret-left-fill"></i></button>
                    <button id="nextPage" onclick="changePage(currentPage + 1)"><i class="bi bi-caret-right-fill"></i></button>
                </div>
            </div>
        </div>
        <div id="appDelet"></div>
    </main>
    <?php require_once './rodape.php'; 
        }else{
        header("location: index.php");
        }
    ?>
    <script>
        var currentPage = 1;
        var totalPages = <?= $totalPaginas ?>;
        var produtosPorPagina = <?= $produtosPorPagina ?>;

        function changePage(page) {
            if (page < 1 || page > totalPages) return;

            currentPage = page;
            var rows = document.querySelectorAll('.line-table');
            var startIndex = (currentPage - 1) * produtosPorPagina;
            var endIndex = startIndex + produtosPorPagina;

            rows.forEach(function(row, index) {
                if (index >= startIndex && index < endIndex) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === totalPages;

            document.getElementById('pageIndicator').textContent = 'Página ' + currentPage + ' de ' + totalPages;
        }

        window.onload = function() {
            changePage(1);
        };
    </script>
    <script src="./script/script-home.js"></script>
    <script src="./script/alert-delet.js"></script>
</body>
</html>
