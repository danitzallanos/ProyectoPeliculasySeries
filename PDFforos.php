<?php
require_once ('../db/conexion.php');
require_once ('../modelo/foro.php');
require_once ('../libs/reportepdf/class.ezpdf.php');
conectar();
session_start();

date_default_timezone_set('america/lima');
setlocale(LC_TIME, 'spanish');
$d = date("Y-m-d");
$fecha = strftime("%A, %d de %B de %Y", strtotime($d));

$cod = $_SESSION["cod"];
$user = $_SESSION["usuario"];


$numeracion=1;

$fechamin2 = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
$fechamax2 = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

 $pdf = new Cezpdf('a4');
// $pdf ->ez
$pdf->ezText(utf8_decode("\n<u>www.PurOcio.com</u>\n"),20,array('justification'=>'center'));
$pdf->ezText("\n\n$fecha\n",12,array('justification'=>'justify'));
$pdf->ezText(utf8_decode("\n<u>Foros</u>\n"),20,array('justification'=>'center'));
$pdf->ezText(utf8_decode("\n\n$Glosa Foros segun fecha de creación  entre $fechamin2 y $fechamax2\n"),12,array('justification'=>'justify'));
$pdf->ezText("Administrador: $user\n",12);
$pdf->ezSetMargins(20, 50, 20, 20);


$foro = new Foro();
$r = $foro->listaforos();


$fechamin = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
$fechamax = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

if ($fechamin>$fechamax) {
	echo "<script>alert('LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA FINAL')
		document.location=('../vista/listaforos.php')</script>";
}


$TOP = $_POST["top"];
if ($TOP=="all") {
			$Limit="";
}elseif ($TOP=="1") {
			$Limit=" Limit 1";
}elseif ($TOP=="5") {
	$Limit=" Limit 5";
}elseif ($TOP=="10") {
	$Limit=" Limit 10";
}elseif ($TOP=="20") {
	$Limit=" Limit 20";
}

$SQL1="SELECT f.foro_id,f.title,f.fecha,u.firstname,u.lastname,u.photo,f.respuestas,f.user_id from foro f inner join users u on f.user_id=u.user_id where f.estado = 1  and f.fecha>='".$fechamin."' and f.fecha<='".$fechamax."' order by f.respuestas desc ".$Limit ;
$fila2 = ejecutar($SQL1);
$fila3 = ejecutar($SQL1);
$aux = mysqli_fetch_array($fila3);

while($row = mysqli_fetch_array($fila2)){

$data[] = array('Nro.'=>$numeracion, 'Titulo'=>utf8_decode($row[1]),'Fecha'=>$row[2], 'Usuario'=>utf8_decode($row[4].", ". $row[3]),  'Visitas'=>"".$row[6]." visitas");
    $numeracion++;
}
$titles = array('Nro.'=>'<b>Nro.</b>', 'Titulo'=>'<b>Titulo</b>','Fecha'=>'<b>Fecha</b>' ,'Usuario'=>'<b>Usuario</b>', 'Visitas'=>'<b>Visitas</b>');




$pdf->ezTable($data,$titles,'');
$pdf->ezStream();


?>
