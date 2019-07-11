<?php

header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );


require_once ('../db/conexion.php');
require_once ('../modelo/serie.php');


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


    $ser=new Serie();
    $ser->setTitle($_POST["txtitulo"]);
    $ser->setDescription($_POST["txtdes"]);
    $ser->setDirector($_POST["txtdirector"]);
    $ser->setEpisodes($_POST["txtepisodes"]);
    $ser->setSeasons($_POST["txtseasons"]);
    $ser->setImage($_FILES['txtimagen']['name']);
    $ser->setTrailer($_POST["txttrailer"]);
    $ser->setCategoriaid($_POST["cat"]);
    $ser->setTematicaid($_POST["tem"]);
    $guardar=$ser->guardar();

$im = $_FILES['txtimagen']['tmp_name'];
$thumb_db = $_FILES['txtimagen']['name'];

$ruta = '../vista/img/' . $thumb_db;

move_uploaded_file($im, $ruta);

    echo "<script>alert('Registraste una nueva Serie')
    document.location=('../vista/listaseries.php')</script>";

}


function modificar(){

$idserie = $_POST["idserie"];


$image = "";
if($_FILES['txtimagen']['name'] == "") {
    $image = $_POST["himage"];
}else{
    $image = $_FILES['txtimagen']['name'];
}


    $ser = new Serie();
    $ser->setTitle($_POST["txtitulo"]);
    $ser->setDescription($_POST["txtdes"]);
    $ser->setDirector($_POST["txtdirector"]);
    $ser->setEpisodes($_POST["txtepisodes"]);
    $ser->setSeasons($_POST["txtseasons"]);
      $ser->setImage($image);
    $ser->setTrailer($_POST["txttrailer"]);
    $ser->setCategoriaid($_POST["cat"]);
    $ser->setTematicaid($_POST["tem"]);
    $ser->setId($idserie);
    $actualizar = $ser->actualizar();

    $im = $_FILES['txtimagen']['tmp_name'];
$thumb_db = $_FILES['txtimagen']['name'];

$ruta = '../vista/img/' . $thumb_db;

move_uploaded_file($im, $ruta);

    echo "<script>alert('Actualizado Correctamente')
    document.location=('../vista/detalleSerie.php')</script>";
}


function eliminar(){

$idserie = $_REQUEST["idserie"];

    $ser = new Serie();
    $ser->setId($idserie);
    $eliminar = $ser->eliminar();

    echo "<script>alert('Serie eliminada')
 document.location=('../vista/detalleSerie.php')</script>";
}



    function like(){
        $post_id = $_POST['post_id'];
        $cod = $_SESSION["cod"];
    try {
        $qry = "select * from like_unlike_series where serie_id = $post_id and user_id=$cod";
        $res = ejecutar($qry);
        if(mysqli_num_rows($res) == 0) {

            $insertquery = "INSERT INTO like_unlike_series(id,type,user_id,serie_id) values(null,1,".$cod.",".$post_id.")";
            $result = ejecutar($insertquery);
            }else {
            $updatequery = "UPDATE like_unlike_series SET type=1 where user_id=" . $cod . " and serie_id=" . $post_id;
            $result = ejecutar($updatequery);
        }

        if($result) {

    $SQL1 = "SELECT COUNT(*) FROM like_unlike_series where type = 1 and serie_id = $post_id";
    $fila1 = ejecutar($SQL1);
    $filita1 = mysqli_fetch_array($fila1);

    $SQL2 = "SELECT COUNT(*) FROM like_unlike_series where type = 0 and serie_id = $post_id";
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
        $qry = "select * from like_unlike_series where serie_id = $post_id and user_id=$cod";
        $res = ejecutar($qry);
        if(mysqli_num_rows($res) == 0) {

            $insertquery = "INSERT INTO like_unlike_series(id,type,user_id,serie_id) values(null,0,".$cod.",".$post_id.")";
            $result = ejecutar($insertquery);
            }else {
            $updatequery = "UPDATE like_unlike_series SET type=0 where user_id=" . $cod . " and serie_id=" . $post_id;
            $result = ejecutar($updatequery);
        }

        if($result) {

    $SQL1 = "SELECT COUNT(*) FROM like_unlike_series where type = 1 and serie_id = $post_id";
    $fila1 = ejecutar($SQL1);
    $filita1 = mysqli_fetch_array($fila1);

    $SQL2 = "SELECT COUNT(*) FROM like_unlike_series where type = 0 and serie_id = $post_id";
    $fila2 = ejecutar($SQL2);
    $filita2 = mysqli_fetch_array($fila2);

                        echo $filita1[0].'|'.$filita2[0];
                    }

                } catch (Exception $e) {
                echo "Error : " .$e->getMessage();
            }
    }







 ?>
