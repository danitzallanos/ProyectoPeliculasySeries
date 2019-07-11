<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );
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
    <link rel="stylesheet" href="css/main.css">
</head>

<body background="white">
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
  <div class="navbar-header">
  <a class="navbar-brand" href="../index.php"style="color:#DAA520;
  font-size: 40px;
  font-family: Garamond">www.PurOcio.com</a></a>
  </div>
  <ul class="nav navbar-nav navbar-right">
   <li><a href="login.php">Ingresar</a></li>
   <li><a href="registrousuario.php">Registrar</a></li>
  </ul>
</nav>


<div class="container">
    <form class="form-horizontal" action="../controlador/usuariocontrolador.php" data-toggle="validator" method="post">

        <legend><center><h1 style="color: #DAA520">Módulo de registro</h1></center></legend>


        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Nombre" >Nombres</label>
          <div class="col-md-4">
          <input id="Nombre" name="txtnom" type="text" placeholder="Nombres" class="form-control input-md"
                  data-error="Por favor, ingresa tu nombre." onkeypress='return validarLetras(event)' required>
          <div class="help-block with-errors"></div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Apellido" >Apellidos</label>
          <div class="col-md-4">
          <input id="Apellido" name="txtape" type="text" placeholder="Apellidos" class="form-control input-md"
                data-error="Por favor, ingresa tus apellidos."  onkeypress='return validarLetras(event)' required>
          <div class="help-block with-errors"></div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Email" >E-mail</label>
          <div class="col-md-4">
          <input id="Email" name="txtcorreo" type="email" placeholder="Ingresa tu e-mail" class="form-control input-md"
          data-error="Por favor, ingresa un correo valido con este formato: alguien@example.com" required>
           <div class="help-block with-errors"></div>
           </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Contrasena">Contraseña</label>
          <div class="col-md-4">
          <input id="Contrasena" name="txtclave" type="password" placeholder="Ingresa tu contraseña" class="form-control input-md" data-minlength="8" autocomplete="off" required>
          <div class="help-block">Longitud mínima de 8 caracteres</div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="cc" >Confirma Contraseña</label>
          <div class="col-md-4">
          <input id="cc" name="txtrc" type="password" placeholder="Confirma tu contraseña" class="form-control input-md"
          data-match="#Contrasena" data-match-error="Las contraseñas no coinciden." required>
          <div class="help-block with-errors"></div>
          </div>
        </div>

        

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="celular" >Celular</label>
          <div class="col-md-4">
          <input id="celular" name="txtcel" type="text" onkeypress="validaNumericos(event)"  placeholder="Celular" class="form-control input-md" maxlength="9" >
          <div class="help-block">Longitud mínima de 9 dígitos</div>
          </div>
        </div>



      <input type=hidden id="tipo" name="txtipo" value="2">

        <!-- Button -->
        <div class="form-group">
           <div class="col-md-4"></div>
           <div class="col-md-4">

             <center>
           <button class="btn btn-primary" block="true" type="submit"
            name="action" value="create" style="background-color: #DAA520;
                                                border-color: black;
                                                color: black" > Aceptar </button>
                                              </center>
           </div>
        </div>



    </form>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<script >
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;
}
</script>


<script type="text/javascript">
function validarLetras(e) { // 1
tecla = (document.all) ? e.keyCode : e.which; // 2
if (tecla==8) return true; // 3
patron =/[A-Za-zñÑáéíóúÁÉÍÓÚ\s]/; // 4
te = String.fromCharCode(tecla); // 5
return patron.test(te); // 6
}
</script>
</body>


</html>
