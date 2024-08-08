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
    
    <title>Página Inicial</title>
</head>
<body>
    <main>
        <section class="container">
            <div>
                <form action="./autentica.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <img src="./assets/img/logo.png" alt="">
                        <span>E-mail</span>
                        <input type="email" name="login" id="login" placeholder="Ex: maria@email.com" required>
                        <span>Senha</span>
                        <div class="container-input">
                            <input type="password" name="senha" id="senha" placeholder="Senha" required>
                            <button type="button" id="togglePassword">
                                <img src="./assets/img/olho-aberto.png" alt="" id="olho-1">
                            </button>
                        </div>
                        <button type="submit" name="autentica">Entrar</button>
                        <a href="./recuperar_senha.php" class="esqueceu-senha">Esqueceu a senha?<b>Redefinir</b></a>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script src="./script/script-password.js"></script>
</body>
</html>
