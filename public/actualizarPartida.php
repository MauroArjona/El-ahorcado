<?php
// Obtener los datos enviados por URL
$idPartida = $_GET['idPartida'];
$palabrita = $_GET['palabrita'];
$tiempoTranscurrido = $_GET['tiempoTranscurrido'];
$cant_errores = $_GET['cant_errores'];
$letrasAcertadas = $_GET['letrasAcertadas'];
$letrasErradas = $_GET['letrasErradas'];

require_once 'clases/partida.class.php';
$partida = new Partida();

// Establecer las propiedades de la partida
$partida->setIdPartida($idPartida);
$partida->setPalabra($palabrita);
$partida->setTiempo($tiempoTranscurrido);
$partida->setCantidadErrores($cant_errores);
$partida->setLetrasAcertadas($letrasAcertadas);
$partida->setLetrasErradas($letrasErradas);

$resultado = $partida->actualizarPartida();
?>
