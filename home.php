<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head> <meta charset="utf-8" /> 

<title>Mr. Data Analyst</title> 

<link id = "estilo" rel="stylesheet" type="text/css" href="estilo.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="script.js"></script> 

</head>



<body bgcolor = "#BCD2EE" id = "telaFixa">

<h1>Mr. Data Analyst</h1>

<img src = "homem.jpg" width="64" height="80" class = "posicaoAvatar">
<font id = "nomeJogador">Marcos Silva</font>

<?php
require_once 'funcoes.php';
echo "<div id = 'nivelJogador'>(".getNivel(). ")</div>"; 
?>
<font id = "placar"> R$1000,00</font>

<font id = "contadorRegressivo"><span id="clock1"></span><script id = 'script'></script></font>
<div id = "divContador" class = "posErros">Erros:  <font id = "numeroDeErrosMarcados">0</font>  /  <font id = "numeroDeErrosExistentes"></font></div>

<HR WIDTH = 100%  color = "blue" class = "posLinha">

<?php
require_once 'funcoes.php';

selecionaTabelas();
cenarioAleatorio();

?>


<!--Botão que avança quando está enable.Precisa redirecionar para outra página e verificar os erros e acertos do usuario.--->
<div id = 'divBotao'>
<input type = "button" value = "Avançar" class = "botaoAvancar disable" onclick = "avancar(false)" action = "funcoes.php"/>
</div>
<div>
<div id = "divResultado"></div>
<div id = "divInformes"></div>
<div id = "divScore"></div>
<div>
</body>
</html>