<?php
require_once 'config.php';

class usuario {
	
	private $idUsuario;
	private $nombre;
	private $correo;
	private $contrasena;
	private $fechaNacimiento;
	private $paisResidencia;

	
	public function __construct(){
		
	}
	
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getCorreo(){
		return $this->correo;
	}
	
	public function setCorreo($correo){
		$this->correo = $correo;
	}
	public function getContrasena(){
		return $this->contrasena;
	}
	
	public function setContrasena($contrasena){
        $this->contrasena = $contrasena;
    }
	
		
	public function getFechaNacimiento(){
		return $this->fechaNacimiento;
	}
	
	public function setFechaNacimiento($fechaNacimiento){
		$this->fechaNacimiento = $fechaNacimiento;
	}
		
	public function getPaisResidencia(){
		return $this->paisResidencia;
	}
	
	public function setPaisResidencia($paisResidencia){
		$this->paisResidencia = $paisResidencia;
	}

	 
	public function RegistrarUsuario() {
		session_start();
		$conexion = conectarBD();
		$nombre = $conexion->real_escape_string($this->nombre);
		$correo = $conexion->real_escape_string($this->correo);
		$contrasena = $conexion->real_escape_string($this->contrasena);
		$fechaNacimiento = $conexion->real_escape_string($this->fechaNacimiento);
		$paisResidencia = $conexion->real_escape_string($this->paisResidencia);

		// Valido el nombre
		$nombreValido = $this->validarNombre($nombre,$paisResidencia);

		// Verificar si el nombre es válido
		if ($nombreValido) {
			$consulta = "INSERT INTO usuario (nombre, correo, contrasena, fechaNacimiento, paisResidencia) VALUES ('$nombre', '$correo', '$contrasena', '$fechaNacimiento', '$paisResidencia')";
			try {
				// Ejecutar la consulta
				$resultado = $conexion->query($consulta);

				// Cerrar la conexión
				$conexion->close();

				// Devuelve true si se realizó la inserción correctamente sino false
				return $resultado ? true : false;
			} catch (mysqli_sql_exception $e) {
				// Capturar la excepción de duplicidad del nombre o el correo y devuelve false
				if ($e->getCode() == 1062) {
					$error = "ERROR ! El nombre de usuario o correo ya existe escriba nuevamente";
					$_SESSION['error'] = $error;
					return false;
					
				} else {
					// Manejar otros errores o mostrar el mensaje de error
					echo "Error: " . $e->getMessage();
					return false;
				}
			}
		} else {
			// El nombre no es válido, retornar false
			$error = "ERROR! El nombre de usuario tiene  menos de 8 caracteres o contiene caracteres especiales. O el país contiene caracteres especiales o números.";
			$_SESSION['error'] = $error;
			return false;
		}
	}
	
		public function validarNombre($nombre, $pais) {
		// Patrón de expresión regular para verificar el nombre
		$patronNombre = "/^[a-zA-Z0-9]{8,}$/";
		// Patrón de expresión regular para verificar el país
		$patronPais = "/^[a-zA-Z]+$/";
		if (preg_match($patronNombre, $nombre) && preg_match($patronPais, $pais)) {
			return true; // El nombre y el país son válidos
		} else {
			return false; // El nombre o el país no son válidos
		}
	}

		public static function VerificarUsuario($nombre, $contrasena) {
		$conexion = conectarBD();
		$nombre = $conexion->real_escape_string($nombre);
		$consulta = "SELECT * FROM usuario WHERE nombre = '$nombre'";
		$listado = $conexion->query($consulta) or die("No se pudo realizar la consulta");
		if ($registro = $listado->fetch_object()) {
			$usuario = new usuario();
			$usuario->setIdUsuario($registro->idUsuario); //para obtener el id al querer guardar una partida
			$usuario->setNombre($registro->nombre);
			$usuario->setContrasena($registro->contrasena);
		} else {
			$usuario = null; // Usuario no encontrado
		}

		$listado->free();
		$conexion->close();

		return $usuario;
	}
}
?>

