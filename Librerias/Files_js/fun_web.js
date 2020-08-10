// Variables carga
	var BarLoad = '<img src="images/load_bar.gif" alt="">';
	var IcoCarga = '<img src="images/carga.gif" alt="" />';
	var IcoCarga2 = '<img src="images/load_bar.gif" alt="" />';
	var IcoReload = '<img src="images/reload.gif" alt="" />';
	var uriIcoRecarga = 'images/recarga.png';

// iconos
	var IcoBlog = '<img src="images/pic/16/blog.png" alt="" style="width: 16px; height: 16px;" />';
	var IcoGaleria = '<img src="images/pic/16/galeria.png" alt="" style="width: 16px; height: 16px;" />';
	var IcoInfo = '<img src="images/pic/16/info.png" alt="" style="width: 16px; height: 16px;" />';

// variables capa
	var divAjax = 'divBlogAjax';
	var divBoxShadow = 'Caja_CConten';
	var spanNavS = 'span_NavSeccion';
	var puntero = 0; // para shadow de MenuTop

// Menu
	function MenuTOP(){ 

		//$("div.TopMenu ul ul").css({display: "none"});
		$("div.TopMenu ul li").hover(function(){ 
			$(this).find('span.T').addClass('InOver'); // buscamos span de titulo
			$('img#img_TecAcatlan').removeClass('Opa65');  // quitamos la opacidad del logo tec
			$('div#TopMenu_Shadow').fadeIn('normal');
			puntero = 1;
			$(this).find('ul:first').css({visibility: "visible",display: "none"}).show('normal');}, function(){ $(this).find('ul:first').css({visibility: "hidden"}); $(this).find('span.T').removeClass('InOver'); 
		
		});
	}

	(function($){$.fn.snow=function(options){var $flake=$('<div id="flake" />').css({'position':'absolute','top':'-50px'}).html('&#10052;'),documentHeight=$(document).height(),documentWidth=$(document).width(),defaults={minSize:15,maxSize:30,newOn:500,flakeColor:"#FFFFFF"},options=$.extend({},defaults,options);var interval=setInterval(function(){var startPositionLeft=Math.random()*documentWidth-100,startOpacity=0.5+Math.random(),sizeFlake=options.minSize+Math.random()*options.maxSize,endPositionTop=documentHeight-40,endPositionLeft=startPositionLeft-100+Math.random()*200,durationFall=documentHeight*10+Math.random()*5000;$flake.clone().appendTo('body').css({left:startPositionLeft,opacity:startOpacity,'font-size':sizeFlake,color:options.flakeColor}).animate({top:endPositionTop,left:endPositionLeft,opacity:0.2},durationFall,'linear',function(){$(this).remove()});},options.newOn);};})(jQuery);

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

//hover
// Desplazamiento scroll animado
	function Dash(p){ if(p == null || p == 'undefined' || p == '' || p == 0) { p = 100; } Desplazar('div#'+divAjax,p);}

