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
	function alta()
	{

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
			$stmt->bind_result($usuario_consulta,$contrasena_consulta,$tipo_consulta);
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