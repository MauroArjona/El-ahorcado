<?php
session_start();
if(isset($_SESSION['juego.php'])){?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Ahorcado</title>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="css/juegoEstilo.css">
 <script src="js/funciones.js"></script>
</head>
	<body>
		<section>
			<article>
				<header>
					<h1>Ahorcado</h1>
				</header>	
				<div id="reloj"></div>
					<main>
						<img id="imagen" src="img/img0.png" alt="Ahorcado" />
						<div>
							<p id="palabra_a_adivinar">
							</p>
							<button id="jugar">Comenzar</button>
							<button id="interrumpir">Seguir Luego</button>
							<button id="rendirse">Rendirse</button>
							<button id="arriesgar">Arriesgar</button>
							<button id="volver" onclick="volverPaginaInicial()">Volver</button>
							
							<script>
							//es para poder volver a la paginaInicial necesito usar la session para que no accedan de forma directa a la pagina
							function volverPaginaInicial() {
							  <?php $_SESSION['paginaInicial'] = true; ?>
							  window.location.href = 'paginaInicial.php';
							}
							</script>
			
							<input type="text" id="input_palabra" style="display: none;" />
							<button id="probar" style="display: none;">Probar</button>	
							<p id="resultado"></p>

							<div id="letras">
								<button>a</button>
								<button>b</button>
								<button>c</button>
								<button>d</button>
								<button>e</button>
								<button>f</button>
								<button>g</button>
								<button>h</button>
								<button>i</button>
								<button>j</button>
								<button>k</button>
								<button>l</button>
								<button>m</button>
								<button>n</button>
								<button>ñ</button>
								<button>o</button>
								<button>p</button>
								<button>q</button>
								<button>r</button>
								<button>s</button>
								<button>t</button>
								<button>u</button>
								<button>v</button>
								<button>w</button>
								<button>x</button>
								<button>y</button>
								<button>z</button>
							</div>
						</div>
					</main>
			</article>
		</section>
		    <script  src="js/juego.js"></script>
	</body>
</html>
<?php
}else{
	echo "No tienes permiso para acceder a esta pagina inicie sesion primero";
	header("refresh:3;url=../index.php");
}
?>