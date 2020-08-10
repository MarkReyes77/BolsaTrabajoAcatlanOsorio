<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

<?php

	// conexion a la bd
	require('config.php');
	$id;
	$n = !empty($_POST['name']) ? $_POST['name'] : '';
	$ln = !empty($_POST['lastname']) ? $_POST['lastname'] : '';
	$tel = !empty($_POST['tel']) ? $_POST['tel'] : '';
	$PD = !empty($_POST['PuestoDeceado']) ? $_POST['PuestoDeceado'] : '';
	$p = !empty($_POST['Pass']) ? $_POST['Pass'] : '';
	$p1= !empty($_POST['Pass1']) ? $_POST['Pass1'] : '';
	
	$userID = NULL;
	$userTel = NULL;
	$userEmail = NULL;
	$userPass = NULL;
	$userTipoUsuario = NULL;

	if ($p===$p1) {
		// ingres_field_precision(result, index)

	
		if(mysqli_query($link, "INSERT INTO usuario(NoTelefono,Pass,ID_TipoUsuario) VALUES('$tel','$p','4')")){

				$r = mysqli_query($link,"SELECT * FROM usuario") or die(mysqli_error($link));
				while ($d = mysqli_fetch_array($r)) {
					$userID= $d['ID_Usuario'];
				}
			
				mysqli_free_result($r);
						$host  = $_SERVER['HTTP_HOST'];
						$folder = "/bolsa";
						$extra = "/frm_login.php";
				?>
						<script type="text/javascript">
							var respuesta = alert("Usted ha sido registrado exitosamente");
							if (!respuesta) {
								var protocolo = window.location.protocol;
								var host = window.location.host;
								var folder= "bolsa";
								var extra = "frm_login.php";
								var dir = protocolo.concat("//",host,"/",folder,"/",extra);
								window.location.replace(dir);
							}else{
								alert("Inicie sesion");
							}
						</script>
				

				<?php
				/*
				if ($userID=='67565') {
					 						/*				Redirecciona a una página
																I M P O R T A N T E
									Cuando se suba a algun servidor, quitar la variable folder del header
								$host  = $_SERVER['HTTP_HOST'];
								$folder = "/bolsa";
								$extra = "/frm_login.php";
								header("Location: http://$host$folder$extra");
								exit;
				}
				*/
				
		}
		else {
			echo "Error: ".mysqli_error($link);
		}

	}else{
		echo "Contraseñas incorrectas";
	}

	?>
</body>
</html>
