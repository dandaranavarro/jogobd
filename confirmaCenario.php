<?php
session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["senha"])) {
	header("location: login.php");
	exit;
} 
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head> <meta charset="utf-8" /> 

<title>Confirmação de Emprego</title>
<link id = "estilo" rel="stylesheet" type="text/css" href="css/confirmaCenario.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/proposta.js"></script>
<body>
<?php
$_SESSION['id_empresa'] = $_GET['id_empresa']; // Criacao da sessao com o id da empresa que o usuario selecionou

include ('acessaBD.php'); // inclusao do arquivo de acesso ao banco de dados

// pesquisa o nivel do uaurio atual
$pesquisaNivel = mysql_query("SELECT * FROM nivel WHERE id_nivel = ". $_SESSION['id_nivel']);

$nivel = mysql_fetch_array($pesquisaNivel); // transforma a pesquisa em um array

$nomeNivel = $nivel['nome']; // seleciona o nome do nivel e guarda na variavel

$salarioInicial = $nivel['salarioInicial']; // seleciona o salario referente ao nivel e guarda numa variavel
$_SESSION['salarioAtual'] = $salarioInicial;
$_SESSION['listaDeCenarios'] = array();

?>
<div id="anuncioAmpliado">

	<h1>Mr. Data Analyst</h1>
	
	
	<h2>Necessitamos Urgentemente!!!</h2>


	<h2><?php echo $nomeNivel;?></h2>
	<h2>Salário Inicial: R$ <?php echo $salarioInicial;?></h2>
	
	<form method = "LINK" action = "javaScript:parent.location = 'partidas.php'"> <INPUT TYPE="submit" VALUE="" class = 'botaoAceita'> </FORM>
	<form method = "LINK" action = "javaScript:parent.location = 'classificados.php'"> <INPUT TYPE="submit" VALUE="" class = 'botaoRejeita'> </FORM>
</div>
</body>
</html>
