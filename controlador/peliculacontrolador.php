<?php

header( 'X-Content-Type-Options: nosniff' );
header( 'X-Frame-Options: SAMEORIGIN' );
header( 'X-XSS-Protection: 1;mode=block' );


require_once ('../db/conexion.php');
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


    $ser=new pelicula();
    $ser->setTitle($_POST["txtitulo"]);
    $ser->setDuration($_POST["txtdurac"]);
    $ser->setPuntuacion($_POST["txtpunt"]);
    $ser->setDescription($_POST["txtdes"]);
    $ser->setDirector($_POST["txtdirector"]);
    $ser->setImage($_FILES['txtimagen']['name']);
    $ser->setTrailer($_POST["txttrailer"]);
    $ser->setCategoriaid($_POST["cat"]);
    $ser->setTematicaid($_POST["tem"]);
    $guardar=$ser->guardar();

$im = $_FILES['txtimagen']['tmp_name'];
$thumb_db = $_FILES['txtimagen']['name'];

$ruta = '../vista/img/' . $thumb_db;

move_uploaded_file($im, $ruta);

    echo "<script>alert('Registraste una nueva Pelicula')
    document.location=('../vista/listapeliculas.php')</script>";

}


    function modificar(){

    $idpelicula = $_POST["idpelicula"];


    $image = "";
    if($_FILES['txtimagen']['name'] == "") {
        $image = $_POST["himage"];
    }else{
        $image = $_FILES['txtimagen']['name'];
    }


        $ser = new Pelicula();
        $ser->setTitle($_POST["txtitulo"]);
        $ser->setDuration($_POST["txtdurac"]);
          $ser->setDirector($_POST["txtdirector"]);
            $ser->setPuntuacion($_POST["txtpunt"]);
        $ser->setDescription($_POST["txtdes"]);
        $ser->setImage($image);
        $ser->setTrailer($_POST["txttrailer"]);
        $ser->setCategoriaid($_POST["cat"]);
        $ser->setTematicaid($_POST["tem"]);
        $ser->setId($idpelicula);
        $actualizar = $ser->actualizar();

        $im = $_FILES['txtimagen']['tmp_name'];
    $thumb_db = $_FILES['txtimagen']['name'];

    $ruta = '../vista/img/' . $thumb_db;

    move_uploaded_file($im, $ruta);

        echo "<script>alert('Actualizado Correctamente')
        document.location=('../vista/detallePelicula.php')</script>";
    }


    function eliminar(){

    $idpelicula = $_REQUEST["idpelicula"];
        $ser = new Pelicula();
        $ser->setId($idpelicula);
        $eliminar = $ser->eliminar();

        echo "<script>alert('Pelicula eliminada')
     document.location=('../vista/detallePelicula.php')</script>";
    }


    function like(){
        $post_id = $_POST['post_id'];
        $cod = $_SESSION["cod"];
    try {
        $qry = "select * from like_unlike_movies where movie_id = $post_id and user_id=$cod";
        $res = ejecutar($qry);
        if(mysqli_num_rows($res) == 0) {

            $insertquery = "INSERT INTO like_unlike_movies(id,type,user_id,movie_id) values(null,1,".$cod.",".$post_id.")";
            $result = ejecutar($insertquery);
            }else {
            $updatequery = "UPDATE like_unlike_movies SET type=1 where user_id=" . $cod . " and movie_id=" . $post_id;
            $result = ejecutar($updatequery);
        }

        if($result) {

    $SQL1 = "SELECT COUNT(*) FROM like_unlike_movies where type = 1 and movie_id = $post_id";
    $fila1 = ejecutar($SQL1);
    $filita1 = mysqli_fetch_array($fila1);

    $SQL2 = "SELECT COUNT(*) FROM like_unlike_movies where type = 0 and movie_id = $post_id";
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
        $qry = "select * from like_unlike_movies where movie_id = $post_id and user_id=$cod";
        $res = ejecutar($qry);
        if(mysqli_num_rows($res) == 0) {

            $insertquery = "INSERT INTO like_unlike_movies(id,type,user_id,movie_id) values(null,0,".$cod.",".$post_id.")";
            $result = ejecutar($insertquery);
            }else {
            $updatequery = "UPDATE like_unlike_movies SET type=0 where user_id=" . $cod . " and movie_id=" . $post_id;
            $result = ejecutar($updatequery);
        }

        if($result) {

    $SQL1 = "SELECT COUNT(*) FROM like_unlike_movies where type = 1 and movie_id = $post_id";
    $fila1 = ejecutar($SQL1);
    $filita1 = mysqli_fetch_array($fila1);

    $SQL2 = "SELECT COUNT(*) FROM like_unlike_movies where type = 0 and movie_id = $post_id";
    $fila2 = ejecutar($SQL2);
    $filita2 = mysqli_fetch_array($fila2);

                        echo $filita1[0].'|'.$filita2[0];
                    }

                } catch (Exception $e) {
                echo "Error : " .$e->getMessage();
            }
    }




     ?>
