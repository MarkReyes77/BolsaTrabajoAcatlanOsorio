<?php header("Content-type: text/javascript"); ?>
var FI = new Array();var PA = new Array();var CA = new Array();var LO = new Array();
var RE = new Array(1000);
for(i = 0; i < RE.length ; i++) {RE[i]=0;}

function Ajax(){ var ajax = false;try{ ajax = new ActiveXObject("Msxml2.XMLHTTP");}catch(e){ try{ajax = new ActiveXObject("Microsoft.XMLHTTP");} catch(E){ajax = false;}} if(!ajax && typeof XMLHttpRequest!='undefined') {ajax = new XMLHttpRequest();}return ajax; }
function Vista(f,p,c,load,r,co){
   if(r == null || r == ''){ var r = Rand(1,1000);} if(co == null || co == ''){ var co = Rand(1,1000);} if(load == null || load == ''){ var load = null;}

   var ajax = new Array(); 
   ajax[r] = Ajax();
   FI[r] = f; PA[r] = p; CA[r] = c; LO[r] = load;

   var Reconectar = "<img src='"+uriIcoRecarga+"' alt='Reintentar' OnClick=\"Vista(FI["+r+"],PA["+r+"],CA["+r+"],LO["+r+"],"+r+","+co+");\">";
   var btnReconectar = "<span class='Boton' OnClick=\"Vista(FI["+r+"],PA["+r+"],CA["+r+"],LO["+r+"],"+r+","+co+");\">Reintentar</span>";

   if(ajax[r]) {
	if(LO[r] == 'img') { TipBox(CA[r],IcoCarga);}
	else if(LO[r] == 'barload') { TipBox(CA[r],"<div style='text-align: center;margin: 40px 0px;'>"+BarLoad+"<br>Cargando...</div>");}
	else if(LO[r] == 'reload') { TipBox(CA[r],IcoReload);}
	else if(LO[r] == 'nwsLoad' || LO[r] == 'FullLoad' || LO[r] == 'MiddleLoad' || LO[r] == 'SmallLoad') { TipBox(CA[r],"<div class='"+LO[r]+" Cir30'><div class='B'><div class='L'><div class='LIzq b_izq'>NS</div><div class='LDer b_der'>"+IcoCarga2+"<div style='height: 10px;'></div>Cargando Contenido...</div></div><div class='Btn'>"+btnReconectar+"</div></div></div>");}
	else { TipBox(CA[r],"<div style='text-align: center;'>"+IcoCarga+"<br>Cargando...</div>");}

	ajax[r].onreadystatechange = function(){
		// mostramos resultados segun estado del ajax
		if(ajax[r].readyState!=4) return;
			switch(ajax[r].status){
			case 200: TipBox(CA[r],ajax[r].responseText); RE[co] = 0; break;
			case 404: TipBox(CA[r],"<strong style='color:red;'>Error 404... No se pudo Cargar "+FI[r]+"...</strong>"); break;
			case 414: TipBox(CA[r],"<strong style='color:red;'>Los valores pasados por GET superan los 512</strong>");break;
			default:
			   RE[co]=RE[co]+1;	
			   TipBox(CA[r],IcoReload);
			   if(RE[co] <= 3){setTimeout("Vista(FI["+r+"],PA["+r+"],CA["+r+"],LO["+r+"],"+r+","+co+");",3000);}
			   else { RE[co] = 0; if(LO[r]=='FullLoad') { TipBox(CA[r],"<div class='FullLoad'><div class='divBody BS-Blue Cir30'><div class='load'>"+IcoChrono+"<br>¡Ups!... tiempo de carga excedido, puede que tu conexión a internet se haya perdido...</div><div class='Boton'>"+btnReconectar+"</div></div></div>");} else { TipBox(CA[r],Reconectar); }}
			break;
		}
		}
		ajax[r].open("POST", f, true);
		ajax[r].setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//ajax[r].setRequestHeader("Content-Length", p.length);
		//ajax[r].setRequestHeader("Connection", "close");
		ajax[r].send(p);

      }
      else{ alert("Error: No Hay Conexion Establecida"); }
}