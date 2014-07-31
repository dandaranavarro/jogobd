/* Arquivo javascript para dinamismo da pagina onde o jogador 
marca os erros e avanca, verificando sua pontuacao

authors: Andreza Raquel e Dandara Navarro
*/

var errosExistentes = 0;
var numErrosEncontrados = 0;
var numNaoMarcados = 0;
var numMarcacoesIncorretas = 0;
var clicked = 0;
var tempo;
var horas = "0"+0; 
var minutos = "0" + 5;
var segundos = +1;

/*Funcao que eh chamada sempre q a pagina carrega*/
$(function () {
	selecionaCelula(); // Funcao que colore a celula marcada com o clique do mouse
	document.getElementById('script').innerHTML = setTimeout('contadorRegressivo()',1000);	// Contador regressivo aparecer na tela
	mostraErrosExistentes(); // Conta os erros existentes no cenario
	selecionaLinha(); // Marca a linha inteira como erro
});

/*Funcao que marca a celula quando o mouse eh clicado*/
function selecionaCelula(){		
	$("table > tbody > tr > td").click(function () {	// Evento acionado quando uma td é clicada
		var tr = $(this).parent();
		
		if (tr.attr("class") != "selected" && $(this).hasClass("destaque")){	// se a celula jah foi clicada, desmarque
			
			clicked--;	// numero de marcacoes diminui
			$(this).removeClass("destaque"); // remove a cor rosa

		} else if (tr.attr("class") != "selected" && clicked < errosExistentes && $(this).attr("class") != "tdCheck"){	// Se não, verifica se a quantidade de marcacao eh menor que a quantidade de erros existentes
			
			clicked++;	// incrementa a quantidade de marcacao
			$(this).addClass("destaque"); // Adiciona a cor rosa
		}

		habilitaDesabilitaBotaoAvancar(); // Funcao que verifica se eh preciso habilitar ou desabilitar o botao de avancar

		atualizaQuantidadeMarcacoes(); // Funcao que atualiza na tela a quantidade de marcacoes feitas ateh o momento

	});
}

function selecionaLinha(){      
     $('table > tbody > tr > td > :checkbox').click(function(){
       var tr = $(this).parent().parent();
	   
	   if ($(this).is(':checked')){
			var incremento = 1;
			$(tr).find('td').each(function(e){
				if ($(this).hasClass('destaque')){
					$(this).removeClass('destaque');
					incremento--;
				}				
			});
			$(tr).addClass('selected');
			clicked += incremento;
	   } else {
			$(tr).removeClass('selected');
			clicked--;
	   }
     });
}

/*Funcao que atualiza na tela a quantidade de marcacoes a cada clique*/
function atualizaQuantidadeMarcacoes(){
	var contador = document.getElementById("numeroDeErrosMarcados");// procura o local onde a quantidade de marcacao deve aparecer
	contador.innerHTML = "<font color= red>" + clicked + "</font>" // Mostra a quantidade atual de marcacoes na pagina.
}

/*Funcao que habilita ou desabilita o botao de avancar */
function habilitaDesabilitaBotaoAvancar(){
	if(clicked == errosExistentes){ // se a quantidade de marcacoes for igual aa quantidade de erros
		$("input").addClass("enable");// habilita o botao
		$("input").addClass("hover"); // permite que o  mouse fique no formato de maozinha ao ser passado por cima do botao

		$("input").removeClass("disable"); // remove a class de desabilitado

	} else{ // se nao desabilita o botao novamente

		$("input").removeClass("enable");
		$("input").removeClass("hover");
		$("input").addClass("disable");
	}
}

