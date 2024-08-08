<?php
    session_start();
    include('./banco.php');
    include('./class.php');
    $db = new banco;
    if (isset($_SESSION['username'])) {

    $id = $_GET['idproduto'];
    $acao = 1;

    $produto = new produto;
    $comando = $produto->excluir_produto($id,$acao);

    if ($comando > 0) {
        $texto = "<span style='color:red'> ".$_GET['nome']."</span>";
        $_SESSION['message'] = "Produto retirado: ".$texto;
        header("Location: ./lista_de_compra.php?a=2");
        exit(0);
    } else {
        $_SESSION['message'] = "Tu ta tentando acessar direto =)";
        header("Location: ./index.php");
        exit(0);
    }
    }else{
        header("location: ./index.php");
    }
?>