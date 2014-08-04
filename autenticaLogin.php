<!DOCTYPE html>
<!-- 
Classe que faz a pesquisa dos dados do usuario cadastrado.

authors: Andreza Raquel e Dandara Navarro
-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta charset="utf-8" /> 

<title>Login Mr. Data Analyst</title> 

<link id = "estilo" rel="stylesheet" type="text/css" href="css/paginaInicial.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/autenticaLogin.js"></script> 
</head>

<body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
include ("acessaBD.php");

$usuario_login = $_POST["login"];
$usuario_senha = $_POST["senha"];

$sql = mysql_query("SELECT * FROM cadastros WHERE usuario = '$usuario_login' and senha = '$usuario_senha'") or die(mysql_error());

$cadastro = mysql_fetch_array($sql);

if (mysql_num_rows($sql) > 0){
	session_start();
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['senha'] = $_POST['senha'];
	$_SESSION['nome'] = $cadastro['nome'];
	$_SESSION['sexo'] = $cadastro['sexo'];
	$_SESSION['id_nivel'] = $cadastro['id_nivel'];
	
	echo "<script>loginSuccessFully()</script>";
} else{	
	echo "<script>loginFailed()</script>";
}
} 
?>
</body>
</html>