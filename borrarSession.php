<?php
session_start();
session_unset(); // Limpiar todas las variables de sesión.
session_destroy(); // Destruir la sesión.

// Redireccionar a la página de inicio.
header("Location: index.php");
exit();
?>
