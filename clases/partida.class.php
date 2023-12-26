<?php
class partida {
	
	private $idPartida;
	private $idUsuario;
	private $palabra;
	private $tiempo;
	private $cantidadErrores;
	private $letrasAcertadas;
	private $letrasErradas;

	
	public function __construct(){
		
	}
	
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	
	public function getIdpartida(){
		return $this->idPartida;
	}
	
	public function setIdPartida($idPartida){
		$this->idPartida = $idPartida;
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
	
		
	public function getCantidadErrores(){
		return $this->cantidadErrores;
	}
	
	public function setCantidadErrores($cantidadErrores){
		$this->cantidadErrores = $cantidadErrores;
	}
		
	public function getLetrasAcertadas(){
		return $this->letrasAcertadas;
	}
	
	public function setLetrasAcertadas($letrasAcertadas){
		$this->letrasAcertadas = $letrasAcertadas;
	}
	
	public function getLetrasErradas(){
		return $this->letrasErradas;
	}
	
	public function setLetrasErradas($letrasErradas){
		$this->letrasErradas = $letrasErradas;
	}

	 
	public function RegistrarPartida() {
    $conexion = new mysqli("localhost", "root", "1234", "ahorcado") or die("No es posible conectarse al motor de BD");

    $idUsuario = $conexion->real_escape_string($this->idUsuario);
    $palabra = $conexion->real_escape_string($this->palabra);
    $tiempo = $conexion->real_escape_string($this->tiempo);
    $cantidadErrores = $conexion->real_escape_string($this->cantidadErrores);
    $letrasAcertadas = $conexion->real_escape_string($this->letrasAcertadas);
	$letrasErradas = $conexion->real_escape_string($this->letrasErradas);

    $consulta = "INSERT INTO partida (idUsuario, palabra, tiempo, cantidadErrores, letrasAcertadas , letrasErradas) VALUES ('$idUsuario', '$palabra', '$tiempo', '$cantidadErrores', '$letrasAcertadas', '$letrasErradas')";

    $resultado = $conexion->query($consulta);

    if ($resultado) {
        // La partida se registró correctamente
        return true;
    } else {
        // Ocurrió un error al registrar la partida
        return false;
    }

    $conexion->close();
}

	 public static function obtenerPartidas($idUsuario) {
		$conexion = new mysqli("localhost", "root", "1234", "ahorcado") or die("No es posible conectarse al motor de BD");
		$consulta = "SELECT * FROM partida WHERE partida.idUsuario = ".$idUsuario;
		$listado = $conexion->query($consulta) or die("No se pudo realizar la consulta");
		$partidas = array();
		while ($registro = $listado->fetch_object()) {
        $partida = new partida();
        $partida->setIdPartida($registro->idPartida);
        $partida->setTiempo($registro->tiempo);
        $partida->setPalabra($registro->palabra);
        $partida->setCantidadErrores($registro->cantidadErrores);
		$partida->setLetrasErradas($registro->letrasErradas);
		
		//para agregar una "," despues de cada letra 
        $letrasString = '';
        $letrasArray = str_split($registro->letrasAcertadas);
        foreach ($letrasArray as $letra) {
            $letrasString .= $letra.",";
        }

        $partida->setLetrasAcertadas($letrasString);
        $partidas[] = $partida;
    }

    $listado->free();
    $conexion->close();

    return $partidas;
	}
	
	public function actualizarPartida() {
		$conexion = new mysqli("localhost", "root", "1234", "ahorcado") or die("No es posible conectarse al motor de BD");

		$idPartida = $conexion->real_escape_string($this->idPartida);
		$palabra = $conexion->real_escape_string($this->palabra);
		$tiempo = $conexion->real_escape_string($this->tiempo);
		$cantidadErrores = $conexion->real_escape_string($this->cantidadErrores);
		$letrasAcertadas = $conexion->real_escape_string($this->letrasAcertadas);
		$letrasErradas = $conexion->real_escape_string($this->letrasErradas);

		$consulta = "UPDATE partida SET palabra = '$palabra', tiempo = '$tiempo', cantidadErrores = '$cantidadErrores', letrasAcertadas = '$letrasAcertadas', letrasErradas = '$letrasErradas' WHERE idPartida = '$idPartida'";

		$resultado = $conexion->query($consulta);
		if ($resultado) {
			// La partida se actualizó correctamente
			return true;
		} else {
			// Ocurrió un error al actualizar la partida
			return false;
		}

		$conexion->close();
   }

	public function eliminarPartida($idPartida) {
		$conexion = new mysqli("localhost", "root", "1234", "ahorcado") or die("No es posible conectarse al motor de BD");

		$idPartida = $conexion->real_escape_string($idPartida);
		$consulta = "DELETE FROM partida WHERE idPartida =" .$idPartida;
		$resultado = $conexion->query($consulta);

		if ($resultado) {
			// La partida se eliminó correctamente
			return true;
		} else {
			// Ocurrió un error al eliminar la partida
			return false;
		}

		$conexion->close();
	}

}
?>

