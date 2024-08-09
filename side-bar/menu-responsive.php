<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <i class="bi bi-list" id="toggleBtn"></i>
    <div class="bg-menu" id="menu_container">
        <div class="menu" id="menu">
            <img src="./assets/img/logo.png" alt="" class="logo">
            <ul>
                <li class="item-menu" id="home">
                    <a href="./home.php">
                        <span class="icon"><i class="bi bi-house-door"></i></span>
                        <span class="txt-link">Home</span>
                    </a>
                </li>
                <li class="item-menu" id="listaDeCompra">
                    <a href="./lista_de_compra.php" >
                        <span class="icon"><i class="bi bi-cart-check"></i></span>
                        <span class="txt-link">Lista de Compra</span>
                    </a>
                </li>
                <li class="item-menu" id="addUsuario">
                    <a href="./cadastro_usuario.php">
                        <span class="icon"><i class="bi bi-person-plus"></i></span>
                        <span class="txt-link">+ Usuario</span>
                    </a>
                </li>
                <li class="item-menu" id="addFornecedor">
                    <a href="./cadastro_fornecedor.php">
                        <span class="icon"><i class="bi bi-bag-check"></i></span>
                        <span class="txt-link">+ Fornecedor</span>
                    </a>
                </li>
                <li class="item-menu" id="sair">
                    <a href="./sair.php">
                        <span class="icon"><i class="bi bi-box-arrow-in-left"></i></span>
                        <span class="txt-link">Sair</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script>
        document.getElementById('toggleBtn').addEventListener('click', function(event) {
            var menu_container = document.getElementById('menu_container');
            var menu = document.getElementById('menu');
            if (menu_container.style.display === 'none' || menu_container.style.display === '') {
                menu_container.style.display = 'block';
                menu.classList.add('visible');
                document.body.style.overflow = 'hidden';
                document.documentElement.style.overflow = 'hidden';
            } else {
                menu_container.style.display = 'none';
                menu.classList.remove('visible');
                document.body.style.overflow = '';
                document.documentElement.style.overflow = '';
            }
        });

        document.getElementById('menu_container').addEventListener('click', function() {
            var menu_container = document.getElementById('menu_container');
            var menu = document.getElementById('menu');
            menu_container.style.display = 'none';
            menu.classList.remove('visible');
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        });

        document.getElementById('menu').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>
</body>
</html>
