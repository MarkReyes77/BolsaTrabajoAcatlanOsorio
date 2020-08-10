<?php header("Content-type: text/javascript"); ?>
/*
*	Funciones Requeridas para las aplicaciones NetWorking System
*	Utiliza API de jQuery
*   ***********************************************************
*       Creado por: Antonio Reyes Mu?z
*	Creacion: Domingo 15 de Abril de 2012
*	Modificacion: 09:49 a.m. 27/07/2015
*	
*   COLABORACIONES Y APORTACIONES
*     - Ismael Alfredo Martinz Escobedo 
*     - Salvador Martinez Sanchez
*       Fecha: 06/03/2018
*/

// demas variables en fun_web.js o fun_nw.js
	var CajaEsc = new Array(10);
	CajaEsc[0] = 0; //Caja Principal
	CajaEsc[1] = 0; //SubCaja Galeria NS (networking System)
	CajaEsc[2] = 0;

// Envio de Formularios
var Formu = Array(20,20);
for(i = 0; i < Formu.length ; i++) {Formu[i]=0;}
function frmSend(id){
	var capa = ExistDOM(id); 
	if(capa[0]){
		if(Formu[id]!=1) { 
			TipBox(id+'_load',IcoCarga); ClaseAdd(id+'_send','btnDisabled'); Formu[id] = 1; capa[1].submit();
		} 
		else { if(confirm('Por favor espere... se esta enviando la información, ¿Desea Cancelar el proceso?')){frmRestore(id);}else{return false;} }
	}
	else {
		alert('Error: No se encontro referencia al formulario: '+id);
	}
	
}
function frmRestore(id){ 
	if(Formu[id] != 0) { 
		TipBox(id+'_load',''); 
		ClaseRev(id+'_send','btnDisabled'); 
		Formu[id] = 0; 
		
		//if(parent.frames[id+'_frame']) { setTimeout("parent.frames['"+id+"_frame'].location.href='../../../blanco.php'; alert('ok uwur');",10000); } 
	}
}

// Gral
	function ExistDOM(id){var x = new Array();if(document.getElementById) {var d = document.getElementById(id);}else if (document.all) { var d = document.all[id];}else if (document.layers) { var d = document.layers[id];} if(d){ x[0] = true; x[1]= d;}else {x[0] = false; x[1]= d;} return x;}
	function Rand(inf,sup){ numP = sup - inf;rnd = Math.random() * numP; rnd = Math.round(rnd); return parseInt(inf) + rnd; }
	function Enter(evento){ if(evento.KeyCode == 13 || evento.which == 13) return true; else return false; }
	function Escape(evento){ if(evento.KeyCode == 27 || evento.which == 27) return true; else return false; }
	function ClaseAdd(id,c){$('#'+id).addClass(c);}
	function ClaseRev(id,c){$('#'+id).removeClass(c);}
	function Enlace(url,target){if(target == 'blank') { window.open(url);}else if(target == 'self') {self.location.href = url;} else if(target == 'top'){top.location.href = url;}else {parent.location.href = url;}}
	function PagAjax(file,param,capa,load,divDom){ if(divDom != 0) {$(divDom).animatescroll({scrollSpeed:2000,easing:'easeOutBack', padding:100});} Vista(file,param,capa,load); }
	function Desplazar(id,p){ $(id).animatescroll({scrollSpeed:2000, easing:'easeOutBack', padding: p});}
	function FocusTr(id,c){  if($(id).hasClass(c)) { $(id).removeClass(c);}else{ $(id).addClass(c); } }
	function TipBox(id,txt){ var capa = ExistDOM(id); if(capa[0]){ capa[1].innerHTML = txt;	} else {return false;}}
	function TipValue(id,txt){ var capa = ExistDOM(id); if(capa[0]){ capa[1].value = txt; } else {return false;}}
	function AreaHeight(id,alto){ $(id).css({'height': alto+'px'});}
 	function NoSelect(id) { $(id).removeAttr('OnMouseOver'); $(id).selectOff();}

