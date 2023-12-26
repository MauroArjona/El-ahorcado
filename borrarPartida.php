<?php
// Obtener los datos enviados por URL
$idPartida = $_GET['idPartida'];
require_once 'partida.class.php';
$partida = new Partida();

$resultado = $partida->eliminarPartida($idPartida);
if ($resultado) {
    echo "Partida eliminada";
} else {
    echo "No se pudo eliminar la partida";
}
?>
