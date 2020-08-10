/*
*	Funciones Requeridas para las aplicaciones NetWorking System
*	Utiliza API de jQuery
*       ***********************************************************
*       Creado por: Antonio Reyes Muñiz
*	Creacion: Domingo 18 de Agosto de 2013
*	Modificacion: 10:41 p.m. 08/09/2013
*/

// Ultimos Cambios
/* = = = = = =  = =  = = = = = = = = = =  = =

06:42 p.m. 09/09/2013.- funcion frmSend() se le incluye el dialogo de cancelacion al llamar doble vez en un mismo formulario.

 = = = = = = = = = = = = = = =  = = = = */
var BarLoad = '<img src="../images/load_bar.gif" alt="">';
var IcoCarga = '<img src="../images/carga.gif" alt="">';
var IcoCarga2 = '<img src="../images/carga_2.gif" alt="">';
var IcoReload = '<img src="../images/reload.gif" alt="">';
var uriIcoRecarga = '../images/recarga.png';

var CredeLoad = 0;
var divBoxShadow = 'Caja_CConten';

// Menu Vertical
var MVFrm = Array(20,20);
for(i=0;i < MVFrm.length;i++) {MVFrm[i]=0;}
function MenuForm(tag,id,max){tagT = 'div#'+tag+'-T-';tagC = 'div#'+tag+'-C-';MVFrm[tagT+id]=id;for(var i = 0; i <= max; i++) {if(i==id){$(tagT+id).addClass('Activo');$(tagC+id).show('normal');}else {if(MVFrm[tagT+id]!=i) {$(tagT+i).removeClass('Activo');$(tagC+i).hide();}}}}

/* 
* Oculta la [ div#AvisoTop ] segun accion...
* num = 0, es ocultar inmediatamente, y num = 1, es una nueva cuenta regresiva
* segun valor de TAviso.
*/
	var eleNoti = new Array();
	var eleNotiTiempo = new Array();
	for(i = 0; i < 50 ; i++) { eleNoti[i] = 0; eleNotiTiempo[i] = 0;}
	var TAviso = 15; // Tiempo para ocultar el [AvisoTop]

	// notificacion y avisos
	function PlayNotifi(){ var audio = document.getElementById("audioNotifi"); audio.play(); }
	function AvisoOut(num,dom) { if(eleNoti[num] != 0 || eleNoti[num] == 'undefined') { if(eleNotiTiempo[num] != 0) { if(eleNotiTiempo[num] == 1) { $('div#'+dom).hide('normal');eleNoti[num] = 0;}if(eleNotiTiempo[num] == 0) { $('div#'+dom).remove(); eleNotiTiempo[num] = 0; }eleNotiTiempo[num]--; setTimeout("AvisoOut("+num+",'"+dom+"');",1000); } else {  $('div#'+dom).hide('normal');  eleNoti[num] = 0; eleNotiTiempo[num] = 0; $('div#'+dom).remove();} } }
	function AvisoTop(clase, txt, frm){frmRestore(frm); PlayNotifi(); var i = Rand(1000,9999); var num = 0; for(var j = 0; j<50; j++){ if(eleNoti[j]==0){ eleNoti[j] = i; eleNotiTiempo[j] = TAviso; num = j; break; } } $("div#AvisoTop").append("<div class='Noti Cir' id='EleNoti_"+i+"' OnClick=\"$('div#EleNoti_"+i+"').fadeOut();\"><div Class='X'><span class='icon-cross Opa85 Opa Cir' title='Cerrar aviso' ></span></div><div class='C "+clase+"'>"+txt+"</div></div>"); AvisoOut(num,"EleNoti_"+i); }


/*
	var TAviso = 15; // Tiempo para ocultar el [AvisoTop]
	var tiempo = TAviso;
	function AvisoOut(num) { if(num != 0 || num == 'undefined') { if(num == 1) { tiempo = TAviso; } if(tiempo != 0) { if(tiempo == 1) { $('div#AvisoTop').fadeOut(); } tiempo--; setTimeout("AvisoOut()",1000); } else { $('div#AvisoTop').fadeOut(); } } }
	function AvisoTop(clase, txt, frm){frmRestore(frm);$('div#AvisoTop').fadeIn();TipBox('AvisoTxt',"<div class='Cir "+clase+"'>"+txt+"</div>"); AvisoOut(1);}
	*/			
