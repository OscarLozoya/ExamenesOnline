<?php 
/**
* 
*/
class PreguntaMdl
{
	private $driver;	
	function __construct()
	{
		include_once('datos_conexion.inc.php');
		$this->driver=new mysqli($servidor,$usuario,$pass,$bd);
	}

	/**
	 *Obtiene todas las categorias que estan en la base de datos
	 *@return array
	*/
	function obtenerCategorias()
	{
		$array = null;
		if($this->driver->connect_errno)
			return false;
		if($stmt=$this->driver->prepare("SELECT ID,Nombre FROM Categoria"))
		{
			$stmt->execute();
			$stmt->bind_result($ID,$Nombre);
			while($stmt->fetch())
			{
				$array[] = array('ID' => $ID, 
								'Nombre' => $Nombre);
			}
			$stmt->close();
		}
		//$this->driver->close();
		return $array;
	}

	function agregar($pregunta,$categorias,$respuesta)
	{
		$Tipo = 1;
		if($stmt = $this->driver->prepare("INSERT INTO Pregunta (Descripcion,Tipo) VALUES (?,?)"))
		{
			if($respuesta == 'Abierta')
				$Tipo = 0;
			$Tipo = $this->driver->real_escape_string($Tipo);
			$pregunta = $this->driver->real_escape_string($pregunta);
			$stmt->bind_param('si',$pregunta,$Tipo);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->close();
		}
		else
			return $stmt->error;

		$Id_Pregunta = $this->driver->insert_id;
		$ID_Categorias = explode(',', $categorias);
		foreach ($ID_Categorias as $categoria) {
			if($categoria!='')
			{
				if($stmt = $this->driver->prepare("INSERT INTO Pregunta_Categoria (Id_Pregunta,Id_Categoria) VALUES (?,?)"))
				{
					$Id_Pregunta = $this->driver->real_escape_string($Id_Pregunta);
					$categoria = $this->driver->real_escape_string($categoria);
					$stmt->bind_param("ii",$Id_Pregunta,$categoria);
					if(!$stmt->execute())
						return $stmt->error;
					$stmt->close();
				}
				else
					return $stmt->error;
			}
		}

		if($respuesta != 'Abierta')
		{
			$Respuestas = explode(',', $respuesta);
			foreach ($Respuestas as $inciso) {
				if($inciso!='')
				{
					$incisoRespuesta = explode('|', $inciso);
					if($stmt = $this->driver->prepare("INSERT INTO Detalle_Pregunta (ID_Pregunta,Descripcion,Respuesta) VALUES (?,?,?)"))
					{
						$Id_Pregunta = $this->driver->real_escape_string($Id_Pregunta);
						$incisoRespuesta[0] =  $this->driver->real_escape_string($incisoRespuesta[0]);
						$incisoRespuesta[1] =  $this->driver->real_escape_string($incisoRespuesta[1]);
						$stmt->bind_param("isi",$Id_Pregunta,$incisoRespuesta[0],$incisoRespuesta[1]);
						if(!$stmt->execute())
							return $stmt->error;
						$stmt->close();
					}
					else
						return $stmt->error;
				}
			}
		}
		return True;
	}

