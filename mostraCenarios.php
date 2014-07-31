
<?php
/*
Classe que permite a criacao das tabelas de um cenario.

authors: Andreza Raquel e Dandara Navarro
*/
/*Funcao que pesquisa o salario dependendo do nivel do jogador*/
function pesquisaSalario(){
	include ("acessaBD.php"); // acessa o arquivo de conexao com o bd

	$id_nivel = $_SESSION['id_nivel']; // recebe o id_nivel de partidas.js, utilizado para pesquisar de qual nivel se trata
	$consulta = mysql_query("SELECT * FROM nivel WHERE id_nivel = ". $id_nivel); // faz a consulta no bd do nivel
	$nivel = mysql_fetch_array($consulta); // tranforna a pesquisa em um array
	echo $nivel['salarioInicial'];  // imprime o indice do array que se refere ao salario

	mysql_close(); // fecha a conexao 
}

// funcao que desenha na tela cada tabela do cenario
function desenhaTabela($nomeTabela){
	include ("acessaBD.php"); // inclui o arquivo de conexao

	echo "<table class = 'tabela tabelaEditavel'><thead><tr><th colspan ='10' bgcolor = '#4682B4'> Tabela " 
	.substr($nomeTabela,0, strlen($nomeTabela) -2). "</th></tr>";// Imprime o nome da tabela sem sair o número

	//query SQL para selecionar o nome das colunas da tabela e executa e guarda como uma lista
	$listaColunas = mysql_query("SHOW COLUMNS FROM $nomeTabela"); 

	echo "<th bgcolor = '#B0C4DE'></th>"; // Imprime a coluna que serve para marcar erro na linha inteira atraves do checkbox

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
		// Depois soh imprime o nome das colunas que nao tem "_erro"
		if (!$ehErro) {
			echo "<th bgcolor = '#B0C4DE'>" . $nomeCampo . "</th>";
		}	
	}
	echo "</thead><tbody>";
	
	// query SQL que seleciona os dados da tabela
	$dadosTabela = mysql_query("SELECT * FROM $nomeTabela");

	// Loop pelo recordset $dadosTabela
	// Cada linha vai para um array ($linha) usando mysql_fetch_array
	$value = 1;
	while($linha = mysql_fetch_array($dadosTabela)) {
		$tamanhoMax = sizeof($linha)/2; // Numero de colunas de cada linha 
		$temp = "<tr id='".$linha[$tamanhoMax-1]."'><td class = 'tdCheck'><input type='checkbox' value='" .$value++."' name='marcar[]' class='cursor' /></td>" ;
		
		
		for ($campo = 0; $campo < $tamanhoMax-1 ; $campo++) {	
			if ($campo % 2 != 0){ // seleciona soh os dados das colunas que nao tem "_erro"
				if($linha[$tamanhoMax-1] == null){
					if ($linha[$campo+1] != null){
						$temp =  $temp . "<td class = 'campoErro' id =". $linha[$campo+1].">" . $linha[$campo] . "</td>" ;
					} else {
						$temp =  $temp . "<td id = null>" . $linha[$campo] . "</td>" ;
					}
				} else {
					$temp =  $temp . "<td id = null>" . $linha[$campo] . "</td>" ;
				}
			}	
		}
		$temp = $temp . "</tr>";
		
		echo $temp ;
	} // fim while	

	echo"</tbody></table>";
	mysql_close(); // fecha conexao
}

//funcao que seleciona as tabelas de um cenario escolhido aleatoriamente
function selecionaTabelas(){
	include ("acessaBD.php"); // inclui o arquivo de conexao
	
	$numeroMaximoDeCenarios = 2; // Numero de cenarios cadastrados para cada empresa naquele nivel
	
	$cenarioAleatorio = rand(1,$numeroMaximoDeCenarios); // Pesquisa um numero aleatoriamente para ser o cenario
	$listaDeCenarios = $_SESSION['listaDeCenarios'];
	
	// Verifica se o cenario ainda não foi escolhido naquela rodada.
	if (!in_array( $cenarioAleatorio  , $listaDeCenarios)){
	
		// Se ainda não foi escolhido, adiciona na lista de escolhidos
		array_push($listaDeCenarios, $cenarioAleatorio);
		// sessão que guarda a lista de cenarios
		$_SESSION['listaDeCenarios'] = $listaDeCenarios;
		
		$nivelJogador = $_SESSION['id_nivel']; 
		$id_empresa = $_SESSION['id_empresa'];
		
		// Pesquisa das tabelas no cenario escolhido aleatoriamente, na empresa escolhida e com o nivel do jogador 
		$nomesTabelas = mysql_query("SELECT nome FROM tabelas WHERE id_empresa = $id_empresa AND id_nivel = $nivelJogador AND cenario = $cenarioAleatorio"); // consulta a(s) tabela(s) referentes ao cenario

		// percorre a consulta pegando o nome da tabela
		while($nome = mysql_fetch_assoc($nomesTabelas)){
			$nomeTabela = $nome["nome"];
			desenhaTabela($nomeTabela); // manda desenhar cada tabela pesquisada
		}
	} else { // se o cenario já tiver sido retornado antes
		selecionaTabelas();// chama a funcao novamente
	}
}
?>

</html>