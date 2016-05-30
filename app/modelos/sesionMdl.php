<?php 

/**
* 
*/
class sesionMdl
{
	private $driver;
	function __construct()
	{
		include('datos_conexion.inc.php');
		$this->driver = new mysqli($servidor,$usuario,$pass,$bd);
	}

	function ExamenesPendientes()
	{
		$array = null;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT e.ID,c.Nombre,e.Nombre,e.Num_Preguntas,e.Duracion 
											FROM Categoria c INNER JOIN Examen e on e.ID_Categoria=c.ID INNER JOIN Resultado_Examen r on r.ID_Examen=e.ID
											WHERE r.Calificacion=-1 AND r.Usuario=?"))
		{
			$usuario = $_SESSION['usuario'];
			$usuario = $this->driver->real_escape_string($usuario);
			$stmt->bind_param("s",$usuario);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($ID,$NombreCategoria,$NombreExamen,$Num_Preguntas,$Tiempo);
			while($stmt->fetch())
			{
				$array[] = array('ID_Examen' => $ID,
								'Categoria' => $NombreCategoria,
								'Examen' => $NombreExamen,
								'Num_Preguntas' =>	$Num_Preguntas,
								'Tiempo' => $Tiempo);
			}
			$stmt->close();
		}
		return $array;
	}

	function respuestasPendientesRevisar()
	{
		$array = null;
		if($this->driver->connect_errno)
			return false;
		if($stmt = $this->driver->prepare("SELECT r.Usuario,r.ID_Examen,r.ID_Pregunta,r.Respuesta,p.Descripcion
											FROM Detalle_Pregunta_Examen r INNER JOIN Pregunta p ON r.ID_Pregunta=p.ID
											WHERE r.Resultado=-1"))
		{
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($usuario,$ID_Examen,$ID_Pregunta,$Respuesta,$Descripcion);
			while ($stmt->fetch()) {
				$array[] = array('usuario' => $usuario,
								'ID_Examen' => $ID_Examen,
								'ID_Pregunta' => $ID_Pregunta,
								'Respuesta' => $Respuesta,
								'Descripcion' => $Descripcion);
			}
		}
		return $array;
	}
}

 ?>