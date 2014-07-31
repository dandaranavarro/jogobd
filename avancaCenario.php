<?php
session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["senha"])) {
	header("location: login.php");
	exit;
} 
?>

<?php
	$_SESSION['salarioAtual'] = $_GET['salarioAtual'];
	header('Location: partidas.php');
?>