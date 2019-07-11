<?php

if(isset($_POST['boton1']))
{
	 include('ficheroexcelPeliculas.php');
}
else if(isset($_POST['boton2']))
{
	include('PDFpeliculas.php');
}
 ?>
