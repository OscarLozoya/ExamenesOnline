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
	function conectar()
	{

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
		//$this->driver->close();
		return $result;
	}

	function vista()
	{

	}

	function buscar($ID,$Nombre,$Categoria)
	{
		$array=null;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT e.ID,e.Nombre, c.Nombre, e.Duracion, e.Num_Preguntas,e.Calificacion_Min 
			FROM Examen e INNER JOIN Categoria c 
			on e.ID = ? OR e.Nombre like ? AND c.Nombre=? and c.ID=e.ID_Categoria"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$Nombre = $this->driver->real_escape_string($Nombre);
			$Categoria = $this->driver->real_escape_string($Categoria);
			$parametroNombre='%'.$Nombre.'%';
			$stmt->bind_param("iss",$ID,$parametroNombre,$Categoria);
			$stmt->execute();
			$stmt->bind_result($ID_Examen,$Nombre_Examen,$Nombre_Categoria,$Duracion,$Num_Preguntas,$Calificacion_Min);
			while ($stmt->fetch()) {
				$array[]= array(
							'ID' => $ID_Examen,
							'Nombre' => $Nombre_Examen,
							'Categoria' => $Nombre_Categoria,
							'Duracion' => $Duracion,
							'Preguntas' => $Num_Preguntas,
							'Calificacion' => $Calificacion_Min);
			}
			$stmt->close();
		}
		//$this->driver->close();
		return $array;
	}

	function obtenerCategorias()
	{
		$array = null;
		if($this->driver->connect_errno)
			return false;
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
		//$this->driver->close();
		return $array;
	}
}
?>