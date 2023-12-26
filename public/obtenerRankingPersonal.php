<?php
session_start();
require_once 'ranking.class.php';
$idUsuario = $_SESSION['idUsuario'];
$ranking = new ranking();
$estadistica = $ranking->obtenerEstadisticaPersonal($idUsuario);

if ($estadistica !== null) {
   
    $estadisticaObj = new StdClass();
    $estadisticaObj->totalAdivinadas = $estadistica->getTotalAdivinadas();
    $estadisticaObj->tiempoMinimo = $estadistica->getTiempoMinimo();
    $estadisticaObj->tiempoMaximo = $estadistica->getTiempoMaximo();

    $myJSON = json_encode($estadisticaObj);
    echo $myJSON;
} else {
    echo "No hay estadísticas disponibles.";
}
?>
