<?php
session_start();
// Obtener los datos enviados por URL
$idUsuario = $_SESSION['idUsuario']; 
require_once 'clases/partida.class.php';
$partida = new Partida();
$partidas = $partida->obtenerPartidas($idUsuario);

if (count($partidas) > 0) { 
    $Listadopartidas = array();

    foreach ($partidas as $partida) {
        $partidaObj = new StdClass();
        $partidaObj->idPartida = $partida->getIdPartida();
        $partidaObj->tiempo = $partida->getTiempo();
        $partidaObj->palabra = $partida->getPalabra();
        $partidaObj->letrasAcertadas = $partida->getLetrasAcertadas();
		$partidaObj->letrasErradas = $partida->getLetrasErradas();
        $partidaObj->cantidadErrores = $partida->getCantidadErrores();

        $Listadopartidas[] = $partidaObj;
    }
    
    $myJSON = json_encode($Listadopartidas);
    echo $myJSON;
} else {
    echo "No hay partidas disponibles.";
}
?>
