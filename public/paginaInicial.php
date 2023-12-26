<?php
session_start();
if(isset($_SESSION['paginaInicial'])){?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Pagina inicio</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
	<body>
		<section>
			<article>
					<script>
						function seleccionarNivel() {
							var select = document.getElementById("nivel");
							var nivelSeleccionado = select.value;
							var peticion = new XMLHttpRequest();
							peticion.open("GET", "obtenerPalabra.php?dificultad=" + nivelSeleccionado , true);
							peticion.onreadystatechange = cargoPalabra;
							peticion.send(null);
							
							function cargoPalabra() {
								if (peticion.readyState == 4 && peticion.status == 200) {
									var myObjeto = JSON.parse(peticion.responseText);
									// Almacenar la palabra en el almacenamiento local
									localStorage.setItem('palabra', myObjeto.palabra);
									localStorage.setItem('globalBandera', false);
						
									<?php
									//para que pueda acceder a la interfaz de juego.php
									$_SESSION['juego.php'] = true;
									//para que pueda acceder a la tabla de ranking de jugadores
									$_SESSION['mostrarRankingJugadores.php'] = true;
									?>
									
									// Redireccionar a la página juego.php
									window.location.href = 'juego.php';
								}
							}
						}
						
								//es para poder acceder a la pagina mostrarRankingPersonal necesito usar la session para que no accedan de forma directa a la pagina
								function mostrarRankingPersonal() {
								  <?php $_SESSION['mostrarRankingPersonal'] = true; ?>
								  window.location.href = 'mostrarRankingPersonal.php';
								}
								
									//es para poder acceder a la pagina mostrarPartidas necesito usar la session para que no accedan de forma directa a la pagina
								function mostrarPartidas() {
								  <?php $_SESSION['mostrarPartidas'] = true; ?>
								  window.location.href = 'mostrarPartidas.php';
								}	
					</script>
		
					<?php
					if(isset($_SESSION['paginaInicial'])){?>
					<div class="contenedor">
						<div class="grupo">
							<h1>Ahorcado</h1>
							<span class="subtitulo" style="font-size: 20px;">¿Juego nuevo? elija el nivel de dificultad</span>
							<select name="nivel" id="nivel" onchange="seleccionarNivel()">
								<option value=""disabled selected>Elija el nivel de dificultad para comenzar</option>
								<option value="facil">Fácil</option>
								<option value="media">Media</option>
								<option value="dificil">Difícil</option>
							</select>
							<button class="boton" id="continuar" onclick="mostrarPartidas()">Continuar</button>
							<button class="boton" id="volver" onclick="mostrarRankingPersonal()">Ranking</button>
							<button class="boton" onclick="window.location.href = 'borrarSession.php';">Cerrar sesión</button>
						</div>
					</div> 
					<?php
					}
					?>
			</article>
		</section>
	</body>
</html>
<?php
}else{
	echo "No tienes permiso para acceder a esta pagina inicie sesion primero";
	header("refresh:3;url=../index.php");
}?>