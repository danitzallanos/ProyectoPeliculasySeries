<?php
conectar();

class Categoria
{
	private $id;
    private $description;
    private $userid;



 function __construct($id=0,$description="",$userid=""){
 $this->id = $id;
 $this->description = $description;
 $this->userid = $userid;

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

    public function setUserid($userid){
    	$this->userid = $userid;
    }

    public function getUserid($userid){
    	return $this->userid;
    }

    public function guardar(){

        $query="INSERT INTO categorias (categoria_id,descripcion,user_id,estado)
                VALUES(0,
                       '".$this->description."',
                       '".$this->userid."',
                       1);";
        $guardar=ejecutar($query) or die (mysqli_error());
        //$this->db()->error;
        return $guardar;

 	}


     public function listarcategorias(){

        $query="SELECT categoria_id, descripcion from categorias" ;
        $tabla=ejecutar($query);

        return $tabla;

    }

    public function categoriapordes(){
        $query="SELECT * from categorias where descripcion='".$this->description."'" ;
        $tabla=ejecutar($query);
        $row = mysqli_fetch_array($tabla);
        return $row;

    }



}



 ?>
