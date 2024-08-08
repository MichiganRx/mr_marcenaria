<?php
session_start();
include('./banco.php');
include('./class.php');
$db = new banco;


if (isset($_POST['salva_cargo'])) {
    $lista = [
        'cargo' => mysqli_real_escape_string($db->conn, $_POST['cargo']),     
    ];

    $cargo = new cargo;
    $retorno = $cargo->cadastrar_cargo($lista);

   if($retorno){
    $_SESSION['message'] = "amem";
    sleep(2);
    header("location: ./cadastro_usuario.php?d=1");
    exit(0);

   }else{
    $_SESSION['message'] = "errou BB";
    header("location: ./cadastro_usuario.php");
    exit(0);

   }


}else{
    $_SESSION['message'] = "Tu ta tentando acessar direto =)";
    header("location: ./cadastro_usuario.php");
    exit(0);
}
?>