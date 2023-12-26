<?php
session_start();
if(isset($_SESSION['mostrarRankingJugadores.php'])){ ?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Mostrar ranking jugadores</title>
<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<article>
			<script> 
				function verRanking() {
					var peticion = new XMLHttpRequest();
					peticion.open("GET", "obtenerRankingJugadores.php", true);
					peticion.onreadystatechange = verRankingJugadores;
					peticion.send(null);

					function verRankingJugadores() {
						if (peticion.readyState == 4 && peticion.status == 200) {
							var jugadores = JSON.parse(peticion.responseText);
							var tabla = document.getElementById("tabla");
							tabla.innerHTML = "";

							for (var i = 0; i < jugadores.length; i++) {
								var jugador = jugadores[i];

								var filaJugador = document.createElement("tr");

								var celdaAdivinadas = document.createElement("td");
								celdaAdivinadas.textContent = jugador.nombre;
								filaJugador.appendChild(celdaAdivinadas);

								var celdaTiempoMinimo = document.createElement("td");
								celdaTiempoMinimo.textContent = jugador.palabra;
								filaJugador.appendChild(celdaTiempoMinimo);

								var celdaTiempoMaximo = document.createElement("td");
								celdaTiempoMaximo.textContent = jugador.tiempo;
								filaJugador.appendChild(celdaTiempoMaximo);

								tabla.appendChild(filaJugador);
							}
						}
					}
				}

				verRanking();
			</script>
					
				<div class="grupo">
					<h1 id="titulo">Ranking Jugadores</h1>
					<div class="table-container">
						<table class="borde">
						<thead>
							<tr>
							<th class="encabezado">Nombre</th>
							<th class="encabezado">Palabra adivinada</th>
							<th class="encabezado">Tiempo</th>
							</tr>
						</thead>
						<tbody id="tabla"></tbody>
						</table>
					</div>
					<button id="volver" onclick="volverPaginaInicial()">Volver</button>
						
					<script>
						//es para poder volver a la paginaInicial necesito usar la session para que no accedan de forma directa a la pagina
						function volverPaginaInicial() {
						<?php $_SESSION['paginaInicial'] = true; ?>
						window.location.href = 'paginaInicial.php';
						}
					</script>
			</div>      
		</article>
	</section>
</body>
</html>
<?php
}else{
	echo "No tienes permiso para acceder a esta pagina inicie sesion primero";
	header("refresh:3;url=index.php");
}
?>
