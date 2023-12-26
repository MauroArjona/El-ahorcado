<?php
session_start();
if(isset($_SESSION['mostrarPartidas'])){ ?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Mostrar Partidas</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
	<body>
		<section>
			<article>
				<script>
					function seleccionarPartida() {
								var peticion = new XMLHttpRequest();
								peticion.open("GET", "obtenerPartidas.php", true);
								peticion.onreadystatechange = verPartidasGuardadas;
								peticion.send(null);
								
								function verPartidasGuardadas() {
									if (peticion.readyState == 4 && peticion.status == 200) {
										var myObjeto = JSON.parse(peticion.responseText);
										var tabla = document.getElementById("tabla");
										
											tabla.innerHTML = "";
											myObjeto.forEach(function (partida) {
											var filaProducto = document.createElement("tr");

											var celdaCliente = document.createElement("td");
											celdaCliente.textContent = partida.idPartida;
											filaProducto.appendChild(celdaCliente);

											var celdaDocumento = document.createElement("td");
											celdaDocumento.textContent = partida.cantidadErrores;
											filaProducto.appendChild(celdaDocumento);

											var celdaCuenta = document.createElement("td");
											celdaCuenta.textContent = partida.letrasAcertadas;
											filaProducto.appendChild(celdaCuenta);

											var celdaTipo = document.createElement("td");
											celdaTipo.textContent =  partida.tiempo;
											filaProducto.appendChild(celdaTipo);

											var celdaBoton = document.createElement("td");
											var boton = document.createElement("input");
											boton.type = 'button';
											boton.id = 'miInput';
											boton.value = 'Continuar';
											
											boton.addEventListener("click", function() {
													continuarPartida(partida.cantidadErrores,partida.letrasAcertadas,partida.letrasErradas,partida.tiempo,partida.idPartida,partida.palabra);
												});
												
												celdaBoton.appendChild(boton);
												filaProducto.appendChild(celdaBoton);

											tabla.appendChild(filaProducto);
										});
								  }
							  }
							  
							  	function continuarPartida(cantErrores, letrasAcertadas, letrasErradas, tiempo, idPartida , palabra) {
			
								  localStorage.setItem('globalCantErrores', cantErrores);
								  localStorage.setItem('globalLetrasAcertadas', letrasAcertadas);
								  localStorage.setItem('globalLetrasErradas', letrasErradas);
								  localStorage.setItem('globalTiempo', tiempo);
								  localStorage.setItem('globalIdPartida', idPartida);
								  localStorage.setItem('globalBandera', true);
								  localStorage.setItem('globalPalabra', palabra);
								  window.location.href = 'juego.php';

								}

	                        }
						
						seleccionarPartida();
					</script>
					
					<div class="grupo">
						<h1 id="titulo">Partidas Guardadas</h1>
		             	<table class="estilo-tabla">
							<tr>
							<td>Id Partida</td>
							<td>Cantidad de errores</td>
							<td>Letras acertadas</td>
							<td>Tiempo realizado</td>
							<td>Partida</td>
							</tr>
							<tbody id="tabla"></tbody>
						</table>
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