function validaCampo()
{
	if(document.cadastro.nome.value=="")
	{
		alert("O campo NOME é obrigatório!");
		return false;
	}else if(document.cadastro.username.value==""){
		alert("O campo USUÁRIO é obrigatório!");
		return false;
	}else if(document.cadastro.senha.value==""){
		alert("O campo SENHA é obrigatório!");
		return false;
	}
	
}