
<!--
*
* @Autor Marcos Cruz Reyes
*
*
*
-->

<!DOCTYPE html>


<html>

<head>
	<meta charset="utf-8">
	<title>Iniciar Sesión</title>
	<link rel="stylesheet" type="text/css" href="nav_estilo.css?r=<?=mt_rand(1,1000);?>">
	<link rel="stylesheet" type="text/css" href="LittleLightBox.css?r=<?=mt_rand(1,1000);?>">
	<script type="text/javascript" src="nav_js.js"></script>
	<script type="text/javascript" src = "Librerias/Files_js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="Iconos/styleIcons.css">
</head>
<body>

<!-- Light Box--->
	<div class="lightBox_Shadow" id="LB_Sh">
	</div>
	<div class="lightBoxConten" id="LB_CT">
		<div class="lightBox_Body" id="LB_Body">
			<div style="text-align: right;">
				<button class="botonCerrar" onclick="accionLB(0);">
					<em class=" icon-cancel-circle"></em>
				</button>
			</div>
			<div id="LB_Body">
				<!--Aqui comineza el contenido del box-->
				<div class="Titulo">
					Registrate como:
				</div>

				<div id="menu" align="center" >
					<ul>
						<li class="botonChooseEmp" >Empleador
							<ul>
								<li onclick="IrPage('registroEmpresa.php')">
									Tengo una empresa
								</li>
							
								<li onclick="IrPage('registroEmpleador.php')">
									No tengo una empresa
								</li>
							</ul>
						</li>
						
					</ul>

					<ul>
						
							<li class="botonChooseCan" onclick="IrPage('registroCandidato.php')">
								Candidato
							</li>
						
					</ul>
					<br><br>
				</div>
				<!--Aqui Termina el contenido del box-->
			</div>
		</div>
	</div>
<!-- Fin Light Box--->
	<div class="Titulo">Bienvenido a Bolsa de trabajo de Acatlán de Osorio, Puebla</div>


	<div class="Body_Login">
		<div>
			<br>
			<form method="post" action="proLogin.php">
				<div id="imgUser">
					<img class="img-circle" src="Imagenes/Mono.png" style="">
					<br>
					<br>
				</div>
				<div>
					<input type="text" name="User" value="" placeholder="Teléfono o E-mail" required=""><br><br>
					<input type="password" name="Pass" placeholder="Contraseña"><br><br>
					<input class="boton" type="submit" name="conectar" value="Iniciar Sesion">
				</div>
			</form> 
			<a class="vinculos" style="cursor: pointer;">¿Olvidaste tu contraseña?</a>
			<br>
			<p  class="vinculos" >¿Todavia no tienes una cuenta? <STRONG style="cursor: pointer; color: #E53935;" onclick="accionLB('abrir');">Registrate</STRONG></p>
			<br><br>
		</div>
	</div>
</body>

</html>