<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro como: </title>
	<link rel="stylesheet" type="text/css" href="nav_estilo.css?r=<?=mt_rand(1,1000);?>">

	
</head>
<body>
<!--<div class="Titulo">Registro como Empleador/Empresa en Bolsa de trabajo de Acatlán de Osorio puebla</div>-->

<!-- Light Box--->
	<div class="Conten">
		<div class="Titulo" style="">
			
			<STRONG style="margin: 5px; padding: 5px;">Introduce los siguientes datos para registrarte como Empleador/Empresa</STRONG>
			
		</div>
		<form method="post"  action="proLogin.php">
<!--***********************Informacion de acceso********************************************-->
			<div class="Body_register">

				<div class="Subtitulo">
					Información de Acceso
				</div>
				<div>
					<br>
						<input type="email" name="e-mail" value="" placeholder="Correo Electrónico" required=""><br><br>
						<input type="password" name="Pass" placeholder="Contraseña" required=""><br><br>
						<input type="password" name="Pass1" placeholder="Confirmar Contraseña" required="">

				</div>
			</div>

<!--***********************Informacion de persona de contacto********************************************-->
			<div class="Body_register">
				<div class="Subtitulo">
					Información de Persona de contacto
				</div>
				<div>
					<br>
						<input type="text" name="nombre" value="" placeholder="Nombre" required=""><br><br>
						<input type="text" name="apellido" value="" placeholder="Apellidos" required=""><br><br>
						<input type="text" name="cargo" value="" placeholder="Cargo" required=""><br><br>
						<input type="text" name="telefono" value="" placeholder="Teléfono" required=""><br><br>
						<input type="text" name="telefono1" value="" placeholder="Teléfono 2"><br><br>
				</div>
			</div>



			<br>
			<input class="boton" type="submit" name="conectar" value="Registrate">
		</form>
		<br>
		<br>
	</div>
<!-- Fin Light Box--->


</body>
</html>