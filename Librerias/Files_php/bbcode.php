<?php
function CleanTxt($t){
	$Format = array(
		"\r\n" => "<br />", "\n" => "<br>",
		"[b]" => "<strong>", "[/b]" => "</strong>",
		"[hr]" => "<hr />",
		"[*]" => " • ",
		"[i]" => "<em>", "[/i]" => "</em>",
		"[u]" => "<u>", "[/u]"   => "</u>",
		"[s]" => "<s>", "[/s]"   => "</s>",
		"[left]" => "", "[/left]" => "",
		"[center]" => "", "[/center]"   => "",
		"[right]" => "", "[/right]" => "",
		"[justify]" => "", "[/justify]"   => ""
	);

	foreach($Format as $a => $b) {$t = str_replace($a,$b,$t);}
	
	$t = preg_replace("/\[url\](.+)\[\/url\]/iU",'$1',$t) ;
	$t = preg_replace("/\[url=(.+)\]/iU",'',$t) ;
	$t = str_replace('[/url]','',$t) ;
	$t = preg_replace("/\[self\](.+)\[\/self\]/iU",'$1',$t) ;
	$t = preg_replace("/\[self=(.+)\]/iU",'',$t) ;
	$t = str_replace('[/self]','',$t) ;

	$t = preg_replace("~\[color=(.*?)\](.*?)\[/color\]~s", "$2",$t);
	$t = preg_replace("~\[size=(.*?)\](.*?)\[/size\]~s", "$2",$t);

// - /\[size=([2]?[1-9])\](.*?)\[\/size\]/is
// - /\[color=(#[0-9A-F]{6}|[a-f]+)\](.*?)\[\/color\]/is
	return $t;

}


function Texto($t){
	$Format = array(
		"\r\n" => "<br />", "\n" => "<br>",
		"[b]" => "<strong>", "[/b]" => "</strong>",
		"[hr]" => "<hr />",
		"[*]" => "<div class='bullet'></div>",
		"[i]" => "<em>", "[/i]" => "</em>",
		"[u]" => "<u>", "[/u]"   => "</u>",
		"[s]" => "<s>", "[/s]"   => "</s>",
		"[left]" => "<div style='position:relative; float:left'>", "[/left]" => "</div>",
		"[center]" => "<div style='text-align: center;'>", "[/center]"   => "</div>",
		"[right]" => "<div style='position:relative; float:right'>", "[/right]" => "</div>",
		"[justify]" => "<div style='text-align: justify;'>", "[/justify]"   => "</div>"
	);

	foreach($Format as $a => $b) {$t = str_replace($a,$b,$t);}

	$t = preg_replace("/\[img_self\](.+)\[\/img_self\]/iU",'<img src="$1" title="Cargando..." alt="Cargando..." />',$t);
	$t = preg_replace("/\[url\](.+)\[\/url\]/iU",'<a href="$1" target="_blank">$1</a>',$t) ;
	$t = preg_replace("/\[url=(.+)\]/iU",'<a href="$1" target="_blank">',$t) ;
	$t = str_replace('[/url]','</a>',$t);
	$t = preg_replace("/\[self\](.+)\[\/self\]/iU",'<a href="$1" target="_self">$1</a>',$t) ;
	$t = preg_replace("/\[self=(.+)\]/iU",'<a href="$1" target="_self">',$t) ;
	$t = str_replace('[/self]','</a>',$t) ;

	$t = preg_replace("~\[color=(.*?)\](.*?)\[/color\]~s", "<span style='color: $1;'>$2</span>",$t);
	$t = preg_replace("~\[size=(.*?)\](.*?)\[/size\]~s", "<span style='font-size: $1em;'>$2</span>",$t);

// - /\[size=([2]?[1-9])\](.*?)\[\/size\]/is
// - /\[color=(#[0-9A-F]{6}|[a-f]+)\](.*?)\[\/color\]/is
	return $t;
}

function URIs($texto) {
	$texto = preg_replace('/(?<!<a href=")(?<!<img src=")(http|ftp)s?:\/\/[^,<\s]+/i','<a href="\\0" target="_blank">\\0</a>',$texto) ;
	$texto = preg_replace('/([\w_-]+)@([\w\.-]+\.\w{2,3})/i',"<script>proteger_email('\\1','\\2')</script>",$texto) ;
	return $texto ;
}
function Imagen($t){ $t = preg_replace_callback("/\[img\](.*?)\[\/img\]/i",create_function('$r','return PutImagen($r[1]);'),$t); return $t;}
												//-->     /\[img\](.+)\[\/img\]/is			
