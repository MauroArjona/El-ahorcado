<?php
require_once 'config.php';

class palabra {
	
	private $palabra;
	private $dificultad;


	
	public function __construct(){
		
	}
		
	public function getPalabra(){
		return $this->palabra;
	}
	
	public function setPalabra($palabra){
		$this->palabra = $palabra;
	}
		
	public function getDificultad(){
		return $this->dificultad;
	}
	
	public function setDificultad($dificultad){
		$this->dificultad = $dificultad;
	}

	
	public static function obtenerPalabra($dificultad) {
		$conexion = conectarBD();
		$consulta = "SELECT * FROM palabras WHERE palabras.nivelDificultad = '$dificultad'";
		$listado = $conexion->query($consulta) or die("No se pudo realizar la consulta");
		$palabras = array();
		while ($registro = $listado->fetch_object()) {
			$palabra = new palabra();
			$palabra->setPalabra($registro->palabra);
			$palabras[] = $palabra;
		}
	
		$listado->free();
		$conexion->close();
		
		//obtengo una palabra aleatoria segun el nivel de dificultad elejido
        $palabraAleatoria = null;
    if (!empty($palabras)) {
        $indiceAleatorio = array_rand($palabras);
        $palabraAleatoria = $palabras[$indiceAleatorio];
    }
		return $palabraAleatoria;
	}

}
?>

