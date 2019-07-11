<?php
require_once('../db/conexion.php');
conectar();

class Serie
{
	private $id;
    private $title;
    private $description;
    private $director;
    private $episodes;
    private $seasons;
    private $image;
    private $trailer;
    private $categoriaid;
		private $tematicaid;


 function __construct($id=0,$title="",$description="",$director="",$episodes="",$seasons="",$image="",$trailer="",$categoriaid="", $tematicaid=""){
 $this->id = $id;
 $this->title = $title;
 $this->description = $description;
 $this->director = $director;
 $this->episodes = $episodes;
 $this->seasons = $seasons;
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

     public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription($description){
        return $this->description;
    }

    public function setDirector($director){
    	$this->director = $director;
    }

    public function getDirector($director){
    	return $this->director;
    }

    public function setEpisodes($episodes){
        $this->episodes = $episodes;
    }

    public function getEpisodes($episodes){
        return $this->episodes;
    }

    public function setSeasons($seasons){
        $this->seasons = $seasons;
    }

    public function getSeasons($seasons){
        return $this->seasons;
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

        $query="INSERT INTO series (serie_id, title, description, director, episodes, seasons, image, trailer, categoria_id, estado, id_tematica1)
                VALUES(0,
                       '".$this->title."',
                       '".$this->description."',
                       '".$this->director."',
                       '".$this->episodes."',
                       '".$this->seasons."',
                       '".$this->image."',
                       '".$this->trailer."',
                       '".$this->categoriaid."',1,
										 	 '".$this->tematicaid."');";

        $guardar=ejecutar($query) or die (mysqli_error());
        //$this->db()->error;
        return $guardar;

 	}

     public function actualizar(){

        $query="UPDATE series SET title='".$this->title."',description='".$this->description."' ,director='".$this->director."',episodes='".$this->episodes."',seasons='".$this->seasons."',image='".$this->image."',trailer='".$this->trailer."',categoria_id='".$this->categoriaid."',id_tematica1='".$this->tematicaid."' where serie_id='".$this->id."'";
        $actualizar=ejecutar($query) or die (mysqli_error());

        return $actualizar;

    }

    public function eliminar(){

        $query="UPDATE series SET estado = '0' where serie_id='".$this->id."'";
        $eliminar=ejecutar($query) or die (mysqli_error());

        return $eliminar;

    }

		public function Series(){

        $query="SELECT serie_id, title, description, director, episodes, seasons, trailer, image, cat.descripcion,criticas  FROM series seri LEFT JOIN categorias cat on seri.categoria_id = cat.categoria_id where seri.estado = 1 " ;
        $tabla=ejecutar($query);

        return $tabla;

    }


    public function buscarSerie($palabra){
      	$query = "SELECT serie_id, title, description, director, episodes, seasons, trailer, image, categoria_id  FROM series where  estado = 1 and title like '%".$palabra."%'  " ;
        $tabla = ejecutar($query);

        return $tabla;

    }

		public function listaseries(){

		        $query="SELECT s.serie_id,s.title,s.description, s.director, s.episodes,s.seasons,s.image,s.trailer,ca.descripcion,ca.categoria_id from series s inner join categorias ca on s.categoria_id=ca.categoria_id where s.estado = 1 order by s.serie_id DESC" ;
		        $tabla=ejecutar($query);


		        return $tabla;


}

public function sumacrit(){
		$query = "UPDATE series set criticas = criticas + 1 where serie_id = '".$this->id."'";
		$sum = ejecutar($query) or die (mysqli_error());
		return $sum;

}


public function restarcrit(){
		 $query = "UPDATE series set criticas =  criticas - 1 where serie_id = '".$this->id."'";
		$res = ejecutar($query) or die (mysqli_error());
		return $res;
}

public function getSeriebyCod(){
		$query="SELECT s.serie_id,s.title,s.description, s.director, s.episodes,s.seasons,s.image,s.trailer,ca.descripcion,ca.categoria_id ,t.tematica,t.id from series s inner join categorias ca on s.categoria_id=ca.categoria_id inner join tematicas t on s.id_tematica1=t.id where s.serie_id = '".$this->id."' " ;
		
		;$tabla=ejecutar($query);
		$row = mysqli_fetch_array($tabla);

		return $row;
}

}



 ?>
