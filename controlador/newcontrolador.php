<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );


require_once ('../db/conexion.php');
require_once ('../modelo/new.php');


conectar();
session_start();

 $action = '';
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'create' :
                create();
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


 function create(){


        $ser=new Noticia();
        $ser->setTitulo($_POST["txtitulo"]);
        $ser->setNoticia($_POST["txtnoticia"]);

        $ser->setImage($_FILES['txtimagen']['name']);
        $guardar=$ser->guardar();

        $im = $_FILES['txtimagen']['tmp_name'];
        $thumb_db = $_FILES['txtimagen']['name'];

        $ruta = '../vista/img/' . $thumb_db;

        move_uploaded_file($im, $ruta);


        echo "<script>alert('Registraste una nueva Noticia')
        document.location=('../vista/listanew.php')</script>";

    }


    function modificar(){

    $idnew = $_POST["idnew"];

 $image = "";
    if($_FILES['txtimagen']['name'] == "") {
        $image = $_POST["himage"];
    }else{
        $image = $_FILES['txtimagen']['name'];
    }



        $ser = new Noticia();
        $ser->setTitulo($_POST["txtitulo"]);
        $ser->setNoticia($_POST["txtnoticia"]);

        $ser->setImage($_FILES['txtimagen']['name']);
        $actualizar = $ser->actualizar();


        $im = $_FILES['txtimagen']['tmp_name'];
    $thumb_db = $_FILES['txtimagen']['name'];

    $ruta = '../vista/img/' . $thumb_db;

    move_uploaded_file($im, $ruta);

        echo "<script>alert('Actualizado Correctamente')
        document.location=('../vista/detalleNew.php')</script>";
    }


    function eliminar(){

    $idnew = $_REQUEST["idnew"];

        $ser = new Noticia();
        $ser->setId($idnew);
        $eliminar = $ser->eliminar();

        echo "<script>alert('Noticia eliminada')
     document.location=('../vista/detalleNew.php')</script>";

}
