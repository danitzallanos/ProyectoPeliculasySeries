<?php
conectar();

class criticas_peliculas
{
	private $id;
    private $description;
    private $dates;
    private $userid;
    private $foroid;


 function __construct($id=0,$description="",$dates="",$userid="",$foroid=""){
 $this->id = $id;
 $this->description = $description;
 $this->dates = $dates;
 $this->userid = $userid;
 $this->foroid = $foroid;
 }

    public function setId($id){
    	$this->id = $id;
    }

    public function getId($id){
    	return $this->id;
    }

    public function setDescription($description){
    	$this->description = $description;
    }

    public function getDescription($description){
        return $this->description;
    }

    public function setDates($dates){
        $this->dates = $dates;
    }

    public function getDates($dates){
        return $this->dates;
    }


    public function setUserid($userid){
    	$this->userid = $userid;
    }

    public function getUserid($userid){
    	return $this->userid;
    }

    public function setForoid($foroid){
        $this->foroid = $foroid;
    }

    public function getForoid($foroid){
        return $this->foroid;
    }


    public function guardar(){
date_default_timezone_set("America/Lima");
$a=date('Y/m/d');


        $query="INSERT INTO criticas_peliculas (critica_id,description,fecha,user_id,movie_id,estado)
                VALUES(0,
                       '".$this->description."',
                       '$a',
                       '".$this->userid."',
                       '".$this->foroid."',1);";
        $guardar=ejecutar($query) or die (mysqli_error());
        //$this->db()->error;
        return $guardar;

 	}

     public function actualizar(){

        $query="UPDATE criticas_peliculas SET description='".$this->description."' where critica_id='".$this->id."'";
        $actualizar=ejecutar($query) or die (mysqli_error());

        return $actualizar;

    }

    public function eliminar(){

        $query="UPDATE criticas_peliculas SET estado = '0' where critica_id='".$this->id."'";
        $eliminar=ejecutar($query) or die (mysqli_error());

        return $eliminar;

    }



     public function listacomentarios(){

        $query="SELECT c.critica_id,c.description,DATE_FORMAT(c.fecha, '%d-%m-%Y'),u.firstname,u.lastname,u.photo,m.title,c.user_id from criticas_peliculas c inner join movies m on c.movie_id=m.movie_id inner join users u on c.user_id=u.user_id where m.movie_id = '".$this->foroid."' and c.estado = 1 order by c.critica_id DESC" ;
        $tabla=ejecutar($query);

        return $tabla;

    }



}



 ?>