// formularios
	function CheckBox(id,tipo) { var form = document.getElementById(id);for (i=0; i < form.elements.length; i++) {if ( form.elements[i].type == 'checkbox' ) {form.elements[i].checked = tipo;}}}
	function VerCheck(id){ var tipo = false; var form = document.getElementById(id); for (var i=0; i < form.elements.length; i++) {if ( form.elements[i].type == 'checkbox') { if(form.elements[i].checked == true){tipo = true;}}} return tipo;}
	function frmSubmit(id){ var capa = ExistDOM(id); if(capa[0]){ capa[1].submit();}else {alert('control no encontrado (FORM): '+id);}}
	function frmReset(id){var capa = ExistDOM(id); if(capa[0]){ capa[1].reset();}else {alert('control no encontrado (FORM): '+id);}}
	function Max(id,SpCon,Max){ var Limit = Max; if(id.value.length <= Max) {TipBox(SpCon,(Max-id.value.length));}else {id.value = id.value.substring(0,Limit);}}
	function LoadLen(id,SpCon,Max){ TipBox(SpCon,(Max-id.value.length));}
	function DomAdd(id,txt){ var capa = ExistDOM(id); if(capa[0]){ capa[1].value += txt; } else {return false;}}
	function DomValue(id){var capa = ExistDOM(id); if(capa[0]){ return capa[1].value; } else {return false;}}
	function DomDisplay(id){ var capa = ExistDOM(id); if(capa[0]){ if(capa[1].style.display == 'none') return true; else return false; } else {return false;}}
	function DomLen(id){var capa = ExistDOM(id); if(capa[0]){ return capa[1].value.length; } else {return false;}}
	function DomFoco(id){var capa = ExistDOM(id); if(capa[0]){ capa[1].focus(); } else {return false;}}
	function DomSelectText(id){var capa = ExistDOM(id); if(capa[0]){ return capa[1].options[capa[1].selectedIndex].text; } else {return false;}}
	function DomSelectValue(id){var capa = ExistDOM(id); if(capa[0]){ return capa[1].options[capa[1].selectedIndex].value; } else {return false;}}

