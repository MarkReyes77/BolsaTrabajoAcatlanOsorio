<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro como: Candidato/Postulante</title>
	<link rel="stylesheet" type="text/css" href="nav_estilo.css?r=<?=mt_rand(1,1000);?>">

	
</head>
<body>


<!-- Light Box--->
	<div class="Conten">
		<div class="Titulo">
				Introduce los siguientes datos para registrarte como Candidato.
		</div>
		<br>
		<div class="Body_register">
			<div class="Subtitulo">
				Información Personal 
			</div>
			<div>
				<br>
				<form method="post"  action="Acciones/AddCandidato.php">

					<input type="text" name="name" value="" placeholder="Nombre" required=""><br><br>
					<input type="text" name="lastname" value="" placeholder="Apellidos" required=""><br><br>
					<input type="text" name="tel" value="" placeholder="Teléfono" required=""><br><br>
					<input type="text" name="PuestoDeceado" placeholder="Puesto Deceado" required=""><br><br>
					<input type="password" name="Pass" placeholder="Contraseña" required=""><br><br>
					<input type="password" name="Pass1" placeholder="Confirmar Contraseña" required=""><br><br>
					<input class="boton" type="submit" name="conectar" value="Registrate">
				</form>
				<br>
			</div>
		</div>
		<br>
		<br>
	</div>
<!-- Fin Light Box--->

</body>
</html>	