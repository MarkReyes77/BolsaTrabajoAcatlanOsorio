<?php
	// patrones para preg_match
	$pat_nums = "/^[[:digit:]]+$/"; // digitos
	$pat_words = "/^[[:word:]]+$/"; // solo letras
	$StatusAlum = array(1=>'Activo',2=>'Termino',3=>'Baja Temporal',4=>'Baja por Reticula');
	$modoUTF = ($_SERVER['SERVER_NAME'] == 'localhost') ? 'de' : 'en'; // www = en  |  local = de
	$modoUTF_In = ($_SERVER['SERVER_NAME'] == 'localhost') ? '' : 'de'; // www = de  |  local = en
	$roman = array(1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X');
	$semTxt = array(1=>'Primero',2=>'Segundo',3=>'Tercero',4=>'Cuarto',5=>'Quinto',6=>'Sexto',7=>'Séptimo',8=>'Octavo',9=>'Noveno',10=>'Decimo',11=>'Onceabo',12=>'Doceabo',13=>'Treceabo');
	$semTxt2 = array(1=>'Primer',2=>'Segundo',3=>'Tercer',4=>'Cuarto',5=>'Quinto',6=>'Sexto',7=>'Séptimo',8=>'Octavo',9=>'Noveno',10=>'Decimo',11=>'Onceabo',12=>'Doceabo',13=>'Treceabo');
	$tipoMate = array(1=>'Normal',2=>'Tronco Común',3=>'Especialidad',4=>'Otro',5=>'Academia Ingles',6=>'Capacitación',7=>'Tutorías');
	$DiasSem = array(1=>'Lunes',2=>'Martes',3=>'Miércoles',4=>'Jueves',5=>'Viernes',6=>'Sabado',7=>'Domingo');
	$LetraDia = array(1=>'L',2=>'M',3=>'M',4=>'J',5=>'V',6=>'S',7=>'D');
	$FormaEva = array(0=>'Sin Especificar',1=>'Parametros',2=>'Rubrica'); // Docencia
	$RubroCat = array(1=>'Sin Especificar',2=>'Desempeño',3=>'Conocimiento',4=>'Producto'); // Docencia
	$Rubro_ModoAct = array(0=>'Sin Especificar',1=>'Individual',2=>'Equipo',3=>'Grupal'); // Docencia
	$kardexLectura = array(1=>'Ordinario',2=>'Ordinario Regula',3=>'Ordinario Extra',4=>'Repite Ordinario',5=>'Repite Regula',6=>'Especial',91=>'Convalidación',92=>'Revalidación',93=>'Equivalencia');
	$statAlumno = array(1=>'Vigente',2=>'Baja Temporal',3=>'Baja por Especial',4=>'Baja Definitiva',5=>'Egresado');
    $statAlumno_abr = array(1=>'Vig.',2=>'B. Temp.',3=>'B. Esp.',4=>'B. Def.',5=>'Egre.');
    $substatsAlumno = array(0=>'Inscrito',1=>'Desertor',2=>'Abandono',3=>'No Inscrito');
    $substatsAlumno_abr = array(0=>'Inscrito',1=>'Desertor',2=>'Abandono',3=>'No Inscrito');
    $debug = "";
	$fila = 0;
	$num = 0;

	// Mireya (Modulo: Vinculacion)
	$VinSS_TipoPrograma = array('Educación para Adultos','Desarrollo de Comunidades','Actividades Deportivas','Actividades Civicas','Actividades Culturales','Medio Ambiente','Desarrollo Sustentable','Apoyo a la Salud','Otros');
	// <===
	// Itandehui & Italletzy (Modulo: Recursos Materiales)
	$Uni_medidas = array('Pieza','Litros','Paquetes','Kilos','Caja');
	$Uni_medidas_abr = array('Pz','Lts','Paq','Kg','Caj');
	// <===



	//Función que limpia la información enviada de formularios para evitar ataques
	function quitar($t) {
		$t = trim($t) ;
		$t = htmlspecialchars($t);
		$t = str_replace(chr(160),'',$t); // <-- Elimina espacios forzados, como caractéres normales pero invisibles
		if(get_magic_quotes_gpc()){ $t = stripslashes($t); }
		return $t ;
	}
	
	// adquiere la raiz del script
	function Directorio($path=''){
		if(!empty($path)){
			$urlNav = $_SERVER['REQUEST_URI'];
			if(preg_match('/ITSAO/',$urlNav)){
				$urlNav = explode('/ITSAO/',$urlNav);
				$urlNav = $urlNav[1];
			}
			$urlNav = explode('/',$urlNav); $total = count($urlNav)-1; // -1 ya que elimina la pagina self.
			$path = "";
			for($i = 1; $i <= $total; $i++){
				$path .= "../";
			}
		}
		return $path;
	}
	function formatTel($t,$sep = ''){
		$tel  = !empty($t) ? $t : '';
		if(!empty($tel)){ 
			if(strlen($tel)==10) {
				$x = substr($tel, 0, 3).$sep.substr($tel, 3, 3).$sep.substr($tel, 6, 10); 
			}
			else if(strlen($tel) == 7) {
				$x = substr($tel, 0, 3).$sep.substr($tel, 3, 7);
			}
			else { $x = $tel; }
		}
		else { $x = '- - -';}
		return $x;
	}

	function put_utf($t,$m='') {
		if($_SERVER['SERVER_NAME'] == 'localhost') {
			if($m == 'en') {
				$t = utf8_encode($t); 
			}
			else { $t = $t; }
		}
		else {
			if($m == 'de'){ // decode
				$t = utf8_decode($t);
			}
			else if($m == 'en'){  // encode
				$t = utf8_encode($t); 
			}
			else { $t = $t; }
		}

		return $t;
	}

	function put_oracion($t){
		if(!empty($t)) { 
			return mb_convert_case($t,MB_CASE_TITLE,'UTF-8');
		}
		else {
			return $t;
		}
	}

	function CalcularDim($AnO,$AlO,$ancho,$hmax){
		if($ancho == 0 && $hmax > 0 && $hmax <= $AlO) {
			$ancho = $AnO;
			$alto = $AlO;
			
			$ratio = ($AnO / $ancho);
			$alto = ($AlO / $ratio);
			if($alto>$hmax){ $anchura2 = $hmax*$ancho/$alto; $alto = $hmax; $ancho = $anchura2; }

			return $ancho.'x'.$alto;
		}
		else if($ancho > 0 && $ancho <=$AnO && $hmax == 0) {
			$width = $AnO;
    		$new_width = $ancho; //nuevo tamaño
    		if ($width > $new_width){
      			$height = $AlO;
	    	  	$calculo = ceil((100*$new_width)/ $width); //porcentaje
    			$new_height = ceil(($height*$calculo)/100);
      		}

			return $new_width.'x'.$new_height;
		}
		else {
			return $AnO.'x'.$AlO;
		}
	}

	function BuscarQue($t,$campos){
		$palabra = explode(" ",$t); // Separamos cadena introducida | Antonio Reyes Muñiz
		$camposTabla = $campos; // campos en la base de datos | Nombre,Anio_in,ApellidoP,ApellidoM,NControl
		$numCampos = count($camposTabla);

		// estructura
		$donde = "WHERE ";
		for($w=0; $w < count($palabra); $w++) {
			$donde .= "(";
		  	for($cam=0; $cam < $numCampos; $cam++) {
				$donde .= $camposTabla[$cam] . " LIKE '%$palabra[$w]%'";
				if($cam < $numCampos-1) $donde .= " OR ";
			}
			$donde .= ")";
			if($w < count($palabra)-1) $donde .= " AND "; // recortamos palabra si se acabo el for
		}

		return $donde; // devolvemos cadena
	}

	function Edad($d,$m,$a,$hd,$hm,$ha) {
	 	// Fecha Actual
		$f = time();
		if($hd==0 || $hm==0 || $ha == 0) { $dia = date('d',$f); $mes = date('m',$f); $anio = date('Y',$f);	}
		else { $dia = $hd; $mes = $hm; $anio = $ha; }
		//condiciones
		if($m == $mes && $d > $dia) $anio = ($anio-1);
		if($m > $mes) $anio = ($anio-1);

		// retornamos años	
		return ($anio-$a);
	}

	function generarPassword($longitud = 8, $opcLetra = TRUE, $opcNumero = TRUE, $opcMayus = TRUE, $opcEspecial = TRUE){
		$letras ="abcdefghijklmnopqrstuvwxyz";
		$numeros = "1234567890";
		$letrasMayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$especiales ="@#$%()=*+[]{}-_";
		$listado = "";
		$password = "";
		if ($opcLetra == TRUE) $listado .= $letras;
		if ($opcNumero == TRUE) $listado .= $numeros;
		if($opcMayus == TRUE) $listado .= $letrasMayus;
		if($opcEspecial == TRUE) $listado .= $especiales;

		for( $i=1; $i<=$longitud; $i++) {
			$caracter = $listado[rand(0,strlen($listado)-1)];
			$password.=$caracter;
			$listado = str_shuffle($listado);
		}
		return $password;
	}
	
	function CheckNav($user_agent) {
    	$navegadores = array(
          'Google Chrome' => '/(Chrome)/'
    	);
    	$ready = false;

    	foreach($navegadores as $navegador=>$pattern){
       		if (preg_match($pattern, $user_agent)) {
           		$ready = true;
       		}
	    }
	    return $ready;
	}

	function CreaOptionMes($d=1,$h=12,$id=0,$patron=0){
		global $Meses,$fila;
     	while($d <= $h) {
			if($fila == 0){$color = "Uno"; $fila=1;}else{$color = "Dos"; $fila=0;}
			if(!empty($patron)) {
				if(preg_match_all("/".$patron."/i",$d)) {
		?>
		<option class="<?=$color;?>" value="<?=$d;?>"<?=$id==$d ? ' selected' : '';?>><?=$Meses[$d];?></option>
		<?php
				}
			}
			else {
		?>
		<option class="<?=$color;?>" value="<?=$d;?>"<?=$id==$d ? ' selected' : '';?>><?=$Meses[$d];?></option>
		<?php
			}
			$d++;
		}
	}
	function CreaOptionDia($f,$id=0,$patron){
		global $DiasSem,$fila;
		$i = 1;
		$max = !empty($f) ? date('t',$f) : date('t',time());
     	while($i <= $max) {
			if($fila == 0){$color = "Uno"; $fila=1;}else{$color = "Dos"; $fila=0;}
			if(!empty($f)){
				$m = date('n',$f); $a = date('Y',$f);
				if(checkdate($m, $i, $a)) {
					$fa = mktime(0,0,0,$m,$i,$a);
					$dia = date("N",$fa); $diaJ = date("j",$fa); 

					if(!empty($patron)) {
						if(preg_match_all("/".$patron."/i",$dia)) {
		?>
		<option class="<?=$color;?>" value="<?=$i;?>"<?=$id==$i ? ' selected' : '';?>><?=$DiasSem[$dia];?> <?=$diaJ;?></option>
		<?php
						}
					}
					else {
		?>
		<option class="<?=$color;?>" value="<?=$i;?>"<?=$id==$i ? ' selected' : '';?>><?=$i;?></option>
		<?php
					}
				}
			}
			else {
		?>
		<option class="<?=$color;?>" value="<?=$i;?>"<?=$id==$i ? ' selected' : '';?>><?=$i;?></option>
		<?php
			}
			$i++;
		}
	}

function getPersonal($idP,$idD = 0,$sigla = 1){
    global $link;

    if(!empty($idD) && empty($idP)){
        $r = mysqli_query($link,"SELECT a.Nombre,a.ApellidoP,a.ApellidoM,a.SiglaPro FROM fh_personal AS a INNER JOIN ed_personal AS b ON a.IDPersonal=b.IDPersonal WHERE b.IDDocente='".$idD."'") or die(mysqli_error($link));
        if(mysqli_num_rows($r)==true) {
            $Data = mysqli_fetch_array($r); mysqli_free_result($r);
            $siglaPro = (!empty($Data['SiglaPro']) && $sigla==1) ? $Data['SiglaPro']." " : '';
            $x = $siglaPro.$Data['Nombre']." ".$Data['ApellidoP']." ".$Data['ApellidoM'];
        }
        else {
            $x = "Sin Definir";
        }
    }
    else if(empty($idD) && !empty($idP)){
        $r = mysqli_query($link,"SELECT SiglaPro,Nombre,ApellidoP,ApellidoM FROM fh_personal WHERE IDPersonal='".$idP."'") or die(mysqli_error($link));
        if(mysqli_num_rows($r)==true) {
            $Data = mysqli_fetch_array($r); mysqli_free_result($r);
            $siglaPro = (!empty($Data['SiglaPro']) && $sigla==1) ? $Data['SiglaPro']." " : '';
            $x = $siglaPro.$Data['Nombre']." ".$Data['ApellidoP']." ".$Data['ApellidoM'];
        }
        else {
            $x = "Sin Definir";
        }
    }
    else {
        $x = "Sin Definir";
    }

    return $x;
}

function numFormat($num, $pre = 2){
    $acum = empty($pre) ? 0 : $pre+1;
    return floor($num).substr(str_replace(floor($num), '', $num), 0, $acum);
}

function NumToTxt_Centena($numc){
        if ($numc >= 100)
        {
            if ($numc >= 900 && $numc <= 999)
            {
                $numce = "NOVECIENTOS ";
                if ($numc > 900)
                    $numce = $numce.(NumToTxt_Decena($numc - 900));
            }
            else if ($numc >= 800 && $numc <= 899)
            {
                $numce = "OCHOCIENTOS ";
                if ($numc > 800)
                    $numce = $numce.(NumToTxt_Decena($numc - 800));
            }
            else if ($numc >= 700 && $numc <= 799)
            {
                $numce = "SETECIENTOS ";
                if ($numc > 700)
                    $numce = $numce.(NumToTxt_Decena($numc - 700));
            }
            else if ($numc >= 600 && $numc <= 699)
            {
                $numce = "SEISCIENTOS ";
                if ($numc > 600)
                    $numce = $numce.(NumToTxt_Decena($numc - 600));
            }
            else if ($numc >= 500 && $numc <= 599)
            {
                $numce = "QUINIENTOS ";
                if ($numc > 500)
                    $numce = $numce.(NumToTxt_Decena($numc - 500));
            }
            else if ($numc >= 400 && $numc <= 499)
            {
                $numce = "CUATROCIENTOS ";
                if ($numc > 400)
                    $numce = $numce.(NumToTxt_Decena($numc - 400));
            }
            else if ($numc >= 300 && $numc <= 399)
            {
                $numce = "TRESCIENTOS ";
                if ($numc > 300)
                    $numce = $numce.(NumToTxt_Decena($numc - 300));
            }
            else if ($numc >= 200 && $numc <= 299)
            {
                $numce = "DOSCIENTOS ";
                if ($numc > 200)
                    $numce = $numce.(NumToTxt_Decena($numc - 200));
            }
            else if ($numc >= 100 && $numc <= 199)
            {
                if ($numc == 100)
                    $numce = "CIEN ";
                else
                    $numce = "CIENTO ".(NumToTxt_Decena($numc - 100));
            }
        }
        else
            $numce = NumToTxt_Decena($numc);
        
        return $numce;  
}
function NumToTxt_Miles($nummero){
        if ($nummero >= 1000 && $nummero < 2000){
            $numm = "MIL ".(NumToTxt_Centena($nummero%1000));
        }
        if ($nummero >= 2000 && $nummero <10000){
            $numm = NumToTxt_Unidad(Floor($nummero/1000))." MIL ".(NumToTxt_Centena($nummero%1000));
        }
        if ($nummero < 1000)
            $numm = NumToTxt_Centena($nummero);
        
        return $numm;
    }
function NumToTxt_Unidad($numuero){
    switch ($numuero)
    {
        case 9:
        {
            $numu = "NUEVE";
            break;
        }
        case 8:
        {
            $numu = "OCHO";
            break;
        }
        case 7:
        {
            $numu = "SIETE";
            break;
        }       
        case 6:
        {
            $numu = "SEIS";
            break;
        }       
        case 5:
        {
            $numu = "CINCO";
            break;
        }       
        case 4:
        {
            $numu = "CUATRO";
            break;
        }       
        case 3:
        {
            $numu = "TRES";
            break;
        }       
        case 2:
        {
            $numu = "DOS";
            break;
        }       
        case 1:
        {
            $numu = "UN";
            break;
        }       
        case 0:
        {
            $numu = "";
            break;
        }       
    }
    return $numu;   
}

function NumToTxt_Decena($numdero){
    
        if ($numdero >= 90 && $numdero <= 99)
        {
            $numd = "NOVENTA ";
            if ($numdero > 90)
                $numd = $numd."Y ".(NumToTxt_Unidad($numdero - 90));
        }
        else if ($numdero >= 80 && $numdero <= 89)
        {
            $numd = "OCHENTA ";
            if ($numdero > 80)
                $numd = $numd."Y ".(NumToTxt_Unidad($numdero - 80));
        }
        else if ($numdero >= 70 && $numdero <= 79)
        {
            $numd = "SETENTA ";
            if ($numdero > 70)
                $numd = $numd."Y ".(NumToTxt_Unidad($numdero - 70));
        }
        else if ($numdero >= 60 && $numdero <= 69)
        {
            $numd = "SESENTA ";
            if ($numdero > 60)
                $numd = $numd."Y ".(NumToTxt_Unidad($numdero - 60));
        }
        else if ($numdero >= 50 && $numdero <= 59)
        {
            $numd = "CINCUENTA ";
            if ($numdero > 50)
                $numd = $numd."Y ".(NumToTxt_Unidad($numdero - 50));
        }
        else if ($numdero >= 40 && $numdero <= 49)
        {
            $numd = "CUARENTA ";
            if ($numdero > 40)
                $numd = $numd."Y ".(NumToTxt_Unidad($numdero - 40));
        }
        else if ($numdero >= 30 && $numdero <= 39)
        {
            $numd = "TREINTA ";
            if ($numdero > 30)
                $numd = $numd."Y ".(NumToTxt_Unidad($numdero - 30));
        }
        else if ($numdero >= 20 && $numdero <= 29)
        {
            if ($numdero == 20)
                $numd = "VEINTE ";
            else
                $numd = "VEINTI".(NumToTxt_Unidad($numdero - 20));
        }
        else if ($numdero >= 10 && $numdero <= 19)
        {
            switch ($numdero){
            case 10:
            {
                $numd = "DIEZ ";
                break;
            }
            case 11:
            {               
                $numd = "ONCE ";
                break;
            }
            case 12:
            {
                $numd = "DOCE ";
                break;
            }
            case 13:
            {
                $numd = "TRECE ";
                break;
            }
            case 14:
            {
                $numd = "CATORCE ";
                break;
            }
            case 15:
            {
                $numd = "QUINCE ";
                break;
            }
            case 16:
            {
                $numd = "DIECISEIS ";
                break;
            }
            case 17:
            {
                $numd = "DIECISIETE ";
                break;
            }
            case 18:
            {
                $numd = "DIECIOCHO ";
                break;
            }
            case 19:
            {
                $numd = "DIECINUEVE ";
                break;
            }
            }   
        }
        else
            $numd = NumToTxt_Unidad($numdero);
    return $numd;
}

?>