//validaciones jQuery Remove Attribute
	// lanza dimensiones sin distorcionar
	function addDim(AnO,AlO,ancho,hmax){ if(ancho == 0 && hmax > 0 && hmax <= AlO) { var ancho = AnO; var alto = AlO; var ratio = (AnO / ancho); alto = (AlO / ratio); if(alto>hmax){ var anchura2 = hmax*ancho/alto; alto = hmax; ancho = anchura2; } return ancho+'x'+alto; } else if(ancho > 0 && ancho <=AnO && hmax == 0) { var width = AnO; var new_width = ancho; if (width > new_width){ var height = AlO; var calculo = Math.round((100*new_width)/width); var new_height = Math.round((height*calculo)/100); } return new_width+'x'+new_height; } else { return AnO+'x'+AlO; } }

	
	function jQ_valEmail(id){
	    var RegExPattern =/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    if ((id.match(RegExPattern))) {
        	return true;
    	} else {
	        return false;
	    } 
	}
	
	function JQ_valGral(id,modo) {
		var atributo = (atributo) ? atributo : 'onmouseover'; $('#'+id).removeAttr(atributo);
		var exp = '';
		if(modo == 'num'){ exp = "/^[0-9]+$/"; }
		if(modo == 'dec'){ exp = "/[-+]?([0-9]*\.[0-9]+|[0-9]+)/"; }
		if(modo == 'let'){ exp = "/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/"; }
		if(modo == 'mail'){ exp = "/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/"; }
		if(modo == 'mail2'){ exp = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/"; }
		if(modo == 'url'){ exp = "/^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,6})?([\.\-\w\/_]+)$/i"; }
		if(modo == 'cp'){ exp = "/^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/"; }
		if($('#'.id).attr("value").match(exp)) {
			return true;
		}
		else { return false; }
	}

	function jQ_OnlyNumber(id,atributo){ var atributo = (atributo) ? atributo : 'onmouseover'; $('#'+id).removeAttr(atributo);  $('#'+id).keydown(function(e) { var evt = e ? e : event;  var key = window.Event ? evt.which : evt.keyCode;  if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) { return; } if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) { e.preventDefault(); } 	   }).keyup(function(e){ var evt = e ? e : event; var key = window.Event ? evt.which : evt.keyCode; if($('#'+id).attr('data-modo')){ var modo = $('#'+id).attr('data-modo'); } else { var modo = 'entero'; } if($('#'+id).attr('data-total')){ var total = $('#'+id).attr('data-total'); } else { var total = 10000000000; } if($('#'+id).attr('data-len')){ var mlen = $('#'+id).attr('data-len'); } else { var mlen = 25; } total = parseInt(total); mlen = parseInt(mlen); if(this.value.length > mlen) { this.value = this.value.substring(0,mlen); } if(this.value > total) { this.value = this.value.substring(0,mlen-1); } if(this.value == 0) { this.value = ''; } });}
	function valUploadImagen(id){var _URL = window.URL || window.webkitURL;$('#'+id).removeAttr('OnMouseOver');$('#'+id).change(function(e) {   var image, file;if ((file = this.files[0])) {var sizeByte = this.files[0].size;var sizeKB = parseInt(sizeByte / 1024);var nomFile = this.files[0].name;var fiExt = nomFile.substr(-3); fiExt = fiExt.toLowerCase();var dim = $('#'+id).attr('data-dim'); dim = dim.split('x');var imgKB = $('#'+id).attr('size');var ext = $('#'+id).attr('data-ext'); ext = ext.split(',');var preview = $('#'+id).attr('data-preview');var preAn = $('#'+id).attr('data-an'); var preHm = $('#'+id).attr('data-hm');image = new Image();image.onload = function() {   if(this.width <= dim[0] && this.height <= dim[1]) {if(sizeKB <= imgKB) {if(ext[0] == fiExt || ext[1] == fiExt || ext[2] == fiExt) {if(preview == 'true') { var DimMini = addDim(this.width,this.height,preAn,preHm); DimMini = DimMini.split('x');var imgN = document.getElementById(id+'_Preview');imgN.src = _URL.createObjectURL(file);imgN.width = DimMini[0];imgN.height = DimMini[1];}AvisoTop('Exito S3','Imagen Inspeccionada con éxito...',null);}else {AvisoTop('Aviso S3','Solo se aceptan JPG, PNG, GIF ==> ( Imagen Actual: ' +fiExt+ ')',null);$('#'+id).val('');}}else{AvisoTop('Aviso S3','El peso de la imagen permitido es de: '+imgKB+'Kb ==> (Imagen Actual: ' + sizeKB + ' Kb)',null);$('#'+id).val('');}}else {AvisoTop('Aviso S3','Las dimensiones permitidas son menor o igual a ' + dim[0]+'x'+dim[1] + 'pixeles.  ==> (Imagen Actual: '+this.width+'x'+this.height+'Px)',null);$('#'+id).val('');}};image.src = _URL.createObjectURL(file);}}); }
	function NumOnly(e,obj){ var evt = e ? e : event; var key = window.Event ? evt.which : evt.keyCode;  if(key > 47 && key < 58 || key > 95 && key < 106 || key == 8 || key == 13 || key == 9){return true;} else {obj.value = obj.value.substring(0,obj.value.length-1);} }

	// cajas
	// fix resolucion de pantalla
	function Gal_FixTeatro() { if ((screen.width == 1024) && (screen.height == 768)) { var hMax = 570;} else if ((screen.width == 800) && (screen.height >= 600))  { var hMax = 500;} else if ((screen.width >= 1024) && (screen.height >= 768)) { var hMax = 580; } else { var hMax = 580; } return hMax; }
	function Caja(){ CajaEsc[0] = 1; $('body#Cuerpo').css({'overflow':'hidden'}); $('div#Caja_Viewer,div#Caja_Shadow').fadeIn(); }
	function CajaOff(){ CajaEsc[0] = 0; $('body#Cuerpo').css({'overflow':'auto'}); $('div#Caja_Viewer,div#Caja_Shadow').fadeOut(); var ControlCaja = setTimeout(function(){TipBox('div#'+divBoxShadow,'')},5000);}
	function TeatroOn(){ CajaEsc[1] = 1; $('body#Cuerpo').css({'overflow':'hidden'}); $('div#Teatro_Shadow,div#Teatro_Viewer').fadeIn(); }
	function TeatroOff(){ CajaEsc[1] = 0; $('body#Cuerpo').css({'overflow':'auto'}); $('div#Teatro_Viewer,div#Teatro_Shadow').fadeOut(); var ControlCaja2 = setTimeout(function(){TipBox('div#Teatro_CConten','')},5000);}
	function SubCaja(tag,forma) { if(forma == 'abrir') { $('div#'+tag+'-S,div#'+tag+'-C').fadeIn(); } else {$('div#'+tag+'-S,div#'+tag+'-C').fadeOut();} }
 
 	// para que cuando se precione la tecla ESC verifique que la caja este activa y cerrarla.
	$(document).keyup(function(e) { if(e.keyCode == 27){ if(CajaEsc[0] == 1) { CajaOff(); } if(CajaEsc[1] == 1) {TeatroOff(); }} });

