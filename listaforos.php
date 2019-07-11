<?php
require_once ('../db/conexion.php');
require_once ('../modelo/foro.php');
conectar();
session_start();
include('templates/validar.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Las mejores noticias de cine y series|PurOcio.com</title>
<link href="css/jquery-ui.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/datatables.css" rel="stylesheet">
    <link href="css/remodal.css" rel="stylesheet">
    <link href="css/remodal-default-theme.css" rel="stylesheet" >




</head>

<body>


  <?php include("templates/menu-usuario.php"); ?>

<div id="wrapper">



<div id="page-content-wrapper">
    <div class="container-fluid">

<div class="panel panel-success col-md-4">
<div class="panel-heading " style="background-color: #646c7a; color: white;border-color: #DAA520;"><h1 style="text-align:center"><b>Foro</b></div>
</br>

  <form class="form-horizontal" action="../controlador/forocontrolador.php" method="post" data-toggle="validator" >




        <!-- Text input-->
        <div class="form-group" >
          <label class="col-md-4 control-label" for="title" >Titulo : </label>
          <div class="col-md-4" >
          <input id="title" name="txtitulo" type="text" placeholder="Titulo" class="form-control input-md" required>
          </div>
          <div class="help-block with-errors"></div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">

          <button class="btn btn-primary" block="true" type="submit" name="action" value="create"> Crear </button>
          </div>
        </div>

  </form>


  </div>








    <div class="table-responsive col-md-12">
    <table class="table table-hover" id="tabla" border="7">
    <thead>
    <tr BGCOLOR="#646c7a"><th colspan="7" style="color:white;"><center>Foros</center></th>
    <tr BGCOLOR="#76848e">
    <th style="text-align:right;"></th>
    <th style="text-align:center; color:white;">Usuario</th>
    <th style="text-align:center; color:white;">Tema</th>
    <th style="text-align:center; color:white;">Fecha</th>
    <th style="text-align:center; color:white;">Visitas</th>
    <th style="text-align:center; color:white;">Editar</th>
    <th style="text-align:center; color:white;">Eliminar</th>
    </tr>
    </thead>




<?php

    $cod = $_SESSION["cod"];

    $foro = new Foro();
    $r = $foro->listaforos();




                while ($row = mysqli_fetch_array($r)) {

                    echo "<tr BGCOLOR='white'>
                            <td align='center'><img src='img/".$row["5"]."' width='40px'></td>
                            <td align='center'>".$row["3"]." ".$row["4"]."</td>";


                    echo "<td align='center'><a href='participarforo.php?foroid=".$row["0"]."'> ".$row["1"]."</a></td>";


                    echo "<td align='center'>".$row["2"]."</td>
                          <td align='center'>".$row["6"]."</td>";

            if($row[7] == $cod){

                 echo "<td align='center'><a href='#modal".$row[0]."'><button class='btn btn-success'>Editar</button></a></td>";

            echo "<td align='center'><a class='btn btn-danger' onclick='return Confirmation()' href='../controlador/forocontrolador.php?idf=".$row[0]." &&action=eliminar'>Eliminar</a></td>";

                      include ('templates/modificar-foro.php');

            }else{
                echo "<td align='center'><i></i></td>
                     <td align='center'><i></i></td>";
            }

                echo "</tr>";

               }
  ?>

   </table>

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
<script src="js/remodal.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"></script>
<script src="js/datatables.js"></script>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
    $("#wrapper").toggleClass("toggled");
        });
</script>


<script>

  $(document).ready(function() {
    $('#tabla').DataTable( {


        lengthMenu: [[10,20,-1],[ "10","20","Todos"]],
        oPaginate: {

		sPrevious: Anterior
	},
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",

        }


      })
} );

</script>

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


</body>

</html>
