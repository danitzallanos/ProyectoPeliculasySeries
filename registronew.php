<?php
require_once ('../db/conexion.php');
require_once ('../modelo/categoria.php');
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
    <link href="css/remodal.css" rel="stylesheet">
    <link href="css/remodal-default-theme.css" rel="stylesheet">
</head>

<body style="background-color: white;">

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
      <div class="panel-heading" style="background-color:black"><h3 style="text-align:center;">Añade una noticia</h3></div>
      </div>

  <form class="form-horizontal" action="../controlador/newcontrolador.php" method="post" data-toggle="validator" enctype="multipart/form-data">



        <!-- Text input-->
        <div class="form-group" >
          <label class="col-md-4 control-label" for="title" >Titulo : </label>
          <div class="col-md-5" >
          <input id="title" name="txtitulo" type="text" placeholder="Titulo" class="form-control input-md" required>
          </div>
          <div class="help-block with-errors"></div>
        </div>


                <div class="form-group" >
                  <label class="col-md-4 control-label" for="noticia" >Noticia: </label>
                  <div class="col-md-5" >
                  <textarea id="noticia" name="txtnoticia" class="form-control input-md" rows="4" required> </textarea>
                 <div class="help-block with-errors"></div>
                  </div>

                </div>



         </select>



        <div class="form-group">
          <label class="col-md-4 control-label" for="imagen" >Imagen : </label>
          <div class="col-md-4">
          <input type="file" onchange="validarFile(this);" name="txtimagen" id="file"/>
          </div>
        <!--  <div class="help-block with-errors"></div> -->
          <div class="help-block">extensiones permitidas jpg, png, jpeg</div>
        </div>






  <button class="remodal-confirm" type="submit" name="action" value="create">Guardar</button>
  <button data-remodal-action="cancel" class="remodal-cancel" >Cancel</button>
          </div>
        </div>
      </form>
    </p>
  </div>

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



<?php
include('templates/notificacion.php');
 ?>


</body>

</html>