// Menu Tabulador Horizontal
var TabHLoad = Array(10,10);
for(i = 0; i < TabHLoad.length ; i++) {TabHLoad[i]=0;}
function Tab(tag,id,max){tagT = '#'+tag+'-Tab_';tagC = 'div#'+tag+'-Capa_'; TabHLoad[tagT+id]=id;for(var i = 0; i <= max; i++) {if(i==id){$(tagT+id).addClass('Activo'); $(tagC+id).show('normal');}else {if(TabHLoad[tagT+id]!=i) {$(tagT+i).removeClass('Activo'); $(tagC+i).hide('normal');}}}}


var AcordLoad = Array(10,10);
var AcordBtn = Array(10,10);
for(i = 0; i < AcordLoad.length ; i++) {AcordLoad[i]=0;AcordBtn[i]=0;}

function TabBotones(tag,id,max){
	var tagT = tag+'_';
	for(var i = 0; i <= max; i++) {
		if(AcordBtn[tagT+id]==i) { 
			$('#'+tagT+i).hide();
			//$('#'+tagT+i).removeClass('Activo'); 
			AcordBtn[tagT+i] = 0; 
		}
		else {
			if(i==id){
				AcordBtn[tagT+id] = id;
				//$('#'+tagT+id).addClass('Activo');
				$('#'+tagT+id).hide();
			}
			else { // si es diferente de ambos, ocultamos todo
				if(AcordBtn[tagT+id]!=i){
					$('#'+tagT+i).show();
					//$('#'+tagT+i).removeClass('Activo');
					AcordLoad[tagT+i] = 0; 
				}
			}
		}
	}
}

function Acordion(tag,id,max){
	var tagC = tag+'_';
	var tagT = tag+'-T_';
	for(var i = 0; i <= max; i++) {
		if(AcordLoad[tagT+id]==i) { 
			$('#'+tagC+i).hide('normal');
			$('#'+tagT+i).removeClass('Activo'); 
			AcordLoad[tagT+i] = 0; 
		}
		else {
			if(i==id){
				AcordLoad[tagT+id] = id;
				$('#'+tagT+id).addClass('Activo');
				$('#'+tagC+id).show('normal');
			}
			else { // si es diferente de ambos, ocultamos todo
				if(AcordLoad[tagT+id]!=i){
					$('#'+tagC+i).hide('normal');
					$('#'+tagT+i).removeClass('Activo');
					AcordLoad[tagT+i] = 0; 
				}
			}
		}
	}
}

function AcordionT(tag,id,max){
	var tagC = tag+'_';
	var tagT = tag+'-T_';
	for(var i = 0; i <= max; i++) {
		if(AcordLoad[tagT+id]==i) { 
			//$('#'+tagC+i).hide('normal');
			//$('#'+tagT+i).removeClass('InOver'); 
			//AcordLoad[tagT+i] = 0; 
		}
		else {
			if(i==id){
				AcordLoad[tagT+id] = id;
				$('#'+tagT+id).addClass('InOver');
				$('#'+tagC+id).show('normal');
			}
			else { // si es diferente de ambos, ocultamos todo
				if(AcordLoad[tagT+id]!=i){
					$('#'+tagC+i).hide('normal');
					$('#'+tagT+i).removeClass('InOver');
					AcordLoad[tagT+i] = 0; 
				}
			}
		}
	}
}



// pluyings
	// evita usar el Backspace en la pagina, pero si en formularios
	if (typeof window.event == 'undefined'){ document.onkeypress = function(e){ var test_var=e.target.nodeName.toUpperCase(); if (e.target.type) { var test_type=e.target.type.toUpperCase(); } if ((test_var == 'INPUT' && test_type == 'TEXT' || test_type == 'PASSWORD') || test_var == 'TEXTAREA'){ return e.keyCode; }else if (e.keyCode == 8){ e.preventDefault(); } }
	}else{ document.onkeydown = function(){ var test_var=event.srcElement.tagName.toUpperCase(); if (event.srcElement.type) {var test_type=event.srcElement.type.toUpperCase(); } if ((test_var == 'INPUT' && test_type == 'TEXT' || test_type == 'PASSWORD') || test_var == 'TEXTAREA'){ return event.keyCode;}else if (event.keyCode == 8){ event.returnValue=false; } }}

