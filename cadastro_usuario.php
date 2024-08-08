<?php
session_start();
require_once './banco.php';
require_once './class.php';

$db = new banco;
if (isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html lang="Pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./side-bar/style.scss" rel="stylesheet">
    <link href="./side-bar/style-responsive.scss" rel="stylesheet">
    <link href="./style/global.scss" rel="stylesheet">
    <link href="./style/cadastro-style.scss" rel="stylesheet">
    <link href="./style/modal-cad-style.scss" rel="stylesheet">
    <link href="./style/select-personalizado.scss" rel="stylesheet">
    <title>Cadastrar Novo Usuário</title>
</head>
<body>
    <main class="container">
        <header>
            <div class="navbar">
                <?php require_once './side-bar/menu-responsive.php'; ?>
            </div>
        </header>
        <?php require_once './side-bar/menu.php'; ?>
        <div class="container_form">
            <form action="./cad_usuario.php" method="POST" id="cadUsuario">
                <div class="container-content">
                    <div class="title-table">
                        <h2>Cadastrar Usuário</h2>
                        <button id="btnAdicionarCargo" type="button"><img src="./assets/img/adicionar.png" alt="">Adicionar Cargo</button>
                    </div>
                    <input type="text" name="nome" id="nome_usuario" placeholder="Nome do Usuário" required>
                    <input type="email" name="login" id="login" placeholder="Login" required>
                    <div class="container-input">
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                        <button type="button" id="togglePassword">
                            <img src="./assets/img/olho-aberto.png" alt="" id="olho-1">
                        </button>
                    </div>
                    <input type="password" name="senha_confirma" id="confirmacao-senha" placeholder="Confirmar Senha">
                    <div class="custom-select" id="cargo-select">
                        <div class="select-selected" required>Selecione o Cargo<i class="bi bi-caret-down-fill"></i></div>
                        <div class="select-items select-hide">
                            <?php
                            $cargo = new cargo;
                            $resultado = $cargo->listar_cargos();
                            while ($linha = $resultado->fetch_array()) {
                                echo '<div class="select-option" data-value="' . $linha['idcargo'] . '">' . $linha['cargo'] . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="idcargo" id="cargo">
                    <div id="error-message-user" class="caixa-de-erro" style="display:none;">Preencha todos os campos!</div>
                    <div id="error-message-senha" class="caixa-de-erro" style="display:none;">Senhas não coincidem!</div>
                </div>
                <button name="salva_funcionario" class="button-save">Salvar</button>
            </form>
        </div>
        <div id="app"></div>
        <div class="modal-cad" id="cadastroCargo">
            <form id="cadastroCargoForm" action="./cad_cargo.php" method="POST">
                <div class="titulo-add">
                    <h3>Cadastrar Cargo</h3>
                    <button type="button" id="btnFecharCadastro"><img src="./assets/img/fechar.png" alt=""></button>
                </div>
                <input type="text" name="cargo" id="cargo_nome" placeholder="Nome do Cargo">
                <div id="error-message" class="caixa-de-erro" style="display:none;">Preencha todos os campos!</div>
                <button type="submit" name="salva_cargo">Cadastrar</button>
            </form>
        </div>
    </main>
    <script src="./script/script-cad-usuario.js"></script>
    <script src="./script/script-password.js"></script>
    <script src="./script/alert.js"></script>
</body>
</html>
<?php
} else {
    header("location: index.php");
}
?>
