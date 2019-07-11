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
$cat = $_POST["cat"];
$CRITERIO=$_POST["criterio"];
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

 $pdf = new Cezpdf('a4');
// $pdf ->ez
$pdf->ezText("\n\n$fecha\n",12,array('justification'=>'justify'));
$pdf->ezText(utf8_decode("\n<u>Peliculas</u>\n"),20,array('justification'=>'center'));
$pdf->ezText(utf8_decode("\n\n$Glosa Peliculas con más $CRITERIO\n"),12,array('justification'=>'justify'));
$pdf->ezText("Administrador: $user\n",12);
$pdf->ezSetMargins(20, 50, 20, 20);


$foro = new Pelicula();
$r = $foro->listapeliculas();



$CATE=$_POST["cat"];
if ($CATE=="all") {
			$FiltroCate="";
}else  {
			$FiltroCate=" AND ca.categoria_id=".$CATE;

}




if ($CRITERIO=="visitas") {
  $SQL1="SELECT m.movie_id,m.title,m.duration, m.director, m.puntuacion,m.description,m.image,m.trailer,ca.descripcion,ca.categoria_id, m.criticas from movies m inner join categorias ca on m.categoria_id=ca.categoria_id where m.estado = 1 ".$FiltroCate." order by m.criticas DESC".$Limit ;
}else {
	$SQL1="SELECT m.movie_id,m.title,m.duration, m.director, m.puntuacion,m.description,m.image,m.trailer,ca.descripcion, (SELECT COUNT(*) FROM like_unlike_movies lum WHERE lum.type = 1 and lum.movie_id=m.movie_id) as likes from movies m inner join categorias ca on m.categoria_id=ca.categoria_id where m.estado = 1 ".$FiltroCate." order by likes DESC".$Limit ;
  	// $SQL1="SELECT *  FROM MOVIES" ;
}
$fila2 = ejecutar($SQL1);
$fila3 = ejecutar($SQL1);
$aux = mysqli_fetch_array($fila3);

echo $SQL1;

if  ($CRITERIO=="visitas")  {
while($row = mysqli_fetch_array($fila2)){

$data[] = array('Nro.'=>$numeracion, 'Titulo'=>utf8_decode($row[1]),'Duracion'=>$row[2], 'Puntuacion'=>utf8_decode($row[4]),'Categoria'=>$row[8], 'Visitas'=>"".$row[10]." visitas");
    $numeracion++;
}
$titles = array('Nro.'=>'<b>Nro.</b>', 'Titulo'=>'<b>Titulo</b>','Duracion'=>'<b>Duracion</b>' ,'Puntuacion'=>'<b>Puntuacion</b>','Categoria'=>'<b>Categoria</b>','Visitas'=>'<b>Visitas</b>');
}else{
  while($row = mysqli_fetch_array($fila2)){

  $data[] = array('Nro.'=>$numeracion, 'Titulo'=>utf8_decode($row[1]),'Duracion'=>$row[2], 'Puntuacion'=>utf8_decode($row[4]),'Categoria'=>$row[8], 'Likes'=>$row[9]);
      $numeracion++;
}
$titles = array('Nro.'=>'<b>Nro.</b>', 'Titulo'=>'<b>Titulo</b>','Duracion'=>'<b>Duracion</b>' ,'Puntuacion'=>'<b>Puntuacion</b>','Categoria'=>'<b>Categoria</b>','Likes'=>'<b>Likes</b>');
}



$pdf->ezTable($data,$titles,'');
$pdf->ezStream();


?>
