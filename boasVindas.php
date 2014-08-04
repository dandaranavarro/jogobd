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

<title>Mr. Data Analyst</title> 

	<link id = "estilo" rel="stylesheet" type="text/css" href="css/paginaInicial.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>

</head>
	<body>
	<div id='tudo'>
		<div id='conteudo'>
	
	<?php
		$nome = $_SESSION['nome'];
		$boasVindas = "";
		$frase = "";
		$imagem = "img/";
		$genero = $_SESSION['sexo'];
		if ($genero == "feminino"){
			$boasVindas = "Seja bem-vinda, ".$nome;
			$frase = "	Agora você é uma Cientista da Computação desejando trabalhar como um Analista de Dados. \n
			É necessário experiência. Assim, você precisa começar como uma estagiária, se tornar uma analista de dados júnior, analista de dados 
			pleno e, finalmente, uma analista de dados sênior. Boa sorte!";
			$imagem = $imagem . "mulher_analista.jpg";
		}else if($genero == "masculino"){
			$boasVindas = "Seja bem-vindo, ".$nome;
			$frase = "	Agora você é um Cientista da Computação desejando trabalhar como um Analista de Dados.
			É necessário experiência. Assim, você precisa começar como um estagiário, se tornar um analista de dados júnior, analista de dados 
			pleno e, finalmente, um analista de dados sênior. Boa sorte!";
			$imagem = $imagem . "homem_analista.jpg";
		}	
	?>
	<form method = "LINK" action = "classificados.php"><input type="submit" class="botaoAvanca" value=""></form>
	
	
	<div id = 'mensagemInicial'>
		<h1><?php echo $boasVindas ?></h1>
		<h2><p><?php echo $frase ?></h2>
		<img src = "<?php echo $imagem; ?>" width='230' height='350' border='3px'class='posAnalista'>
	</div>
	
		</div>
	</div>
	</body>
</html>