/*Funcao para o contador regressivo*/
function contadorRegressivo(){
	segundos--;

	if(segundos==-1){ // reinicia a contagem regressiva do segundos
		segundos=59;
		if(minutos ==1){ // tratamento para os minutos ficarem com duas casas sempre
			minutos="0" + 0;

		} else if (minutos == "00") { // verifica se o tempo esgotou!!
			alert("Tempo Esgotado! :(");
			avancar(true); // parametro de controle. Ele sendo true pode avancar mesmo q o botao esteja desabilitado

		}else { // se nada disse acontecer continua a contagem regressiva.
			minutos = "0" + --minutos;
		}
	}

	if(segundos<=9)segundos="0"+segundos; // decrementa sempre os segundos	
	
	atualizaTempoNaPagina();
	setTimeout('contadorRegressivo()',1000); // chama a funcao a cada segundo

}

/*Funcao que atualiza o tempo na pagina a cada segundo*/
function atualizaTempoNaPagina(){
	tempo = horas+"<font color=#000000>:</font>"+minutos+"<font color=#000000>:</font>"+segundos; // procura o local onde o tempo deve aparecer
	document.getElementById('clock1').innerHTML=tempo; //mostra o tempo atual na pagina
}

/*Funcao ajax que retorna o erro de cada celula*/
function getErro(id) {
	$.ajax({
		type: 'get',
		url: "pesquisaErro.php",
		data: {identificador: id},
	}).done(function(data){
		$(".tooltip").html(data);
	});

}

// funcao que colore as celulas segundo a marcacao correta e errada ou falta de marcacao do erro pelo jogador
function coloreCelulas(){
	$(".tabela").find('td').each(function(i){ // percorre todas as td's da tabela

		if ($(this).attr("class") == "campoErro destaque"){ // se a celula estiver marcada corretamente marca com verde
			numErrosEncontrados++; // incrementa a quantidade de erros encontrados 
			$(this).removeClass("destaque"); // remove a cor rosa
			$(this).addClass("marcouCerto") // adiciona a cor verde

			$(this).hover(function(){ // quando o mouse passar por cima da celula selecionada
				$(this).prepend("<div class = 'tooltip'><font></font></div>"); // adiciona um tooltip com o nome e a descricao do erro
				getErro($(this).attr('id'));
				
			}, function(){ // quando o mouse sair de cima da celula
				$(".tooltip").remove(); // remove o tooltip
			});

		} else if ($(this).attr("class") == "campoErro") { // verifica se a celula eh errada e não foi marcada. Se isso acontece, marca com amarelo

			numNaoMarcados++; // incrementa o numero de erros nao marcados
			$(this).addClass("erroNaoMarcado"); // adiciona a cor amarela

			$(this).hover(function(){ // quando o mouse passar por cima da celula selecionada
				$(this).prepend("<div class = 'tooltip'><font></font></div>"); // adiciona um tooltip com o nome e a descricao do erro
				getErro($(this).attr('id'));
				
			}, function(){ // quando o mouse sair de cima da celula
				$(".tooltip").remove(); // remove o tooltip
			});	

		} else if ($(this).attr("class") == "destaque") { // se não, verifica se uma celula que não tem erro foi marcada. Se sim, marca com vermelho

			numMarcacoesIncorretas++; // incrementa a quantidade de marcações incorretas
			$(this).removeClass("destaque"); // remove a cor rosa
			$(this).addClass("marcouErrado");// adiciona a cor vermelha

			$(this).hover(function(){ // quando o mouse passar por cima da celula selecionada
				$(this).prepend("<div class = 'tooltip'>Não é erro</div>"); // adiciona um tooltip informando que nao ha erro

			}, function(){ // quando o mouse sair de cima da celula
				$(".tooltip").remove(); // remove o tooltip
			});	
			
		} // fim else if
	}); // fim da procura por td's
} // fim funcao coloreCelulas

// funcao que imprime na tela o resultado das marcacoes realizadas pelo usuario
function mostraResultado(){

	var resultado = document.getElementById("divResultado"); // procura o elemto com o id informado. No caso, a div onde sera colocada o resultado da partida

	// atibui ao resultado da pesquisa os valores das marcacoes corretas e erradas
	resultado.innerHTML = "<font color= green>Erro(s) Encontrado(s): " + numErrosEncontrados + "</font></br>" +
	"<font color= #DAA520>Erro(s) Não Marcado(s): " + numNaoMarcados + "</font></br>" +
	"<font color= red>Marcação(ões) Errada(s): " + numMarcacoesIncorretas+ "</font>"

}

