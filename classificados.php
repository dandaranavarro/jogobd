<?php
session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["senha"])) {
	header("location: login.php");
	exit;
} 
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta charset="utf-8" />
<title>Classificados</title> 

<link id = "estilo" rel="stylesheet" type="text/css" href="css/classificados.css" />
<link id = "estilo" rel="stylesheet" type="text/css" href="css/confirmaCenario.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/proposta.js"></script> 
</head>

	<body>
	<div id='tudo'>
		<div id='conteudo'>
			<div id = 'jornal'>	
				<img src="img/classificados/classificados.jpg" width='941' height='548'>	
			</div>
		
		<a href="#janela1" rel="modal" name = '1' onclick ='mostraFrame(1);'><img class="anuncio01"></a>
		<a href="#janela1" rel="modal" name = '2' onclick ='mostraFrame(2);'><img class="anuncio02"></a>
		<a href="#janela1" rel="modal" name = '3' onclick ='mostraFrame(3);'><img class="anuncio03"></a>
		<a href="#janela1" rel="modal" name = '4' onclick ='mostraFrame(4);'><img class="anuncio04"></a>
		<a href="#janela1" rel="modal" name = '5' onclick ='mostraFrame(5);'><img class="anuncio05"></a>
		<a href="#janela1" rel="modal" name = '6' onclick ='mostraFrame(6);'><img class="anuncio06"></a>
		<a href="#janela1" rel="modal" name = '7' onclick ='mostraFrame(7);'><img class="anuncio07"></a>
		<a href="#janela1" rel="modal" name = '8' onclick ='mostraFrame(8);'><img class="anuncio08"></a>
		<a href="#janela1" rel="modal" name = '9' onclick ='mostraFrame(9);'><img class="anuncio09"></a>
		
		<div class="window" id="janela1">			
		</div>
			
 
	</div>
	</div>
	</body>

</html>