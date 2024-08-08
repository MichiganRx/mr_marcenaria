<?php
session_start();
include('banco.php');
include('class.php');
$db = new banco;

if (isset($_POST['salva_tipo'])) {
    $lista = [
        'tipo' => mysqli_real_escape_string($db->conn, $_POST['tipo']),     
    ];

    $tipo = new tipo;
    $retorno = $tipo->cadastrar_tipo($lista);

    if ($retorno) {
        $_SESSION['message'] = "Cadastro realizado com sucesso.";
        sleep(2);
        header("location: ./cadastro_fornecedor.php?d=1");
        exit(0);
    } else {
        $_SESSION['message'] = "Erro ao realizar o cadastro. Por favor, tente novamente.";
        header("location: ./cadastro_fornecedor.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Acesso não autorizado.";
    header("location: ./cadastro_fornecedor.php");
    exit(0);
}
?>