/* Funciones del sitio web */
	// acceso blog
		function Blog(id){ Dash(); TipBox(spanNavS,IcoBlog+'Noticias ITSAO'); Vista('web_inc/general/blog.php','Mode=Ajax&id='+id,divAjax,'FullLoad'); }
		function Blog_Leer(id) {Dash(); Vista('web_inc/general/blog_leer.php','Mode=Ajax&Sec=Leer&idEn='+id,divAjax,'FullLoad'); }
		function Blog_Preview(id) { Caja(); Vista('web_inc/general/blog_leer.php','Mode=Ajax&Sec=Preview&id='+id,divBoxShadow,'FullLoad'); }

		function ViewReticula(id){ Caja(); Vista('web_inc/general/Reticula.php','Mode=Ajax&id='+id,divBoxShadow,'FullLoad'); }


	// galeria fotografica
		function Galeria_Nav(p){ Dash(); Vista('web_inc/general/mod_galeria.php','Mode=Ajax&'+p,divAjax,'FullLoad'); toolTip();}
		function Galeria_Teatro(id){ Caja(); Vista('web_inc/general/mod_galeria.php','Mode=Ajax&Sec=Teatro&idF='+id,divBoxShadow,'FullLoad'); }
		function GaleriaNS_Teatro(id){ Caja(); Vista('archivos/php/ViewImgNS.php','Mode=Ajax&Sec='+id,divBoxShadow,'FullLoad'); $('div#TopMenu_Shadow').fadeOut(); }


			/* Descontinuado */
			// Complementos
				//var sliderGal = 0; var sliderFoto = 1;
				//function Gal_VarNavFotoReset(){ sliderFoto = 1; sliderGal = 0; }
				//function Gal_ActivaSlider(){ $('div#GaleriaSlider').mouseover(function(){ if(sliderGal == 0) { var Id = $("ul:first",this).attr("id"); var SpNext = $("span.car-h-next",this).attr("id"); var SpPrev = $("span.car-h-prev",this).attr("id"); sliderGal = 1; $('#'+Id).carouFredSel({ start: 0, prev: '#'+SpPrev, next: '#'+SpNext, direction: 'left', scroll: { items: 4, pauseOnHover: "resume", duration: 1500 }}); $(this).removeAttr('OnMouseOver'); $(this).removeAttr('id'); } }); }
			//================
	// Menu Institucion
	// Servicios (engloba todos los departamentos)
	function Servicios_Pags(p) { Dash(); Vista('web_inc/servicios/conten_dptos.php','Mode=Ajax&'+p,divAjax,'FullLoad'); }
	function Servicios_Inicio(p) { Dash(); Vista('web_inc/servicios/inicio.php','Mode=Ajax&'+p,divAjax,'FullLoad'); }
	// Ingenierias (engloba todas las carreras)
	function Ingenierias_Pags(p) { Dash(); Vista('web_inc/ingenierias/contenido.php','Mode=Ajax&'+p,divAjax,'FullLoad'); }
	function Ingenierias_Reticula(id){ Caja(); Vista('web_inc/ingenierias/contenido.php','Mode=Ajax&Ver=Reticula&Sec='+id,divBoxShadow,'FullLoad');}
	

// Difusion Extension
	function de_Actividades(id){ TipBox('idNavBarTitle',IcoBlog+'Act. Extraescolares');  Dash(); Vista('web_inc/mods/ajax/de_actividades.php','Mode=Ajax&id='+id,'divBlogAjax','FullLoad'); }
	function de_Inicio(){TipBox('idNavBarTitle',IcoBlog+'Información');  Dash(); Vista('web_inc/mods/ajax/de_inicio.php','Mode=Ajax','divBlogAjax','FullLoad'); }
	function de_Contacto(){TipBox('idNavBarTitle',IcoBlog+'Contacto'); Dash(); Vista('web_inc/mods/ajax/de_contacto.php','Mode=Ajax','divBlogAjax','FullLoad'); }
	function de_Gaceta(){TipBox('idNavBarTitle',IcoBlog+'Gaceta ITSAO');  Dash(); Vista('web_inc/mods/ajax/de_gaceta.php','Mode=Ajax','divBlogAjax','FullLoad'); }

// Desarrollo academico
	
	function da_Menu(ver, title){TipBox('idNavBarTitle',IcoBlog+title); Blog_Dash(); Vista('web_inc/mods/ajax/da_menu.php','Mode=Ajax&Ver='+ver,'divBlogAjax','FullLoad'); }


// Mod Alumnos
	function Nav_Alumnos(pag,val){
		var val = (val == null) ? '' : val;
		
		Blog_Dash();
		Vista('web_inc/alumnos/Pag'+pag+'.php','Ver=Inicio'+val,'divBlogAjax','FullLoad');

	}
	function Nav_alPerfil(){
		Vista('web_inc/alumnos/Pag'+pag+'.php','Ver=Inicio'+val,'divBlogAjax','FullLoad');		
	}


