<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );







require_once ('../db/conexion.php');
require_once ('../modelo/categoria.php');


conectar();
session_start();

 $action = '';
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'agregar' :
                agregar();
                break;
            case 'modificar' :
                modificar();
                break;

        }
    }else{
        $action = $_REQUEST["action"];
        switch ($action) {
            case 'eliminar':
                eliminar();
                break;

        }
    }


function agregar(){

   $cat = new Categoria();
   $cat->setDescription($_POST["txtcate"]);
   $buscar = $cat->categoriapordes();

if($buscar){

    echo "<script>alert('ESA CATEGORIA YA EXISTE')
    document.location=('../vista/registropelicula.php')</script>";


}else{
    $cate=new Categoria();
    $cate->setDescription($_POST["txtcate"]);
    $cate->setUserid($_SESSION["cod"]);

    $guardar=$cate->guardar();


        echo "<script>alert('LA CATEGORIA SE AÑADIO')
    document.location=('../vista/registropelicula.php')</script>";

}


}




 ?>
