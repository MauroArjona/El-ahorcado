<!DOCTYPE html>
<html lang="es">
<head>
<title>Iniciando Sesion</title>
<link rel="stylesheet" type="text/css" href="public/css/estilo.css">
</head>
	<body>
		<section>
			<article>
				<main>
			       <?php
						include_once "public/clases/usuario.class.php";
						session_start();

						if (isset($_POST['submit'])) {
							$nombre = $_POST['usuario'];
							$_SESSION['nombreUsuario'] = $nombre;
							$contrasena = $_POST['Contrasena'];
							
							// Verifica el usuario y la contraseña
							$usuario = usuario::VerificarUsuario($nombre, $contrasena);
							if($usuario !== null){
								$_SESSION['idUsuario'] = $usuario->getIdUsuario();
								//verifica que la contrasena coincida con el nombre de usuario
								if ($usuario !== null && password_verify($contrasena, $usuario->getContrasena())) {
									// Inicio de sesión exitoso, redirigir a la página deseada
									unset($_SESSION['nombreUsuario']);
									$_SESSION['paginaInicial'] = true;
									header("Location: public/paginaInicial.php");
									exit();
								} else {
									// Datos de inicio de sesión incorrectos, mostrar mensaje de error
									$error = "Contraseña incorrecta";
									$_SESSION['ERROR'] = $error;
								}
							}else{
									// Datos de inicio de sesión incorrectos, mostrar mensaje de error
									$error = "El usuario ingresado no existe.";
									$_SESSION['ERROR'] = $error;
								}
						}
						?>
					
						  <form id="idformu" name="formu" method="post" action="index.php">
							   <div class="grupo">
								 <h2>Ingresar Sesion</h2>
								 <?php
								if (isset($_SESSION['ERROR'])) {
									echo '<div class="contenedorError">' . $_SESSION['ERROR'] . '</div>';
									unset($_SESSION['ERROR']);
								}else if(isset($_SESSION['REGISTRO'])){
									echo '<div class="contenedorRegistro">' . $_SESSION['REGISTRO'] . '</div>';
									unset($_SESSION['REGISTRO']);
								}
								?>
								<label for="usuario">Nombre de usuario:</label>
								<input id="usuario" name="usuario" type="text" value="<?php echo isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario'] : '' ?>" required>
								<label for="contrasena">Contraseña:</label>
								<input id="contrasena" name="Contrasena" type="password" required>
								<button class="boton" type="submit" id="idIniciarSesion" name="submit">Iniciar Sesion</button>
								 <p>¿No tienes una cuenta? <a href="public/registro.php?registrarse">Registrarse</a></p>
							</div>
					   </form>  
					</main>
			</article>
		</section>
	</body>
</html>
