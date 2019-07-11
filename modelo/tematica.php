<?php
conectar();

class Tematica
{
	private $id;
    private $tematica;
    private $fecha_inicio;
    private $fecha_fin;



 function __construct($id=0,$tematica="",$fecha_inicio="", $fecha_fin=""){
 $this->id = $id;
 $this->tematica = $tematica;
 $this->fecha_inicio = $fecha_inicio;
 $this->fecha_fin = $fecha_fin;

 }

    public function setId($id){
    	$this->id = $id;
    }

    public function getId($id){
    	return $this->id;
    }

    public function setTematica($tematica){
      $this->tematica = $tematica;
    }

    public function getTematica($tematica){
      return $this->tematica;
    }

    public function setFecha_inicio($fecha_inicio){
    	$this->fecha_inicio = $fecha_inicio;
    }

    public function getFecha_inicio($fecha_inicio){
        return $this->fecha_inicio;
    }

    public function setFecha_fin($fecha_fin){
      $this->fecha_fin = $fecha_fin;
    }

    public function getFecha_fin($fecha_fin){
        return $this->fecha_fin;
    }

    public function guardar(){

        $query="INSERT INTO tematicas (id,tematica,fecha_inicio,fecha_fin,estado)
                VALUES(0,
                       '".$this->tematica."',
                       '".$this->fecha_inicio."',
                       '".$this->fecha_fin."',1);";
        $guardar=ejecutar($query) or die (mysqli_error());
        //$this->db()->error;
        return $guardar;

 	}

	public function actualizar(){

		 $query="UPDATE tematicas SET tematica='".$this->tematica."',fecha_inicio='".$this->fecha_inicio."',fecha_fin='".$this->fecha_fin."' where id=".$this->id." ";
		 $actualizar=ejecutar($query) or die (mysqli_error());

		 return $actualizar;

 }

 public function listar(){

		$query="SELECT * from tematicas where estado=1" ;
		$tabla=ejecutar($query);

		return $tabla;

}
public function listarporCodigo(){

	 $query="SELECT * from tematicas where id='".$this->id."' " ;
	 $tabla=ejecutar($query);

	 return $tabla;

}

public function eliminar(){

		$query="UPDATE tematicas SET estado = '0' where id='".$this->id."'";
		$eliminar=ejecutar($query) or die (mysqli_error());

		return $eliminar;

}

}



 ?>
