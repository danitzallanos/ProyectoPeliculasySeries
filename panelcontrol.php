<?php
require_once('../db/conexion.php');
require_once('../modelo/foro.php');
// require_once('../modelo/notificacion.php');
session_start();
include('templates/validar.php');
conectar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Las mejores noticias de cine y series|PurOcio.com</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/notificacion.css" rel="stylesheet">
</head>

<body>



    <div id="wrapper">

    <?php include("templates/menu-admin.php"); ?>
        <!-- Navigation -->

            <!-- /.navbar-top-links -->



        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- <div id="donut-example">aaaaaaaaaaa</div> -->
            <!-- /.row -->
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


                    <?php
                    $cod = $_SESSION["cod"];

                    $sql1 = "SELECT COUNT(foro_id) from foro  where estado = 1  ";
                    $resp1 = ejecutar($sql1);
                    $r1 = mysqli_fetch_array($resp1);

                    ?>
                                    <div class="huge"><?php echo $r1[0] ; ?></div>
                                    <div>Foros!</div>
                                </div>
                            </div>
                        </div>
                        <a href="listaforos2.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalle</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                    <?php

                    $sql2 = "SELECT COUNT(movie_id) from movies where estado=1";
                    $resp2 = ejecutar($sql2);
                    $r2 = mysqli_fetch_array($resp2);

                    ?>

                                    <div class="huge"><?php echo $r2[0] ; ?></div>
                                    <div>Películas!</div>
                                </div>
                            </div>
                        </div>
                        <a href="detallePelicula.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalle</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                    <?php

                    $sql3 = "SELECT COUNT(serie_id) from series where estado=1 ";
                    $resp3 = ejecutar($sql3);
                    $r3 = mysqli_fetch_array($resp3);

                    ?>
                                    <div class="huge"><?php echo $r3[0] ; ?></div>
                                    <div>Series!</div>
                                </div>
                            </div>
                        </div>
                        <a href="detalleserie.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalle</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <i class="fa fa-bar-chart-o fa-fw"></i> Datos totales de Peliculas y series
                      </div>
                      <div class="panel-body">
                          <div id="donut-example"></div>

                      </div>
                      <!-- /.panel-body -->
                  </div>
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <i class="fa fa-bar-chart-o fa-fw"></i> Usuarios vs Foros
                      </div>
                      <div class="panel-body">
                          <div id="donut-example-2"></div>

                      </div>
                      <!-- /.panel-body -->
                  </div>


                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Foros
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul style="list-style:none;">

                    <?php

                    $test = new Foro();
                    $r = $test->listaforos();

                    while ($row = mysqli_fetch_array($r)) {

echo "<li class='alert alert-success'>
    <div><center><img src='img/".$row[5]."' alt='User Avatar' class='img-circle' width='60px' height='55px'></center>
    </div>
    <div>
    <div>
    <center><h4 style='color:black'>".$row[4].", ".$row[3]."</h4></center>
    </div>
    <div >
    <p>“".$row[1]."”</p>
    </div>
    </div>
    </li>";

}
                    ?>

                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->


                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



<footer>
</footer>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael.min.js"></script>
<script>
    $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
</script>

<?php
// include('templates/notificacion.php');
include('templates/morris-data.php');

 ?>


</body>

</html>
