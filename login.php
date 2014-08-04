<html>
<head>
<title> Login Mr. Data Analyst</title>
<link id = "estilo" rel="stylesheet" type="text/css" href="css/paginaInicial.css" />
</head>

<body>
	<div id='tudo'>
		<div id='conteudo'>
			<img src = "img/investigador.jpg" width="200" height="180" class = "investigador">
			<font id = 'nomeJogo'> Mr. Data Analyst</font>

			<form method="post" action="autenticaLogin.php" id = 'formulario'>

				<h3>Login:</h3>
				<input type="text" name="login" maxlength="60"/>
				<h3>Senha:</h3>
				<input type="password" name="senha" maxlength="60" />
				</br></br>
				<input type="submit" value="Entrar" class='botao3d'/>

			</form>
		</div>
	</div>
</body>
</html>