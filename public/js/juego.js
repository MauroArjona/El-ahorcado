let palabrita;
let gano = false;
let terminoPartida = false;
let cant_errores = 0; //cuantas veces me equivoqué
let cant_aciertos = 0; //cuantas letras acerté
let bandera = false;
let tiempoTranscurrido = 0; // tiempo transcurrido en segundos
let tiempoFormateado = 0;
let cronometroInterval; 
let letrasAcertadas;
let BanderaGlobal;
let letrasErradas = "";

const btnComenzar = id('jugar');
const btnSeguirLuego = id('interrumpir');
const btnVolver = id('volver');
const btnRendirse = id('rendirse');
const btnArriesgar = id('arriesgar');
const btnProbar = id("probar");
const imagen = id( 'imagen' );
const btn_letras = document.querySelectorAll( "#letras button" );
const cronometro = id('reloj');


//************** click y guarda la partida para continuarla en otro momento **********************
btnSeguirLuego.addEventListener('click', seguirLuego);

function seguirLuego(){
  bandera = true;
  game_over();
  const spans = document.querySelectorAll('#palabra_a_adivinar span');
  const letrasAcertadas = Array.from(spans).map(span => span.innerHTML).join('');

  const peticion = new XMLHttpRequest();
  if(BanderaGlobal === "false"){
	peticion.open("GET", `guardarPartida.php?palabrita=${encodeURIComponent(palabrita)}&tiempoTranscurrido=${encodeURIComponent(tiempoFormateado)}&cant_errores=${cant_errores}&letrasAcertadas=${encodeURIComponent(letrasAcertadas)}&letrasErradas=${encodeURIComponent(letrasErradas)}`, true);
  }else{
	const globalIdPartida = localStorage.getItem('globalIdPartida');
	peticion.open("GET", `actualizarPartida.php?idPartida=${encodeURIComponent(globalIdPartida)}&palabrita=${encodeURIComponent(palabrita)}&tiempoTranscurrido=${encodeURIComponent(tiempoFormateado)}&cant_errores=${cant_errores}&letrasAcertadas=${encodeURIComponent(letrasAcertadas)}&letrasErradas=${encodeURIComponent(letrasErradas)}`, true);  
  }
  peticion.send(null);
}

//****************** click y se arriesga poniendo la palabra ********************
btnArriesgar.addEventListener('click', arriesgar);

function arriesgar(){
  game_over();
  id('input_palabra').style.display = "block";
  id('input_palabra').focus();
  
  var boton = document.getElementById("probar");
      boton.style.display = "block";
}

// click comprueba  la palabra ingresada con la cual va a arriesgar 
btnProbar.addEventListener('click', probar);

function probar(){
  const palabraIngresada = id('input_palabra').value.toLowerCase();
	  if (palabraIngresada === palabrita) {
		  gano = true;
		  id('resultado').innerHTML = "GANASTE!! FELICIDADES";
      }else {
		  id('resultado').innerHTML = "Perdiste, la palabra era " + palabrita;
		  cant_errores = 10;
		  const source = `img/img${cant_errores}.png` ;
          imagen.src = source;
	  }
	  
	  btnProbar.disabled = true;
	  terminoPartida = true;
	  game_over();
	  
	   // Redirigir después de 3 segundos a la tabla de ranking de jugadores
	  setTimeout(function() {
		window.location.href = "mostrarRankingJugadores.php";
	  }, 3000);
}

//************************* click y se rinde ********************************
btnRendirse.addEventListener('click', rendirse);

function rendirse(){
   id('resultado').innerHTML ="Te rendiste!!, la palabra era " + palabrita;
		cant_errores = 10;
		const source = `img/img${cant_errores}.png` ;
        imagen.src = source;
		bandera = true;
		terminoPartida = true;
        game_over( );	
}

//********************* click inicia juego ********************************
btnComenzar.addEventListener('click', iniciar );

