<?php
require_once ('../db/conexion.php');
require_once ('../modelo/serie.php');
require_once ('../libs/reportepdf/class.ezpdf.php');
conectar();
session_start();

date_default_timezone_set('america/lima');
setlocale(LC_TIME, 'spanish');
$d = date("Y-m-d");
$fecha = strftime("%A, %d de %B de %Y", strtotime($d));

$cod = $_SESSION["cod"];
$user = $_SESSION["usuario"];
$cat = $_POST["cat"];
$CRITERIO=$_POST["criterio"];
$TOP = $_POST["top"];
if ($TOP=="all") {
			$Limit="";
      $Glosa="";
}elseif ($TOP=="1") {
			$Limit=" Limit 1";
      $Glosa="TOP 1";
}elseif ($TOP=="5") {
	$Limit=" Limit 5";
  $Glosa="TOP 5";
}elseif ($TOP=="10") {
	$Limit=" Limit 10";
  $Glosa="TOP 10";
}elseif ($TOP=="20") {
	$Limit=" Limit 20";
  $Glosa="TOP 20";
}
$numeracion=1;

 $pdf = new Cezpdf('a4');
// $pdf ->ez
$pdf->ezText(utf8_decode("\n<u>www.PurOcio.com</u>\n"),20,array('justification'=>'center'));
$pdf->ezText("\n\n$fecha\n",12,array('justification'=>'justify'));
$pdf->ezText(utf8_decode("\n<u>Series</u>\n"),20,array('justification'=>'center'));
$pdf->ezText(utf8_decode("\n\n$Glosa Series con más $CRITERIO\n"),12,array('justification'=>'justify'));
$pdf->ezText("Administrador: $user\n",12);
$pdf->ezSetMargins(20, 50, 20, 20);


$foro = new Serie();
$r = $foro->listaseries();



$CATE=$_POST["cat"];
if ($CATE=="all") {
			$FiltroCate="";
}else  {
			$FiltroCate=" AND ca.categoria_id=".$CATE;

}




if ($CRITERIO=="visitas") {
$SQL1="SELECT s.serie_id,s.title,s.description, s.director, s.episodes,s.seasons,s.image,s.trailer,ca.descripcion,ca.categoria_id,s.criticas from series s inner join categorias ca on s.categoria_id=ca.categoria_id where s.estado = 1 ".$FiltroCate." order by s.criticas DESC".$Limit ;
}else{
$SQL1="SELECT s.serie_id,s.title,s.description, s.director, s.episodes,s.seasons,s.image,s.trailer, s.criticas, (SELECT COUNT(*) FROM like_unlike_series lus WHERE lus.type = 1 and lus.serie_id=s.serie_id) as likes from series s  where s.estado = 1 ".$FiltroCate." order by likes DESC".$Limit ;
}


$fila2 = ejecutar($SQL1);
$fila3 = ejecutar($SQL1);
$aux = mysqli_fetch_array($fila3);

if  ($CRITERIO=="visitas")  {
  while($row = mysqli_fetch_array($fila2)){
  $data[] = array('Nro.'=>$numeracion, 'Titulo'=>utf8_decode($row[1]),'Temporadas'=>$row[5], 'Episodios'=>utf8_decode($row[4]),'Categoria'=>$row[8], 'Visitas'=>"".$row[10]." visitas");
      $numeracion++;
  }
  $titles = array('Nro.'=>'<b>Nro.</b>', 'Titulo'=>'<b>Titulo</b>','Temporadas'=>'<b>Temporadas</b>' ,'Episodios'=>'<b>Episodios</b>','Categoria'=>'<b>Categoria</b>','Visitas'=>'<b>Visitas</b>');

}else{
  while($row = mysqli_fetch_array($fila2)){
  $data[] = array('Nro.'=>$numeracion, 'Titulo'=>utf8_decode($row[1]),'Temporadas'=>$row[5], 'Episodios'=>utf8_decode($row[4]),'Categoria'=>$row[8], 'Likes'=>"".$row[9]." likes");
      $numeracion++;
  }
  $titles = array('Nro.'=>'<b>Nro.</b>', 'Titulo'=>'<b>Titulo</b>','Temporadas'=>'<b>Temporadas</b>' ,'Episodios'=>'<b>Episodios</b>','Categoria'=>'<b>Categoria</b>','Likes'=>'<b>Likes</b>');

}




$pdf->ezTable($data,$titles,'');
$pdf->ezStream();


?>