//funcao que calcula o tempo que resta, em segundos, apos o jogador concluir a partida
function calculaSegundosRestantes() {
	return minutos * 60 + segundos; // tranforma tudo em segundos e retorna
}

//Calcula o aumento conforme o tempo restante e a medida fMeasure alcançada
function calculaAumentoSalarial(){
	var acrescimos = 0;
	if (fMeasure() >= 70){
		acrescimos = fMeasure() + parseInt(calculaSegundosRestantes()/4);
	}
	// Aumento com base no salario, fMeasure e acrescimo em relacao ao tempo restante (soh a parte inteira)
	var salario = parseInt(document.getElementById('placar').innerHTML) + acrescimos;

	document.getElementById('placar').innerHTML = salario; // atualiza o salario na tela
}

/*Funcao que calcula a medida de acertos com base no total de marcacoes feitas pelo usuario*/
function fMeasure() {

	//RECALL é a razão entre o número de registros relevantes (numero de erros marcados corretamente)
	//recuperado para o número total de registros relevantes na base de dados (numero de erros existentes, de fato).
	var recall = 0;
	if (errosExistentes != 0) {
		recall = numErrosEncontrados / errosExistentes; 
	}

	//A precisão é a razão entre o número de registros relevantes recuperados (o numero de erros marcados corretamente)
	// para o número total de registros recuperados (irrelevante e relevantes) (erros marcados corretamente e marcacoes incorretas)
	var precision  = 0;
	if (numErrosEncontrados + numMarcacoesIncorretas){
		precision = numErrosEncontrados / (numErrosEncontrados + numMarcacoesIncorretas);
	}

	var measure = 0;
	if (precision + recall != 0){
		// formula da f-measure;
		measure = 2 * precision * recall / (precision + recall);
	}
	// retorna a parte inteira do percentual f-measure.
	return parseInt(measure * 100);
}

/*Funcao que mostra na tela o desempenho do jogador*/
function mostraScore(){
	document.getElementById("divScore").innerHTML = "<br/><font>Seu desempenho foi de " + fMeasure() + "%</font>";
}

/*Funcao redireciona para outro cenario*/
function avancaCenario(){
	var salarioAtual = document.getElementById('placar').innerHTML; // o salario atual do jogador
	location.href="avancaCenario.php?salarioAtual="+salarioAtual; // redireciona para mudar o cenario
}

/*Funcao para o botao de avancar. So redireciona se o botao estiver habilitado ou se o tempo acabou*/
function avancar(tempoEsgotado){
	if ($("#buttonAvancar").attr("class") == "botaoAvancar enable hover" || tempoEsgotado) { // verifica se o botao esta habilitado.

		document.getElementById('divBotao').innerHTML = "<input type = 'button' id = 'buttonAvancar' value = 'Avançar' class = 'botaoAvancar' onClick = 'avancaCenario()'/>";
		document.getElementById("contadorRegressivo").innerHTML = tempo; // mostra o tempo que ele passou para concluir uma etapa

		coloreCelulas(); // colore as celulas marcadas ou nao
		mostraResultado(); // mostra o resultado das marcacoes na tela
		mostraScore();
		calculaAumentoSalarial();
	}	
}

// funcao que percorre as tabelas para verificar a quantidade de erros no cenario atual
function mostraErrosExistentes() {
	$(".campoErro").each(function(i) { 
		errosExistentes++;
	});

	var contador = document.getElementById("numeroDeErrosExistentes"); //Procura o local onde colocar a quantidade de erros
	contador.innerHTML = "<font>"+errosExistentes+"</font>" // adiciona a quantidade de erros existentes ao carregar a pagina
}