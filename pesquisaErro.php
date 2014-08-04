<?php
session_start();

if (!isset($_SESSION["login"]) || !isset($_SESSION["senha"])) {
	header("location: login.php");
	exit;
} 
?>
<?php
/*
Classe que faz a pesquisa no banco de dados do erro que aparece ao usuario.
Sao informados o nome e a descricao do erro.

authors: Andreza Raquel e Dandara Navarro
*/

include ("acessaBD.php"); // acessa o arquivo de conexao com o bd

$id = $_GET['identificador']; // recebe o id do erro em questao

$informacoesErro = mysql_query("SELECT * FROM erros WHERE id_erros = ". $id); // pesquisa no bd o erro que tem o id recebido

$erro = mysql_fetch_array($informacoesErro); // transforma a pesquisa em um array

echo $erro['nome'] . ": ". $erro['descricao'] ; // imprime od indices do array referentes ao nome e a descricao do erro

mysql_close(); // fecha a conexao
?>