// Reinscripcion
	function Reins_View_DatosPAC(nc){
		Vista('web_inc/reinscripcion/pro/frmDatosPAC.php','Mode=Ajax&nc='+nc,'divPagLoad_Solicitud','FullLoad');
		toolTip();
	}
	function Reins_Load_cmbMaterias(idA,idc,gru){
		Vista('web_inc/reinscripcion/pro/frmMaterias.php','Mode=Ajax&idA='+idA+'&idc='+idc+'&gru='+gru,'divPagLoad_cmbMaterias','img');
		toolTip();
	}
	function Reins_Load_cmbGrupos(idA,idc,dom){
		Vista('web_inc/reinscripcion/pro/frmGrupos.php','Mode=Ajax&idA='+idA+'&idc='+idc,dom,'img');
		toolTip();
	}

	function Reins_View_CodigoPostal(val){
		Vista('web_inc/reinscripcion/pro/frmCodigoPostal.php','Mode=Ajax&'+val,'divPag_frmCodigoPostal',null);
		toolTip();
	}
	function Reins_Save(cam,id,val){
		Vista('web_inc/reinscripcion/pro/proSalvar.php','Mode=Ajax&Do=Campo&idA='+id+'&cam='+cam+'&val='+val,'span'+cam+'_save','img');
		toolTip();
	}
	function Reins_SaveOrden(cam,id,val){
		Vista('web_inc/reinscripcion/pro/proSalvar.php','Mode=Ajax&Do=Orden&idA='+id+'&cam='+cam+'&val='+val,'span'+cam+'_save','img');
		toolTip();
	}
	function Reins_SaveCurso(id,val){
		Vista('web_inc/reinscripcion/pro/proSalvar.php','Mode=Ajax&Do=Curso&id='+id+'&val='+val,'spanCursoLoad'+id+'_save','img');
		toolTip();
	}
	//
	function Reins_Load_ListaCargas(ida,idc,hacer){
		Vista('web_inc/reinscripcion/pro/proListaCargas.php','Mode=Ajax&Do='+hacer+'&idA='+ida+'&idC='+idc,'divPag_ListaCargas',null);
		toolTip();
	}



// Reinscripcion v.Beta 2.0
	function RI_ViewPaso(p,dom,load){
		Desplazar('div#'+dom,100);
		if(load == 'undefined' || load == '') { var load = 'img'; }
		Vista('web_inc/reinscripcion/pro/frmPasos.php',p,dom,'FullLoad');
		toolTip();
	}
	function Reins_SaveReg(cam,id,val,t){
		Vista('web_inc/reinscripcion/pro/proSalvar.php','Mode=Ajax&Do=Campo&idA='+id+'&cam='+cam+'&val='+val+'&ta='+t,'span'+cam+'_save','img');
		toolTip();
	}




// Encuesta v0.1
	function Encuesta_ViewPaso(p,dom,load){
		if(load == 'undefined' || load == '') { var load = 'img'; }
		Vista('web_inc/proEncuesta.php',p,dom);
		toolTip();
	}

	function Encuesta_RespSave(p,dom){
		Vista('web_inc/proEncuesta.php','Mode=Ajax&Do=Save&'+p,dom,'img');
		toolTip();
	}

	function Encuesta_Terminar(p,maxRadio,dom){
		var paso = 1;
		for(var i=1; i<=maxRadio; i++){
			if(!$("#tablaPreguntas input[name='valor"+i+"']").is(':checked')){ paso = 0;}
  		}
  		
  		if(paso==1) {
  			Encuesta_ViewPaso(p,dom,'nwsLoad');
  		}
  		else {
  			alert('¡Debes de Calificar las Preguntas con las opciones Correspondientes para Terminar la Encuesta!...');
  		}
		
	}