// evitar la selecci? en los elementos seleccionados por jQuery [ 22/08/2011 | JFcoD?z (http://www.devtics.com.mx) | MIT/GNU ]
	(function($){ $.fn.extend({ selectOff : function(){this.attr('unselectable', 'on').css({ 'KhtmlUserSelect' : 'none','MozUserSelect' : 'none','WebKitUserSelect' : 'none'}).each(function(i,o){ o["onselectstart"] = o['onmousedown'] = function(){return false;} });} }); })(jQuery);

//para BBCode
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version
var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1) && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1) && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;
var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);
function InTexto(text,id){ var txtarea = document.getElementById(id);text = ' '+text+' '; if (txtarea.createTextRange && txtarea.caretPos) { var caretPos = txtarea.caretPos; caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text; txtarea.focus(); } else {txtarea.value  += text; txtarea.focus();}}
function bbDoble(id,bbopen, bbclose) { var txtarea = document.getElementById(id);if ((clientVer >= 4) && is_ie && is_win) { theSelection = document.selection.createRange().text; if (!theSelection) { txtarea.value += bbopen + bbclose; txtarea.focus(); return;} document.selection.createRange().text = bbopen + theSelection + bbclose; txtarea.focus(); return;}else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0)) { mozWrap(txtarea, bbopen, bbclose); return;}else { txtarea.value += bbopen + bbclose; txtarea.focus();}storeCaret(txtarea); }
function mozWrap(txtarea, open, close) {var selLength = txtarea.textLength;var selStart = txtarea.selectionStart;var selEnd = txtarea.selectionEnd;if (selEnd == 1 || selEnd == 2) { selEnd = selLength;} var s1 = (txtarea.value).substring(0,selStart); var s2 = (txtarea.value).substring(selStart, selEnd); var s3 = (txtarea.value).substring(selEnd, selLength); txtarea.value = s1 + open + s2 + close + s3;return;}
function storeCaret(textEl) { if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate(); }




//funciones de vaidacion del formularios de servicios escolares

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnñopqrstuvwxyz úáéíó";
    especiales = "8-37-39-46";

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}
function SoloNumeros(e){
 key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}
//https://es.stackoverflow.com/questions/31039/c%C3%B3mo-validar-una-curp-de-m%C3%A9xico
//Función para validar una CURP
function curpValida(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);
    
    if (!validado)  //Coincide con el formato general?
        return false;
    
    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma      = 0.0,
            lngDigito    = 0.0;
        for(var i=0; i< 17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if (lngDigito == 10) return 0;
        return lngDigito;
    }
  
    if (validado[2] != digitoVerificador(validado[1])) 
        return false;
        
    return true; //Validado
}


//Handler para el evento cuando cambia el input
//Lleva la CURP a mayúsculas para validarlo
function validarInput(input) {
    var curp = input.value.toUpperCase();
        //resultado = document.getElementById("resultado"),
                
    if (curpValida(curp)) { //Acá se comprueba
        AvisoTop('Exito S5','¡CURP VALIDA!...','null');
    } else {
        //input.value="";
        AvisoTop('Error S5','¡CURP NO VALIDA!...','null');
    }
        
}

function NumeroLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnñopqrstuvwxyz 1234567890-+*";
    especiales = "8-37-39-46";

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}
function NumeroLetras1(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "abcdefghijklmnñopqrstuvwxyz 1234567890";
    especiales = "8-37-39-46";

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function validateCorreo(campo) {
    var RegExPattern =/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //var errorMessage = 'Password Incorrecta.';
    AvisoTop('Error S5','Correo Incorrecta','null');
    if ((campo.value.match(RegExPattern)) && (campo.value!='email')) {
        //alert('Password Correcta');
         AvisoTop('Exito S5','Correo correcto','null');
    } else {
        //alert(errorMessage);
         AvisoTop('Error S5','Correo Incorrecta','null');
        campo.focus();
    } 
}
function validarRFC(campo) {
    var RegExPattern =/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
    //var errorMessage = 'Password Incorrecta.';
    AvisoTop('Error S5','RFC Incorrecta','null');
    if ((campo.value.match(RegExPattern)) && (campo.value!='rfc')) {
        //alert('Password Correcta');
         AvisoTop('Exito S5','RFC correcto','null');
    } else {
        //alert(errorMessage);
         AvisoTop('Error S5','RFC Incorrecto','null');
        campo.focus();
    } 
}

//Fin validaciones Residentes 