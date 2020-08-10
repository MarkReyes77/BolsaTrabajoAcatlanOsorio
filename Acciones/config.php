<?php
$serie = array("h"=>"localhost","u"=>"root","p"=>"","bd"=>"bolsa_trabajo"); 
$link = mysqli_connect($serie['h'],$serie['u'],$serie['p'],$serie['bd']);
if(!$link){
	echo 'Error de Conexión<br><br>
		<strong style="color: red; font-weight: bold;">
			No se pudo Conectar a la Base de Datos:
		</strong>
		<br/><br/>
		<em>'.mysqli_connect_error().'</em><br/>
		';
	exit();
}
?>