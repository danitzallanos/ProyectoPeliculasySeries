<?php
require_once ('../db/conexion.php');
require_once ('../modelo/pelicula.php');
require_once ('../libs/reportepdf/class.ezpdf.php');
conectar();
session_start();

date_default_timezone_set('america/lima');
setlocale(LC_TIME, 'spanish');
$d = date("Y-m-d");
$fecha = strftime("%A, %d de %B de %Y", strtotime($d));

$cod = $_SESSION["cod"];
$user = $_SESSION["usuario"];

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
$numeracion=1;

$fechamin = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
$fechamax = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

$fechamin2 = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
$fechamax2 = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));


 $pdf = new Cezpdf('a4');
// $pdf ->ez
$pdf->ezText(utf8_decode("\n<u>www.PurOcio.com</u>\n"),20,array('justification'=>'center'));
$pdf->ezText("\n\n$fecha\n",12,array('justification'=>'justify'));
$pdf->ezText(utf8_decode("\n<u>Peliculas</u>\n"),20,array('justification'=>'center'));
$pdf->ezText(utf8_decode("\n\n$Glosa Peliculas segun fecha de registro  entre $fechamin2 y $fechamax2\n"),12,array('justification'=>'justify'));
$pdf->ezText("Administrador: $user\n",12);
$pdf->ezSetMargins(20, 50, 20, 20);


$foro = new Pelicula();
$r = $foro->listapeliculas();


if ($fechamin>$fechamax) {
	echo "<script>alert('LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA FINAL')
		document.location=('../vista/listaforos.php')</script>";
}






  $SQL1="SELECT m.movie_id,m.title,m.duration, m.director, m.puntuacion,m.description,m.image,m.trailer,ca.descripcion,ca.categoria_id, m.criticas, m.Registered from movies m inner join categorias ca on m.categoria_id=ca.categoria_id where m.estado = 1 and m.Registered >= '".$fechamin."' and m.Registered <= '".$fechamax."'  order by m.Registered DESC".$Limit ;

$fila2 = ejecutar($SQL1);
$fila3 = ejecutar($SQL1);
$aux = mysqli_fetch_array($fila3);

echo $SQL1;


while($row = mysqli_fetch_array($fila2)){

$data[] = array('Nro.'=>$numeracion, 'Titulo'=>utf8_decode($row[1]),'Duracion'=>$row[2], 'Puntuacion'=>utf8_decode($row[4]),'Categoria'=>$row[8], 'Creado'=>date('d/m/Y', strtotime(str_replace('/', '-',$row[11]))));
    $numeracion++;
}
$titles = array('Nro.'=>'<b>Nro.</b>', 'Titulo'=>'<b>Titulo</b>','Duracion'=>'<b>Duracion</b>' ,'Puntuacion'=>'<b>Puntuacion</b>','Categoria'=>'<b>Categoria</b>','Creado'=>'<b>Creado</b>');




$pdf->ezTable($data,$titles,'');
$pdf->ezStream();


?>
