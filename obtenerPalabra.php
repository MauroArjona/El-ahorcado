<?php
include_once("palabra.class.php");
$dificultad = $_GET['dificultad'];
$palabra = palabra::obtenerPalabra($dificultad);

if (!empty($palabra)) { 
			$objTemp = new StdClass();
			$objTemp->palabra =$palabra->getPalabra();
        }
    $myJSON =json_encode($objTemp);
	
echo $myJSON;
?>

