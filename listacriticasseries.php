<?php
require_once ('../db/conexion.php');
require_once ('../modelo/serie.php');
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

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/datatables.css" rel="stylesheet">
    <link href="css/remodal.css" rel="stylesheet">
    <link href="css/remodal-default-theme.css" rel="stylesheet" >




</head>

<body background="img/peliseries.jpg">

  <?php
    $tipo =@$_SESSION['tipo'];

    if( $tipo == "1"){
    include("templates/menu-admin.php");
    }else{
    include("templates/menu-usuario.php");
    }
  ?>

<div id="wrapper">



<div id="page-content-wrapper">
    <div class="container-fluid">


    <div class="table-responsive col-md-12">
    <table class="table table-hover" id="tabla" border="7">
    <thead>
    <tr BGCOLOR="#646c7a"><th colspan="7" style="color:white;"><center>CRITICAS</center></th>
    <tr BGCOLOR="#76848e">
    <th style="text-align:center; color:white;">Poster</th>

    <th style="text-align:center; color:white;">Serie</th>

    <th style="text-align:center; color:white;">Criticas</th>


    </tr>
    </thead>




<?php

    $cod = $_SESSION["cod"];

    $foro = new Serie();
    $r = $foro->Series();




                while ($row = mysqli_fetch_array($r)) {

                    echo "<tr BGCOLOR='white'>
                            <td align='center'><img src='img/".$row["7"]."' width='40px'></td>";


                    echo "<td align='center'><a href='participarcriticaserie.php?peliid=".$row["0"]."'> ".$row["1"]."</a></td>";


                    echo "
                          <td align='center'>".$row["9"]."</td>";



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


        lengthMenu: [[5,10,20,-1],["5","10","20","Todos"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",

        }


      })
} );

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




</body>

</html>
