<?php
session_start();
include('banco.php');
include('class.php');
$db = new banco;

if (isset($_SESSION['username'])) {
    if (isset($_POST['salva_funcionario'])) {
        $inputData = [
            'nome' => mysqli_real_escape_string($db->conn, $_POST['nome']),
            'login' => mysqli_real_escape_string($db->conn, $_POST['login']),
            'senha' => mysqli_real_escape_string($db->conn, $_POST['senha']),
            'confirma_senha' => mysqli_real_escape_string($db->conn, $_POST['senha_confirma']),
            'idcargo' => mysqli_real_escape_string($db->conn, $_POST['idcargo']),
        ];

        $senha = $_POST['senha'];
        $senha_confirma = $_POST['senha_confirma'];

        if ($senha !== $senha_confirma) {
            $_SESSION['message'] = "Senhas diferentes";
            header("location: ./cadastro_usuario.php");
        } else if (!empty($senha) && !empty($inputData['idcargo'])) {
            $funcionario = new funcionario;
            $result = $funcionario->criar($inputData);

            if ($result) {
                $_SESSION['message'] = "Cadastro ok - bem vindo " . $_POST['nome'];
                sleep(2);
                header("location: ./cadastro_usuario.php?c=1");
                exit(0);
            } else {
                $_SESSION['message'] = "Erro ao cadastrar";
                header("location: ./cadastro_usuario.php?c=1");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Campos obrigatórios não preenchidos";
            header("location: ./cadastro_usuario.php");
        }
    } else {
        $_SESSION['message'] = "Requisição inválida.";
        header("location: ./cadastro_usuario.php");
    }
} else {
    header("location: ./index.php");
}
?>
