<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );

require_once ('../db/conexion.php');
require_once ('../modelo/serie.php');
require_once ('../modelo/criticas_series.php');
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
    <link href="css/jPages.css" rel="stylesheet">
    <link href="css/remodal.css" rel="stylesheet" >
    <link href="css/remodal-default-theme.css" rel="stylesheet" >

    <style >
      .jumbotron {
        background-color: black;
}

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

<body style="background-color: gray;">



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


<div class="panel panel-success">
<div class="panel-heading"><h1 style="text-align:center;"><b>Tema</b></div>
</div>

    <?php

    $foroid=mysqli_real_escape_string(conectar(),$_REQUEST["peliid"]);

    $f = new Serie();
    $f->setId($foroid);
    $r = $f->getSeriebyCod();

    echo "<div class='jumbotron' >
          <center><h1 style='color:yellow'>".$r["1"]."</h1></center>
          </div>";
    ?>

    <div class="col-md-6">

      <?php
      echo"
        <center><img src='img/".$r["6"]."' width='50%' height='50%' ></center>
        <h3 style='color:white'>".$r["2"]."</h3>
        "
     ?>
    </div>


    <?php
    $SQL1="SELECT criticas from series where estado = 1  and serie_id='".$foroid."'" ;
    $fila1 = ejecutar($SQL1);
    $filita1 = mysqli_fetch_array($fila1);
    // echo "Nro de visitas: ".$filita1[0];
    $visitas= 1+$filita1[0];

    $SQL2="UPDATE series set criticas= '".$visitas."' where estado = 1  and serie_id='".$foroid."'" ;
    // echo $SQL2;
    $fila2 = ejecutar($SQL2);
    //$filita2 = mysqli_fetch_array($fila2);

    ?>


    <div class="col-md-6">
       <center><div class="holder"></div></center>
       <h3 style="color:white;">Déjanos tu crítica sobre esta serie</h3>
       <?php

       echo"
       <div id='fb-root' ></div>
       <script async defer crossorigin='anonymous' src='https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3'></script>
       <div class='fb-comments' data-mobile='Auto-detected' data-colorscheme='light' data-href='participarcriticaserie.php?peliid=".$foroid."' data-width='600' data-numposts='10'></div>
       <span class='fb-comments-count' data-href='participarcriticaserie.php?peliid=".$foroid."'></span>"


       ?>

<footer>
</footer>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/jPages.js"></script>
<script src="js/remodal.js"></script>


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
      perPage      : 4,
      startPage    : 1,
      startRange   : 1,
      midRange     : 1,
      endRange     : 1

    });
  });

</script>

<script type="text/javascript">
function Confirmation() {

  if (confirm('Esta seguro de eliminar este comentario?')==true) {

      return true;
  }else{
      //alert('Cancelo la eliminacion');
      return false;
  }
}
</script>

<script type="text/javascript">

  $(document).ready(function() {
     $('.like, .dislike').click(function() {
      var action = $(this).attr('class');
      var post_id = $(this).parent().parent().parent().find("#post_id").val();


            $.ajax({
              url: "../controlador/critica_serie_controlador.php",
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


</body>

</html>
