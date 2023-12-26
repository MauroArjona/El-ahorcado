<?php
session_start();
// Obtener los datos enviados por URL
$idUsuario = $_SESSION['idUsuario']; 
$palabrita = $_GET['palabrita'];
$tiempoTranscurrido = $_GET['tiempoTranscurrido'];
$cant_errores = $_GET['cant_errores'];
$letrasAcertadas = $_GET['letrasAcertadas'];
$letrasErradas = $_GET['letrasErradas'];

require_once 'partida.class.php';
$partida = new Partida();

// Establecer las propiedades de la partida
$partida->setIdUsuario($idUsuario);
$partida->setPalabra($palabrita);
$partida->setTiempo($tiempoTranscurrido);
$partida->setCantidadErrores($cant_errores);
$partida->setLetrasAcertadas($letrasAcertadas);
$partida->setLetrasErradas($letrasErradas);

$resultado = $partida->registrarPartida();
if($resultado){
	echo "Partida guardada";
}else{
	echo "no se pudo guardar la partida";
}
?>
