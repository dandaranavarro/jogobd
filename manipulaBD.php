<?php
require_once 'funcoes.php';

//Tabela com 4 campos que aparecem
function insereDados4($nomeTabela, $idTabela, $campo1, $campo1_erro, $campo2, $campo2_erro,
$campo3, $campo3_erro, $campo4, $campo4_erro, $linha_erro){
acessaBD();
$strSQL1 = "INSERT INTO " . $nomeTabela . " VALUES(" . $idTabela .",". $campo1. "," .$campo1_erro . ",".
$campo2 . "," . $campo3 . "," . $campo3_erro . "," . $campo4 . "," . $campo4_erro . "," . $linha_erro. ")";

mysql_query($strSQL1) or die (mysql_error());

//	mysql_close();


}

function insereDados5($nomeTabela, $idTabela, $campo1, $campo1_erro, $campo2, $campo2_erro,
$campo3, $campo3_erro, $campo4, $campo4_erro, $campo5, $campo5_erro, $linha_erro){
acessaBD();
mysql_query( "INSERT INTO " . $nomeTabela . " VALUES(" . $idTabela .",". $campo1. "," .$campo1_erro . ",".
$campo2 . "," . $campo3 . "," . $campo3_erro . "," . $campo4 . "," . $campo4_erro . ","
. $campo5 . "," . $campo5_erro.",". $linha_erro. ")");

//	mysql_query($strSQL1) or die (mysql_error());
}

function criaTabela($nomeTabela, $campo1, $campo1_tipo, $campo2, $campo2_tipo, $campo3, $campo3_tipo, $campo4, $campo4_tipo){
acessaBD();
mysql_query("CREATE TABLE " .$nomeTabela ." (id_" . $nomeTabela . " INT(2)," . $campo1 ." ". $campo1_tipo. ",". $campo1 . "_erro INT(2),"
. $campo2 ." ".$campo2_tipo .",". $campo2 . "_erro INT(2)," .$campo3 ." ". $campo3_tipo. ",". $campo3 . "_erro INT(2)," .
$campo4. " ". $campo4_tipo. ",". $campo4 . "_erro INT(2),". "linha_erro INT(2), PRIMARY KEY (id_" . $nomeTabela . "))") Or die(mysql_error());

mysql_close();

}


?>
