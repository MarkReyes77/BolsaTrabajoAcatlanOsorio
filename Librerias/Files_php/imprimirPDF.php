<?php 
$header = '
<div style="padding-top: -70px;">
    
</div>
';

$footer = '
<div style="padding-bottom: -60px;">

</div>
';

 
ob_start(); ?><html>

<head>
<meta http-equiv="Content-Language" content="es-mx">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Reporte de Seguimiento y Avance de Curso Número <?=$NumR;?></title>

<style type="text/css">
td.rotar {transform: rotate(90deg);
	transform-origin: left top 0;}
table, body {font-family: Arial; font-size: 14px;}
table tr td {text-align: left; font-family: Arial; font-size: 13px;}

.borT {border: 1px solid #999;}
.borTop {border-top: 1px solid #999;}
.upper {text-transform: uppercase;}
.borC1 {border-left: 1px solid #999; border-bottom: 1px solid #999;}
.borCel {border-right: 1px solid #999; border-bottom: 1px solid #999;}
.spanTitulo {font-size: 15px; font-weight: bold; letter-spacing: 0.5px; font-family: Arial;}
.spSmall {font-family: Arial; font-size: 10px;}
.divTxtaux {font-size: 11px; font-family: Arial;}
.spAsigTitulo {font-weight: bold; padding: 4px;}
.spProtesta {font-size: 11px; font-family: Arial;}

.borCTop {border: 1px solid #000; border-bottom: 0px none;}
.borCCen {border-top: 0px solid #000; border-left: 1px solid #000; border-right: 1px solid #000;}
.borCCur {border-top: 1px solid #000; border-left: 0px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000;}

.borCBot {border: 1px solid #000;}

.borCTop, .borCCen, .borCBot,.borCLeft,.borCenter, .borCRight, .borCCur {text-align: center; font: normal 9px Arial;}

.borCLeft {border-top: 1px solid #000; border-bottom: 1px solid #000;  border-left: 1px solid #000;}
.borCenter {border-top: 1px solid #000; border-bottom: 1px solid #000;}
.borCRight {font-weight: bold; background: #CCFFCC; border-top: 0px solid #000; border-left: 1px solid #000; border-bottom: 1px solid #000;  border-right: 1px solid #000; font-size: 11px;}

.CabNum {font: bold 11px Arial; text-align: center;}
.TableMat {margin: 3px;}

.Apro {background: #91FF91;}
.center {text-align: center;}

span.Titulo {font: normal 1.6em Tahoma;}
div.Clave {font: normal 1.2em Tahoma;}
div.Especialidad {font: normal 1em Tahoma; height: 20px;}
div.Especialidad em { font-size: 15px; padding-left: 30px;}
.bgEsp {background-color: #FFFFC4;}
.bgGen {background-color: #FFF;}
.bgOtro {background-color: #E1E1E1;}
.bgCursando { background-color: #E6F7FF;}
.bgCursado {background-color: #CCFFCC;}
.stg {font-weight: bold; font-size: 10px;}
.pie {font-weight: italic; font-size: 10px;}
.notas {text-align: left; font-size: 11px; font-family: Arial, Verdana;}
.notas span {font-weight: bold; }
.notas em {}
</style>
</head>

<body>
<div style=" padding: 5px;">
	imprimir en pdf
</div>
</body>

</html>
<?php

                $html = ob_get_contents();
                ob_clean();
                require("mpdf/mpdf.php");
                $mpdf = new Mpdf();
                $mpdf->SetHTMLHeader($header);
                $mpdf->SetHTMLFooter($footer);
                //Tamaño de hoja y forceo de orientacion | orientacion L=Horizontal/P=Vertical
                $mpdf->AddPageByArray(array('sheet-size' => 'Letter-P','orientation' => 'P','mgl' => '15','mgr' => '8','mgt' => '34','mgb' => '70','mgh' => '30','mgf' => '30'));
                $mpdf->WriteHTML($html);
                $mpdf->output('archivo.pdf','I'); // I = ver en pantalla | D =  Descrgar
 

?>