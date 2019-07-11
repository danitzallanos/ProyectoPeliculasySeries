<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );
header( 'Set-Cookie: name=value; httpOnly' );
?>

<!doctype html>
<?php require_once ('db/conexion.php');
conectar();
session_start();
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Las mejores noticias de cine y series|PurOcio.com</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="vista/css/all.min.css">
  <link rel="stylesheet" href="vista/css/normalize.css">
  <link rel="stylesheet" href="vista/css/main.css">
  <link rel="stylesheet" href="vista/css/bootstrap.min.css">
  <link rel="stylesheet" href="vista/css/colorbox.css">
  <link rel="stylesheet" href="vista/css/jPagesindex.css">
  <link rel="stylesheet" href="vista/css/animate.css">
  <link rel="stylesheet" href="vista/css/estilos.css">
  <link rel="stylesheet" href="vista/css/fonts.css">


</head>

<body>

  <?php include_once ('vista/templates/header.php'); ?>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="index.php"style="color:#DAA520;
font-size: 40px;
font-family: Garamond">www.PurOcio.com</a></a>
</div>
<ul class="nav navbar-nav navbar-right">
<li class="active"><a href="#">Inicio</a></li>
<li><a href="vista/listapeliculas.php">Peliculas</a>
  <li><a href="vista/listaseries.php">Series</a></li>
  <li><a href="vista/listanew.php">Noticias</a></li>
 <li><a href="vista/login.php">Ingresar</a></li>
 <li><a href="vista/registrousuario.php">Registrar</a></li>