	function buscar($ID,$Pregunta,$Categoria)
	{
		$array=null;
		if($this->driver->connect_errno)
			return $this->driver->connect_error;

		if($stmt = $this->driver->prepare("SELECT p.ID, p.Descripcion, c.Nombre  
										FROM Pregunta p
										INNER JOIN Pregunta_Categoria pc ON p.ID = pc.Id_pregunta
										INNER JOIN Categoria c ON c.ID = pc.Id_categoria
										WHERE p.ID = ?  OR p.Descripcion like ? OR c.Nombre = ?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$Pregunta = $this->driver->real_escape_string($Pregunta);
			$Categoria = $this->driver->real_escape_string($Categoria);
			$parametroPregunta = '%'.$Pregunta.'%';
			$stmt->bind_param('iss',$ID,$parametroPregunta,$Categoria);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($ID_Pregunta,$Descripcion,$Nombre);
			while ($stmt->fetch()) {
				$array[] = array('ID' => $ID_Pregunta,
								'Descripcion' => $Descripcion,
								'Categoria' => $Nombre);
			}
			$stmt->close();
		}
		else
			return "error";
		

		return $array;
	}

	function eliminar($ID)
	{
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		//Spliteamos el string
		$arrayID = explode(',', $ID);
		//por cada id ejecutamos el query de eliminar
		foreach ($arrayID as $id_eliminar) {
			//si el ID no esta vacio, ya que se concatena 1,2, quedaria un indice vacio
			if($id_eliminar != ''){
				if($stmt=$this->driver->prepare("DELETE FROM Pregunta WHERE ID=?"))
				{
					$id_eliminar = $this->driver->real_escape_string($id_eliminar);
					$stmt->bind_param("i",$id_eliminar);
					//si  hubo un error lo regresa
					if(!$stmt->execute())
						return $stmt->error;
					$stmt->close();
				}
				else
					return $stmt->error;
			}
		}
		
		//Si todo se ejecuto bien regresamos true
		return True;
	}
	function obtenerPregunta($ID)
	{
		$array = null;
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		if($stmt = $this->driver->prepare("SELECT * FROM Pregunta WHERE ID=?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$stmt->bind_param('i',$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($ID_Pregunta,$Descripcion,$Tipo);
			while($stmt->fetch())
			{
				$array[] = array('ID' => $ID_Pregunta,
								'Descripcion' => $Descripcion,
								'Tipo' => $Tipo);
			}
			$stmt->close();
		}
		else
			return $stmt->error;
		return $array;
	}
	function categoriasPregunta($ID)
	{
		$array = null;
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		if($stmt = $this->driver->prepare('SELECT c.Nombre,c.ID 
										FROM Categoria c INNER JOIN Pregunta_Categoria pc
										ON c.ID=pc.Id_Categoria
										WHERE pc.Id_Pregunta=?'))
		{
			$ID = $this->driver->real_escape_string($ID);
			$stmt->bind_param("i",$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($Nombre,$Id_Categoria);
			while ($stmt->fetch()) {
				$array[] = array('Nombre' => $Nombre,
								'ID' =>  $Id_Categoria);
			}
			$stmt->close();
		}
		else
			return $stmt->error;
		return $array;
	}
	function respuestasPregunta($ID)
	{
		$array = null;
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		if($stmt = $this->driver->prepare("SELECT r.Descripcion,r.Respuesta
										FROM Detalle_Pregunta r INNER JOIN Pregunta p
										ON r.ID_Pregunta=p.ID
										WHERE r.ID_Pregunta=?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$stmt->bind_param("i",$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->bind_result($Descripcion,$Respuesta);
			while($stmt->fetch())
			{
				$array[] = array('Descripcion' => $Descripcion,
								'Respuesta' => $Respuesta);
			}
			$stmt->close();
		}
		else
			return $stmt->error;
		return $array;
	}

	function modificarPregunta($ID,$Pregunta,$Categorias,$Respuestas)
	{
		$Tipo = 1;
		if($this->driver->connect_errno)
			return $this->driver->connect_error;
		if($stmt = $this->driver->prepare("UPDATE Pregunta SET 
											Descripcion=?, Tipo=?
											WHERE ID=?"))
		{
			if($Respuestas == 'Abierta')
				$Tipo = 0;
			$ID = $this->driver->real_escape_string($ID);
			$Pregunta = $this->driver->real_escape_string($Pregunta);
			$Tipo = $this->driver->real_escape_string($Tipo);
			$stmt->bind_param("sii",$Pregunta,$Tipo,$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->close();
		}

		if($stmt = $this->driver->prepare("DELETE FROM Pregunta_Categoria WHERE Id_Pregunta=?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$stmt->bind_param("i",$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->close();
		}
		$ID_Categorias = explode(',', $Categorias);
		foreach ($ID_Categorias as $categoria) {
			if($categoria!='')
			{
				if($stmt = $this->driver->prepare("INSERT INTO Pregunta_Categoria (Id_Pregunta,Id_Categoria) VALUES (?,?)"))
				{
					$ID = $this->driver->real_escape_string($ID);
					$categoria = $this->driver->real_escape_string($categoria);
					$stmt->bind_param("ii",$ID,$categoria);
					if(!$stmt->execute())
						return $stmt->error;
					$stmt->close();
				}
				else
					return $stmt->error;
			}
		}

		if($stmt = $this->driver->prepare("DELETE FROM Detalle_Pregunta WHERE ID_Pregunta=?"))
		{
			$ID = $this->driver->real_escape_string($ID);
			$stmt->bind_param("i",$ID);
			if(!$stmt->execute())
				return $stmt->error;
			$stmt->close();
		}
		if($Respuestas != 'Abierta')
		{
			$Opciones = explode(',', $Respuestas);
			foreach ($Opciones as $inciso) {
				if($inciso!='')
				{
					$incisoRespuesta = explode('|', $inciso);
					if($stmt = $this->driver->prepare("INSERT INTO Detalle_Pregunta (ID_Pregunta,Descripcion,Respuesta) VALUES (?,?,?)"))
					{
						$ID = $this->driver->real_escape_string($ID);
						$incisoRespuesta[0] =  $this->driver->real_escape_string($incisoRespuesta[0]);
						$incisoRespuesta[1] =  $this->driver->real_escape_string($incisoRespuesta[1]);
						$stmt->bind_param("isi",$ID,$incisoRespuesta[0],$incisoRespuesta[1]);
						if(!$stmt->execute())
							return $stmt->error;
						$stmt->close();
					}
					else
						return $stmt->error;
				}
			}

		}
		return True;
	}
}
 ?>