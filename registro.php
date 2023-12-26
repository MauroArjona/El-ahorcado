<?php
session_start();
// Inicializar variables para que el formulario que cargue con los valores ingresados anteriormente.
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
$fechaNacimiento = isset($_SESSION['fechaNacimiento']) ? $_SESSION['fechaNacimiento'] : '';
$paisResidencia = isset($_SESSION['paisResidencia']) ? $_SESSION['paisResidencia'] : '';
include_once "usuario.class.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Registrando Usuario</title>
<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<article>
			<?php
			if (isset($_POST['registro'])) {
				$nombre = trim($_POST['nombre']);
				$correo = trim($_POST['Correo']);
				$contrasena = trim($_POST['Contrasena']);
				$fechaNacimiento = trim($_POST['fecha']);
				$paisResidencia = trim($_POST['Pais']);
				$fechaActual = time();
				$fechaLimite = strtotime('1900-01-01');

				if (empty($nombre) || empty($correo) || empty($contrasena) || empty($fechaNacimiento) || empty($paisResidencia)) {
					$error = "ERROR ! Todos los campos son obligatorios. Por favor, complete todos los campos.";
					$_SESSION['error'] = $error;
				} elseif (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $contrasena)) {
					$error = "ERROR ! La contraseña no cumple con los requisitos. Por favor, escríbala nuevamente.";
					$_SESSION['error'] = $error;
				} else {
					$fechaNacimientoTimestamp = strtotime($fechaNacimiento);
					if ($fechaNacimientoTimestamp === false || $fechaNacimientoTimestamp > $fechaActual || $fechaNacimientoTimestamp < $fechaLimite) {
						$error = "ERROR ! La fecha de nacimiento debe estar entre 1900 y la fecha actual. Por favor, ingrese una fecha válida.";
						$_SESSION['error'] = $error;
					} else {
						// En caso de error, configurar las variables de sesión para mantener los valores del formulario
						$_SESSION['nombre'] = $nombre;
						$_SESSION['correo'] = $correo;
						$_SESSION['fechaNacimiento'] = $fechaNacimiento;
						$_SESSION['paisResidencia'] = $paisResidencia;

						$usuario = new usuario();
						$usuario->setNombre($nombre);
						$usuario->setCorreo($correo);
						$contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
						$usuario->setContrasena($contrasenaEncriptada);
						$usuario->setFechaNacimiento($fechaNacimiento);
						$usuario->setPaisResidencia($paisResidencia);
						// Llamo al método RegistrarUsuario para insertar los datos en la base de datos
						$registroExitoso = $usuario->RegistrarUsuario();

						if ($registroExitoso) {
							$registro = "Cuenta creada exitosamente.";
							$_SESSION['REGISTRO'] = $registro;
							//elimino las sessiones para que no se mantengan los valores en el formulario
							unset($_SESSION['nombre']);
							unset($_SESSION['fechaNacimiento']);
							unset($_SESSION['correo']);
							unset($_SESSION['paisResidencia']);
							header("Location: index.php");
							exit();
						} else {
							header("Location: registro.php");
							exit();
						}
					}
				}
			}
			?>
			<form id="idformu1" name="formu1" method="post">
				<div class="grupo">
					<h2>Registrarse</h2>
					<?php
					if (!empty($_SESSION['error'])) {
						echo '<div class="contenedorError">' . $_SESSION['error'] . '</div>';
						unset($_SESSION['error']);
					}
					?>
					<label for="nombre">Nombre de usuario </label>
					<input name="nombre" type="text" placeholder="Debe tener al menos 8 caracteres alfanuméricos" value="<?= isset($nombre) ? htmlspecialchars($nombre) : '' ?>" required>
					<label for="Correo">Correo electrónico</label>
					<input name="Correo" type="email" placeholder="Ingrese su correo electrónico" value="<?= isset($correo) ? htmlspecialchars($correo) : '' ?>" required>
					<label for="Contrasena">Contraseña </label>
					<input name="Contrasena" type="password" placeholder="Ingrese una contraseña" required>
					<span class="atencion">Debe contener al menos 8 caracteres alfanuméricos,<br> con al menos un número, una letra mayúscula y una letra minúscula.</span>
					<label for="fecha">Fecha de Nacimiento </label>
					<input name="fecha" type="date" value="<?= isset($fechaNacimiento) ? htmlspecialchars($fechaNacimiento) : '' ?>" max="9999-12-31" required>
					<label for="Pais">País de residencia </label>
					<input name="Pais" type="text" placeholder="Ingrese su país de residencia" value="<?= isset($paisResidencia) ? htmlspecialchars($paisResidencia) : '' ?>" required>
					<button class="boton" type="submit" id="idregistro" name="registro">Registrarse</button>
				</div>
			</form>
		</article>
	</section>
</body>
</html>
				