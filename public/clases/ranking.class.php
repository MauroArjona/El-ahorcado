<?php
require_once 'config.php';

class ranking {
	
	private $idUsuario;
	private $nombre;
	private $palabra;
	private $tiempo;
	private $tiempoMinimo;
	private $tiempoMaximo;
	private $totalAdivinadas;

	public function __construct(){
		
	}
	
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	
	public function getPalabra(){
		return $this->palabra;
	}
	
	public function setPalabra($palabra){
		$this->palabra = $palabra;
	}
	public function getTiempo(){
		return $this->tiempo;
	}
	
	public function setTiempo($tiempo){
        $this->tiempo = $tiempo;
    }
	
		public function getTiempoMinimo(){
		return $this->tiempoMinimo;
	}

	public function setTiempoMinimo($tiempoMinimo){
		$this->tiempoMinimo = $tiempoMinimo;
	}

	public function getTiempoMaximo(){
		return $this->tiempoMaximo;
	}

	public function setTiempoMaximo($tiempoMaximo){
		$this->tiempoMaximo = $tiempoMaximo;
	}
	
	public function getTotalAdivinadas(){
		return $this->totalAdivinadas;
	}

	public function setTotalAdivinadas($totalAdivinadas){
		$this->totalAdivinadas = $totalAdivinadas;
	}
	
	    public function registrarEstadistica() {
		$conexion = conectarBD();
        $idUsuario = $conexion->real_escape_string($this->idUsuario);
        $palabra = $conexion->real_escape_string($this->palabra);
        $tiempo = $conexion->real_escape_string($this->tiempo);

        $consulta = "INSERT INTO ranking (idUsuario, palabra, tiempo) VALUES ('$idUsuario', '$palabra', '$tiempo')";
        $resultado = $conexion->query($consulta);
        $conexion->close();

        return $resultado ? true : false;
    }

	 public static function obtenerEstadisticas() {
		$conexion = conectarBD();

		// Consulta para obtener las estadísticas del usuario
		$consulta = "SELECT u.nombre, r.palabra, r.tiempo 
					FROM ranking r 
					INNER JOIN usuario u ON r.idUsuario = u.idUsuario
					ORDER BY r.tiempo ASC";
		$resultados = $conexion->query($consulta);

		$listaRankings = array();

		while ($registro = $resultados->fetch_object()) {
			$ranking = new ranking();
			$ranking->setNombre($registro->nombre);
			$ranking->setPalabra($registro->palabra);
			$ranking->setTiempo($registro->tiempo);
			$listaRankings[] = $ranking;
		}

		$resultados->free();
		$conexion->close();

		return $listaRankings;
	}

	
	
	   public static function obtenerEstadisticaPersonal($idUsuario) {
		$conexion = conectarBD();

		$idUsuario = $conexion->real_escape_string($idUsuario);

		// Consulta para obtener las estadísticas del usuario
		$consulta = "SELECT COUNT(*) AS totalAdivinadas, MIN(tiempo) AS tiempoMinimo, MAX(tiempo) AS tiempoMaximo FROM ranking WHERE idUsuario = '$idUsuario'";
		$resultados = $conexion->query($consulta);

		$estadisticaPersonal = $resultados->fetch_object();
		
		$ranking = new ranking();
		$ranking->setTotalAdivinadas($estadisticaPersonal->totalAdivinadas);
		$ranking->setTiempoMinimo($estadisticaPersonal->tiempoMinimo);
		$ranking->setTiempoMaximo($estadisticaPersonal->tiempoMaximo);

		$resultados->free();
		$conexion->close();

		return $ranking;
	}

}
?>

