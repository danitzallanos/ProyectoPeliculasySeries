<?php
require_once('../db/conexion.php');
conectar();

class Noticia
{
	private $id;
    private $titulo;
    private $noticia;
    private $image;


 function __construct($id=0,$titulo="",$noticia="",$image=""){
 $this->id = $id;
 $this->titulo = $titulo;
 $this->noticia = $noticia;
 $this->image = $image;
 }

    public function setId($id){
    	$this->id = $id;
    }

    public function getId($id){
    	return $this->id;
    }

    public function setTitulo($titulo){
    	$this->titulo = $titulo;
    }

    public function getTitulo($titulo){
        return $this->titulo;
    }

    public function setNoticia($noticia){
      $this->noticia = $noticia;
    }

    public function getNoticia($noticia){
      return $this->noticia;
    }

    public function setImage($image){
        $this->image = $image;
    }
    public function getImage($image){
        return $this->image;
    }


    public function Guardar(){

        $query="INSERT INTO news (new_id, titulo, noticia,image, estado)
                VALUES(0,
                       '".$this->titulo."',
                       '".$this->noticia."',

                       '".$this->image."',1);";
        $guardar=ejecutar($query) or die (mysqli_error());
        //$this->db()->error;
        return $guardar;

 	}

     public function actualizar(){

			 $query="UPDATE news SET titulo='".$this->titulo."',noticia='".$this->noticia."',image='".$this->image."'  where  new_id='".$this->id."'";;
			 $actualizar=ejecutar($query) or die (mysqli_error());

			 return $actualizar;

  }

    public function eliminar(){

        $query="UPDATE news SET estado = '0' where new_id='".$this->id."'";
        $eliminar=ejecutar($query) or die (mysqli_error());

        return $eliminar;

    }

		public function Noticias(){

				$query="SELECT new_id, titulo, noticia,image from news where estado=1" ;
				$tabla=ejecutar($query);

				return $tabla;

		}


		public function buscarNew($palabra){
				$query = "SELECT new_id, titulo, noticia, image  FROM news where  estado = 1 and titulo like '%".$palabra."%'  " ;
				$tabla = ejecutar($query);

				return $tabla;

		}

/*	public function getSeriebyCod(){
		$query="SELECT s.serie_id,s.title,s.description, s.director, s.episodes,s.seasons,s.image,s.trailer,ca.descripcion,ca.categoria_id from series s inner join categorias ca on s.categoria_id=ca.categoria_id where s.serie_id = '".$this->id."' " ;
		$tabla=ejecutar($query);
		$row = mysqli_fetch_array($tabla);

		return $row; *
	}
*/
	}



	?>
