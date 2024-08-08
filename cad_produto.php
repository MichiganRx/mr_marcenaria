<?php
session_start();
include('./banco.php');
include('./class.php');
$db = new banco;
if (isset($_SESSION['username'])) {
 


if (isset($_POST['salva_produto'])) {

    $lista = [
        'produto' => mysqli_real_escape_string($db->conn, $_POST['produto']),
        'saldo' => mysqli_real_escape_string($db->conn, $_POST['saldo']),
        'minimo' => mysqli_real_escape_string($db->conn, $_POST['minimo']),            
        'idestoque' => mysqli_real_escape_string($db->conn, $_POST['idestoque']),
        'idfornecedor' => mysqli_real_escape_string($db->conn, $_POST['idfornecedores']),
    ];

    $produto = new produto;
    $retorno = $produto->cadastrar($lista);

   if($retorno){
    $_SESSION['message'] = ": ".$_POST['produto']." - Cadastrado com sucesso!";
    sleep(2);
    header("location: ./home.php?a=1");
    exit(0);

   }else{
    $_SESSION['message'] = "- Não cadastrado!";
    header("location: ./home.php");
    exit(0);

   }


}else{
    $_SESSION['message'] = "Tu ta tentando acessar direto =)";
    header("location: ./home.php");
    exit(0);
}
}else{
  header("location: ./index.php");
}
?> 