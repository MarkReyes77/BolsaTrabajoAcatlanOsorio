/** login.js ****************/
/*
 * activacion dinamica de elementos para inicio de sesión
 */
$(document).ready(function() {
	// activacion y cierre de caja
	$('span#link_Iniciar-Sesion').click(function(){ $('body#Cuerpo').addClass('OverFlow-N'); $('div#Login-Shadow').fadeIn(); $('div#Login-Body').show();});
	$('span#cerrar-InicioSesion').click(function(){ $('body#Cuerpo').removeClass('OverFlow-N'); $('div#Login-Shadow').fadeOut(); $('div#Login-Body').hide();});
	// formulario login
	$('span#LinkLogin').click(function(){ $('div#login-form').fadeIn();  $('div#login-repass').fadeOut(); });
	
	$('span#login-Alumno').click(function(){ $(this).addClass('Activo'); $('span#login-Docente,span#login-Operador').removeClass('Activo'); TipValue('tipoLogin','1'); TipBox('tipoInner','› Matricula:');});
	//$('span#login-Docente').click(function(){$(this).addClass('Activo'); $('span#login-Alumno,span#login-Operador').removeClass('Activo');TipValue('tipoLogin','2'); TipBox('tipoInner','› Clave:');});
	$('span#login-Operador').click(function(){$(this).addClass('Activo'); $('span#login-Alumno,span#login-Docente').removeClass('Activo');TipValue('tipoLogin','2'); TipBox('tipoInner','› E-Mail:');});
	

	$('span#login-iniciar').click(function(){ frmSubmit('frmLogin'); });

	
	// formulario repass
	$('span#LinkRepass').click(function(){ $('div#login-form').fadeOut();  $('div#login-repass').fadeIn(); });
	$('span#repass-Alumno').click(function(){ $(this).addClass('Activo'); $('span#repass-Docente,span#repass-Operador').removeClass('Activo');TipValue('tipoRepass','1'); });
	//$('span#repass-Docente').click(function(){$(this).addClass('Activo'); $('span#repass-Alumno,span#repass-Operador').removeClass('Activo');TipValue('tipoRepass','2'); });
	$('span#repass-Operador').click(function(){$(this).addClass('Activo'); $('span#repass-Alumno,span#repass-Docente').removeClass('Activo');TipValue('tipoRepass','2'); });
	$('span#repass-iniciar').click(function(){ frmSubmit('frmRepass'); });
});