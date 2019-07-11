<?php

header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );


require_once ('../db/conexion.php');
require_once ('../modelo/criticas_pelis.php');
require_once ('../modelo/pelicula.php');

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
            case 'like' :
                like();
                break;
            case 'dislike' :
                dislike();
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

    $fi = $_POST["fi"];



    $comentario=new criticas_peliculas();
    $comentario->setDescription($_POST["txtdes"]);
    $comentario->setUserid($_SESSION["cod"]);
    $comentario->setForoid($_POST["fi"]);
    $guardar=$comentario->guardar();

    if($guardar){
        $sumar = new Pelicula();
        $sumar->setId($_POST["fi"]);
        $sumar->sumacrit();

        echo "<script>alert('tu comentario se añadio')
    document.location=('../vista/participarcriticapeli.php?peliid=$fi')</script>";
    }



}


function modificar(){

$idcome = $_POST["comid"];
$idforo = $_REQUEST["foroid"];

    $comentario = new criticas_peliculas();
    $comentario->setDescription($_POST["txtcomen"]);
    $comentario->setId($idcome);
    $actualizar = $comentario->actualizar();

    echo "<script>alert('Actualizado Correctamente')
    document.location=('../vista/participarcriticapeli.php?peliid=$idforo')</script>";
}


function eliminar(){

$idcome = $_REQUEST["idcome"];
$idforo = $_REQUEST["foroid"];

    $come = new criticas_peliculas();
    $come->setId($idcome);
    $eliminar = $come->eliminar();

    if($eliminar){
        $restar = new Pelicula();
        $restar->setId($idforo);
        $restar->restarcrit();


    echo "<script>alert('comentario eliminado')
document.location=('../vista/participarcriticapeli.php?peliid=$idforo')</script>";
}

}

function like(){
    $post_id = $_POST['post_id'];
    $cod = $_SESSION["cod"];
try {
    $qry = "select * from like_unlike_crit_peli where critica_id = $post_id and user_id=$cod";
    $res = ejecutar($qry);
    if(mysqli_num_rows($res) == 0) {

        $insertquery = "INSERT INTO like_unlike_crit_peli(id,type,user_id,critica_id) values(null,1,".$cod.",".$post_id.")";
        $result = ejecutar($insertquery);
        }else {
        $updatequery = "UPDATE like_unlike_crit_peli SET type=1 where user_id=" . $cod . " and critica_id=" . $post_id;
        $result = ejecutar($updatequery);
    }

    if($result) {

$SQL1 = "SELECT COUNT(*) FROM like_unlike_crit_peli where type = 1 and critica_id = $post_id";
$fila1 = ejecutar($SQL1);
$filita1 = mysqli_fetch_array($fila1);

$SQL2 = "SELECT COUNT(*) FROM like_unlike_crit_peli where type = 0 and critica_id = $post_id";
$fila2 = ejecutar($SQL2);
$filita2 = mysqli_fetch_array($fila2);

                    echo $filita1[0].'|'.$filita2[0];
                }

            } catch (Exception $e) {
            echo "Error : " .$e->getMessage();
        }
}

function dislike(){
    $post_id = $_POST['post_id'];
    $cod = $_SESSION["cod"];
try {
    $qry = "select * from like_unlike_crit_peli where critica_id = $post_id and user_id=$cod";
    $res = ejecutar($qry);
    if(mysqli_num_rows($res) == 0) {

        $insertquery = "INSERT INTO like_unlike_crit_peli(id,type,user_id,critica_id) values(null,0,".$cod.",".$post_id.")";
        $result = ejecutar($insertquery);
        }else {
        $updatequery = "UPDATE like_unlike_crit_peli SET type=0 where user_id=" . $cod . " and critica_id=" . $post_id;
        $result = ejecutar($updatequery);
    }

    if($result) {

$SQL1 = "SELECT COUNT(*) FROM like_unlike_crit_peli where type = 1 and critica_id = $post_id";
$fila1 = ejecutar($SQL1);
$filita1 = mysqli_fetch_array($fila1);

$SQL2 = "SELECT COUNT(*) FROM like_unlike_crit_peli where type = 0 and critica_id = $post_id";
$fila2 = ejecutar($SQL2);
$filita2 = mysqli_fetch_array($fila2);

                    echo $filita1[0].'|'.$filita2[0];
                }

            } catch (Exception $e) {
            echo "Error : " .$e->getMessage();
        }
}


 ?>
