<?php
session_start();
include('./banco.php');
include('./class.php');
$db = new banco;

if (isset($_SESSION['username'])) {

    if (isset($_POST['atualiza_produto'])) {
        echo "<pre>";
        print_r($_POST);

        if(isset($_POST['idestoque'])){
            $ide = $_POST['idestoque'];
        }else{
            $ide = 1;
        }
        if(isset($_POST['idfornecedores'])){
            $idf = $_POST['idfornecedores'];
        }else{
            $idf = 1;
        }

         $inputData = [
            'idproduto' => mysqli_real_escape_string($db->conn, $_POST['idproduto']),
            'nomeproduto' => mysqli_real_escape_string($db->conn, $_POST['nomeproduto']),
            'minimo' => mysqli_real_escape_string($db->conn, $_POST['minimo']),
            'saldo' => mysqli_real_escape_string($db->conn, $_POST['saldo']),
            'idestoque' => mysqli_real_escape_string($db->conn, $ide),
            'idfornecedores' => mysqli_real_escape_string($db->conn, $idf),
        ];
        $acao = 1;
        $produto = new produto;
        $comando = $produto->editar_produto($inputData, $acao);

        if ($comando > 0) {
            echo  $texto = "<span style='color:red'> " . $_POST['nomeproduto'] . "</span>";
            $_SESSION['message'] = "Atualizado  Produto:" . $texto;
            sleep(2);
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");
            exit(0);
        } else {
            $_SESSION['message'] = "Não atualizado =)";
            header("Location: " . $_SERVER['HTTP_REFERER'] . "");
            exit(0);
        }
    }
} else {
    header("Location: ./index.php");
}
