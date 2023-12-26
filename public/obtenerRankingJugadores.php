<?php
require_once 'ranking.class.php';
$ranking = new ranking();
// Obtener las estadísticas
$estadisticas = $ranking->obtenerEstadisticas();

if (!empty($estadisticas)) {
    $estadisticasArray = array();
    foreach ($estadisticas as $estadistica) {
        $estadisticaObj = new StdClass();
        $estadisticaObj->nombre = $estadistica->getNombre();
        $estadisticaObj->palabra = $estadistica->getPalabra();
        $estadisticaObj->tiempo = $estadistica->getTiempo();

        $estadisticasArray[] = $estadisticaObj;
    }

    $myJSON = json_encode($estadisticasArray);
    echo $myJSON;
} else {
    echo "No hay estadísticas disponibles.";
}
?>
