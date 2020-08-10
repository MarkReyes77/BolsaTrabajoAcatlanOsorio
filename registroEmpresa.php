<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro como: </title>
	<link rel="stylesheet" type="text/css" href="nav_estilo.css?r=<?=mt_rand(1,1000);?>">

	
</head>
<body>


<!-- Light Box--->
	<div class="Conten">
		<div class="Titulo">
			Introduce los siguientes datos para registrarte como Empresa
		</div>
		<br>
		<form method="post"  action="proLogin.php">
<!--***********************Informacion de acceso********************************************-->
			<div class="Body_register">

				<div class="Subtitulo">
					<br>Información de Acceso 
				</div>
				<div>
					<br>
						<input type="email" name="e-mail" value="" placeholder="Correo Electrónico" required=""><br><br>
						<input type="password" name="Pass" placeholder="Contraseña" required=""><br><br>
						<input type="password" name="Pass1" placeholder="Confirmar Contraseña" required="">
						<br><br>
				</div>
			</div>
<!--***********************Informacion de la empresa********************************************-->

			<div class="Body_register">
				<div class="Subtitulo">
					<br>Información De La Empresa 
				</div>
				<div>
					<br>
						<input type="text" name="nombreempresa" value="" placeholder="Nombre de la empresa" required=""><br><br>
						<input type="text" name="rfc" value="" placeholder="RFC" required=""><br><br>
						<!--
						<input type="text" name="pais" value="México" placeholder="País" required=""><br><br>
						-->
						<select name = "ChooseCountry" >
							<option >Elige un Pais</option>
							<option selected="">México</option>
						</select>
						<br><br>
						<input type="text" name="estado" value="Puebla" placeholder="Estado" required=""><br><br>
						<input type="text" name="ciudad" value="Acatlán" placeholder="Ciudad" required=""><br><br>
						<textarea name="direccion" placeholder="Dirección" required=""></textarea><br><br>
						<input type="text" name="giroempresarial" value="" placeholder="Giro Empresarial" required=""><br><br>
						<input type="text" name="ntrabajadores" value="" placeholder="Número de Trabajadores" required=""><br><br>
				</div>

			</div>
<!--***********************Informacion del tipo de empresa********************************************-->
			<div class="Body_register">
				<div class="Subtitulo">
					Información del tipo de empresa
				</div>
				<div>
					<br>
							<textarea name="descripcionempresa" placeholder="Descripción de la Empresa" required=""></textarea><br><br>
							<input type="text" name="web" value="" placeholder="Página WEB"><br><br>

							<!--
							
							<div class="Titulo2" id="imgUser">
								Logo de la Empresa:<br><br> <img class="img-circle" src="Imagenes/Psociety.png">
							</div>
							<br>
							<input class="boton" style="width: 55%" type="file" name="selccionar" onclick=""></input>
							-->
							
							<br><br>
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