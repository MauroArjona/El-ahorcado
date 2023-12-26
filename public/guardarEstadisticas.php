<?php
session_start();
// Obtener los datos enviados por URL
$idUsuario = $_SESSION['idUsuario']; 
$palabrita = $_GET['palabrita'];
$tiempoTranscurrido = $_GET['tiempoTranscurrido'];

require_once 'clases/ranking.class.php';
$ranking = new ranking();

// Establecer las propiedades de la partida
$ranking->setIdUsuario($idUsuario);
$ranking->setPalabra($palabrita);
$ranking->setTiempo($tiempoTranscurrido);

$resultado = $ranking->registrarEstadistica();
if($resultado){
	echo "estadistica guardada";
}else{
	echo "no se pudo guardar la estadistica";
}
?>