function iniciar(event){
	
	 BanderaGlobal = localStorage.getItem('globalBandera');
	 //si toco continuar una partida entonces BanderaGlobal es true por lo que se cargaran los datos de esa partida
	if(BanderaGlobal === "true"){
		// Obtener los valores de la partida que quiere continuar
		const globalCantErrores = localStorage.getItem('globalCantErrores');
		 letrasAcertadas = localStorage.getItem('globalLetrasAcertadas');
		 letrasErradas = localStorage.getItem('globalLetrasErradas');
		const globalTiempo = localStorage.getItem('globalTiempo');
		const globalPalabra = localStorage.getItem('globalPalabra');
		console.log("letra acertada"+letrasAcertadas);
		//pongo el tiempo en el minuto y segundo que se halla quedado o solo segundos.
		const tiempoSplit = globalTiempo.split(':');
		const minutos = parseInt(tiempoSplit[0], 10); 
		const segundos = parseInt(tiempoSplit[1], 10);
		tiempoTranscurrido = minutos * 60 + segundos;
		//obtengo la cantidad de letras acertadas
		var letrasArray = letrasAcertadas.replace(/\s/g, '').split(',');
		var cantidadLetras = letrasArray.filter(letra => letra !== '').length;
		console.log("letra acertada array"+cantidadLetras);
		imagen.src = 'img/img' + globalCantErrores + '.png'; //cargo la imagen en la que se quedo
		cant_errores = globalCantErrores; // cargo los errore que tuvo
		cant_aciertos = cantidadLetras;  // cargo los aciertos que tuvo
		palabrita = globalPalabra;  // cargo la palabra que tenia que adivinar
		cronometro.innerHTML = 'Tiempo: Minutos '+tiempoTranscurrido+' segundos'; //cargo el tiempo como lo dejo en la anterior partida
		
		//elimino las variables del localStorange
		localStorage.removeItem('globalCantErrores');
		localStorage.removeItem('globalLetrasAcertadas');
		localStorage.removeItem('globalLetrasErradas');
		localStorage.removeItem('globalTiempo');
		localStorage.removeItem('globalPalabra');
		
	}else{
		//inicia una partida nueva "no toco continuar partida"
		imagen.src = 'img/img0.png';
		cant_errores = 0;
		cant_aciertos = 0; 
		tiempoTranscurrido = 0;  
		cronometro.innerHTML = 'Tiempo: 0 segundos';
		palabrita = localStorage.getItem('palabra');
	}
		
		btnComenzar.disabled = true;
		btnRendirse.disabled = false;
		btnArriesgar.disabled = false;	
		btnSeguirLuego.disabled = false;
		const parrafo = id( 'palabra_a_adivinar' ); 
		parrafo.innerHTML = ''; 
		const cant_letras = palabrita.length;

		//habilito todas las letras
		for( let i = 0; i < btn_letras.length ; i++ ){
			btn_letras[ i ].disabled = false;
		}
		//creo un span para cada letra de la palabra a adivinar
		for( let i = 0; i < cant_letras; i++ ){
			const span = document.createElement( 'span' );
			parrafo.appendChild( span );
		}
		
	/////// cargo los spans con las letras que acerto cuando guardo la partida solo si es una partida que va a continuar ////////
		if(BanderaGlobal === "true"){
		
			const spans = document.querySelectorAll('#palabra_a_adivinar span');
			// Convierto las letras acertadas y las no acertadas en un array
			const letrasAcertadasArray = letrasAcertadas.split(',');
			const letrasErradasArray = letrasErradas.split(',');
			
			// Recorro cada letra acertada
			for (let i = 0; i < letrasAcertadasArray.length; i++) {
			  const letraAcertada = letrasAcertadasArray[i];
			  //deshabilito las letras que unicamente acerte
			  for( let i = 0; i < btn_letras.length ; i++ ){
				  if(letraAcertada == btn_letras[ i ].textContent){
					btn_letras[ i ].disabled = true;
				  }
				}
			  // Recorro la palabra para buscar coincidencias
			  for (let j = 0; j < palabrita.length; j++) {
				const letraPalabra = palabrita[j];
				// Si la letra acertada coincide con la letra de la palabra la asigno al span correspondiente
				if (letraAcertada === letraPalabra) {
				  spans[j].innerHTML = letraAcertada;
				}
			  }
			}
			//deshabilito las letras que erre anteriormente
			for (let i = 0; i < letrasErradasArray.length; i++) {
				  const letraErrada = letrasErradasArray[i];
				  
				 for( let i = 0; i < btn_letras.length ; i++ ){
				  if(letraErrada == btn_letras[ i ].textContent){
					btn_letras[ i ].disabled = true;
				  }
				}
			}
		}
		// Inicio cronómetro
		cronometroInterval = setInterval(actualizarCronometro, 1000);
	
}

   //actualizo el tiempo
