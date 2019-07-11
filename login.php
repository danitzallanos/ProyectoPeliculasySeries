<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Las mejores noticias de cine y series|PurOcio.com</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">


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

        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <center><img src="img/claqueta.png" width="40%" height="40%" align="center"></center>
          <legend><h3><center>¡Luces, cámara, acción!</center> </h3></legend>
          <p>¡Bienvenido! Por favor,<br>ingresa tu e-mail y contraseña:</p>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">
          <input type="email" name="txtemail" placeholder="Ingresa tu e-mail" class="form-control input-md" data-error="Por favor, ingresa un formato de correo válido: alguien@ejemplo.com" required>
          <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">
          <input type="password" name="txtpass" placeholder="Ingresa tu contraseña" class="form-control input-md" id="password" data-error="Por favor, ingresa tu contraseña" autocomplete="off" required>
          <div class="help-block with-errors"></div>
          <a href="recuperarcontrasenia.php">¿Olvidaste tu contraseña?</a>
          </div>
          </br>
        </div>

        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">

          <button type="submit" class="btn btn-success" name="action" value="login" style="background-color: #DAA520;
                                              border-color: black;
                                              color: black" >Ingresar</button>
          </div>
        </div>

    </form>
</div>

<footer>
</footer>

<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>

</body>

</html>
