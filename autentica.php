<?php 
     session_start();
     include ('./class.php');
     include ('./banco.php');

     $db = new banco;

     if(isset($_POST['autentica'])){
     $login = $_POST['login'];
     $senha = $_POST['senha'];

     $teste = [  
     'login' => mysqli_real_escape_string($db->conn, $login),
     'senha' => mysqli_real_escape_string($db->conn, $senha)];

     $validar =  new funcionario;
     $resultado = $validar->validar($teste);
     if($resultado == 1){
          $_SESSION['message'] = "Bem vindo(a): &nbsp;".$login;
          
          $_SESSION['username'] = $login;

     header('location: ./home.php');
     }else{
          $_SESSION['message'] = "Login incorreto";
     header('location: ./index.php');
     }

     }else{
     $_SESSION['message'] = "deu errado";
          header('location: ./index.php');
     }
?>
