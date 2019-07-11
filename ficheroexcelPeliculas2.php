<?php
require_once ('../db/conexion.php');
require_once ('../modelo/foro.php');
conectar();
session_start();

header('Content-Encoding: UTF-8');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=peliculas.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

 <div class="table-responsive">
                  <table class="table table-hover" id="tablita" border="2" >
                  	<center><h1>www.PurOcio.com</h1></center>
                  	<h3>Adminsitrador: <?php echo $_SESSION["usuario"] ?></h3>
                  	<h3>Fecha: <?php
										date_default_timezone_set('America/Lima');
										echo date("d/m/Y") ?></h3>

                  	<h3>Hora: <?php

                  		date_default_timezone_set("America/Lima");
                  	echo date("H:i:s"); ?></h3>
                    <thead>
                  <tr bgcolor="#ABBCB7  ">
										<th style="text-align:right;">N°</th>
	                  <th style="text-align:center;">Titulo</th>
	                  <th style="text-align:center;">Duracion</th>
	                  <th style="text-align:center;">Director</th>
	                  <th style="text-align:center;">Puntuacion</th>
	                  <th style="text-align:center;">Descripcion</th>
										 <th style='text-align:center;'>Fecha de registro</th>
										 <th style="text-align:center;">Trailer</th>
										 <th style="text-align:center;">Categoria</th>


                  </tr>
                </thead>


<?php
$cod = $_SESSION["cod"];

$foro = new Foro();
$r = $foro->listaforos();

//$id = $row[0];

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


if ($fechamin<="1980/12/31") {
	$fechamin="1999/01/01";
}
if ($fechamax<="1980/12/31") {
	$fechamax="2090/01/01";
}
//$SQL1 ="SELECT f.foro_id,f.title,f.fecha,u.firstname,u.lastname,u.photo,f.respuestas,f.user_id from foro f inner join users u on f.user_id=u.user_id where f.estado = 1 and f.fecha>'".$fechamin."' and f.fecha<'".$fechamax."' order by f.fecha  desc " ;
		$SQL1="SELECT m.movie_id,m.title,m.duration, m.director, m.puntuacion,m.description,m.image,m.trailer,ca.descripcion, m.criticas, m.Registered from movies m inner join categorias ca on m.categoria_id=ca.categoria_id where m.estado = 1 and m.Registered >= '".$fechamin."' and m.Registered<='".$fechamax."' order by m.Registered DESC".$Limit ;
$fila1 = ejecutar($SQL1);
//$filita1 = mysqli_fetch_array($fila1);

	          // $cod = $_SESSION["cod"];
						//
	          // $campania = new Campania();
	          // $campania->setUserid($cod);
	          // $r = $campania->campaniaporusuario();

          $numeracion=1;

 // echo $SQL1 ." -- ".  $TOP;

// echo $fechamin;


while ($row = mysqli_fetch_array($fila1)) {

 echo "<tr BGCOLOR='white'><td align='center'>".$numeracion."</td>";

	//Titulo
	echo "<td align='center'>".$row["1"]."</td>";

	//Director
	echo "<td align='center'>".$row["2"]."</td>";

	//Episodios
	echo "<td align='center'>".$row["3"]."</td>";

	//Temporadas
	echo "<td align='center'>".$row["4"]."</td>";


	//Descripcion
	// $des = substr($row["5"],0,50);
	echo "<td align='center' style= 'font-size:12px;'>".$row["5"]."</td>";


	//Visitas
	// if ($CRITERIO=="visitas") {
			echo "<td align='center'>".$row["10"]." </td>";
	// }else{
		// $SQLconteo="SELECT COUNT(*) FROM `like_unlike_series` WHERE serie_id=".$row["0"] ;
		// $filaconteo = ejecutar($SQLconteo);
		// $rowconteo = mysqli_fetch_array($filaconteo);
		// echo "<td align='center'>".$row["10"]." </td>";




	//Trailer
	echo "<td align='center'>".$row["7"]."</td>";

	//Categoria
	echo "<td align='center'>".$row["8"]."</td>";


$numeracion++;

}



?>

                </table>



</body>
</html>
