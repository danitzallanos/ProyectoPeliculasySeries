<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );

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

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/colorbox.css">
    <link rel="stylesheet" href="css/jPages.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/notificacion.css" >

    <style >
      .jumbotron {
       background-image: url("img/fondito1.jpg"); }

       .like {
        background-image: url('img/like.png');
         margin-right: 30px;
        }
      .like:hover {
    background-image: url('img/liked.png');
    }
    .dislike {
    background-image: url('img/dislike.png');

    }
    .dislike:hover {
    background-image: url('img/disliked.png');
    }
    .like,.dislike {
    /*height:55px;*/
    width:74px;
    background-repeat: no-repeat;
    float: left;
    background-size: 35%;
    cursor: pointer;
    }

    .counter {
    /*position: absolute;
    bottom: 0;*/
    padding-left:35px;
    }

    </style>

</head>

<body background="img/fondito.jpg">



<div id="wrapper">

  <?php
    $tipo =@$_SESSION['tipo'];

    if( $tipo == "1"){
    include("templates/menu-admin.php");
    }else{
    include("templates/menu-usuario.php");
    }
  ?>

<div id="page-content-wrapper">
    <div class="container-fluid">

  <div class="panel panel-primary">
  <div class="panel-heading" style="background-color:black"><h1 style="text-align:center;"><b>Series</b></div>
  </div>

  <form class="form-horizontal" name="form1" method="post" action="" data-toggle="validator">
     <div class="col-md-4"></div>
     <div class="col-md-4">
     <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-info" type="submit" name="submit" value="Buscar">Buscar</button>
      </span>
      <input type="text" name="busca" id="busca" class="form-control" placeholder="Ingresa un nombre de la serie" required>
     </div>
     <div class="help-block with-errors"></div>
     </div>
     <div class="col-md-4"></div>
  </form>

<?php
if(!empty($_POST["busca"])){

  $cod = $_SESSION["cod"];
  $ca = new Serie();
  $r1 = $ca->buscarSerie($_POST["busca"]);
  echo "<a class='btn btn-success' href='listaseries.php'>volver</a>";
}
?>


         <section id="campanas" class="campanas contenedor seccion">

          <ul class="lista-campanas clearfix" id="itemContainer">


<?php

    $cod = $_SESSION["cod"];

    $serie = new Serie();

    $r = $serie->Series();

if(empty($_POST["busca"])){
                while ($row = mysqli_fetch_array($r)) {
                  $id = $row[0];
                  $SQL1 = "SELECT COUNT(*) FROM like_unlike_series where type = 1 and serie_id = $id";
                  $fila1 = ejecutar($SQL1);
                  $filita1 = mysqli_fetch_array($fila1);

                  $SQL2 = "SELECT COUNT(*) FROM like_unlike_series where type = 0 and serie_id = $id";
                  $fila2 = ejecutar($SQL2);
                  $filita2 = mysqli_fetch_array($fila2);
                    echo "
                        <li>                          <br>

                          <div class='campana'>
                            <a class='campana-info' href='#campana".$row["0"]."'>
                            <img src='img/".$row["7"]."' width='400px' height='200px'>
                            <p>".$row["1"]."</p>
                            </a>
                          </div>
                          <br>
                        <center> <a href='participarcriticaserie.php?peliid=".$row["0"]."' ><button class='btn btn-success'  href='participarcriticaserie.php?peliid=".$row["0"]."'   name='submit' value='Buscar' > Ver Criticas</button></a> </center>
                        </li>
                        <div style='display:none;'>
                          <div class='campana-info' id='campana".$row["0"]."'>
                              <h2>".$row["1"]."</h2>
                              <h3> <p>Género: ".$row["8"]."</p></h3>
                              <img src='img/".$row["7"]."' >
                              <p>".$row["2"]."</p>
                              <p> Episodios:".$row["4"]."</p>
                              <p> Temporadas:".$row["5"]."</p>
                              <p> Director: ".$row["3"]."</p>
                              <p> Trailer:
                              <a href=".$row["6"].">".$row["6"]."</a></p>
                              <p><form action='' method='post' id='".$row[0]."'>
                                    <input type='hidden' name='post_id' id='post_id' value='".$row[0]."'>
                                    <div class='like-dislike'>
                                    <div class='like'><div class='counter'>".$filita1[0]."</div></div>
                                    <div class='dislike'><div class='counter'>".$filita2[0]."</div></div>
                                    <div class='clearfix'></div>
                                    </div>
                              </form></p>
                          </div>

                        </div>";
               }
             }else{
                while ($row2 = mysqli_fetch_array($r1)) {
                  $id = $row[0];
                  $SQL1 = "SELECT COUNT(*) FROM like_unlike_series where type = 1 and serie_id = $id";
                  $fila1 = ejecutar($SQL1);
                  $filita1 = mysqli_fetch_array($fila1);

                  $SQL2 = "SELECT COUNT(*) FROM like_unlike_series where type = 0 and serie_id = $id";
                  $fila2 = ejecutar($SQL2);
                  $filita2 = mysqli_fetch_array($fila2);
                    echo "
                        <li>
                          <div class='campana'>
                            <a class='campana-info' href='#campana".$row2["0"]."'>
                            <img src='img/".$row2["7"]."' width='400px' height='200px'>
                            <p>".$row2["1"]."</p>
                            </a>
                          </div>
                        </li>
                        <div style='display:none;'>
                          <div class='campana-info' id='campana".$row2["0"]."'>
                              <h2>".$row2["1"]."</h2>
                              <h3> <p>Género: ".$row2["8"]."</p></h3>
                              <img src='img/".$row2["7"]."' >
                              <p>".$row2["2"]."</p>
                              <p> Episodios:".$row["4"]."</p>
                              <p> Temporadas:".$row["5"]."</p>
                              <p> Director: ".$row["3"]."</p>
                              <p> Trailer:
                              <a href=".$row2["6"].">".$row2["6"]."</a></p>
                              <p><form action='' method='post' id='".$row[0]."'>
                                    <input type='hidden' name='post_id' id='post_id' value='".$row[0]."'>
                                    <div class='like-dislike'>
                                    <div class='like'><div class='counter'>".$filita1[0]."</div></div>
                                    <div class='dislike'><div class='counter'>".$filita2[0]."</div></div>
                                    <div class='clearfix'></div>
                                    </div>
                              </form></p>
                          </div>

                        </div>";}

             }

  ?>

            </ul>
    </section>




<center><div class="holder"></div></center>

    </div>
</div>

</div>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/main.js"></script>
<script src="js/jPages.js"></script>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
    $("#wrapper").toggleClass("toggled");
        });
</script>

<script>

$(function(){
    $("div.holder").jPages({
      containerID  : "itemContainer",
      perPage      : 6,
      startPage    : 1,
      startRange   : 1,
      midRange     : 1,
      endRange     : 1,
      animation   : "bounceInUp"
    });
  });

</script>
<script type="text/javascript">

  $(document).ready(function() {
     $('.like, .dislike').click(function() {
      var action = $(this).attr('class');
      var post_id = $(this).parent().parent().parent().find("#post_id").val();


            $.ajax({
              url: "../controlador/seriecontrolador.php",
              method: 'post',
              data:{action:action, post_id:post_id},
              success: function(resp){
                resp = $.trim(resp);
                console.log(resp);
                if(resp != '') {
                  resp = resp.split('|');
                  $('form#'+post_id+' .like .counter').html(resp[0]);
                  $('form#'+post_id+' .dislike .counter').html(resp[1]);
                }
              }
            });



     });
});
</script>
<?php
include('templates/notificacion.php');
 ?>

</body>

</html>