/* * *
*	Funcion [MenuNWS] para cargar "x" pagina del menu, esta debe de existir
*	en "Modulo"/mod/frmPagina.php ejem: Difusion_Extension/mod/frmActividades.php
*	en frmPagina.php debe de tener siempre un [Sec=Inicio].
*	la variable "pag" de la funcion es el texto despues de "frm", ejem: frmActividades = Actividades.
*	en caso de "inicio", al llamar a la funcion, en el parametro "pag" declararlo como "null".
* * * * * *
* Cargado[id] = si esta cargada la pag o no.
* id = numero del elemento del menu
* pag = pagina que se cargara en el contenedor
*/
	// Variables para el menu y carga de ajax segun menu elegido
	var Cargado = new Array(20); var CargadoUl = new Array(20); var Activo = 1; var ActivoUl = 0; for(i = 0; i < Cargado.length ; i++) {Cargado[i]=0;} Cargado[1] = 1; for(i = 0; i < CargadoUl.length ; i++) {CargadoUl[i]=0;}
	function MenuNWS(id,pag){ $('div#Body-MenuTopUShadow,div#Body-MenuU-Nav').fadeOut(); if(Activo != id){ $('span#ModM_'+id+',span#ModMT_'+id).addClass('Activo'); $('span#ModM_'+Activo+',span#ModMT_'+Activo).removeClass('Activo'); $('div#NWSConten_'+Activo).fadeOut(); $('div#NWSConten_'+id).fadeIn(); if(Cargado[id] == 0){ Cargado[id] = 1; Vista(Modulo+'/mod/frm'+pag+'.php','Ver=Inicio&Modulo='+Modulo+'&idmo='+id+'&pgmo='+pag,'NWSConten_'+id,'nwsLoad');} Activo = id; } }
	function MenuNWS_RL(id,pag){toolTip(); Vista(Modulo+'/mod/frm'+pag+'.php','Ver=Inicio&Modulo='+Modulo+'&idmo='+id+'&pgmo='+pag,'NWSConten_'+id,'nwsLoad');}

	// submenu delmenu :v
	function MenuNWS_li(id,pag,num){ 
		//$('div#Body-MenuTopUShadow,div#Body-MenuU-Nav').fadeOut(); 
		// click padre
		if(ActivoUl == id && pag == 0) {
			$('ul#ModMT_'+id+'_Ul').fadeOut(); // abrimos menu
			$('span#ModMT_'+ActivoUl).removeClass('Activo'); 
			ActivoUl = 0;
		}
		else if(pag == 0){

			ActivoUl = id;
			//alert(Activo);
			$('ul#ModMT_'+id+'_Ul').fadeIn(); // abrimos menu
			$('span#ModMT_'+id).addClass('Activo'); 
			//$('span#ModMT_'+Activo).removeClass('Activo'); 
		}
		/*else if(Activo != id &&){ 
			$('span#ModM_'+id+',span#ModMT_'+id).addClass('Activo'); 
			$('span#ModM_'+Activo+',span#ModMT_'+Activo).removeClass('Activo'); 
			$('div#NWSConten_'+Activo).fadeOut(); 
			$('div#NWSConten_'+id).fadeIn(); 
			if(Cargado[id] == 0){ 
				Cargado[id] = 1; 
				Vista(Modulo+'/mod/frm'+pag+'.php','Ver=Inicio&Modulo='+Modulo+'&idmo='+id+'&pgmo='+pag,'NWSConten_'+id,'nwsLoad');
			} 
			Activo = id; 
		} // click Hijo
		else if(Activo != id && ActivoUl != num) {

		}*/
	}