function actualizarCronometro() { 
    tiempoTranscurrido++;
    const minutos = Math.floor(tiempoTranscurrido / 60).toString().padStart(2, '0');
    const segundos = (tiempoTranscurrido % 60).toString().padStart(2, '0');
    tiempoFormateado = `${minutos}:${segundos}`;
    cronometro.innerHTML = 'Tiempo: Minutos ' + tiempoFormateado + " Segundos";

}

/* agrego un click a cada boton para que llame a la funcion */
for( let i = 0; i < btn_letras.length ; i++ ){
    btn_letras[ i ].addEventListener( 'click', click_letras );
}

function click_letras(event){
    spans = document.querySelectorAll( '#palabra_a_adivinar span' ); //traigo todos los span creados
    const button = event.target; //cuál de todas las letras, llamó a la función.
    button.disabled = true;

    const letra = button.innerHTML.toLowerCase( );
    const palabra = palabrita.toLowerCase( ); // paso a minusculas la palabra para que sea compatible.

    let acerto = false;
    for( let i = 0; i < palabra.length;  i++ ){
        if( letra == palabra[i] ){
            //la variable i es la posición de la letra en la palabra.
            //que coincide con el span al que tenemos que mostarle esta letra...
            spans[i].innerHTML = letra;
            cant_aciertos++;
            acerto = true;
        }
    }

    if( acerto == false ){
		letrasErradas+=letra+",";
        cant_errores++;
        const source = `img/img${cant_errores}.png` ;
        imagen.src = source;
    }

    if( cant_errores == 10 ){
        id('resultado').innerHTML ="Perdiste, la palabra era " + palabrita;
		bandera = true;
		terminoPartida = true;
        game_over( );
    }else if( cant_aciertos == palabrita.length ){
        id('resultado').innerHTML = "GANASTE!! FELICIDADES";
		bandera = true;
		terminoPartida = true;
		gano = true;
        game_over( );
    }
    //console.log( "la letra " + letra + " en la palabra " + palabra + " ¿existe?: " + acerto );//cuando quiera saber que palabra es descomento aca
}


/************* fin del juego ****************/
function game_over( ){
	clearInterval(cronometroInterval); // Detener el cronómetro////////////////////
	
    for( let i = 0; i < btn_letras.length ; i++ ){
        btn_letras[ i ].disabled = true;
    }
	btnSeguirLuego.disabled = true;
	btnVolver.disabled = true;
	btnRendirse.disabled = true;
	btnArriesgar.disabled = true;
	
	if(bandera == true){
	btnVolver.disabled = false;	
	}
	
	//guardo el ranking solo si gana la partida
	if(gano == true){
		const peticion = new XMLHttpRequest();
		peticion.open("GET", `guardarEstadisticas.php?tiempoTranscurrido=${encodeURIComponent(tiempoFormateado)}&palabrita=${encodeURIComponent(palabrita)}`, true);
	    peticion.send(null);
	}
	
	//si es una partida que guardo anteriormente la elimino de la base de datos por que perdio , gano o se rindio
	if(BanderaGlobal === "true" && terminoPartida == true){
		const peticion = new XMLHttpRequest();
		const globalIdPartida = localStorage.getItem('globalIdPartida');
		peticion.open("GET", `borrarPartida.php?idPartida=${encodeURIComponent(globalIdPartida)}`, true);  
		localStorage.removeItem('globalIdPartida');
		peticion.send(null);
	}
}

game_over( );