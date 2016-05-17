<?php 

/**
* 
*/
class ExamenMdl
{
	private $driver;
	function __construct()
	{
		include_once('datos_conexion.inc.php');
		$this->driver=new mysqli($servidor,$usuario,$pass,$bd);
	}

	function crear()
	{

	}

	function modificar()
	{

	}

	function eliminar($ID)
	{
		if($this->driver->connect_errno)
			return false;
		if($stmt=$this->driver->prepare("DELETE FROM Examen WHERE ID=?"))
		{
			$ID=$driver->real_escape_string($ID);
			$stmt->bind_param("i",$ID);
			$stmt->execute();
			$stmt->bind_result($result);
			$stmt->fetch();
			$stmt->close();
		}
		$this->driver->close();
		return $result;
	}

	function vista()
	{

	}

	function buscar()
	{
		if($this->driver->connect_errno)
			return false;
		//if($stmt=$driver->prepare("SELECT * FROM Examen WHERE ID=? AND Nombre=? AND ID_Categoria=?"))
	}

	function obtenerCategorias()
	{
		$array = null;
		if($this->driver->connect_errno)
			die("Fallo la conexion");
		if($stmt=$this->driver->prepare("SELECT Nombre FROM Categoria"))
		{
			$stmt->execute();
			$stmt->bind_result($Nombre);
			while($stmt->fetch())
			{
				$array[] = $Nombre;
			}
			$stmt->close();
		}
		$this->driver->close();
		return $array;
	}
}
?>