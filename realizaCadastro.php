<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
	session_start();
	include ('acessaBD.php');
	
	$nome= $_POST ["nome"];
	$usuario_login = $_POST["username"];
	$sexo = $_POST["sexo"];
	$usuario_senha = $_POST["senha"];
	$id_nivel = 1;
	
	
	
	$strSQL1 = "INSERT INTO `cadastros` (`usuario`,`senha`,`nome`,`sexo`, `id_nivel`) VALUES ('$usuario_login', '$usuario_senha', '$nome', '$sexo', '$id_nivel')";
	mysql_query($strSQL1) or die (mysql_error());

	$_SESSION['login'] = $usuario_login;
	$_SESSION['senha'] = $usuario_senha;
	$_SESSION['nome'] = $nome;
	$_SESSION['sexo'] = $sexo;
	$_SESSION['id_nivel'] = $id_nivel;
	
	header("location: boasVindas.php");
}
?>