function PutImagen($r){
	$r = explode('|',$r);

	// direccion externa
	if(preg_match('/url=/', $r[2])){ $url = explode("url=",$r[2]); $rUrl = $url[1];}
	else { $rUrl = ""; }
	
	// descripcion o titulo
	if(preg_match('/titulo=/', $r[1]) || preg_match('/Titulo=/', $r[1])){
		$descrip = explode('=',$r[1]);
		if(!empty($rUrl)){$BloqueSpan = "class='Link' OnClick=\"Enlace('".$rUrl."','blank');\"";}
		$titulo = "<span class='Bloque'><span ".$BloqueSpan.">".$descrip[1]."</span></span>";} else {$titulo = "";
	}

	// obtencion de imagen
	if(preg_match('/idFoto=/', $r[0])){ // si es imagen de galeria o foto
		$idFoto = explode('=',$r[0]);
		//$dato = ViewDataFoto(0,0,$idFoto[1],false,0,0,380,'./');
		$foto = "<img OnClick=\"Gal_Teatro_Single(".$idFoto[1].",'idFoto',0);\" src='archivos/php/viewRecurso.php?idFoto=".$idFoto[1]."&amp;hMax=360' style='cursor: pointer;' alt='".$rUrl."' />";
	}
	else if(preg_match('/id=/', $r[0])){ // recurso de la galeria NS		
		$id = explode('=',$r[0]);
		$id = preg_replace("//", "", $id[1]);
		//$dato = ViewDataFoto($id[1],0,0,false,0,0,380,'./');
		$foto = "<img OnClick=\"Gal_Teatro_Single(".$id.",'id',0);\" src='archivos/php/viewRecurso.php?id=".$id."&amp;hMax=360' style='cursor: pointer;' alt='".$rUrl."' />";
	}
	else {// sino es externa
		$foto = "<img src='".$r[0]."' alt='".$rUrl."'>";
	}
	
	// descripcion o titulo
	return '
		<span class="Blog_Imagen">
			<span class="Img Cir">
				'.$foto.'
				'.$titulo.'
			</span>
		</span>';
}
function Imagen_View($t){ $t = preg_replace_callback("/\[img\](.*?)\[\/img\]/i",create_function('$r','return PutImagen_View($r[1]);'),$t); return $t;}
function PutImagen_View($r){
	$r = explode('|',$r);

	// direccion externa
	if(preg_match('/url=/', $r[2])){ $url = explode("url=",$r[2]); $rUrl = $url[1];}
	else { $rUrl = ""; }
	
	// descripcion o titulo
	if(preg_match('/titulo=/', $r[1]) || preg_match('/Titulo=/', $r[1])){
		$descrip = explode('=',$r[1]);
		$titulo = "<span class='Bloque'><span>".$descrip[1]."</span></span>";} else {$titulo = "";
	}

	// obtencion de imagen
	if(preg_match('/idFoto=/', $r[0])){ // si es imagen de galeria o foto
		$idFoto = explode('=',$r[0]);
		$foto = "<img src='../archivos/php/viewRecurso.php?idFoto=".$idFoto[1]."&amp;hMax=380&amp;rnd=".mt_rand(1,10)."' alt='".$rUrl."' />";
	}
	else if(preg_match('/id=/', $r[0])){ // recurso de la galeria NS		
		$id = explode('=',$r[0]);		
		$foto = "<img src='../archivos/php/viewRecurso.php?id=".$id[1]."&amp;hMax=380&amp;rnd=".mt_rand(1,10)."' alt='".$rUrl."' />";
	}
	else {// sino es externa
		$foto = "<img src='".$r[0]."' alt='".$rUrl."'>";
	}
	
	// descripcion o titulo
	
	return '
		<span class="Blog_Imagen">
			<span class="Img Cir">
				'.$foto.'
				'.$titulo.'
			</span>
		</span>';

}

function Frame($t){ $t = preg_replace_callback("/\[frame\](.+)\[\/frame\]/is",create_function('$r','return PutFrame($r[1]);'),$t); return $t;}
function PutFrame($r){
	$data = explode('|',$r);
	
	$url = $data[0];
	$dim = explode('x',$data[1]);
	
	if(empty($data[1])){
		$dim[0] = 425;
		$dim[1] = 350;
	}
	if(!empty($data[2])){$titulo = "<span class='Bloque'><span class='Link' OnClick=\"Enlace('".$url."','blank');\">".utf8_decode($data[2])."</span></span>";} else {$titulo = "";}
	
	return '
		<div class="Blog_Frame">
			<div class="Cir">
				<iframe style="width: '.$dim[0].'px; height: '.$dim[1].'px; border: 0px none; overflow: hidden; margin: 0px; padding: 0px;" src="'.$url.'"></iframe>
				'.$titulo.'
			</div>
		</div>';
}


function Video($t){ $t = preg_replace_callback("/\[youtube\](.*?)\[\/youtube\]/is",create_function('$r','return PutVideo($r[1]);'),$t); return $t; }
function PutVideo($t){

	return '
		<div class="Blog_Frame">
			<div class="Cir">
				<iframe style="width: 550px; height: 335px; border: 0px none; overflow: hidden; margin: 0px; padding: 0px;" src="blanco.php?sec=Video&var='.$t.'"></iframe>
				<span class="Bloque"><span class="Link" OnClick="Enlace(\'http://www.youtube.com/watch?v='.$t.'\',\'blank\');">Ver video en YouTube</span></span>
			</div>
		</div>';
}

function Censura($t){
	return $t;
}

function Filtro($t,$tipo) {

	if ($tipo =='FULL') {
		$t = Texto($t);
		$t = Imagen($t);
		//$t = URIs($t);
		$t = Video($t);
		$t = Frame($t);
	}
	else if ($tipo =='Limpio') {
		$t = CleanTxt($t);
		$t = Imagen($t);
		//$t = URIs($t);
		$t = Video($t);
		$t = Frame($t);
	}
	else if ($tipo =='View') {
		$t = Texto($t);
		$t = Imagen_View($t);
		//$t = URIs($t);
		$t = Video($t);
		$t = Frame($t);
	}
	else if($tipo == 'portada'){
		$t = Texto($t);
	}
	
	return $t;
}
?>