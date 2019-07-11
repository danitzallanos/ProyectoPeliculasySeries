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

 $pdf = new Cezpdf('a4');
// $pdf ->ez
$pdf->ezText("\n\n$fecha\n",12,array('justification'=>'justify'));
// $pdf->ezImage("https://www.casanovafoto.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/d/w/dwfml.jpg");
// // echo "<img src='img/claqueta.png' alt='logo' height='42' width='42'>";
// $img = ImageCreatefromjpeg('img\persona9.jpg');
// $pdf->ezImage("img/claqueta.png", 0, 420, 'none', 'left');
// $pdf->addImage($img, 50, 697, 47, 50);
$fechamin = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
$fechamax = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

$fechamin2 = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
$fechamax2 = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

$pdf->ezText(utf8_decode("\n<u>www.PurOcio.com</u>\n"),20,array('justification'=>'center'));
$pdf->ezText(utf8_decode("\n<u>Series</u>\n"),20,array('justification'=>'center'));
$pdf->ezText(utf8_decode("\n\n$Glosa Series segun fecha de registro entre $fechamin2 y $fechamax2\n"),12,array('justification'=>'justify'));
$pdf->ezText("Administrador: $user\n",12);
$pdf->ezSetMargins(20, 50, 20, 20);


$foro = new Foro();
$r = $foro->listaforos();


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

$SQL1="SELECT s.serie_id,s.title,s.description, s.director, s.episodes,s.seasons,s.image,s.trailer,ca.descripcion,ca.categoria_id,s.criticas,s.Registered from series s inner join categorias ca on s.categoria_id=ca.categoria_id where s.estado = 1 and s.Registered >= '".$fechamin."' and s.Registered <= '".$fechamax."'  order by s.Registered DESC ".$Limit ;
// $pdf->ezText("Administrador: $SQL1\n",12);

// $SQL1="SELECT s.serie_id,s.title,s.description, s.director, s.episodes,s.seasons,s.image,s.trailer,ca.descripcion,ca.categoria_id,s.criticas,s.Registered from series s inner join categorias ca on s.categoria_id=ca.categoria_id where s.estado = 1 and s.Registered >= '".$fechamin."' and s.Registered<='".$fechamax."'   order by s.Registered DESC ".$Limit ;
$fila2 = ejecutar($SQL1);
$fila3 = ejecutar($SQL1);
$aux = mysqli_fetch_array($fila3);

while($row = mysqli_fetch_array($fila2)){

  $data[] = array('Nro.'=>$numeracion, 'Titulo'=>utf8_decode($row[1]),'Temporadas'=>$row[5], 'Episodios'=>utf8_decode($row[4]),'Categoria'=>$row[8], 'Creado'=>date('d/m/Y', strtotime(str_replace('/', '-', $row[11]))));
      $numeracion++;
  }
  $titles = array('Nro.'=>'<b>Nro.</b>', 'Titulo'=>'<b>Titulo</b>','Temporadas'=>'<b>Temporadas</b>' ,'Episodios'=>'<b>Episodios</b>','Categoria'=>'<b>Categoria</b>','Creado'=>'<b>Creado</b>');




$pdf->ezTable($data,$titles,'');
$pdf->ezStream();


?>
