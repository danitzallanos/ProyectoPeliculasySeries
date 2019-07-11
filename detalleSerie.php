<?php
require_once ('../db/conexion.php');
require_once ('../modelo/serie.php');
require_once ('../modelo/categoria.php');
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
        <link href="css/notificacion.css"rel="stylesheet">
</head>

<body background="img/fondito1.jpg">

<?php include("templates/menu-admin.php"); ?>


<div id="page-content-wrapper">
                <div class="container-fluid">



     <div class="panel panel-primary">

  <div class="panel-heading" style="text-align:center;"><h2>Registros de Series</h2></div>
  </br>



  </br> </br>

  <div class="panel panel-success col-md-4">
  <div class="panel-heading " style="background-color: #646c7a; color: white;border-color: #DAA520;"><h1 style="text-align:center"><b>Reporte en base a visitas</b></div>
  </br>

    <form class="form-horizontal" action="ExportarSeries.php" method="post" data-toggle="validator" enctype="multipart/form-data">

      <div class="form-group">

        <label class="col-md-4 control-label" for="criterio" >Criterio : </label>
        <div class="col-md-4">
        <select class="col-md-2 form-control" name="criterio" id="criterio"  >

       <option value="visitas" >VISITAS</option>
       <option value="valoracion" >VALORACION</option>

        </select>

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

  <div class="form-group">
   <label class="col-md-4 control-label" for="cat" >Categoria : </label>
   <div class="col-md-4">
   <select class="form-control" name="cat" id="cat" >

  <option value="all" >-- TODAS --</option>

  <?php

   $codcat = $_POST["cat"];

   $cate = new Categoria();
   $rc = $cate->listarcategorias();

   while($row=mysqli_fetch_array($rc)){
   if($codcat == $row[0]){
   echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
   }else{
   echo "<option value='".$row[0]."' >".$row[1]."</option>";

   }
   }
   ?>

   </select>

   </div>

  </div>

          <!-- <div class="form-group">
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
      </div> -->
          <!-- Button -->
          <div class="form-group">
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <button class="btn btn-success"   type="submit" name="boton1" value="create"> Exportar Excel </button>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4"></div>
            <div class="col-md-4">

            <button class="btn btn-danger"   type="submit" name="boton2" value="create"> Exportar PDF </button>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4"></div>
            <div class="col-md-4">

                <a class='btn btn-info  '  href='graficoSeries.php'>Generar gráfico</a>
            </div>
          </div>


          <!-- <center><a href="ficheroexcelforos.php" class="btn btn-success">Exportar Excel</a></center> <br> -->

    </form>


    </div>


    <div class="panel panel-success col-md-6">
    <div class="panel-heading " style="background-color: #646c7a; color: white;border-color: #DAA520;"><h1 style="text-align:center"><b>Reporte en base a fecha de registro</b></div>
    </br>

      <form class="form-horizontal" action="ExportarSeries2.php" method="post" data-toggle="validator" enctype="multipart/form-data">


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
            <!-- Button -->
            <div class="form-group">
              <div class="col-md-4"></div>
              <div class="col-md-4">

              <button class="btn btn-success"   type="submit" name="boton1" value="create"> Exportar Excel </button>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4"></div>
              <div class="col-md-4">

              <button class="btn btn-danger"   type="submit" name="boton2" value="create"> Exportar PDF </button>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4"></div>
              <div class="col-md-4">

                  <a class='btn btn-info  '  href='graficoSeries2.php'>Generar gráfico</a>
              </div>
            </div>

            <!-- <center><a href="ficheroexcelforos.php" class="btn btn-success">Exportar Excel</a></center> <br> -->

      </form>


      </div>



  <div class="table-responsive col-md-12" >
                  <table class="table table-hover" id="tablita" border="0" >
                    <thead>
                  <tr bgcolor="#ABBCB7  ">
                  <th style="text-align:center;">N°</th>
                  <th style="text-align:center;">Titulo</th>
                  <th style="text-align:center;">Descripcion</th>
                  <th style="text-align:center;">Director</th>
                  <th style="text-align:center;">Episodios</th>
                  <th style="text-align:center;">Temporadas</th>
                  <th style="text-align:center;">Imagen</th>
                  <th style="text-align:center;">Trailer</th>
                  <th style="text-align:center;">Categoria</th>
                  <th style="text-align:center;">Editar</th>
                  <th style="text-align:center;">Eliminar</th>
                  </tr>
                </thead>


<?php

          $cod = $_SESSION["cod"];

          $serie = new Serie();

          $r = $serie->listaseries();

          $numeracion=1;




while ($row = mysqli_fetch_array($r)) {

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
$des = substr($row["5"],0,50);
echo "<td align='center' style= 'font-size:12px;'>".$des."</td>";


//Imagen
echo "<td align='center'><img src='img/".$row["6"]."' width='75px'  ></td>";


//Trailer
echo "<td align='center'>".$row["7"]."</td>";

//Categoria
echo "<td align='center'>".$row["8"]."</td>";

//Modificar
echo "<td align='center'><a class='btn btn-success' href='modificar-serie.php?idserie=".$row["0"]."'>Modificar</a></td>";

//Eliminar
echo "<td align='center'>
       <a class='btn btn-danger' onclick='return Confirmation()' href='../controlador/seriecontrolador.php?action=eliminar&&idserie=".$row["0"]."'>Eliminar</a></td</tr>";

$numeracion++;

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
    $('#tablita').DataTable( {


        lengthMenu: [[5,10,20,-1],["5","10","20","Todos"]],
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



<?php
include('templates/notificacion.php');
 ?>

</body>

</html>