// carga de complementos
	$(document).ready(function(){ 
		//Portada
		$('#coin-slider').coinslider({ opacity: 0.9, width: 990, height: 450, hoverPause: true, navigation: true, links: true, spw: 4, sph:8, delay: 6000, effect: '' });
		$('div#Portada').removeClass('OverFlow-Y');

		$('div.AvisoGral, div.AvisoGral_Body').fadeTo('90');
		// Carruseles
	  	$('.list_carousel-h li span img, .prev-ch, .next-ch, .cubo_prev-v, .cubo_next-v').fadeTo('normal',0.75);
	  	$('.list_carousel-h li span img, .prev-ch, .next-ch, .cubo_prev-v, .cubo_next-v').mouseenter(function(){$(this).fadeTo('normal',1);});
	  	$('.list_carousel-h li span img, .prev-ch, .next-ch, .cubo_prev-v, .cubo_next-v').mouseleave(function(){$(this).fadeTo('normal',0.75);});
		$.fn.carouFredSel.defaults.auto = true;
		$.fn.carouFredSel.defaults.direction = "up";
		$.fn.carouFredSel.defaults.items = 4;
		$.fn.carouFredSel.defaults.align = "center";

		// scrolls
		if($("#jv_avisos").length) { $('#jv_avisos').carouFredSel({ prev: '#jv_avisos_prev', next: '#jv_avisos_next', direction: 'down', scroll: { items: 1, pauseOnHover: "resume", duration: 800 }});}
		if($("#jv_trip").length) { $('#jv_trip').carouFredSel({ prev: '#jv_trip_prev', next: '#jv_trip_next', direction: 'down', scroll: { items: 1, pauseOnHover: "resume", duration: 800 }});}
		if($("#jv_proExt").length) { $('#jv_proExt').carouFredSel({ prev: '#jv_proExt_prev', next: '#jv_proExt_next', direction: 'down', scroll: { items: 1, pauseOnHover: "resume", duration: 800 }});}
		if($("#jv_COpera").length) { $('#jv_COpera').carouFredSel({ prev: '#jv_COpera_prev', next: '#jv_COpera_next', direction: 'down', scroll: { items: 1, pauseOnHover: "resume", duration: 800 }});}
		if($("#jv_galerias").length) { $('#jv_galerias').carouFredSel({ prev: '#jv_galerias_prev', next: '#jv_galerias_next', direction: 'down', scroll: { items: 2, pauseOnHover: "resume", duration: 800 }});}
		if($("#jv_noticias").length) { $('#jv_noticias').carouFredSel({ prev: '#jv_noticias_prev', next: '#jv_noticias_next', direction: 'down', scroll: { items: 5, pauseOnHover: "resume", duration: 800 }});}
		if($("#jv_pie").length) {  $('#jv_pie').carouFredSel({  circular: true, infinite: false, prev: '#jv_pie_next',  next: '#jv_pie_prev',  direction: 'right', scroll: { items: 1, pauseOnHover: "resume", duration: 800 } }); }
		
		//otros
		$('.btnAceptar, .btnCancelar, .btnExtra, div.TopMenu li, #coin-slider, .prev-ch, .next-ch, .cubo_prev-v, .cubo_next-v').selectOff();

		// evita usar el boton back
		if (typeof history.pushState === "function") { history.pushState("jibberish", null, null); window.onpopstate = function () { history.pushState('newjibberish', null, null);            }; } else { var ignoreHashChange = true; window.onhashchange = function () { if (!ignoreHashChange) { ignoreHashChange = true; window.location.hash = Math.random();                 } else { ignoreHashChange = false;    } }; }
		//=======

	});
	
	function MainITSAO(p){ Caja(); Vista('web_inc/requires/top_conten_itsao.php','Mode=Ajax&Ver='+p,'Caja_CConten','FullLoad'); }

// general
	function Convocatoria_View(p){Caja();Vista('web_inc/requires/Pop_Convocatorias.php','Mode=Ajax&'+p,'Caja_CConten','FullLoad');}
	function Convocatoria(id){Caja();Vista('web_inc/requires/TxtConvocatorias.php','Mode=Ajax&id='+id,'CConten','FullLoad');}
	function Contraloria_Social(){Caja();Vista('web_inc/requires/Pop_Contraloria.php','Mode=Ajax&Ver=Inicio','Caja_CConten','FullLoad');}
	function PagOpen(id){Caja();Vista('web_inc/paginas/'+id+'.php','Mode=Ajax&Ver=Inicio','CConten','FullLoad');}
	function Compartir(tipo,url,titulo){if(tipo == 'TW') {url = "http://twitter.com/share?url="+url+"&via=todossomositsao&text="+titulo;} else if(tipo == 'FB'){url = "http://www.facebook.com/share.php?u="+url;} window.open(url,'Shared'+tipo,'width=650,height=400,scrollbars=NO');}

