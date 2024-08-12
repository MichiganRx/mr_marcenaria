<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./style/global.scss" rel="stylesheet">
        <link href="./style/index.scss" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
        <link rel="icon" href="./assets/favicon/favicon.ico">
        <link rel="manifest" href="./assets/favicon/site.webmanifest">
        <title>Recuperação de Senha</title>
    </head>
    <body class="container">
        <div>
            <form id="passwordForm" action="./autentica.php" method="POST" enctype="multipart/form-data">
                <div>
                    <img src="./assets/img/logo.png" alt="">
                    <span>Nova Senha</span>
                    <div class="container-input">
                        <input type="password" name="novaSenha" id="novaSenha" placeholder="Senha" required>
                        <button type="button" id="togglePassword">
                            <img src="./assets/img/olho-aberto.png" alt="" id="olho-1">
                        </button>
                    </div>
                    <span>Repetir Senha</span>
                    <input type="password" name="repetirSenha" id="repetirSenha" placeholder="Repetir Senha" required>
                    <span id="error-message" class="error-message">As senhas não coincidem!</span>
                    <button type="submit" name="autentica">Salvar</button>
                    <a href="./index.php" class="esqueceu-senha"><img src="./assets/img/voltar.png" alt=""><b>Voltar</b></a>
                </div>
            </form>
        </div>
        <script>
            document.getElementById('passwordForm').addEventListener('submit', function(event) {
                var novaSenha = document.getElementById('novaSenha').value;
                var repetirSenha = document.getElementById('repetirSenha').value;
                var errorMessage = document.getElementById('error-message');

                if (novaSenha !== repetirSenha) {
                    event.preventDefault();
                    errorMessage.style.display = 'block';
                } else {
                    errorMessage.style.display = 'none';
                }
            });

            document.getElementById('togglePassword').addEventListener('click', function() {
                var novaSenha = document.getElementById('novaSenha');
                var olho = document.getElementById('olho-1');
                if (novaSenha.type === 'password') {
                    novaSenha.type = 'text';
                    olho.src = './assets/img/olho-fechado.png';
                } else {
                    novaSenha.type = 'password';
                    olho.src = './assets/img/olho-aberto.png';
                }
            });
        </script>
        
    </body>
</html>
