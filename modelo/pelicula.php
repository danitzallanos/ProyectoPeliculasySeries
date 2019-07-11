<?php
require_once('../db/conexion.php');
conectar();

class Pelicula
{
	private $id;
    private $title;
    private $duration;
    private $director;
    private $puntuacion;
    private $description;
    private $image;
    private $trailer;
    private $categoriaid;
		private $tematicaid;


 function __construct($id=0,$title="",$duration="",$director="",$puntuacion="",$description="",$image="",$trailer="",$categoriaid="", $tematicaid=""){
 $this->id = $id;
 $this->title = $title;
 $this->duration = $duration;
 $this->director = $director;
 $this->puntuacion = $puntuacion;
 $this->description = $description;
 $this->image = $image;
 $this->trailer = $trailer;
 $this->categoriaid = $categoriaid;
 $this->tematicaid =  $tematicaid;
 }

    public function setId($id){
    	$this->id = $id;
    }

    public function getId($id){
    	return $this->id;
    }

    public function setTitle($title){
    	$this->title = $title;
    }

    public function getTitle($title){
        return $this->title;
    }

    public function setDuration($duration){
      $this->duration = $duration;
    }

    public function getDuration($duration){
      return $this->duration;
    }
    public function setDirector($director){
      $this->director = $director;
    }

    public function getDirector($director){
      return $this->director;
    }

    public function setPuntuacion($puntuacion){
      $this->puntuacion = $puntuacion;

    }
    public function getPuntuacion($puntuacion){
      return $this->puntuacion;
    }

     public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription($description){
        return $this->description;
    }

    public function setImage($image){
        $this->image = $image;
    }
    public function getImage($image){
        return $this->image;
    }

    public function setTrailer($trailer){
    	$this->trailer = $trailer;
    }

    public function getTrailer($trailer){
    	return $this->trailer;
    }

      public function setCategoriaid($categoriaid){
        $this->categoriaid = $categoriaid;
    }

    public function getCategoriaid($categoriaid){
        return $this->categoriaid;
    }
		public function setTematicaid($tematicaid){
			$this->tematicaid = $tematicaid;
	}

	public function getTematicaid($tematicaid){
			return $this->tematicaid;
	}

    public function Guardar(){

        $query="INSERT INTO movies (movie_id, title, duration, director, puntuacion, description, image, trailer, categoria_id, estado, id_tematica1)
                VALUES(0,
                       '".$this->title."',
                       '".$this->duration."',
                       '".$this->director."',
                       '".$this->puntuacion."',
                       '".$this->description."',
                       '".$this->image."',
                       '".$this->trailer."',
                       '".$this->categoriaid."',1,
										 	 '".$this->tematicaid."');";
											 echo $query;
        $guardar=ejecutar($query) or die (mysqli_error());
        //$this->db()->error;
        return $guardar;

 	}

     public function actualizar(){

        $query="UPDATE movies SET title='".$this->title."',duration='".$this->duration."',director='".$this->director."',puntuacion='".$this->puntuacion."',description='".$this->description."',image='".$this->image."',trailer='".$this->trailer."',categoria_id='".$this->categoriaid."',id_tematica1='".$this->tematicaid."' where movie_id='".$this->id."'";
        $actualizar=ejecutar($query) or die (mysqli_error());

        return $actualizar;

    }

    public function eliminar(){

        $query="UPDATE movies SET estado = '0' where movie_id='".$this->id."'";
        $eliminar=ejecutar($query) or die (mysqli_error());

        return $eliminar;

    }


    public function Peliculas(){

        $query="SELECT movie_id, title, description, duration, director, image, puntuacion, trailer, cat.descripcion,criticas  FROM movies mov LEFT JOIN categorias cat on mov.categoria_id = cat.categoria_id where mov.estado = 1 " ;
        $tabla=ejecutar($query);

        return $tabla;

    }


		public function PeliculasySeries(){

        $query="SELECT movie_id, title, image,criticas  FROM movies UNION ALL SELECT serie_id, title, image,criticas  FROM series  " ;
        $tabla=ejecutar($query);

        return $tabla;

    }


    public function buscarPelicula($palabra){
      	$query = "SELECT movie_id, title, description, duration, director, image, puntuacion, trailer, categoria_id  FROM movies where  estado = 1 and title like '%".$palabra."%'  " ;
        $tabla = ejecutar($query);

        return $tabla;

    }
		public function listapeliculas(){

		        $query="SELECT m.movie_id,m.title,m.duration, m.director, m.puntuacion,m.description,m.image,m.trailer,ca.descripcion,ca.categoria_id from movies m inner join categorias ca on m.categoria_id=ca.categoria_id where m.estado = 1 order by m.movie_id DESC" ;
		        $tabla=ejecutar($query);


		        return $tabla;


}

public function sumacrit(){
		$query = "UPDATE movies set criticas = criticas + 1 where movie_id = '".$this->id."'";
		$sum = ejecutar($query) or die (mysqli_error());
		return $sum;

}


public function restarcrit(){
		 $query = "UPDATE movies set criticas =  criticas - 1 where movie_id = '".$this->id."'";
		$res = ejecutar($query) or die (mysqli_error());
		return $res;
}


public function getPeliculabyCod(){
		$query="SELECT m.movie_id,m.title,m.duration, m.director, m.puntuacion,m.description,m.image,m.trailer,ca.descripcion,ca.categoria_id,t.tematica,t.id from movies m inner join categorias ca on m.categoria_id=ca.categoria_id inner join tematicas t on m.id_tematica1=t.id where m.movie_id = '".$this->id."' " ;
		$tabla=ejecutar($query);
		$row = mysqli_fetch_array($tabla);

		return $row;
}

}

 ?>
