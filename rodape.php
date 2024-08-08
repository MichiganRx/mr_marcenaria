<?php 
if (isset($_SESSION['username'])) {

?>
<?php 
}else{
    session_destroy();
    unset($_SESSION['username']);
    header("location: ./index.php");
}
?>