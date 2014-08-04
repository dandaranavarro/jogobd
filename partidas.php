<?php
session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["senha"])) {
	header("location: login.php");
	exit;
} 
?>

<!--
Classe que representa cada partida jogada pelo usuario.

authors: Andreza Raquel e Dandara Navarro
-->

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head> <meta charset="utf-8" /> 

<title>Mr. Data Analyst</title> 

<link id = "estilo" rel="stylesheet" type="text/css" href="css/partidas.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/partidas.js"></script> 

</head>

<body bgcolor = "#BCD2EE" id = "telaFixa">

<h1>Mr. Data Analyst</h1>


<?php	
	$imagem = "img/". $_SESSION['sexo']. ".jpg";		
?>

<img src = "<?php echo $imagem; ?>" width="64" height="80" class = "posicaoAvatar">
<font id = "nomeJogador"><?php echo "Olá, ". $_SESSION['nome'] ?></font>

<?php

include ('acessaBD.php');
$id_nivel = $_SESSION['id_nivel'];
$pesquisaNivel = mysql_query("SELECT * FROM nivel WHERE id_nivel = $id_nivel") or die(mysql_error());
$nivel = mysql_fetch_array($pesquisaNivel);

$salarioAtual = $_SESSION['salarioAtual'];
$listaDeCenarios = $_SESSION['listaDeCenarios'];

echo "<div id = 'nivelJogador'>(".$nivel['nome']. ")</div>"; 
?>
<div id = 'divPlacar'> R$<font id = "placar"><?php echo $salarioAtual;?></font>,00</div>

<font id = "contadorRegressivo"><span id="clock1"></span><script id = 'script'></script></font>
<div id = "divContador" class = "posErros">Erros:  <font id = "numeroDeErrosMarcados" color = 'red'>0</font>  /  <font id = "numeroDeErrosExistentes"></font></div>

<a type = "button" href= "logout.php">Sair</a>

<HR WIDTH = 100%  color = "blue" class = "posLinha">

<?php
require_once 'mostraCenarios.php'; // conexao com o arquivo que desenha os cenarios na tela
if (count($listaDeCenarios) < 2){
	selecionaTabelas();
} else {
	echo 'Ir para outra página!! Você concluiu a fase estagiário';
}
?>

<!--Botão que avança quando está enable.Precisa redirecionar para outra página e verificar os erros e acertos do usuario.--->
<div id = 'divBotao'>
<input type = "button" id = 'buttonAvancar' value = "Avançar" class = "botaoAvancar disable" onclick = "avancar(false)" action = "mostraCenarios.php"/>
</div>
<div>
<div id = "divResultado"></div>
<div id = "divInformes"></div>
<div id = "divScore"></div>
<div>

</body>
</html>