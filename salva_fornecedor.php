<?php
session_start();
include('./banco.php');
include('./class.php');

$db = new banco;

if (isset($_SESSION['username'])) {
    if (isset($_POST['salva_fornecedor'])) {
        $nomeFornecedor = mysqli_real_escape_string($db->conn, $_POST['nome_forn']);
        $telefone = mysqli_real_escape_string($db->conn, $_POST['telefone']);
        $tipoForn = mysqli_real_escape_string($db->conn, $_POST['tipo_forn']);

        $lista = [
            'nomefornecedor' => $nomeFornecedor,
            'telefone' => $telefone,
            'tipoforn' => $tipoForn,
        ];

        $fornecedor = new fornecedores;
        $retorno = $fornecedor->cadastrar_fornecedor($lista);

        if ($retorno) {
            $_SESSION['message'] = "Cadastrado com Sucesso!";
            sleep(2);
            header("Location: ./cadastro_fornecedor.php?b=1");
            exit(0);
        } else {
            $error = $db->conn->error;
            $_SESSION['message'] = "Algo deu errado: $error";
            header("Location: ./cadastro_fornecedor.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Acesso não autorizado.";
        header("Location: ./cadastro_fornecedor.php");
        exit(0);
    }
} else {
    header("Location: ./index.php");
}
?>
