<?php 

/**
* 
*/
class usuarioMdl
{
	private $driver;
	function __construct()
	{
		include_once('datos_conexion.inc.php');
		$this->driver=new mysqli($servidor,$usuario,$pass,$bd);
	}
	function alta($usuario, $correo, $token, $tipo, $estado)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("INSERT INTO Usuario VALUES(?,?,?,?,?)")) 
		{
			$token = $this->driver->real_escape_string($token); //Aegurarnos que el usuario no ingrese palabras reservadas
			$correo = $this->driver->real_escape_string($correo);
			$usuario = $this->driver->real_escape_string($usuario);
			$tipo = $this->driver->real_escape_string($tipo);
			$estado = $this->driver->real_escape_string($estado);
			$stmt->bind_param("sssii",$usuario,$correo,$token,$tipo,$estado); 
			if($stmt->execute())
			$stmt->close();
		}
	}
	function registrar()
	{

	}
	function baja()
	{

	}
	function mostrarPerfil()
	{
		
	}
	function cambioContrasena()
	{
		
	}
	function completarRegistro()
	{
		
	}
	function eventosProximos()
	{
		
	}
	function detalleExamen()
	{
		
	}
	function ingresar($usuario,$contrasena)
	{
		$existe=false;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT * FROM Usuario WHERE Usuario=? and Contrasena=?")) 
		{
			$usuario = $this->driver->real_escape_string($usuario);
			$contrasena = $this->driver->real_escape_string($contrasena);
			$stmt->bind_param("ss",$usuario,$contrasena);
			$stmt->execute();
			$stmt->bind_result($usuario_consulta,$correo_consulta,$contrasena_consulta,$tipo_consulta,$status_consulta);
			while ($stmt->fetch()) {
				$_SESSION['usuario'] = $usuario_consulta;
				$_SESSION['tipo'] = $tipo_consulta;
				$existe = true;
			}
			$stmt->close();
		}
		return $existe;

	}
}
?>