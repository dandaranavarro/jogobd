<?php

require_once 'funcoes.php';

acessaBD();

$id = $_GET['identificador'];

$informacoesErro = mysql_query("SELECT * FROM erros WHERE id_erros = ". $id);

$erro = mysql_fetch_array($informacoesErro);

echo $erro['nome'] . ": ". $erro['descricao'] ; 

?>