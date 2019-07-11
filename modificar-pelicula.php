<?php
require_once ('../db/conexion.php');
require_once ('../modelo/pelicula.php');
require_once ('../modelo/categoria.php');
require_once ('../modelo/tematica.php');
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
    <link href="css/jquery-ui.css" rel="stylesheet">
    <link href="css/notificacion.css"rel="stylesheet">

</head>

<body background="img/fondito.jpg">

<?php include("templates/menu-admin.php"); ?>


<div id="page-content-wrapper">
<div class="container-fluid">

<div class="panel panel-info">
<div class="panel-heading"><h3 style="text-align:center;">Modifica el registro de la pelicula</h3></div>
</div>
                <?php
                $codpelicula=$_REQUEST["idpelicula"];
                $pelicula=new Pelicula();
                $pelicula->setId($codpelicula);
                $r = $pelicula->getPeliculabyCod();
                ?>

<form class="form-horizontal" action="../controlador/peliculacontrolador.php" method="post" enctype="multipart/form-data" data-toggle="validator">

                   <input value="<?=$r[0]?>" type="hidden" name="idpelicula" />

         <div class="form-group">
          <label class="col-md-4 control-label" for="cat" >Categoria : </label>
          <div class="col-md-4">
          <select class="form-control" name="cat" id="cat" required>

         <option value="<?=$r[9]?>" ><?=$r[8]?></option>

         <?php

          $codcat = $_POST["cat"];

          $cate = new Categoria();
          $rc = $cate->listarcategorias();

          while($row=mysqli_fetch_array($rc)){
          if($codcat == $row[0]){
          echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
        }if ($row[1] != $r[8]){
          echo "<option value='".$row[0]."' >".$row[1]."</option>";
          }
          }
          ?>

          </select>

          </div>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
         <label class="col-md-4 control-label" for="tem" >Tematica : </label>
         <div class="col-md-4">
         <select class="form-control" name="tem" id="tem" required>

           <option value="<?=$r[11]?>" ><?=$r[10]?></option>


        <?php

         $codcat = $_POST["tem"];

         $cate = new Tematica();
         $rc = $cate->listar();

         while($row=mysqli_fetch_array($rc)){
         if($codcat == $row[0]){
         echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
       }if ($row[1] != $r[10]){
         echo "<option value='".$row[0]."' >".$row[1]."</option>";
         }
         }
         ?>

         </select>

         </div>
         <div class="help-block with-errors"></div>
        </div>

        <!-- Text input-->
        <div class="form-group" >
          <label class="col-md-4 control-label" for="title" >Titulo : </label>
          <div class="col-md-5" >
          <input value="<?=$r[1]?>" id="title" name="txtitulo" type="text" class="form-control input-md" required>
          </div>
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group" >
          <label class="col-md-4 control-label" for="des">Descripción : </label>
          <div class="col-md-5" >
         <textarea id="des" name="txtdes" class="form-control input-md" rows="6" ><?=$r[5]?></textarea>
          <input value=" <?=$r[5]?>" type="hidden" id="hd" />
          </div>
          <div class="help-block with-errors"></div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="direc" >Director : </label>
          <div class="col-md-5">
          <input value="<?=$r[3]?>" id="direc" name="txtdirector" type="text" class="form-control input-md" required>
          </div>
          <div class="help-block with-errors"></div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="durac" >Duracion : </label>
          <div class="col-md-2">
          <input value="<?=$r[2]?>" id="durac" name="txtdurac" type="text" class="form-control input-md" onkeypress='return validaNumericos(event)' required>
          </div>
         <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="punt" >Puntuacion : </label>
          <div class="col-md-2">
          <input value="<?=$r[4]?>" id="punt" name="txtpunt" type="text" class="form-control input-md" onkeypress='return validaNumericos(event)' required>
          </div>
         <div class="help-block with-errors"></div>
        </div>



        <div class="form-group">
          <label class="col-md-4 control-label" for="trailer" >Trailer: </label>
          <div class="col-md-5">
          <input value="<?=$r[7]?>" id="trailer" name="txttrailer" type="text" class="form-control input-md" required>
          </div>
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
                <label class="col-md-4 control-label" for="imagen" >Imagen : </label>
                <div class="col-md-4">
                <input type="file" onchange="validarFile(this);" name="txtimagen" id="image" />
                <input value="<?=$r[6]?>" type="show" name="himage" />
                </div>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                  <?php echo "<center><img src='img/".$r["6"]."' alt='Norway' width='50%' height='50%'></center> ";  ?>
                  </div>
              </div>

               <!-- Button -->
        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">
        <button class="btn btn-success" block="true" type="submit" name="action" value="modificar"> Guardar </button>
          <a class='btn btn-info' href='detallePelicula.php'>Cancelar</a>
          </div>
        </div>

  </form>


      </div>
</div>

</div>

<footer>
</footer>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/jquery-ui.js"></script>




<script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
</script>


<script >
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;
}
</script>

<script>
  function validarFile(all)
{
    //EXTENSIONES Y TAMANO PERMITIDO.
    var extensiones_permitidas = [".png",".jpg", ".jpeg", ];
    //var tamano = 8; // EXPRESADO EN MB.
    var rutayarchivo = all.value;
    var ultimo_punto = all.value.lastIndexOf(".");
    var extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
    if(extensiones_permitidas.indexOf(extension) == -1)
    {
        alert("Extensión de archivo no valida");
        document.getElementById(all.id).value = "";
        return; // Si la extension es no válida ya no chequeo lo de abajo.
    }}
</script>


</body>

</html>
