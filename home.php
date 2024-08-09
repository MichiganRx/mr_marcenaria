<?php
session_start();
require_once './banco.php';
require_once './class.php';

if (isset($_SESSION['username'])) {
    if (isset($_POST['buscar']) && !empty($_POST['buscar'])) {
        $filtroProduto = new FiltroProduto();
        $result = $filtroProduto->filtrarProdutos($_POST['buscar']);
    } else {
        $produto = new Produto();
        $result = $produto->listar_produtos();
    }
    
    $produtos = [];
    while ($linha = $result->fetch_array()) {
        $produtos[] = $linha;
    }
    
    $totalProdutos = count($produtos);
    $produtosPorPagina = 12;
    $totalPaginas = max(1, ceil($totalProdutos / $produtosPorPagina));
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
    <title>Home</title>
</head>
<body>
    <main class="container">
        <header>
            <div class="navbar">
                <?php require_once './side-bar/menu-responsive.php'; ?>
            </div>
        </header>
        <?php require_once './side-bar/menu.php'; ?>
        <div class="table">
            <div class="content-table">
                <div class="title-table">
                    <div class="title-page">
                        <h2>Produtos em Estoque</h2>
                        <button id="btnAdicionarProduto"><img src="./assets/img/adicionar.png" alt="">Adicionar Produto</button>
                    </div>
                    <div class="container-search">
                        <form method="POST" action="">
                            <button type="submit"><i class="bi bi-search"></i></button>
                            <input type="text" name="buscar" placeholder="Pesquisar" value="<?= isset($_POST['buscar']) ? htmlspecialchars($_POST['buscar']) : '' ?>">
                        </form>
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
                                                echo '<img src="./assets/img/ok.png" alt="Em Estoque">';
                                            }
                                        ?>
                                    </td>
                                    <td><?= isset($linha['idfornecedor']) ? htmlspecialchars($linha['idfornecedor']) : 'N/A' ?></td>
                                    <td>
                                        <a href="#" onclick="return confirmarExclusao('<?= htmlspecialchars($linha['nomeproduto']) ?>', './apagar_produto.php?idproduto=<?= htmlspecialchars($linha['idproduto']) ?>&nome=<?= htmlspecialchars($linha['nomeproduto']) ?>&redirect=home')">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                        <button type="button" class="btnEdita" 
                                                data-id="<?= htmlspecialchars($linha['idproduto']) ?>"
                                                data-nome="<?= htmlspecialchars($linha['nomeproduto']) ?>"
                                                data-saldo="<?= htmlspecialchars($linha['saldo']) ?>"
                                                data-minimo="<?= htmlspecialchars($linha['quantidade_minima']) ?>"
                                                data-fornecedor="<?= htmlspecialchars($linha['idfornecedor']) ?>"
                                                data-estoque="<?= htmlspecialchars($linha['idestoque']) ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="container-table-responsive">
                    <?php 
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
                                    <button type="button" class="btnEdita" 
                                        data-id="<?= htmlspecialchars($linha['idproduto']) ?>"
                                        data-nome="<?= htmlspecialchars($linha['nomeproduto']) ?>"
                                        data-saldo="<?= htmlspecialchars($linha['saldo']) ?>"
                                        data-minimo="<?= htmlspecialchars($linha['quantidade_minima']) ?>"
                                        data-fornecedor="<?= htmlspecialchars($linha['idfornecedor']) ?>"
                                        data-estoque="<?= htmlspecialchars($linha['idestoque']) ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
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
                    <?php } ?>
                </div>
                <div class="pagination">
                    <span id="pageIndicator">Página 1 de <?= $totalPaginas ?></span>
                    <button id="prevPage" onclick="changePage(currentPage - 1)" disabled><i class="bi bi-caret-left-fill"></i></button>
                    <button id="nextPage" onclick="changePage(currentPage + 1)"><i class="bi bi-caret-right-fill"></i></button>
                </div>
            </div>
        </div>
        <div class="modal-cad" id="cadastroProduto">
            <form id="cadastroProdutoForm" action="./cad_produto.php" method="POST" enctype="multipart/form-data">
                <div class="titulo-add">
                    <h3>Cadastrar Produto</h3>
                    <button type="button" id="btnFecharCadastro"><img src="./assets/img/fechar.png" alt=""></button>
                </div>
                <input type="text" name="produto" id="nome_produto" placeholder="Nome do Produto">
                <input type="text" name="saldo" id="saldo" placeholder="Saldo">
                <input type="text" name="minimo" id="minimo" placeholder="Quantidade mínima">
                <div class="custom-select" id="fornecedor-select">
                    <div class="select-selected select-2">Selecione o Fornecedor<i class="bi bi-caret-down-fill"></i></div>
                    <div class="select-items select-hide content-2">
                        <?php
                        $forn = new fornecedores;
                        $result = $forn->listar_fornecedor();
                        while ($linha = $result->fetch_array()) {
                            echo '<div class="select-option" data-value="' . $linha['idfornecedores'] . '">' . $linha['nomefornecedor'] . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <input type="hidden" name="idfornecedores" id="idfornecedores">
                <div class="custom-select" id="estoque-select">
                    <div class="select-selected">Selecione o Estoque<i class="bi bi-caret-down-fill"></i></div>
                    <div class="select-items select-hide">
                        <?php
                        $est = new estoque;
                        $resultado = $est->listar_estoques();
                        while ($linha = $resultado->fetch_array()) {
                            echo '<div class="select-option" data-value="' . $linha['idestoque'] . '">' . $linha['estoque'] . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <input type="hidden" name="idestoque" id="idestoque">
                <div id="error-message" class="caixa-de-erro" style="display:none;">Preencha todos os campos!</div>
                <button type="submit" name="salva_produto">Cadastrar</button>
            </form>
        </div>
        <div class="modal-cad" id="editarProduto">
            <form action="./produto_edita.php" method="POST" enctype="multipart/form-data" id="editarProdutoForm">
                <div class="titulo-add">
                    <h3>Editar Produto</h3>
                    <button type="button" id="btnFecharEdicao"><img src="./assets/img/fechar.png" alt=""></button>
                </div>
                <input type="hidden" name="idproduto" id="edit_idproduto">
                <input type="text" name="nomeproduto" id="edit_nome_produto" placeholder="Nome do Produto">
                <input type="text" name="saldo" id="edit_saldo" placeholder="Saldo">
                <input type="text" name="minimo" id="edit_minimo" placeholder="Quantidade mínima">
                <div class="custom-select" id="edit_fornecedor-select">
                    <div class="select-selected select-2" placeholder="">Selecione o Fornecedor<i class="bi bi-caret-down-fill"></i></div>
                    <div class="select-items select-hide content-2">
                        <?php
                        $forn = new fornecedores;
                        $result = $forn->listar_fornecedor();
                        while ($linha = $result->fetch_array()) {
                            echo '<div class="select-option" data-value="' . $linha['idfornecedores'] . '">' . $linha['nomefornecedor'] . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <input type="hidden" name="idfornecedores" id="edit_idfornecedores">
                <div class="custom-select" id="edit_estoque-select">
                    <div class="select-selected">Selecione o Estoque<i class="bi bi-caret-down-fill"></i></div>
                    <div class="select-items select-hide">
                        <?php
                        $est = new estoque;
                        $resultado = $est->listar_estoques();
                        while ($linha = $resultado->fetch_array()) {
                            echo '<div class="select-option" data-value="' . $linha['idestoque'] . '">' . $linha['estoque'] . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <input type="hidden" name="idestoque" id="edit_idestoque">
                <div id="error-message-edita" class="caixa-de-erro" style="display:none;">Preencha todos os campos!</div>
                <button type="submit" name="atualiza_produto">Atualizar</button>
            </form>
        </div>
        <div id="app"></div>
        <div id="appDelet"></div>
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
