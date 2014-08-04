<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html"; charset="UTF-8">
    <title>Cadastro</title> 
	
    <link id = "estilo" rel="stylesheet" type="text/css" href="css/paginaInicial.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/settings.js"></script>
	<script type="text/javascript" src="js/cadastro.js"></script>

<SCRIPT type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "loader.gif";

$(document).ready(function(){

$("#username").change(function() { 

var usr = $("#username").val();

if(usr.length >= 3)
{
$("#status").html('<img src="img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "check.php",  
    data: "username="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#username").removeClass('object_error'); // if necessary
		$("#username").addClass("object_ok");
		$(this).html('&nbsp;<img src="img/accepted.png" align="absmiddle"> <font color="Green"> Available </font>  ');
	}  
	else  
	{  
		$("#username").removeClass('object_ok'); // if necessary
		$("#username").addClass("object_error");
		$(this).html(msg);
	}  
   
   });
 } 
  }); 

}
else
	{
	$("#status").html('<font color="red">The username should have at least <strong>3</strong> characters.</font>');
	$("#username").removeClass('object_ok'); // if necessary
	$("#username").addClass("object_error");
	}

});

});


</SCRIPT>
  
  </head>
  
  <body>
		<div id='tudo'>
		<div id='conteudo'>
			<?php
				session_start();
			?>
		 
			<img src = "img/investigador.jpg" width="200" height="180" class = "investigador">
			<font id = 'nomeJogo'> Mr. Data Analyst</font>
			
			<form name="cadastro" method="post" action="realizaCadastro.php" id = "formulario" onsubmit="return validaCampo();"> 
			<table >
					
					<tr>
					  <td width="35%">Nome:</td>
					  <td width="65%"><input name="nome" type="text" id="nome" size="30" maxlength="20" />
					</tr>
					
					 <tr width = "100%">
						<td width="35%"  valign="middle" id="abc">Usuário:</td>
						<td width="65%"  valign="middle" ><input id="username"  type="text" name="username" onkeyup="twitter.updateUrl(this.value)" class="inn" />
				  &nbsp;<span id="username_url"  style="color:#006600; font-weight:bold;">USUÁRIO</span> </td>
						<td align="left" valign="bottom" height="20px"><div id="status"></div></td>
					</tr>
					<tr>
						<td>Sexo:</td>
						<td><input name="sexo" type="radio" value="masculino" id="masculino" checked="checked" />
						Masculino
						<input name="sexo" type="radio" value="feminino" id="feminino"/>
						Feminino 
					</tr>
					
					<tr>
					  <td>Senha:</td>
					  <td><input name="senha" type="password" id="senha" maxlength="12" />
						  
					</tr>
					
					<tr>
						<td colspan="2"><p>
						<input type="submit" VALUE="ENTRAR" class = 'botaoEntrar'>
					</tr>	
					
				
			  
				 </table>
			  
			</form>
		</div>
	</div>
  </body>
  </html>