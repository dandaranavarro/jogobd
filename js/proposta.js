
$(function(){

    $("a[rel=modal]").click( function(ev){
        ev.preventDefault();
 
        var id = $(this).attr("href");
		var id_empresa = $(this).attr('name');
				
        var alturaTela = $(document).height();
        var larguraTela = $("#tudo").width();
     
        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela,'height':alturaTela});
        $('#mascara').fadeIn(1000);
        $('#mascara').fadeTo("slow",0.8);
 
        var left = ($("#tudo").width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
        $(id).css({'top':top,'left':left});
        $(id).show(); 
			
    });	

    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
});

/*Funcao que mostra o frame referente a empresa que o usuario escolheu
	id_empresa: identificador da empresa escolhida
*/
function mostraFrame(id_empresa){
	document.getElementById('janela1').innerHTML = "<iframe name = 'confirmaCenario' src='confirmaCenario.php?id_empresa="+id_empresa+"' scrolling='auto' frameborder='0' width='100%' height='90%'></iframe>";
}