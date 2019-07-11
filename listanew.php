<?php
require_once ('../db/conexion.php');
require_once ('../modelo/new.php');
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body background="img/fondito.jpg">


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

  <div class="panel panel-primary">
  <div class="panel-heading"style="background-color:black"><h1 style="text-align:center;"><b>Noticias</b>
  </div>
  </div>
  <form class="form-horizontal" name="form1" method="post" action="" data-toggle="validator">
     <div class="col-md-4"></div>
     <div class="col-md-4">
     <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-info" type="submit" name="submit" value="Buscar">Buscar</button>
      </span>
      <input type="text" name="busca" id="busca" class="form-control" placeholder="buscar noticia" required>
     </div>
     <div class="help-block with-errors"></div>
     </div>
     <div class="col-md-4"></div>
  </form>
<br></br>
<br></br>
<br></br>

<?php
if(!empty($_POST["busca"])){

  $cod = $_SESSION["cod"];
  $ca = new Noticia();
  $r1 = $ca->buscarNew($_POST["busca"]);
  echo "<a class='btn btn-success' href='listanew.php'>volver</a>";
}
?>
<section id="campanas" class="campanas contenedor seccion">

 <ul class="lista-campanas clearfix" id="itemContainer">

   <?php

       $cod = $_SESSION["cod"];

       $noticia = new Noticia();

       $r = $noticia->Noticias();

       if(empty($_POST["busca"])){
                       while ($row = mysqli_fetch_array($r)) {


echo"
<div class='w3-content'>

<div class='w3-row w3-margin'>

<div class='w3-third'>
  <img src='img/".$row["3"]."' style='width:100%;height:200px'>
</div>
<div class='w3-twothird w3-container'>
  <h2>".$row["1"]."</h2>
  <p>".$row["2"]."</p>
</div>

</div>
";}
}else{
   while ($row2 = mysqli_fetch_array($r1)) {

     echo"
     <div class='w3-content'>

     <div class='w3-row w3-margin'>

     <div class='w3-third'>
       <img src='img/".$row2["3"]."' style='width:100%;height:200px'>
     </div>
     <div class='w3-twothird w3-container'>
       <h2>".$row2["1"]."</h2>
       <p>".$row2["2"]."</p>
     </div>

     </div>
     ";
}
}
?>

</body>
</html>
