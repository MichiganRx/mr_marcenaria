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
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="icon" href="./assets/favicon/favicon.ico">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <title>Cadastrar Novo Fornedor</title>
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
            <form  action="./salva_fornecedor.php" method="POST" id="cadFornecedor">
                <div class="container-content">
                    <div class="title-table">
                        <h2>Cadastrar Fornecedor</h2>
                        <button id="btnAdicionarTipo" type="button"><img src="./assets/img/adicionar.png" alt="">Adicionar Tipo</button>
                    </div>
                    <input type="text" name="nome_forn" id="nome_forn" placeholder="Nome do Fornecedor">
                    <input type="tel" maxlength="15" onkeyup="handlePhone(event)" name="telefone" id="telefone" placeholder="Telefone"/>
                    <div class="custom-select" id="tipo-select">
                        <div class="select-selected" required>Tipo de Fornecedor<i class="bi bi-caret-down-fill"></i></div>
                        <div class="select-items select-hide">
                            <?php
                            $tipo = new tipo;
                            $resultado = $tipo->listar_tipos();
                            while ($linha = $resultado->fetch_array()) {
                                echo '<div class="select-option" data-value="' . $linha['idtipo'] . '">' . $linha['tipo'] . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="tipo_forn" id="tipo_forn">
                    <div id="error-message-user" class="caixa-de-erro" style="display:none;"><span>Preencha todos os campos!</span></div>
                </div>
                <button name="salva_fornecedor" class="button-save">Salvar</button>
            </form>
        </div>
        <div id="app"></div>
        <div class="modal-cad" id="cadastroTipo">
            <form id="cadastroTipoForm" action="./cad_tipo.php" method="POST">
                <div class="titulo-add">
                    <h3>Cadastrar Tipo</h3>
                    <button type="button" id="btnFecharCadastro"><img src="./assets/img/fechar.png" alt=""></button>
                </div>
                <input type="text" name="tipo" id="tipo_nome" placeholder="Tipo de Fornecedor">
                <div id="error-message" class="caixa-de-erro" style="display:none;"><span>Preencha todos os campos!</span></div>
                <button type="submit" name="salva_tipo">Cadastrar</button>
            </form>
        </div>
    </main>
    <script src="./script/script-cad-fornecedor.js"></script>
    <script src="./script/alert.js"></script>
    <script>
        const handlePhone = (event) => {
        let input = event.target
        input.value = phoneMask(input.value)
      }
      
      const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g,'')
        value = value.replace(/(\d{2})(\d)/,"($1) $2")
        value = value.replace(/(\d)(\d{4})$/,"$1-$2")
        return value
      }
    </script>

</body>
</html>
<?php
} else {
    header("location: index.php");
}
?>
