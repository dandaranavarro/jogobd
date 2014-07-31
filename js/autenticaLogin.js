function loginSuccessFully(){
	setTimeout("window.location = 'boasVindas.php'", 0);
}

function loginFailed() {
	alert("Nome de usuário ou senha Inválida!")
	setTimeout("window.location = 'login.php'", 0);
}