
<?php
	require('config.php');

	$u=!empty($_POST['User']) ? $_POST['User'] : '';
	
	$p=!empty($_POST['Pass']) ? $_POST['Pass']:'';

	$b=!empty($_POST['conectar']) ? $_POST['conectar'] : '';



	$r = mysqli_query($link,"SELECT * FROM usuario WHERE NoTelefono = '$u' or Email = '$u'");
	
	if (mysqli_num_rows($r)==true) {
		$user = mysqli_fetch_array($r);
		mysqli_free_result($r);
		if ($p == $user['Pass']) {
			
			/*setcookie("nc",$u,time()+60);*/
			/*header("location: frm_login.php");*/
			header("location: index.php");

		}else{
			echo "Error: Contraseña incorrecta";
		}
	}else{
		echo "Error: No existe el usuario";
	}

