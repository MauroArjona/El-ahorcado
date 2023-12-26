<?php
session_start();
if(isset($_SESSION['mostrarRankingPersonal'])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Mostrar ranking personal</title>
<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<section>
		<article>
			<script>
				function verRanking() {
					var peticion = new XMLHttpRequest();
					peticion.open("GET", "obtenerRankingPersonal.php", true);
					peticion.onreadystatechange = verRankingPersonal;
					peticion.send(null);

					function verRankingPersonal() {
						if (peticion.readyState == 4 && peticion.status == 200) {
							var myObjeto = JSON.parse(peticion.responseText);
							var tabla = document.getElementById("tabla");
							tabla.innerHTML = "";
							
								var filaProducto = document.createElement("tr");

								var celdaCantidadErrores = document.createElement("td");
								celdaCantidadErrores.textContent = myObjeto.totalAdivinadas;
								filaProducto.appendChild(celdaCantidadErrores);

								var celdaTiempoMinimo = document.createElement("td");
								celdaTiempoMinimo.textContent = myObjeto.tiempoMinimo;
								filaProducto.appendChild(celdaTiempoMinimo);

								var celdaTiempoMaximo = document.createElement("td");
								celdaTiempoMaximo.textContent = myObjeto.tiempoMaximo;
								filaProducto.appendChild(celdaTiempoMaximo);

								tabla.appendChild(filaProducto);
						
						}
					}
				}
				
			verRanking();
			</script>
					
			<div class="grupo">
				<h1 id="titulo">Ranking Personal</h1>
		        <table class="estilo-tabla">
					<tr>
						<td>Palabras adivinadas</td>
						<td>Tiempo Mínimo</td>
						<td>Tiempo Máximo</td>
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
