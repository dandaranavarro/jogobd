errosExistentes = 0;
var numErrosEncontrados = 0;
var numNaoMarcados = 0;
var numMarcacoesIncorretas = 0;


/*Funcao que marca a celula quando o mouse eh clicado*/
$(function () {
var clicked = 0;	
$("td").click(function () {	// Evento acionado quando uma td é clicada

if ($(this).attr("class") == "destaque" || 
$(this).attr("class") == "campoErro destaque"){	// se a celula jah foi clicada, desmarque

clicked--;	// numero de marcacoes diminui
$(this).removeClass("destaque"); // remove a cor rosa


} else if (clicked < errosExistentes){	// Se não, verifica se a quantidade de marcacao eh menor que a quantidade de erros existentes

clicked++;	// incrementa a quantidade de marcacao
$(this).addClass("destaque"); // Adiciona a cor rosa
}

if(clicked == errosExistentes){ // se a quantidade de marcacoes for igual aa quantidade de erros
// habilita o botao
$("input").addClass("enable");
$("input").addClass("hover"); // permite que o  mouse fique no formato de maozinha ao ser passado por cima do botao

$("input").removeClass("disable"); // remove a class de desabilitado

} else{ // se nao
// desabilita o botao novamente

$("input").removeClass("enable");
$("input").removeClass("hover");
$("input").addClass("disable");
}

var contador = document.getElementById("numeroDeErrosMarcados");// procura o local onde a quantidade de marcacao deve aparecer
contador.innerHTML = "<font color= red>" + clicked + "</font>" // Mostra a quantidade atual de marcacoes na pagina.

});	
});

var tempo;
var sHors = "0"+0; 
var sMins = "0" + 5;
var sSecs = +1;
function getSecs(){
sSecs--;

if(sSecs==-1){ // reinicia a contagem regressiva do segundos
sSecs=59;

if(sMins ==1){ // tratamento para os minutos ficarem com duas casas sempre
sMins="0" + 0;

} else if (sMins == "00") { // verifica se o tempo esgotou!!
alert("Tempo Esgotado! :(");
avancar(true); // parametro de controle. Ele sendo true pode avancar mesmo q o botao esteja desabilitado

}else{ // se nada disse acontecer continua a contagem regressiva.
sMins = "0" + --sMins;
}

}

if(sSecs<=9)sSecs="0"+sSecs; // decrementa sempre os segundos
tempo = sHors+"<font color=#000000>:</font>"+sMins+"<font color=#000000>:</font>"+sSecs;
document.getElementById('clock1').innerHTML=tempo; //mostra o tempo atual na pagina

setTimeout('getSecs()',1000); // chama a funcao a cada segundo

}
// função para o contador regressivo aparecer na tela
$(function(){
document.getElementById('script').innerHTML = setTimeout('getSecs()',1000);
});


/*Funcao chamada assim que a página carregada - Conta os erros existentes no cenario*/
$(function () { 
contaErros();

});

function pegaErro(id) {
$.ajax({
type: 'get',
url: "ajax.php",
data: {identificador: id},
}).done(function(data){
$(".tooltip").html(data);
});

}



// funcao que colore as celulas segundo a marcacao correta e errada ou falta de marcacao do erro pelo jogador
function coloreCelulas(){

$(".tabela").find('td').each(function(i){ // percorre todas as td's da tabela

if($(this).attr("class") == "campoErro destaque"){ // se a celula estiver marcada corretamente marca com verde
numErrosEncontrados++; // incrementa a quantidade de erros encontrados 
$(this).removeClass("destaque"); // remove a cor rosa
$(this).addClass("marcouCerto") // adiciona a cor verde

$(this).hover(function(){ // quando o mouse passar por cima da celula selecionada
$(this).prepend("<div class = 'tooltip'><font></font></div>"); // adiciona um tooltip com o nome e a descricao do erro
pegaErro($(this).attr('id'));
}, function(){ // quando o mouse sair de cima da celula
$(".tooltip").remove(); // remove o tooltip
});	


} else if($(this).attr("class") == "campoErro") { // verifica se a celula eh errada e não foi marcada. Se isso acontece, marca com amarelo

numNaoMarcados++; // incrementa o numero de erros nao marcados
$(this).addClass("erroNaoMarcado"); // adiciona a cor amarela

$(this).hover(function(){ // quando o mouse passar por cima da celula selecionada
$(this).prepend("<div class = 'tooltip'><font></font></div>"); // adiciona um tooltip com o nome e a descricao do erro
pegaErro($(this).attr('id'));
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
return sMins * 60 + sSecs; // tranforma tudo em segundos e retorna
}

//Calcula o aumento conforme o tempo restante e a medida fMeasure alcançada
function aumentoSalarial(){
var acrescimos = 0;
var salario = 1000;

if (fMeasure() >= 70){
acrescimos = fMeasure() + parseInt(calculaSegundosRestantes()/4);
}
// Aumento com base no salario, fMeasure e acrescimo em relacao ao tempo restante (soh a parte inteira)
return salario + acrescimos;
}

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

function mostraScore(){
document.getElementById("divScore").innerHTML = "<br/><font>Seu desempenho foi de " + fMeasure() + "%</font>";

}

/*Funcao para o botao de avancar. So redireciona se o botao estiver habilitado ou se pode avarcar diretamente*/
function avancar(avancaDireto){
if ($("input").attr("class") == "botaoAvancar enable hover" || avancaDireto) { // verifica se o botao esta habilitado.

document.getElementById("divBotao").innerHTML = ""; // não mostra mais o botao
document.getElementById("contadorProgressivo").innerHTML = tempo; // mostra o tempo que ele passou para concluir uma etapa

coloreCelulas(); // colore as celulas marcadas ou nao
mostraResultado(); // mostra o resultado das marcacoes na tela
mostraScore();


//alert("F-Measure = " + fMeasure() + "%"); // alerta provisorio. Em seguida temos que atribuir isso ao placar...
// o placar - salario -  vai ser igual a medida F-measure implementada. salario += fMeasure();

var aumento = aumentoSalarial();
document.getElementById('placar').innerHTML = "R$" + aumento + ",00";
}	
}


function contaErros() {
$(".campoErro").each(function(i) { // funcao que percorre as tabelas para verificar a quantidade de erros no cenario atual
errosExistentes++;

});

var contador = document.getElementById("numeroDeErrosExistentes"); //Procura o local onde colocar a quantidade de erros
contador.innerHTML = "<font>"+errosExistentes+"</font>" // adiciona a quantidade de erros existentes ao carregar a pagina

}