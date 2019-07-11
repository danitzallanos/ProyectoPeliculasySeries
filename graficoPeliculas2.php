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
    <title>Foros</title>

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
<label class="col-md-4 control-label" for="fecha1" >DESDE : </label>
<div class="col-md-4">


<input id="fecha1" onchange="ValidarFechaInicial();" name="txtfecha1" type="text" placeholder="Fecha de inicio" class="form-control input-md" >
</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="fecha2" >HASTA : </label>
<div class="col-md-4">
<input id="fecha2" onchange="ValidarFechaFinal();" name="txtfecha2" type="text" placeholder="Fecha final" class="form-control input-md"  >
</div>
</div>

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
    <div class="col-md-5"></div>
    <div class="col-md-6">
    <button class="btn btn-info" block="true" type="submit" name="action" value="create"> Generar Reporte </button>

        <a class='btn btn-danger  '  href='detallePelicula.php'>Volver</a>
    </div>
</div>



</form>
</br>

<?php

echo "<div id='container1' style='min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto'>  </div>";


if(isset($_POST["top"])){

  $fechamin = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
  $fechamax = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

  if ($fechamin>$fechamax) {
  	echo "<script>alert('LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA FINAL')
  		document.location=('../vista/graficoForos.php')</script>";
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


  if ($fechamin<="1980/01/01") {
  	$fechamin="1999/01/01";
  }
  if ($fechamax<="1980/01/01") {
  	$fechamax="2090/01/01";
  }
  //$SQL1 ="SELECT f.foro_id,f.title,f.fecha,u.firstname,u.lastname,u.photo,f.respuestas,f.user_id from foro f inner join users u on f.user_id=u.user_id where f.estado = 1 and f.fecha>'".$fechamin."' and f.fecha<'".$fechamax."' order by f.fecha  desc " ;
  // $SQL1="SELECT m.title,m.Registered, from movies m where m.estado = 1  and m.Registered>='".$fechamin."' and m.Registered<='".$fechamax."' order by m.Registered asc ".$Limit ;
    $SQL1="SELECT registered, COUNT(Registered) from movies where Registered>='".$fechamin."' and Registered<='".$fechamax."' group by Registered asc".$Limit ;
  $resultados1 = ejecutar($SQL1);
  // echo $SQL1;

  $SQL3="SELECT registered, COUNT(Registered) from movies group by Registered asc".$Limit ;
  $resultados3 = ejecutar($SQL3);

$aux = ejecutar($SQL1);
$rowaux = mysqli_fetch_array($aux);

// //Filtro 2
// $sql2 = "SELECT u.firstname,u.lastname,COUNT(*) as cantidad from details_campaigns d inner JOIN users u on d.user_id=u.user_id INNER JOIN campaigns c on c.campaign_id=d.campaign_id where d.estado = 1 and c.start_date>'$fecha1' and c.start_date<'$fecha2' GROUP BY d.user_id";
//
// $resultados2 = ejecutar($sql2);
$fechaminString = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
$fechamaxString = date('d/m/Y', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));
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
<div id="container" style="height: 400px"></div>
<img class='hidden' src='claqueta.png' >







<?php
echo "min: ".$fechamin. " /// limit: ".$Limit ."/// sql: ". $SQL1 ;

include('templates/notificacion.php');
 ?>

 <script>

  var dateToday = new Date();


 $("#fecha1").datepicker({
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     dateFormat: 'dd/mm/yy',


 });

  var fechamin = document.getElementById("fecha1").innerHTML;

 $("#fecha2").datepicker({
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     dateFormat: 'dd/mm/yy',
     mindate: fechamin,

 });

   </script>
 <script type="text/javascript">
 function Confirmation() {

   if (confirm('Esta seguro de eliminar el registro?')==true) {

       return true;
   }else{
       //alert('Cancelo la eliminacion');
       return false;
   }
 }
 </script>

 <script>
 function ValidarFechaInicial()
 {

 var f1 = document.getElementById("fecha1").value;
 var f2 = document.getElementById("fecha2").value;

 if (($.datepicker.parseDate('dd/mm/yy', f1) > $.datepicker.parseDate('dd/mm/yy', f2)) && f2 != ""){
      alert("La Fecha Inicial no puede ser mayor que la Fecha Final");
      document.getElementById("fecha1").value = "";
      return
 }else{
 }
 }

 </script>

 <script>
 function ValidarFechaFinal()
 {

 var f1 = document.getElementById("fecha1").value;
 var f2 = document.getElementById("fecha2").value;

 if ($.datepicker.parseDate('dd/mm/yy', f2) < $.datepicker.parseDate('dd/mm/yy', f1)){
      alert("La Fecha Final no puede ser menor que la Fecha Inicial");
      document.getElementById("fecha2").value = "";
      return
 }else{
 }
 }

 </script>

<script>
Highcharts.chart('container1', {
    chart: {
      type: 'column',
    events: {
               load: function(event) {this.renderer.image('https://images.vexels.com/media/users/3/153066/isolated/preview/bd68ff1f02d1ea6c96a0a8df91057465-icono-de-trazo-de-claqueta-by-vexels.png',40,280,50,72).add();

               }
           }
//     events: {
//                load: function () {
//
// this.renderer.image('claqueta.png', 700,0,50,72)
//                    .add();
//
//
//
//                },
//                beforePrint: function(){
//                    x=this.renderer.image('claqueta.png', 700,0,50,72).add();
//                    this.print();
//                },
//                                afterPrint: function(){
//                                    x.element.remove();
//                }
//            }
     },
    title: {
              text: 'REPORTE GENERADO EL <?php date_default_timezone_set('america/lima'); $fecha_actual = date("d-m-Y"); echo $fecha_actual." a las ".date("H:i:s")."<br>" ; ?> <?php if($TOP!="all"){echo "TOP ".$TOP;} ?> Peliculas registradas <?php if($fechamin!="1999/01/01" || $fechamax!="2090/01/01" ){echo "desde ".$fechaminString." hasta ".$fechamaxString; } ?>'
            },
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
        title: { text: '# Registros' }
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

        name: 'Registros',

        data: [

        <?php
              // $row3 = mysqli_fetch_array($resultados3);
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
