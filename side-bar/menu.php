<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral</title>
    <link rel="stylesheet" href="./style.scss">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style/global.scss">
</head>
<body>
    <nav class="menu-lateral">
        <div class="btn-expandir">
            <i class="bi bi-list" id="btn-exp"></i>
        </div>
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
    </nav>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const path = window.location.pathname;
            const page = path.split("/").pop();

            const menuItems = {
                'home.php': 'home',
                'lista_de_compra.php': 'listaDeCompra',
                'cadastro_usuario.php': 'addUsuario',
                'cadastro_fornecedor.php': 'addFornecedor',
                'sair.php': 'sair',
            };

            if (menuItems[page]) {
                document.getElementById(menuItems[page]).classList.add('ativo');
            }
        });
        var menuItem = document.querySelectorAll('.item-menu')

        function selectLink(){
            menuItem.forEach((item)=>
                item.classList.remove('ativo')
            )
            this.classList.add('ativo')
        }

        menuItem.forEach((item)=>
            item.addEventListener('click', selectLink)
        )

        var btnExp = document.querySelector('#btn-exp')
        var menuSide = document.querySelector('.menu-lateral')

        btnExp.addEventListener('click', function(){
            menuSide.classList.toggle('expandir')
        })
    </script>
</body>
</html>
