<?php
require_once('../db/conexion.php');
session_start();
include('templates/validar.php');
require_once ('../modelo/categoria.php');

conectar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Las mejores noticias de cine y series|PurOcio.com</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/notificacion.css" rel="stylesheet">
     <link href="css/jquery-ui.css" rel="stylesheet">

</head>

<body background="img/fondito.jpg">



<div id="wrapper">

<?php include("templates/menu-admin.php"); ?>


<div id="page-content-wrapper">
<div class="container-fluid">

<div class="panel panel-primary">
<div class="panel-heading" style="text-align:center;"><h2>Grafico de Peliculas</h2></div>


<form class="form-horizontal" id="form1" name="form1" method="post" action="" data-toggle="validator">
<br>
<div class="form-group">

  <label class="col-md-4 control-label" for="top" >TOP : </label>
  <div class="col-md-4">
  <select class="col-md-2 form-control" name="top" id="top"  >

 <option value="all" >TODOS</option>
 <option value="1" >TOP 1</option>
 <option value="5" >TOP 5</option>
 <option value="10" >TOP 10</option>
 <option value="20" >TOP 20</option>
  </select>

  </div>
</div>
<br>
  <div class="form-group">
   <label class="col-md-4 control-label" for="cat" >Categoria : </label>
   <div class="col-md-4">
   <select class="form-control" name="cat" id="cat" >

  <option value="all" >-- TODAS --</option>

  <?php



   $cate = new Categoria();
   $rc = $cate->listarcategorias();

   while($row=mysqli_fetch_array($rc)){

   echo "<option value='".$row[0]."' >".$row[1]."</option>";

   }
   ?>

 </select>

 </div>

 </div>


<div class="form-group">
    <div class="col-md-5"></div>
    <div class="col-md-6">
    <button class="btn btn-info" block="true" type="submit" name="action" value="create"> Generar Reporte </button>

        <a class='btn btn-danger  '  href='detallePelicula.php'>Volver</a>
    </div>
</div>



</form>
</br>

<?php

echo "<div id='container1' style='min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto'></div>";


if(isset($_POST["cat"])){
$CATE=$_POST["cat"];
if ($CATE=="all") {
			$FiltroCate="";
}else  {
			$FiltroCate=" AND ca.categoria_id=".$CATE;

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

$SQL1="SELECT m.title, m.criticas,ca.descripcion from movies m inner join categorias ca on m.categoria_id=ca.categoria_id where m.estado = 1 ".$FiltroCate." order by m.criticas DESC".$Limit ;
$resultados1 = ejecutar($SQL1);

$aux = ejecutar($SQL1);
$rowaux = mysqli_fetch_array($aux);

// //Filtro 2
// $sql2 = "SELECT u.firstname,u.lastname,COUNT(*) as cantidad from details_campaigns d inner JOIN users u on d.user_id=u.user_id INNER JOIN campaigns c on c.campaign_id=d.campaign_id where d.estado = 1 and c.start_date>'$fecha1' and c.start_date<'$fecha2' GROUP BY d.user_id";
//
// $resultados2 = ejecutar($sql2);
}
?>

</div>

</div>
</div>

</div>

<footer>
</footer>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>








<?php
echo $FiltroCate. " /// ".$Limit ."///". $SQL1 ;

include('templates/notificacion.php');
 ?>

<script>
Highcharts.chart('container1', {
    chart: { type: 'column'},
    title: { text: '<?php if($TOP!="all"){echo "TOP ".$TOP;} ?> Cantidad de Visitas por Película <?php if($FiltroCate!=""){echo "en categoría: ". $rowaux[2];} ?>' },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: { text: '# Visitas' }
    },
    legend: { enabled: false },

    series: [{

      color: {
              linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
              stops: [
                        [0, '#003399'],
                        [1, '#FF0000']
                      ]
            },

        name: 'Visitas',

        data: [

        <?php
             while($row = mysqli_fetch_array($resultados1)){?>
            ['<?php echo $row[0]; ?>', <?php echo $row[1]; ?>],

        <?php  } ?>,

        ],
        dataLabels: {
            enabled: true,
            //rotation: -90,
            color: '#000000',

            align: 'center',
            //format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '18px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script>


</body>

</html>