</ul>

  </nav>
  <section class="seccion contenedor">
    <h2>VER TRAILER DE LOS PROXIMOS EXTRENOS</h2>
  </section>
  <div class="main">
        <div class="slides">
          <a href="https://www.youtube.com/watch?v=CTuGTLx2iEI" target="_blank"><img src="vista/img/dumbo.jpg" alt=""></a>
          <a href="https://www.youtube.com/watch?v=Z1BCujX3pw8&t=26s" target="_blank"><img src="vista/img/capitana.jpg" alt=""></a>
          <a href="https://www.youtube.com/watch?v=VhCUoIuC5zs" target="_blank"><img src="vista/img/endgame.jpg" alt=""></a>

        </div>
      </div>


      <?php


          $fecha_actual = date("Y")."-". date("m") . "-" . date("d");

          /*$query="SELECT IF('".$fecha_actual."'>=fecha_inicio AND '".$fecha_actual."'<=fecha_fin, tematica, '0' ) FROM tematicas  order by tematica asc limit 1";*/
          $query="SELECT Tematica FROM TEMATICAS WHERE '".$fecha_actual."'>=fecha_inicio AND '".$fecha_actual."'<=fecha_fin and ESTADO = 1  LIMIT 1 ";
          $fila1 = ejecutar($query);
          $filita1 = mysqli_fetch_array($fila1);

          /*EXISTE FESTIVIDAD?*/
          $queryaux="SELECT COUNT(*) FROM TEMATICAS WHERE '".$fecha_actual."'>=fecha_inicio AND '".$fecha_actual."'<=fecha_fin and ESTADO = 1";
          $fila_aux = ejecutar($queryaux);
          $filita_aux = mysqli_fetch_array($fila_aux);

          /*EXISTEN REGISTROS CON ESA FESTIVIDAD?*/
          $queryaux2="SELECT COUNT(*) FROM movies m left join tematicas t on m.id_tematica1 = t.id where m.estado = 1 AND t.tematica = '".$filita1[0]."'";
          $fila_aux2 = ejecutar($queryaux2);
          $filita_aux2 = mysqli_fetch_array($fila_aux2);



          if ($filita_aux[0]!="0" && $filita_aux2[0]!="0") {
            $query2="SELECT *,t.id,t.tematica FROM movies m left join tematicas t on m.id_tematica1 = t.id where m.estado = 1 AND t.tematica = '".$filita1[0]."'";
          } else {

            $query2="SELECT * FROM movies where estado = 1 ORDER BY RAND() LIMIT 2;";
          }


          /*  echo $queryaux." ______________".$filita1[0]; */
            $fila2 = ejecutar($query2);



      ?>


      <section class="seccion contenedor">

            <?php if ($filita_aux[0]!='0' AND $filita_aux2[0]!="0") {

              echo "<h2>PELICULAS RECOMENDADAS  por ".$filita1[0]."</h2>";
            } else {
              echo " <h2>Nuestras PELICULAS RECOMENDADAS   </h2>";
            }
              ?>


      </section>

      <section id="campanas" class="campanas contenedor seccion">

       <ul class="lista-campanas clearfix" id="itemContainer">
         <?php
         while ($row = mysqli_fetch_array($fila2)) {
           echo "
               <li>
               <br>
                 <div class='campana'>
                   <a class='campana-info' href='#campana".$row["0"]."'>
                   <img src='vista/img/".$row["6"]."' width='400px' height='200px'>
                   <p>".$row["1"]." </p>
                   </a>
                 </div>
                 <br>
               <center> <a href='vista/participarcriticapeli.php?peliid=".$row["0"]."' ><button class='btn btn-success'  href='participarcriticapeli.php?peliid=".$row["0"]."'   name='submit' value='Buscar' > Ver Criticas</button></a> </center>

               </li>
              ";
         }
         ?>
       </ul>
     </section>


           <?php


               $fecha_actual = date("Y")."-". date("m") . "-" . date("d");

               /*$query="SELECT IF('".$fecha_actual."'>=fecha_inicio AND '".$fecha_actual."'<=fecha_fin, tematica, '0' ) FROM tematicas  order by tematica asc limit 1";*/
               $query_series="SELECT Tematica FROM TEMATICAS WHERE '".$fecha_actual."'>=fecha_inicio AND '".$fecha_actual."'<=fecha_fin and ESTADO = 1  LIMIT 1 ";
               $fila1_series = ejecutar($query_series);
               $filita1_series = mysqli_fetch_array($fila1_series);

               /*EXISTE FESTIVIDAD?*/
               $queryaux_series="SELECT COUNT(*) FROM TEMATICAS WHERE '".$fecha_actual."'>=fecha_inicio AND '".$fecha_actual."'<=fecha_fin and ESTADO = 1";
               $fila_aux_series= ejecutar($queryaux_series);
               $filita_aux_series = mysqli_fetch_array($fila_aux_series);

               /*EXISTEN REGISTROS CON ESA FESTIVIDAD?*/
               $queryaux2_series="SELECT COUNT(*) FROM series m left join tematicas t on m.id_tematica1 = t.id where m.estado = 1 AND t.tematica = '".$filita1_series[0]."'";
               $fila_aux2_series = ejecutar($queryaux2_series);
               $filita_aux2_series = mysqli_fetch_array($fila_aux2_series);



               if ($filita_aux_series[0]!="0" && $filita_aux2_series[0]!="0") {
                 $query2_series="SELECT *,t.id,t.tematica FROM series m left join tematicas t on m.id_tematica1 = t.id where m.estado = 1 AND t.tematica = '".$filita1_series[0]."'";
               } else {

                 $query2_series="SELECT * FROM series where estado = 1 ORDER BY RAND() LIMIT 2;";
               }


                /* echo $queryaux." ______________".$filita1[0]; */
                 $fila2_series = ejecutar($query2_series);



           ?>



     <section class="seccion contenedor">

           <?php if ($filita_aux_series[0]!='0' AND $filita_aux2_series[0]!="0") {

             echo "<h2>series RECOMENDADAS  por ".$filita1_series[0]."</h2>";
           } else {
             echo " <h2>Nuestras series RECOMENDADAS   </h2>";
           }
             ?>


     </section>

     <section id="campanas" class="campanas contenedor seccion">

      <ul class="lista-campanas clearfix" id="itemContainer">
        <?php
        while ($row = mysqli_fetch_array($fila2_series)) {
          echo "
              <li>
              <br>
                <div class='campana'>
                  <a class='campana-info' href='#campana".$row["0"]."'>
                  <img src='vista/img/".$row["7"]."' width='400px' height='200px'>
                  <p>".$row["1"]." </p>
                  </a>
                </div>
                <br>
              <center> <a href='vista/participarcriticaserie.php?peliid=".$row["0"]."' ><button class='btn btn-success'  href='participarcriticapeli.php?peliid=".$row["0"]."'   name='submit' value='Buscar' > Ver Criticas</button></a> </center>

              </li>
             ";
        }
        ?>
      </ul>
    </section>

<?php include_once ('vista/templates/footer.php'); ?>
  <script src="vista/js/jquery.js"></script>
  <script src="vista/js/jquery.slides.js"></script>
  <script>
  $(function(){
    $(".slides").slidesjs({

    });
  });
</script>
</body>

</html>
