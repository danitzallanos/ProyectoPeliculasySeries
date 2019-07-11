<?php
header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );



require_once ('../db/conexion.php');
require_once ('../modelo/tematica.php');


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

    $fecha1 = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
    $fecha2 = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

        $tema=new Tematica();
        $tema->setTematica($_POST["txttematica"]);
        $tema->setFecha_inicio($fecha1);
        $tema->setFecha_fin($fecha2);
        $guardar=$tema->guardar();


        echo "<script>alert('Registraste una nueva tematica')
        document.location=('../vista/listatematicas.php')</script>";

    }


        function modificar(){

        $idpelicula = $_POST["idpelicula"];


        $fecha1 = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha1"])));
        $fecha2 = date('Y/m/d', strtotime(str_replace('/', '-', $_POST["txtfecha2"])));

        echo $fecha2;


            $ser = new Tematica();
            $ser->setTematica($_POST["txttematica"]);
            $ser->setFecha_inicio($fecha1);
            $ser->setFecha_fin($fecha2);
            $ser->setId($idpelicula);

            $actualizar = $ser->actualizar();

            echo "<script>alert('Actualizado Correctamente')
            document.location=('../vista/listatematicas.php')</script>";
        }


        function eliminar(){

            $idpelicula = $_REQUEST["idpelicula"];
            $ser = new Tematica();
            $ser->setId($idpelicula);
            $eliminar = $ser->eliminar();

            echo "<script>alert('Pelicula eliminada')
         document.location=('../vista/listatematicas.php')</script>";
        }




 ?>
