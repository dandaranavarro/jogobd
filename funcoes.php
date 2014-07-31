<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head> <meta charset="utf-8" /> 

<link id = "estilo" rel="stylesheet" type="text/css" href="estilo.css" />
</head>


<?php

function acessaBD(){
$servidor = "localhost";
$usuario = "root";
$senha = "vertrigo";

mysql_connect($servidor, $usuario, $senha) or die (mysql_error ()); // Conexao com o Banco de Dados        
mysql_select_db("jogobd") or die(mysql_error()); // Selecao da base de dados
}



function desenhaTabela($nomeTabela){
acessaBD();

//$nomeTabela = "Titular02";// Selecionar o nome da tabela aleatoriamente mais tarde	


echo "<table class = 'tabela tabelaEditavel'><tr><th colspan ='10' bgcolor = '#4682B4'> Tabela " .substr($nomeTabela,0, strlen($nomeTabela) -2). "</th></tr>";// Imprime o nome da tabela sem sair o número

//query SQL para selecionar o nome das colunas da tabela e executa e guarda como uma lista
$listaColunas = mysql_query("SHOW COLUMNS FROM $nomeTabela"); 

// Percorre a lista ($query) e imprime o primeiro elemento de cada registro. Isso porque ($query) eh uma lista composta por 
// varias colunas para cada registro. Uma dessas colunas eh o valor do nome da nossa coluna.
while ($coluna = mysql_fetch_assoc($listaColunas)) {
// Aqui pegamos o valor da coluna "Field" de cada registro, que corresponde ao nome do campo.
$nomeCampo =  $coluna["Field"];

// Para todo nome do campo ele verifica se existe um "_erro" q indica q a coluna eh de erros
// ou se a coluna corresponde a chave primaria de controle interno, caracterizada por id_ seguido do nome da tabela
$ehErro = false;
if (substr($nomeCampo, -5, strlen($nomeCampo)) == "_erro" || $nomeCampo == "id_".$nomeTabela){

$ehErro = true;
}

// Depois soh imprime o nome das colunas que nao tem "_"
if (!$ehErro) {
// Classe "nada" para diferenciar das celulas editaveis
echo "<th bgcolor = '#B0C4DE'>" . $nomeCampo . "</th>";


}	
}


// query SQL que seleciona os dados da tabela
$dadosTabela = mysql_query("SELECT * FROM $nomeTabela");

// Loop pelo recordset $dadosTabela
// Cada linha vai para um array ($linha) usando mysql_fetch_array

while($linha = mysql_fetch_array($dadosTabela)) {
$temp = "<tr>" ;
$tamanhoMax = sizeof($linha)/2; // Numero de colunas de cada linha 
for ($campo = 0; $campo < $tamanhoMax-1 ; $campo++) {	
if ($campo % 2 != 0){ // seleciona soh os dados das colunas que nao tem "_erro"
if ($linha[$campo+1] != null){
$temp =  $temp . "<td class = 'campoErro' id =". $linha[$campo+1].">" . $linha[$campo] . "</td>" ;
}else {
$temp =  $temp . "<td id = null>" . $linha[$campo] . "</td>" ;
}
}	
}
$temp = $temp . "</tr>";

echo $temp ;
}	

echo"</table>";

mysql_close();
}

function selecionaTabelas(){
acessaBD();
$nomesTabelas = mysql_query("SELECT nome FROM tabela WHERE id_cenario = 1");
while($nome = mysql_fetch_assoc($nomesTabelas)){
$nomeTabela = $nome["nome"];
desenhaTabela($nomeTabela);

}

}

function getNivel(){
acessaBD();
$nivel = mysql_query("SELECT nome FROM nivel WHERE id_nivel = 1");
$listaNome = mysql_fetch_array($nivel);
return $listaNome["nome"];
}


function cenarioAleatorio(){
acessaBD();
$sql_cenario = mysql_query("SELECT id_cenario FROM cenario ORDER BY rand()") or die (mysql_error());
$cenario_aleatorio = mysql_fetch_array($sql_cenario);

return $cenario_aleatorio['id_cenario'];
mysql_close();
}
?>
</html>