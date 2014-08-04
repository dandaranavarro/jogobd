<?php
/*
Classe que faz a conexao com o banco de dados mysql.

authors: Andreza Raquel e Dandara Navarro
*/

$servidor = "localhost"; // o servidor onde está o bd
$usuario = "root"; // o usuario que solicita acesso
$senha = "vertrigo"; // a senha desse usuario

mysql_connect($servidor, $usuario, $senha) or die (mysql_error ()); // Conexao com o Banco de Dados        
mysql_select_db("jogobd") or die(mysql_error()); // Selecao da base de dados

?>