// == Mireya Modulo Vinculacion
	    //funciones para servicio social
    	function Solicitud_SS(id){Dash();Vista('web_inc/estudiantes/Servicio_Social/frmSolicitud.php','Ver=Edicion&id='+id,divAjax,'FullLoad');}
    	function Solicitud_SS_Editar_Act(ver,cam,val,idAct,dom){
		Vista('web_inc/estudiantes/Servicio_Social/proSolicitud.php','Mode=Ajax&Sec=Campos&Do='+ver+'&idA='+idAct+'&cam='+cam+'&val='+val,dom,'img');
		toolTip();
		}
		function Solicitud_SS_Lista_Act(ver,nom,des,id,dom){
		Vista('web_inc/estudiantes/Servicio_Social/proSolicitud.php','Mode=Ajax&Sec=Tabla&Do='+ver+'&id='+id+'&nombre='+nom+'&descripcion='+des,dom,'img');
		toolTip();
		}
	// funciones para los reportes de servicio social
		function Reportes_SS(id){Dash();Vista('web_inc/estudiantes/Servicio_Social/frmReporte.php','Ver=Edicion&id='+id,divAjax,'FullLoad');}
    	function Reportes_SS_Editar_Act(ver,cam,val,idAct,dom){
		Vista('web_inc/estudiantes/Servicio_Social/proSolicitud.php','Mode=Ajax&Sec=Campos&Do='+ver+'&idA='+idAct+'&cam='+cam+'&val='+val,dom,'img');
		toolTip();
		}
		function Reportes_SS_ActLista(p,dom) {
			Vista('web_inc/estudiantes/Servicio_Social/proReporte.php','Mode=Ajax&Sec=Actividades&id='+p,dom,null);
		}
    	function Reportes_SS_Borrar_Act(nom,p,dom){
    		if(confirm('¿Seguro/a que desea eliminar la Actividad ['+nom+'] de la Lista?...')){ 
    			Reportes_SS_ActLista(p,dom);
    		 } else { return false; }
		}

	// funciones para el cronoframa de actividades servicio social
		function Cronograma_SS(id){Caja();Vista('web_inc/estudiantes/Servicio_Social/frmCronograma.php','Ver=Edicion&id='+id,divBoxShadow,'FullLoad');}
    	function Cronograma_SS_Save(id,indice,val,dom){
		Vista('web_inc/estudiantes/Servicio_Social/proCronograma.php','Mode=Ajax&Sec=Editar&id='+id+'&indice='+indice+'&val='+val+'&dom='+dom,dom,'img');
		toolTip();
		}

// === Napoleon Salas - Centro de Informacion Modulo Alumnos
	function CI_BuscarLibro(){
		var palabra = DomValue('CI_txtPalabraClave');
		var idC = DomValue('CI_cmbCarrera');
		if(palabra != ''){
			Vista('web_inc/estudiantes/Centro_Informacion/frmSolicitud.php','Ver=Busqueda&idC='+idC+'&P='+palabra,'CI_listaResultados',null);
		}
		else {
			$('input#CI_txtPalabraClave').focus();
			AvisoTop('Aviso','Es necesario que escribas una palabra clave para buscar el libro...','null');
			
		}
	}
	function CI_SolicitarLibro(id){
		Vista('web_inc/estudiantes/Centro_Informacion/frmSolicitud.php','Ver=Solicitar&id='+id,'CI_listaResultados',null);
	}
	function CI_ListaPreActual(a,b){
		Vista('web_inc/estudiantes/Centro_Informacion/frmSolicitud.php','Ver=Lista_Prestamos_Actuales','Ci_ListaPreActual',null);
	}

	function CI_RenovarLibro(id){
		Vista('web_inc/estudiantes/Centro_Informacion/frmSolicitud.php','Ver=Renovar&id='+id,'CI_RenovarLoad','img');
	}