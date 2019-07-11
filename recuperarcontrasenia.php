<?php
header( 'X-Content-Type-Options: nosniff' );
header('X-Frame-Options: DENY');
header("X-XSS-Protection: 1; mode=block");
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
</head>

<body >

  <nav class="navbar navbar-default" style="background-color: #565a60;">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header" style="float: none">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php" style="color:#DAA520;
                                                              font-size: 40px;
                                                              font-family: Garamond">www.PurOcio.com</a>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
            <ul class="nav navbar-nav navbar-right">
              <li ><a href="login.php" style="color: #FFFFFF  ">Ingresar</a></li>
              <li ><a href="registrousuario.php" style="color: #FFFFFF">Registrarse</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
  </nav>

<div class="container">
    <form class="form-horizontal" action="../controlador/usuariocontrolador.php" data-toggle="validator" method="post">
          <center><img src="img/carta.png" width="8%" height="8%" align="center"></center>
        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">
          <h3>Por favor, ingresa tu correo electrónico, </h3>
          y nosotros te enviaremos tu contraseña inmediatamente
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">
          <input type="email" name="txtemail" placeholder="Correo Electrónico" class="form-control input-md" data-error="Por favor, ingresa un formato de correo válido: alguien@example.com" required>
          <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <center>
          <button type="submit" class="btn btn-success" value="recuperar" name="action"
                                              style="background-color: #DAA520;
                                              border-color: black;
                                              color: black" >Aceptar</button>
        </center>
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