// Carga del menu carrusel y restriccion de seleccion
$(document).ready(function(){ 
	// pendiente 01:13 a.m. 08/12/2013
	//$('div#Body-MenuU-Nav').mouseleave(function () { $(this).fadeOut(); $('div#Body-MenuTopUShadow').fadeOut();});
	
	$('span.btnAceptar, span.btnCancelar, span.btnRecarga, div#AvisoTop, div#Body-MenuU, div#Body-Ti-MenuM').selectOff();

});
// Menu Tabulador Horizontal
/*
var TabHLoad = Array(20,20);
for(i = 0; i < TabHLoad.length ; i++) {TabHLoad[i]=0;}
function Tab(tag,id,max){
	tagT = 'li#'+tag+'-Tab_';
	tagC = 'div#'+tag+'-Capa_';
	TabHLoad[tagT+id]=id;
	for(var i = 0; i <= max; i++) {
		if(i==id){
			$(tagT+id).addClass('Activo');
			$(tagC+id).fadeIn();
		}
		else {
			if(TabHLoad[tagT+id]!=i) {
				$(tagT+i).removeClass('Activo'); 
				$(tagC+i).fadeOut();
			}
		}
	}
}
*/


/* Funciones globales Panel Web */
	// id = categoria/carpeta	
	function NS_Vincular(ver,DomTag,input,m,dim){ 
		SubCaja(DomTag,'abrir'); 
		Vista('frmVincular.php','Ver='+ver+'&input='+input+'&dom='+DomTag+'&modo='+m+'&dim='+dim,DomTag+'-C','nwsLoad');
	}
	


	function NS_Vincular_Opt(ver,p,Dom,load = "nwsLoad"){
		Vista('frmVincular.php','Ver='+ver+'&'+p,Dom,load);
		toolTip();
	}

	function NS_Vincular_Borrar(ver,p,Dom){
		if(confirm('¿Seguro/a que desea eliminar la imagen y su coleccion de dimensiones?')) {
			NS_Vincular_Opt(ver,p,Dom);
		}
		else {return false;}
	}
	function NS_Vincular_BorrarDim(ver,p,Dom){
		if(confirm('¿Seguro/a que desea eliminar la Dimensión seleccionada?')) {
			NS_Vincular_Opt(ver,p,Dom,'barload');
		}
		else {return false;}
	}

	function NS_Vincular_cmbCarpeta(i,abr){
		Vista('frmVincular.php','Ver=Galeria_cmbCarpetas&input='+i,abr+'-cmbCarpeta','reload');
	}
	function NS_Vincular_ViewImagen(id,ver){if(id!=0){ Caja();Vista('frmVincular.php','Ver='+ver+'&id='+id,divBoxShadow,'nwsLoad'); } else {return false;}}
	function NS_Vincular_Put(val,tag,CloseTag){ TipValue(tag,val); SubCaja(CloseTag,'cerrar'); AvisoTop('Exito S3','¡Recurso Insertado Con Exito!...','null');}
	function NS_Vincular_Imagen(tag,id,an,al){ TipBox(tag,'<img OnClick="NS_Vincular_ViewImagen('+id+',\'ViewDim\');" src="../archivos/php/img_ns.php?ta='+id+'" style="width: '+an+'px; height: '+al+'px; cursor:pointer;" />');} 

/* general credenciales */
	function Credenciales_Home(p,dom) {  Vista('frmCredenciales.php','Ver=Inicio&'+p,dom,'nwsLoad'); if(CredeLoad==0) {  CredeLoad = 1; }} 
	function Credenciales_cmbPersonal(p,dom){Vista('frmCredenciales.php','Ver=Combo_Personal&P='+p,dom,'reload');}
	function Credenciales_Listado(p,dom){Vista('frmCredenciales.php','Ver=Lista&'+p,dom,'nwsLoad');}

/* Factor Humano */	

	// datos Carreras
	function FactorHumano_Buscar(P,inp,txt,tag) {
		Vista(Modulo+'/mod/frmDatos.php','Ver=Factor_Humano_Lista&input='+inp+'&span='+txt+'&Modulo='+Modulo+'&P='+P,tag,null);
	}
	function FactorHumano(p,dom,tipo) {
		if(tipo=='SC') { SubCaja(dom,'abrir'); var tagC = dom+'-C'; var F_load = 'nwsLoad'; } else { var tagC = dom; var F_load = 'reload';}
		Vista('frmGeneral_cmb.php',p,tagC,F_load);
	}


	function FactorHumano_Put(ids,vals,tag) {
		var ids = ids.split('|');
		var vals = vals.split('|');
		TipValue(ids[0],vals[0]);
		TipBox(ids[1],vals[1]);
		if(tag!=''){ 
			SubCaja(tag,'cerrar');
		}
	}