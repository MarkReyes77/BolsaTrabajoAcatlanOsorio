function Ir(p){
	window.location.href = '?Seccion=' + p;
}
function IrPage(p){
	window.location.href = p;
}
//obtener el valor de un campo de texto DOM

function getValor(id,id2, id3){
	var txt = document.getElementById(id);
	var txt2 = document.getElementById(id2);
	var txt3 = document.getElementById(id3);
	var res = parseInt(txt.value,10)+parseInt(txt2.value,10)+parseInt(txt3.value,10) 
	viewValor('Resultado: ' + res);
	alert('El resultado es: ' + res);
	
}

function viewValor(val){
	document.getElementById('EscribeResultado').innerHTML = val;
}

function accionLB(p){
			if (p=='abrir') {	
				$('div#LB_Sh,div#LB_CT').fadeIn('slow');
			}else{
				$('div#LB_Sh,div#LB_CT').fadeOut('slow');
			}
		}


function VerContenido(pag, cadena,capa,lb = 0){
	if (lb!=0) {accionLB('abrir'); capa	= 'LB_Body';}
	$("#"+capa).html('<div style = "text-aling:center;"><img src= "images/cargando.gif"></div>');

	$.ajax({
		type: "POST",
		url: ""+pag+"",
		data: cadena,
		seccess: function(r){
			$("#"+capa).html(r);
		},
		error: function(){
			$("#"+capa).html('Sin Respuesta: ['+pag+']-['+cadena+']-['+capa+']')
		}
	});
}